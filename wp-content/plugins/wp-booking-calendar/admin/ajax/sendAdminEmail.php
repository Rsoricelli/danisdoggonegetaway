<?php
include '../common.php';

global $current_user;
wp_get_current_user();


$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=UTF-8\n";
$headers .= "X-Priority: 5\n";
$headers .= "X-MSMail-Priority: Low\n";
$headers .= "X-Mailer: php\n";
$headers .= "From: Booking Calendar from user ".$current_user->user_login." <".$current_user->user_email.">\n" . "Reply-To: ".$current_user->user_email."\n";
$subject = $_POST["admin_contact_subject"];
$message=$_POST["admin_contact_message"];
$to=$bookingSettingObj->getEmailReservation();
if(wp_mail($to, $subject,$message, $headers )) {
	?>
    <script>
		window.parent.alert('<?php echo __( 'Message successfully sent!', 'wp-booking-calendar' ); ?>');
		window.parent.document.forms[0].reset();
	</script>
    <?php
} else {
	?>
    <script>
		window.parent.alert('<?php echo __( 'An error has occurred. Retry', 'wp-booking-calendar' ); ?>');
	</script>
    <?php
}

?>
