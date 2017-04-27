<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_template_aurora_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_template_aurora_theme_setup', 1 );
	function themerex_template_aurora_theme_setup() {
		themerex_add_template(array(
			'layout' => 'aurora_3',
			'template' => 'aurora',
			'mode'   => 'blog',
			'need_columns' => true,
			'title'  => __('Aurora (3 column)', 'themerex'),
			'thumb_title'  => __('Aurora image (3 column)', 'themerex'),
            'w'		 => 370,    //160,
            'h'		 => 260     //160
		));
        themerex_add_template(array(
            'layout' => 'aurora_4',
            'template' => 'aurora',
            'mode'   => 'blog',
            'need_columns' => true,
            'title'  => __('Aurora (4 column)', 'themerex'),
            'thumb_title'  => __('Aurora image (4 column)', 'themerex'),
            'w'		 => 270,    //160,
            'h'		 => 260     //160
        ));
	}
}

// Template output
if ( !function_exists( 'themerex_template_aurora_output' ) ) {
	function themerex_template_aurora_output($post_options, $post_data) {
		$show_title = true;	//!in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote'));
		$parts = explode('_', $post_options['layout']);
		$style = $parts[0];
        $columns = max(1, min(4, empty($parts[1]) ? $post_options['columns_count'] : (int) $parts[1]));
		$tag = themerex_sc_in_shortcode_blogger(true) ? 'div' : 'article';


		if ($columns > 1) {
            ?>
            <div class="<?php echo 'column-1_'.esc_attr($columns); ?> column_padding_bottom">
        <?php
        }
		?>

		<<?php echo ($tag); ?> <?php post_class('post_item post_item_aurora post_item_' . esc_attr($post_options['layout']) . ' post_format_'.esc_attr($post_data['post_format']) . ($post_options['number']%2==0 ? ' even' : ' odd') . ($post_options['number']==0 ? ' first' : '') . ($post_options['number']==$post_options['posts_on_page']? ' last' : '') . ($post_options['add_view_more'] ? ' viewmore' : '')); ?>>
					
			
            <?php
			if (!$post_data['post_protected'] && (!empty($post_options['dedicated']) || $post_data['post_thumb'] || $post_data['post_gallery'] || $post_data['post_video'] || $post_data['post_audio'])) {
				?>
				<div class="post_featured">
				<?php
				if (!empty($post_options['dedicated'])) {
					echo ($post_options['dedicated']);
				} else if ($post_data['post_thumb'] || $post_data['post_gallery'] || $post_data['post_video'] || $post_data['post_audio']) {
                    require(themerex_get_file_dir('templates/_parts/post-featured.php'));
				}
				?>
				</div>			

			<?php
			}
			?>

            <div class="post_content clearfix">
				<?php
				if ($show_title && !empty($post_data['post_title'])) {
					?><h5 class="post_title"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo ($post_data['post_title']); ?></a></h5><?php
				} ?>


        <?php
            if (!$post_data['post_protected'] && $post_options['info'] && (!in_array($post_data['post_format'], array('quote', 'chat', 'aside', 'status'))) ){
            $info_parts = array( 'date' => true, 'author' => false, 'terms' => false, 'counters' => false, 'comments' => true );
            ?>
                <span class="post_info_pluss"><?php require(themerex_get_file_dir('templates/_parts/post-info.php'));?></span>
                <a class="post_counters_item post_counters_comments icon-comment" title="<?php echo sprintf(__('Comments - %s', 'themerex'), $post_data['post_comments']); ?>" href="<?php echo esc_url($post_data['post_comments_link']); ?>"><span class="post_counters_number"><?php echo ($post_data['post_comments']); ?></span></a>
            <?php
            }
        ?>
                <div class="post_descr">
                        <?php
                            if ($post_data['post_protected']) {
                                echo ($post_data['post_excerpt']);
                            } else {
                                if ($post_data['post_excerpt']) {
                                    echo '<p>'.trim(themerex_strshort($post_data['post_excerpt'], isset($post_options['descr']) ? $post_options['descr'] : themerex_get_custom_option('post_excerpt_maxlength'))).'</p>';
                                }
                            }
                        if (empty($post_options['readmore'])) $post_options['readmore'] = __('More info', 'themerex');
                        if (!themerex_sc_param_is_off($post_options['links']) && !in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status'))) {
                            echo do_shortcode('[trx_button link="' . esc_url($post_data['post_link']) . '"]' . ($post_options['readmore']) . '[/trx_button]');
                        }

                        ?>
                </div>

            <?php
				if (!$post_data['post_protected'] && $post_options['info']) {
					if (!empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_links)) {
						?>
						<div class="post_info">
						<span class="post_info_item post_info_tags"><?php _e('in', 'themerex'); ?> <?php echo join(', ', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_links); ?></span>
						</div>
						<?php
					}
				}
				?>

			</div>  <!-- /.post_content -->


		</<?php echo ($tag); ?>>	<!-- /.post_item -->
		
	<?php
	if ($columns > 1) {
            ?>
            </div>
        <?php
        }
	}
}
?>