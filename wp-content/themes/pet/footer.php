<?php
/**
 * The template for displaying the footer.
 */

global $THEMEREX_GLOBALS;

				themerex_close_wrapper();	// <!-- </.content> -->

				// Show main sidebar
				get_sidebar();

				if (themerex_get_custom_option('body_style')!='fullscreen') themerex_close_wrapper();	// <!-- </.content_wrap> -->
				?>
			
			</div>		<!-- </.page_content_wrap> -->
			
			<?php
			// Footer Testimonials stream
			if (themerex_get_custom_option('show_testimonials_in_footer')=='yes') { 
				$count = max(1, themerex_get_custom_option('testimonials_count'));
				$data = do_shortcode('[trx_testimonials count="'.esc_attr($count).'"][/trx_testimonials]');
				if ($data) {
					?>
					<footer class="testimonials_wrap sc_section scheme_<?php echo esc_attr(themerex_get_custom_option('testimonials_scheme')); ?>">
						<div class="testimonials_wrap_inner sc_section_inner sc_section_overlay">
							<div class="content_wrap"><?php echo ($data); ?></div>
						</div>
					</footer>
					<?php
				}
			}
			
			// Footer sidebar
			$footer_show  = themerex_get_custom_option('show_sidebar_footer');
			$sidebar_name = themerex_get_custom_option('sidebar_footer');
			if (!themerex_sc_param_is_off($footer_show) && is_active_sidebar($sidebar_name)) { 
				$THEMEREX_GLOBALS['current_sidebar'] = 'footer';
				?>
				<footer class="footer_wrap widget_area scheme_<?php echo esc_attr(themerex_get_custom_option('sidebar_footer_scheme')); ?>">
					<div class="footer_wrap_inner widget_area_inner">
						<div class="content_wrap">
							<div class="columns_wrap"><?php
							ob_start();
							do_action( 'before_sidebar' );
							if ( !dynamic_sidebar($sidebar_name) ) {
								// Put here html if user no set widgets in sidebar
							}
							do_action( 'after_sidebar' );
							$out = ob_get_contents();
							ob_end_clean();
							echo trim(chop(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $out)));
							?></div>	<!-- /.columns_wrap -->
						</div>	<!-- /.content_wrap -->
					</div>	<!-- /.footer_wrap_inner -->
				</footer>	<!-- /.footer_wrap -->
			<?php
			}


			// Footer Twitter stream
			if (themerex_get_custom_option('show_twitter_in_footer')=='yes') { 
				$count = max(1, themerex_get_custom_option('twitter_count'));
				$data = do_shortcode('[trx_twitter count="'.esc_attr($count).'"]');
				if ($data) {
					?>
					<footer class="twitter_wrap sc_section scheme_<?php echo esc_attr(themerex_get_custom_option('twitter_scheme')); ?>">
						<div class="twitter_wrap_inner sc_section_inner sc_section_overlay">
							<div class="content_wrap"><?php echo ($data); ?></div>
						</div>
					</footer>
					<?php
				}
			}


            // Footer Prices area
            if (themerex_get_custom_option('show_price_in_footer')=='yes') {
                $count = max(1, themerex_get_custom_option('price_count'));

                $title_1 = themerex_get_custom_option('title_1');
                $link_1 = themerex_get_custom_option('link_1');
                $money_1 = themerex_get_custom_option('money_1');
                $currency_1 = themerex_get_custom_option('currency_1');
                $price_content_1 = (themerex_get_custom_option('price_content_1'));

                $title_2 = themerex_get_custom_option('title_2');
                $link_2 = themerex_get_custom_option('link_2');
                $money_2 = themerex_get_custom_option('money_2');
                $currency_2 = themerex_get_custom_option('currency_2');
                $price_content_2 = (themerex_get_custom_option('price_content_2'));

                $title_3 = themerex_get_custom_option('title_3');
                $link_3 = themerex_get_custom_option('link_3');
                $money_3 = themerex_get_custom_option('money_3');
                $currency_3 = themerex_get_custom_option('currency_3');
                $price_content_3 = (themerex_get_custom_option('price_content_3'));

                if ( $count == 1 ){
                    $data_1 = do_shortcode('[trx_price_block title="'.esc_attr($title_1) .'" link="'.esc_attr($link_1) .'" money="'.esc_attr($money_1) .'" currency="'.esc_attr($currency_1) .'" height="" width="" left="1em" right="1em" link_text="Order now" period=""]'
                              . ($price_content_1) . '[/trx_price_block]');
                    if ($data_1) {
                        ?>
                        <footer class="prices_area_wrap sc_section scheme_<?php echo esc_attr(themerex_get_custom_option('price_scheme')); ?>">
                            <h6>Our Price</h6>
                            <div class="prices_area_wrap_inner sc_section_inner sc_section_overlay">
                                <div class="content_wrap"><div class="column-1_1"><?php echo ($data_1); ?></div></div>
                            </div>
                        </footer>
                    <?php
                    }
                }
                if( $count == 2 ){
                    $data_1 = do_shortcode('[trx_price_block title="'.esc_attr($title_1) .'" link="'.esc_attr($link_1) .'" money="'.esc_attr($money_1) .'" currency="'.esc_attr($currency_1) .'" height="" width="" left="1em" right="1em" link_text="Order now" period=""]'
                        . ($price_content_1) . '[/trx_price_block]');
                    $data_2 = do_shortcode('[trx_price_block title="'.esc_attr($title_2) .'" link="'.esc_attr($link_2) .'" money="'.esc_attr($money_2) .'" currency="'.esc_attr($currency_2) .'" height="" width="" left="1em" right="1em" link_text="Order now" period=""]'
                        . ($price_content_2) . '[/trx_price_block]');
                    if ($data_1 || $data_2) {
                        ?>
                        <footer class="prices_area_wrap sc_section scheme_<?php echo esc_attr(themerex_get_custom_option('price_scheme')); ?>">
                            <h6>Our Prices</h6>
                            <div class="prices_area_wrap_inner sc_section_inner sc_section_overlay">
                                <div class="content_wrap">
                                    <div class="column-1_2"><?php echo ($data_1); ?></div>
                                    <div class="column-1_2"><?php echo ($data_2); ?></div>
                                </div>
                            </div>
                        </footer>
                    <?php
                    }
                }
                if( $count == 3 ){
                    $data_1 = do_shortcode('[trx_price_block title="'.esc_attr($title_1) .'" link="'.esc_attr($link_1) .'" money="'.esc_attr($money_1) .'" currency="'.esc_attr($currency_1) .'" height="" width="" left=""     right="" link_text="Order now" period=""]'
                        . ($price_content_1) . '[/trx_price_block]');
                    $data_2 = do_shortcode('[trx_price_block title="'.esc_attr($title_2) .'" link="'.esc_attr($link_2) .'" money="'.esc_attr($money_2) .'" currency="'.esc_attr($currency_2) .'" height="" width="" left=""     right="" link_text="Order now" period=""]'
                        . ($price_content_2) . '[/trx_price_block]');
                    $data_3 = do_shortcode('[trx_price_block title="'.esc_attr($title_3) .'" link="'.esc_attr($link_3) .'" money="'.esc_attr($money_3) .'" currency="'.esc_attr($currency_3) .'" height="" width="" left=""     right="" link_text="Order now" period=""]'
                        . ($price_content_3) . '[/trx_price_block]');
                    if ($data_1 || $data_2 || $data_3) {
                        ?>
                        <footer class="prices_area_wrap sc_section scheme_<?php echo esc_attr(themerex_get_custom_option('price_scheme')); ?>">
                            <h6>Our Prices</h6>
                            <div class="prices_area_wrap_inner sc_section_inner sc_section_overlay">
                                <div class="content_wrap">
                                <?php echo do_shortcode('[trx_columns count="3"][trx_column_item]'. ($data_1) .'[/trx_column_item][trx_column_item]'. ($data_2) .'[/trx_column_item][trx_column_item]'. ($data_3) .'[/trx_column_item][/trx_columns]')   ?>
                                </div>
                            </div>
                        </footer>

                    <?php
                    }
                }

            }


			// Google map
			if ( themerex_get_custom_option('show_googlemap')=='yes' ) { 
				$map_address = themerex_get_custom_option('googlemap_address');
				$map_latlng  = themerex_get_custom_option('googlemap_latlng');
				$map_zoom    = themerex_get_custom_option('googlemap_zoom');
				$map_style   = themerex_get_custom_option('googlemap_style');
				$map_height  = themerex_get_custom_option('googlemap_height');
				$map_title   = themerex_get_custom_option('googlemap_title');
				$map_descr   = themerex_strmacros(themerex_get_custom_option('googlemap_description'));
				if (!empty($map_address) || !empty($map_latlng)) {
					echo do_shortcode('[trx_googlemap'
							. (!empty($map_style)   ? ' style="'.esc_attr($map_style).'"' : '')
							. (!empty($map_zoom)    ? ' zoom="'.esc_attr($map_zoom).'"' : '')
							. (!empty($map_height)  ? ' height="'.esc_attr($map_height).'"' : '')
							. ']'
								. '[trx_googlemap_marker'
									. (!empty($map_title)   ? ' title="'.esc_attr($map_title).'"' : '')
									. (!empty($map_descr)   ? ' description="'.esc_attr($map_descr).'"' : '')
									. (!empty($map_address) ? ' address="'.esc_attr($map_address).'"' : '')
									. (!empty($map_latlng)  ? ' latlng="'.esc_attr($map_latlng).'"' : '')
								. ']'
							. '[/trx_googlemap]'
							);
				}
			}

			// Footer contacts
			if (themerex_get_custom_option('show_contacts_in_footer')=='yes') { 
				$address_1 = themerex_get_theme_option('contact_address_1');
				$phone = themerex_get_theme_option('contact_phone');
				$fax = themerex_get_theme_option('contact_fax');
				if (!empty($address_1)  || !empty($phone) || !empty($fax)) {
					?>
					<footer class="contacts_wrap scheme_<?php echo esc_attr(themerex_get_custom_option('contacts_scheme')); ?>">
						<div class="contacts_wrap_inner">
							<div class="content_wrap">

                                <?php
                                // Google map in contact info
                                if ( themerex_get_custom_option('show_googlemap_in_contacts')=='yes' ) {
                                    ?>
                                    <div class="column-1_2 alignleft">
                                        <?php
                                        $map_latlng  = themerex_get_custom_option('googlemap_latlng');
                                        $map_zoom    = themerex_get_custom_option('googlemap_zoom');
                                        $map_style   = themerex_get_custom_option('googlemap_style');
                                        $map_height  = themerex_get_custom_option('googlemap_height');
                                        $map_title   = themerex_get_custom_option('googlemap_title');
                                        $map_descr   = themerex_strmacros(themerex_get_custom_option('googlemap_description'));
                                        if (!empty($address_1) ) {
                                            echo do_shortcode('[trx_googlemap'
                                                . (!empty($map_style) ? ' style="' . esc_attr($map_style) . '"' : '')
                                                . (!empty($map_zoom) ? ' zoom="' . esc_attr($map_zoom) . '"' : '12')
                                                . (' height="342"')
                                                . ']'
                                                . '[trx_googlemap_marker'
                                                . (!empty($map_title) ? ' title="' . esc_attr($map_title) . '"' : '')
                                                . (!empty($map_descr) ? ' description="' . esc_attr($map_descr) . '"' : '')
                                                . (!empty($address_1) ? ' address="' . esc_attr($address_1) . '"' : '$address_2')
                                                . (!empty($map_latlng) ? ' latlng="' . esc_attr($map_latlng) . '"' : '')
                                                . ']'
                                                . '[/trx_googlemap]'
                                            );
                                        }
                                        ?></div>
                                    <div class="contact-info">
                                        <?php }
                                        ?>
                                            <div class="contacts-title"><?php echo __('Contact Info', 'themerex'); ?>
                                                <div class="circle-bottom-title-area">
                                                    <span class="circle-bottom-title one"></span>
                                                    <span class="circle-bottom-title two"></span>
                                                    <span class="circle-bottom-title three"></span>
                                                </div>
                                            </div>
                                            <div class="contacts_address">
                                                 <div class="contacts-area-adress"><?php if (!empty($address_1)) echo ($address_1); ?></div>
                                                 <?php $top_panel_top_components = array( 'open_hours' );
                                                       require_once( themerex_get_file_dir('templates/headers/_parts/top-panel-top.php') );
                                                       $top_panel_top_components = array( 'open_hours2' );
                                                       require_once( themerex_get_file_dir('templates/headers/_parts/top-panel-top.php') );
                                                       $top_panel_top_components = array( 'open_hours3');
                                                       require_once( themerex_get_file_dir('templates/headers/_parts/top-panel-top.php') );?>
                                                <?php if (!empty($phone)) echo ('<div class="contacts-area-phone icon-phone">'.($phone) . '</div>'); ?>
                                                <?php if (!empty($fax)) echo ('<div class="contacts-area-fax">' .__('Fax:', 'themerex') . ' ' . ($fax) . '</div>'); ?>
                                            </div>
                                    <?php       if ( themerex_get_custom_option('show_googlemap_in_contacts')=='yes' ) { ?>
                                            </div>
                                    <?php } ?>

							</div>	<!-- /.content_wrap -->
						</div>	<!-- /.contacts_wrap_inner -->
					</footer>	<!-- /.contacts_wrap -->
					<?php
				}
			}

            // Contact form area
            if (themerex_get_custom_option('show_contacts_form_in_footer')=='yes') {
                ?>
                <div class="contact_form_wrap contact_form_style_<?php echo esc_attr($copyright_style); ?>  scheme_<?php echo esc_attr(themerex_get_custom_option('contacts_form_scheme')); ?>">
                    <div class="contact_form_wrap_inner">
                        <div class="content_wrap">
                            <?php
                            echo do_shortcode('[vc_row full_width="" parallax="" parallax_image=""][vc_column width="1/1"][trx_content scheme="inherit" id="" class="" animation="none" css="" top="" bottom=""][trx_title type="1" style="underline" align="center" font_weight="inherit" icon="inherit" image="none" image_size="small" position="top" animation="none" font_size="2em" top="2.1em"]Send Us a Message[/trx_title][trx_contact_form custom="" style="1" align="none" animation="none" top="3em" bottom="3em" width="83%" left="auto" right="auto"][/trx_contact_form][/trx_content][/vc_column][/vc_row][vc_row][vc_column][vc_column_text][/vc_column_text][/vc_column][/vc_row]');
                            ?>
                        </div>
                    </div>
                </div>
            <?php }

			// Copyright area
			$copyright_style = themerex_get_custom_option('show_copyright_in_footer');
			if (!themerex_sc_param_is_off($copyright_style)) {
			?> 
				<div class="copyright_wrap copyright_style_<?php echo esc_attr($copyright_style); ?>  scheme_<?php echo esc_attr(themerex_get_custom_option('copyright_scheme')); ?>">
					<div class="copyright_wrap_inner">
						<div class="content_wrap">
							<?php
							if ($copyright_style == 'menu') {
								if (empty($THEMEREX_GLOBALS['menu_footer']))	$THEMEREX_GLOBALS['menu_footer'] = themerex_get_nav_menu('menu_footer');
								if (!empty($THEMEREX_GLOBALS['menu_footer']))	echo ($THEMEREX_GLOBALS['menu_footer']);
							} else if ($copyright_style == 'socials') {
								echo do_shortcode('[trx_socials size="tiny"][/trx_socials]'); /*medium*/
							}
							?>
							<div class="copyright_text"><?php echo force_balance_tags(themerex_get_theme_option('footer_copyright')); ?></div>
						</div>
					</div>
				</div>
			<?php } ?>
			
		</div>	<!-- /.page_wrap -->

	</div>		<!-- /.body_wrap -->
	
	<?php if ( !themerex_sc_param_is_off(themerex_get_custom_option('show_sidebar_outer')) ) { ?>
	</div>	<!-- /.outer_wrap -->
	<?php } ?>

<?php
if (themerex_get_custom_option('show_theme_customizer')=='yes') {
	require_once( themerex_get_file_dir('core/core.customizer/front.customizer.php') );
}
?>

<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="scroll_to_top icon-up" title="<?php _e('Scroll to top', 'themerex'); ?>"></a>

<div class="custom_html_section">
<?php echo force_balance_tags(themerex_get_custom_option('custom_code')); ?>
</div>

<?php echo force_balance_tags(themerex_get_custom_option('gtm_code2')); ?>

<?php wp_footer(); ?>

</body>
</html>