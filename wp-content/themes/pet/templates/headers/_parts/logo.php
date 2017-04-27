					<div class="logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php
							echo !empty($THEMEREX_GLOBALS['logo'])
								? '<div class="divider_image_logo"><img src="'.esc_url($THEMEREX_GLOBALS['logo']).'" class="logo_main" alt=""></div>'
								: '';
							echo !empty($THEMEREX_GLOBALS['logo_fixed'])
								? '<div class="divider_image_logo"><img src="'.esc_url($THEMEREX_GLOBALS['logo_fixed']).'" class="logo_fixed" alt=""></div>'
								: '';
							if ($THEMEREX_GLOBALS['logo_text'] || $THEMEREX_GLOBALS['logo_slogan'] ){?><div class="divider_text_logo"><?php
							echo ($THEMEREX_GLOBALS['logo_text']
								? '<div class="logo_text">'.($THEMEREX_GLOBALS['logo_text']).'</div>'
								: '');
							echo ($THEMEREX_GLOBALS['logo_slogan']
								? '<div class="divider_logo"></div><div class="logo_slogan">' . esc_html($THEMEREX_GLOBALS['logo_slogan']) . '</div>'
								: '');
								?></div><?php }
							?></a>
					</div>
