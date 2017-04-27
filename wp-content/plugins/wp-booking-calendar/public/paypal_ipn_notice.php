<?php 
include 'common.php';
$reservationsList = urldecode($_POST["custom"]);
$orderResult = 0;

// Build the required acknowledgement message out of the notification just received
  $req = 'cmd=_notify-validate';               // Add 'cmd=_notify-validate' to beginning of the acknowledgement

  foreach ($_POST as $key => $value) {         // Loop through the notification NV pairs
    $value = urlencode(stripslashes($value));  // Encode these values
    $req  .= "&$key=$value";                   // Add the NV pairs to the acknowledgement
  }
  
   // Set up the acknowledgement request headers
  $header  = "POST /cgi-bin/webscr HTTP/1.1\r\n";                    // HTTP POST request
  $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
  $header .= "Host: www.paypal.com\r\n";
  $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

  // Open a socket for the acknowledgement request
  $fp = fsockopen('ssl://www.paypal.com', 443, $errno, $errstr, 30);

  // Send the HTTP POST request back to PayPal for validation
  fputs($fp, $header . $req);
  
   while (!feof($fp)) {                     // While not EOF
    $res = fgets($fp, 1024);   
	
	
	              // Get the acknowledgement response
    if (strcmp (trim($res), "VERIFIED") == 0) {  // Response contains VERIFIED - process notification
		$orderResult = 1;
		if($bookingSettingObj->getPaypal() == 1 && $bookingSettingObj->getReservationAfterPayment() == 1) {
			$reservationsArray = explode(",",$reservationsList);
			$slotsArray = Array();
			for($i=0;$i<count($reservationsArray);$i++) {
				$bookingReservationObj->setReservationByMD5($reservationsArray[$i]);
				$calendar_id = $bookingReservationObj->getReservationCalendarId();
				array_push($slotsArray,$bookingReservationObj->getReservationSlotId());
			}
			//check if reservations are already unfaked
			
				
				
			//send email to administrator to confirm the reservation
			$bookingCalendarObj->setCalendar($calendar_id);
			if($bookingCalendarObj->getCalendarEmail() != '') {
				$to = $bookingCalendarObj->getCalendarEmail();
			} else {
				$to = $bookingSettingObj->getEmailReservation();
			}
			
			$headers  = "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=UTF-8\n";
			$headers .= "From: ".$bookingSettingObj->getNameFromReservation()." <".$bookingSettingObj->getEmailFromReservation().">\n" . "Reply-To: ".$bookingSettingObj->getEmailFromReservation()."\n";
			$subject = __( 'New reservation', 'wp-booking-calendar' );
			$message=__( 'Reservation data below.', 'wp-booking-calendar' )."<br>";
			
			if(in_array("reservation_name",$bookingSettingObj->getVisibleFields())) {
				$message.="<strong>".__( 'Name', 'wp-booking-calendar' )."</strong>: ".$bookingReservationObj->getReservationName()."<br>";
			}
			if(in_array("reservation_surname",$bookingSettingObj->getVisibleFields())) {
				$message.="<strong>".__( 'Surname', 'wp-booking-calendar' )."</strong>: ".$bookingReservationObj->getReservationSurname()."<br>";
			}
			if(in_array("reservation_email",$bookingSettingObj->getVisibleFields())) {
				$message.="<strong>".__( 'Email', 'wp-booking-calendar' )."</strong>: ".$bookingReservationObj->getReservationEmail()."<br>";
			}
			if(in_array("reservation_phone",$bookingSettingObj->getVisibleFields())) {
				$message.="<strong>".__( 'Phone', 'wp-booking-calendar' )."</strong>: ".$bookingReservationObj->getReservationPhone()."<br>";
			}
			
			if(in_array("reservation_message",$bookingSettingObj->getVisibleFields())) {
				$message.="<strong>".__( 'Message', 'wp-booking-calendar' )."</strong>: ".$bookingReservationObj->getReservationMessage()."<br>";
			}	
			if(in_array("reservation_field1",$bookingSettingObj->getVisibleFields())) {
				$message.="<strong>".__( 'Additional field 1', 'wp-booking-calendar' )."</strong>: ".$bookingReservationObj->getReservationField1()."<br>";
			}
			if(in_array("reservation_field2",$bookingSettingObj->getVisibleFields())) {
				$message.="<strong>".__( 'Additional field 2', 'wp-booking-calendar' )."</strong>: ".$bookingReservationObj->getReservationField2()."<br>";
			}
			if(in_array("reservation_field3",$bookingSettingObj->getVisibleFields())) {
				$message.="<strong>".__( 'Additional field 3', 'wp-booking-calendar' )."</strong>: ".$bookingReservationObj->getReservationField3()."<br>";
			}
			if(in_array("reservation_field4",$bookingSettingObj->getVisibleFields())) {
				$message.="<strong>".__( 'Additional field 4', 'wp-booking-calendar' )."</strong>: ".$bookingReservationObj->getReservationField4()."<br>";
			}
			$message.="<br><strong>".__( 'Slots reserved', 'wp-booking-calendar' )."</strong>:<br>";
			
			$message.="<ul type='disc'>";
			//loop through slots
			
			for($i=0;$i<count($slotsArray);$i++) {
				$bookingSlotsObj->setSlot($slotsArray[$i]);
				$bookingCalendarObj->setCalendar($calendar_id);
				$bookingReservationObj->setReservationByMD5($reservationsArray[$i]);
				
				$message.="<li>";
				$message.="<strong>".__( 'Calendar', 'wp-booking-calendar' )."</strong>: ".$bookingCalendarObj->getCalendarTitle()."<br>";
				$dateToSend = strftime('%B %d %Y',strtotime($bookingSlotsObj->getSlotDate()));
				if($bookingSettingObj->getDateFormat() == "UK") {
					$dateToSend = strftime('%d/%m/%Y',strtotime($bookingSlotsObj->getSlotDate()));
				} else if($bookingSettingObj->getDateFormat() == "EU") {
					$dateToSend = strftime('%Y/%m/%d',strtotime($bookingSlotsObj->getSlotDate()));
				} else {
					$dateToSend = strftime('%m/%d/%Y',strtotime($bookingSlotsObj->getSlotDate()));
				}
				$message.="<strong>".__( 'Date', 'wp-booking-calendar' )."</strong>: ".$dateToSend."<br>";
				if($bookingSettingObj->getTimeFormat() == "12") {
					$message.="<strong>".__( 'Time', 'wp-booking-calendar' )."</strong>: ".$bookingSlotsObj->getSlotTimeFromAMPM()."-".$bookingSlotsObj->getSlotTimeToAMPM()."<br>";
				} else {
					$message.="<strong>".__( 'Time', 'wp-booking-calendar' )."</strong>: ".$bookingSlotsObj->getSlotTimeFrom()."-".$bookingSlotsObj->getSlotTimeTo()."<br>";
				}
				if($bookingSettingObj->getSlotsUnlimited() == 2) {
					$message.="<strong>".__( 'Seats', 'wp-booking-calendar' )."</strong>: ".$bookingReservationObj->getReservationSeats()."<br>";
				}
				if($bookingSettingObj->getPaypalDisplayPrice() == 1) {
					$price= money_format('%!.2n',$bookingSlotsObj->getSlotPrice())."&nbsp;".$bookingSettingObj->getPaypalCurrency();			
					$message.="<strong>".__( 'Price', 'wp-booking-calendar' )."</strong>: ".$price."<br>";
				}
				$message.="</li>";
				
			}
			$message.="</ul>";
			if($bookingSettingObj->getReservationConfirmationMode() == 3) {
				
				$message.=__( 'All reservations must be confirmed in ', 'wp-booking-calendar' ).'<a href="'.site_url('wp-admin/admin.php?page=wp-booking-calendar-reservations').'">'.__( 'admin panel', 'wp-booking-calendar' ).'</a>';
			}
			//$headers = 'From: Booking Calendar <'.$bookingSettingObj->getEmailFromReservation().'>' . "\r\n";
			//mail($to, $subject, $message, $headers);
			wp_mail($to, $subject,$message, $headers );
			
			
			//send reservation email to user
			$to = $bookingReservationObj->getReservationEmail();
			$headers  = "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=UTF-8\n";
			$headers .= "From: ".$bookingSettingObj->getNameFromReservation()." <".$bookingSettingObj->getEmailFromReservation().">\n" . "Reply-To: ".$bookingSettingObj->getEmailFromReservation()."\n";
			//WARNING!! static mail record ids, if deleted/changed, must be changed here also
			switch($bookingSettingObj->getReservationConfirmationMode()) {
				case "1":
					$bookingMailObj->setMail(1);
					break;
				case "2":
					$bookingMailObj->setMail(2);
					break;
				case "3":
					$bookingMailObj->setMail(3);
					break;
			}
			if($bookingSettingObj->getPaypal()==1 && $bookingSettingObj->getPaypalAccount() != '' && $bookingSettingObj->getPaypalLocale() != '' && $bookingSettingObj->getPaypalCurrency() != '' && $bookingSettingObj->getReservationConfirmationModeOverride() == 1) {
				$bookingMailObj->setMail(1);
			}
			$subject = $bookingMailObj->getMailSubject();
			//setting username in message
			$message=str_replace("[customer-name]",$bookingReservationObj->getReservationName(),$bookingMailObj->getMailText());
			//check if cancellation is enabled id email is 1
			if($bookingMailObj->getMailId() == 1 && $bookingSettingObj->getReservationCancel() == "1") {
				$message.=$bookingMailObj->getMailCancelText();
			}
			//setting reservation detail in message
			//loop through slots
			$res_details = "";
			for($i=0;$i<count($slotsArray);$i++) {
				$bookingSlotsObj->setSlot($slotsArray[$i]);
				
				$res_details.="<strong>".__( 'Venue', 'wp-booking-calendar' )."</strong>: ".$bookingCalendarObj->getCalendarTitle()."<br>";
				$dateToSend = strftime('%B %d %Y',strtotime($bookingSlotsObj->getSlotDate()));
				if($bookingSettingObj->getDateFormat() == "UK") {
					$dateToSend = strftime('%d/%m/%Y',strtotime($bookingSlotsObj->getSlotDate()));
				} else if($bookingSettingObj->getDateFormat() == "EU") {
					$dateToSend = strftime('%Y/%m/%d',strtotime($bookingSlotsObj->getSlotDate()));
				} else {
					$dateToSend = strftime('%m/%d/%Y',strtotime($bookingSlotsObj->getSlotDate()));
				}
				$res_details.="<strong>".__( 'Date', 'wp-booking-calendar' )."</strong>: ".$dateToSend."<br>";
				if($bookingSlotsObj->getSlotSpecialMode() == 1) {
					if($bookingSettingObj->getTimeFormat() == "12") {
						$res_details.="<strong>".__( 'Time', 'wp-booking-calendar' )."</strong>: ".$bookingSlotsObj->getSlotTimeFromAMPM()."-".$bookingSlotsObj->getSlotTimeToAMPM();
					} else {
						$res_details.="<strong>".__( 'Time', 'wp-booking-calendar' )."</strong>: ".$bookingSlotsObj->getSlotTimeFrom()."-".$bookingSlotsObj->getSlotTimeTo();
					}
					if($bookingSlotsObj->getSlotSpecialText()!='') {
						$res_details.=" - ".$bookingSlotsObj->getSlotSpecialText();
					}
					$res_details.="<br>";
				} else if($bookingSlotsObj->getSlotSpecialMode() == 0 && $bookingSlotsObj->getSlotSpecialText() != '') {
					$res_details.="<strong>".__( 'Time', 'wp-booking-calendar' )."</strong>:".$bookingSlotsObj->getSlotSpecialText()."<br>";
				} else {
					if($bookingSettingObj->getTimeFormat() == "12") {
						$res_details.="<strong>".__( 'Time', 'wp-booking-calendar' )."</strong>: ".$bookingSlotsObj->getSlotTimeFromAMPM()."-".$bookingSlotsObj->getSlotTimeToAMPM()."<br>";
					} else {
						$res_details.="<strong>".__( 'Time', 'wp-booking-calendar' )."</strong>: ".$bookingSlotsObj->getSlotTimeFrom()."-".$bookingSlotsObj->getSlotTimeTo()."<br>";
					}
				}
				if($bookingSettingObj->getSlotsUnlimited() == 2) {
					$res_details.="<strong>".__( 'Seats', 'wp-booking-calendar' )."</strong>: ".$bookingReservationObj->getReservationSeats()."<br>";
				}
				if($bookingSettingObj->getPaypalDisplayPrice() == 1) {
					$price= money_format('%!.2n',$bookingSlotsObj->getSlotPrice())."&nbsp;".$bookingSettingObj->getPaypalCurrency();			
					$res_details.="<strong>".__( 'Price', 'wp-booking-calendar' )."</strong>: ".$price."<br>";
				}
				$res_details.="<br><br>";
				
			}
			$message=str_replace("[reservation-details]",$res_details,$message);	
			
			
			if($bookingMailObj->getMailId() == 2) {
				//setting reservation confirmation link in message
				//if he must confirm it via mail, I send the link
				$message=str_replace("[confirmation-link]","<a href='".site_url('')."/?p=".$bookingReservationObj->getReservationPostId()."&confirm=1&reservations=".$listReservations."'>".__( 'Click here to confirm your reservation', 'wp-booking-calendar' )."</a>",$message);
				$message=str_replace("[confirmation-link-url]",site_url('')."/?p=".$bookingReservationObj->getReservationPostId()."&confirm=1&reservations=".$listReservations,$message);
			}
			
			if($bookingMailObj->getMailId() == 1 && $bookingSettingObj->getReservationCancel() == "1") {
				$message=str_replace("[cancellation-link]","<a href='".site_url('')."/?p=".$bookingReservationObj->getReservationPostId()."&cancel=1&reservations=".$listReservations."'>".__( 'Click here to cancel your reservation', 'wp-booking-calendar' )."</a>",$message);
				$message=str_replace("[cancellation-link-url]",site_url('')."/?p=".$bookingReservationObj->getReservationPostId()."&cancel=1&reservations=".$listReservations,$message);
			}
			$message.="<br><br>".$bookingMailObj->getMailSignature();
			
			//$headers = 'From: Booking Calendar <'.$bookingSettingObj->getEmailFromReservation().'>' . "\r\n";
			//mail($to, $subject, $message, $headers);
			wp_mail($to, $subject,$message, $headers );
		
			$bookingReservationObj->unfakeReservations($reservationsList);
		}
		if($bookingSettingObj->getReservationConfirmationModeOverride() == 1) {
			$bookingReservationObj->confirmReservations($reservationsList);
		}
      // Send an email announcing the IPN message is VERIFIED
      /*$mail_From    = "IPN@example.com";
      $mail_To      = "d.romeo@wachipi.com";
      $mail_Subject = "VERIFIED IPN";
      $mail_Body    = $req."-".$reservationsList;
      mail($mail_To, $mail_Subject, $mail_Body, $mail_From);*/



      // Authentication protocol is complete - OK to process notification contents

      // Possible processing steps for a payment include the following:

      // Check that the payment_status is Completed
      // Check that txn_id has not been previously processed
      // Check that receiver_email is your Primary PayPal email
      // Check that payment_amount/payment_currency are correct
      // Process payment

    } 
    else if (strcmp (trim($res), "INVALID") == 0) { 
		$orderResult = 0;
		$bookingReservationObj->deleteReservations($reservationsList);
	//Response contains INVALID - reject notification

      // Authentication protocol is complete - begin error handling

      // Send an email announcing the IPN message is INVALID
      /*$mail_From    = "IPN@example.com";
      $mail_To      = "d.romeo@wachipi.com";
      $mail_Subject = "INVALID IPN";
      $mail_Body    = $req."-".$reservationsList;

      mail($mail_To, $mail_Subject, $mail_Body, $mail_From);*/
    }
  }
 

  
   fclose($fp);  // Close the file


/*if($orderResult == 1) {
	
	 //confirm reservation
	 $bookingReservationObj->confirmReservations($reservationsList);
	 $mail_From    = "IPN@example.com";
      $mail_To      = "d.romeo@wachipi.com";
      $mail_Subject = "IPN";
      $mail_Body    = "order result 1".mysql_error();

      mail($mail_To, $mail_Subject, $mail_Body, $mail_From);
 } else {
	 //if payment failed delete reservation to free slot
	 $bookingReservationObj->deleteReservations($reservationsList);
	 $mail_From    = "IPN@example.com";
      $mail_To      = "d.romeo@wachipi.com";
      $mail_Subject = "IPN";
      $mail_Body    = "order result 0".mysql_error();

      mail($mail_To, $mail_Subject, $mail_Body, $mail_From);
 }*/


?>