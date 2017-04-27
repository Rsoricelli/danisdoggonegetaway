<?php 

include 'common.php';

if(isset($_POST["operation"]) && $_POST["operation"] != '') {
	$arrCategories=$_POST["categories"];
	$qryString = "0";
	for($i=0;$i<count($arrCategories); $i++) {
		$qryString .= ",".$arrCategories[$i];
	}
		
	switch($_POST["operation"]) {
		case "publishCategories":
			$bookingCategoryObj->publishCategories($qryString);
			break;
		case "unpublishCategories":
			$bookingCategoryObj->unpublishCategories($qryString);
			break;
		case "delCategories":
			$bookingCategoryObj->delCategories($qryString);
			break;
		
	}                
	//header('Location: calendars.php');
}

?>

<!-- 
=====================================================================
=====================================================================
-->


<div class="booking_padding_20 booking_font_14 booking_line_percent booking_bg_fff">

        
            <?php
			$arrayCategories = $bookingListObj->getCategoriesList(); 
			
			?>
            <!-- 
            =======================
            === js - check ==
            =======================
            -->
            <script>
                
                var $wbc = jQuery;
              
                
                function delItem(itemId) {
                    if(confirm("<?php echo __('Are you sure you want to delete this category? All calendars, slots, holidays and reservations related to it will be deleted too','wp-booking-calendar'); ?>")) {
                        $wbc.ajax({
                          url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/delCategoryItem.php?item_id='+itemId,
                          success: function(data) {
                              $wbc('#booking_table').hide().html(data).fadeIn(2000);
                             
                            
                          }
                        });
                    } 
                }
                function publishCategory(itemId) {
                    if(confirm("<?php echo __('Are you sure you want to publish this category?','wp-booking-calendar'); ?>")) {
                        $wbc.ajax({
                          url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/publishCategory.php?category_id='+itemId,
                          success: function(data) {
                              $wbc('#publish_'+itemId).html('<a href="javascript:unpublishCategory('+itemId+');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/published.png" border=0 /></a>');								 							 
                            
                          }
                        });
                    } 
                }
                function unpublishCategory(itemId) {
                    if(confirm("<?php echo __('Are you sure you want to unpublish this category?','wp-booking-calendar'); ?>")) {
                        $wbc.ajax({
                          url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/unpublishCategory.php?category_id='+itemId,
                          success: function(data) {
                              $wbc('#publish_'+itemId).html('<a href="javascript:publishCategory('+itemId+');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/unpublished.png" border=0 /></a>');								 							 
                            
                          }
                        });
                    } 
                }
                
                function addCategory() {
                    if(Trim($wbc('#category_name').val())!= '') {
                        $wbc.ajax({
                          url: '<?php echo plugins_url('wp-booking-calendar/admin/'); ?>ajax/addCategory.php?category_name='+$wbc('#category_name').val(),
                          success: function(data) {
                              $wbc('#booking_table').hide().html(data).fadeIn(2000);							 
                              $wbc('#category_name').val('');
                            
                          }
                        });
                    } else {
                        alert("<?php echo __('Insert a name for the category','wp-booking-calendar'); ?>");
                    }
                }
                function editItem(category) {
                    $wbc('#modify_'+category).html('<a href="javascript:saveItem('+category+');"><?php echo __('Save','wp-booking-calendar'); ?></a>');
                    $wbc('#name_display_'+category).fadeOut(0);
                    $wbc('#name_input_'+category).fadeIn(0);
                    
                }
                function saveItem(category) {
                    if(Trim($wbc('#category_name_'+category).val()) != '') {
						$wbc('#modify_'+category).parent().append('<img id="small_save_loader" src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/loading.gif" style="display: table-cell;vertical-align:middle" border=0>');
                        $wbc.ajax({
                          url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveCategory.php?item_id='+category+"&name="+$wbc('#category_name_'+category).val(),
                          success: function(data) {
                             
                              $wbc('#name_display_'+category).fadeIn(0);
                              $wbc('#name_input_'+category).fadeOut(0);
                              $wbc('#name_display_'+category).html($wbc('#category_name_'+category).val());
                              $wbc('#modify_'+category).html('<a href="javascript:editItem('+category+');"><?php echo __('Modify name','wp-booking-calendar'); ?></a>');
							  $wbc('#small_save_loader').remove();
                              $wbc('#row_'+category).hide().fadeIn(2000);
                              
                             
                            
                          }
                        });
                    }
                }
                function setDefaultCategory(category) {
                    $wbc.ajax({
                      url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/setDefaultCategory.php?category_id='+category,
                      success: function(data) {
                        document.location.reload();
                      }
                    });
                }
				
				$wbc(function() {
					<?php
					if(count($arrayCategories)>0) {
						?>
						showActionBar();
						<?php
					}
					?>
				});
				
				function showActionBar() {
					$wbc('#action_bar').slideDown();
				}
				function hideActionBar() {
					$wbc('#action_bar').slideUp();
				}
				
            </script>
            
           
           
            <!-- 
            =======================
            === create calendar ==
            =======================
            -->
            
            <div class="booking_float_left booking_height_30 booking_line_30 booking_margin_t_10"><strong><?php echo __('Create new category','wp-booking-calendar'); ?></strong>: <?php echo __('Type the name','wp-booking-calendar'); ?></div> 
            <div class="booking_float_left booking_margin_l_10"><input type="text" id="category_name" name="category_name" style="height:50px"></div>   
            <div class="booking_float_left booking_margin_l_10"><a href="javascript:addCategory();" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"><?php echo __('Add','wp-booking-calendar'); ?></a></div>
            <div class="booking_cleardiv"></div>
            
            
             <!-- 
            =======================
            === action bar ==
            =======================
            -->
            
            <div id="action_bar" style="display:none !important" class="booking_margin_t_20 booking_bg_f6f booking_border_1 booking_border_solid booking_border_ccc booking_padding_10">
            	<div class="booking_float_right">
                	<div class="booking_float_left"><?php echo __('Selected items','wp-booking-calendar'); ?>:</div>
                	<a onclick="javascript:delItems('manage_categories','categories[]','publishCategories','<?php echo __('Are you sure you want to publish the selected items?','wp-booking-calendar'); ?>','<?php echo __('No items selected','wp-booking-calendar'); ?>')" class="booking_float_left booking_margin_l_20 booking_mark_333 booking_pointer booking_font_bold"><?php echo __('Publish','wp-booking-calendar'); ?></a>
                    <a onclick="javascript:delItems('manage_categories','categories[]','unpublishCategories','<?php echo __('Are you sure you want to unpublish the selected items?','wp-booking-calendar'); ?>','<?php echo __('No items selected','wp-booking-calendar'); ?>')" class="booking_float_left booking_margin_l_20 booking_mark_333 booking_pointer booking_font_bold"><?php echo __('Unpublish','wp-booking-calendar'); ?></a>
                    <a onclick="javascript:delItems('manage_categories','categories[]','delCategories','<?php echo __('Are you sure you want to delete the selected items? All calendars, slots, holidays and reservations related to them will be deleted too','wp-booking-calendar'); ?>','<?php echo __('No items selected','wp-booking-calendar'); ?>')" class="booking_float_left booking_margin_l_20 booking_mark_333 booking_pointer booking_font_bold"><?php echo __('Delete','wp-booking-calendar'); ?></a>
                   
                    <div class="booking_cleardiv"></div>
                </div>
                <div class="booking_cleardiv"></div>
                
            </div>
           
            <!-- 
            =======================
            === table calendars ==
            =======================
            -->
            <form name="manage_categories" action="" method="post" style="display: inline;">
                <input type="hidden" name="operation" />
                <input type="hidden" name="categories[]" value=0 />
                
                <div class="booking_margin_t_20">
                    <div id="booking_table">
                    
                    	
                        
                        
                        
                        <?php include'ajax/categories.php';?>
                    </div>
                </div>
            </form>
            
            
            <div class="booking_cleardiv"></div>
    
</div>
