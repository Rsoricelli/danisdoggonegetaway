<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_template_masonry_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_template_masonry_theme_setup', 1 );
	function themerex_template_masonry_theme_setup() {
		themerex_add_template(array(
			'layout' => 'masonry_2',
			'template' => 'masonry',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Masonry tile (different height) /2 columns/', 'themerex'),
			'thumb_title'  => __('Large image', 'themerex'),
			'w'		 => 870,
			'h_crop' => 490,
			'h'      => null
		));
		themerex_add_template(array(
			'layout' => 'masonry_3',
			'template' => 'masonry',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Masonry tile /3 columns/', 'themerex'),
			'thumb_title'  => __('Medium image', 'themerex'),
			'w'		 => 390,
			'h_crop' => 220,
			'h'      => null
		));
		themerex_add_template(array(
			'layout' => 'masonry_4',
			'template' => 'masonry',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Masonry tile /4 columns/', 'themerex'),
			'thumb_title'  => __('Small image', 'themerex'),
			'w'		 => 300,
			'h_crop' => 170,
			'h'      => null
		));
		themerex_add_template(array(
			'layout' => 'classic_2',
			'template' => 'masonry',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Classic tile (equal height) /2 columns/', 'themerex'),
			'thumb_title'  => __('Large image (crop)', 'themerex'),
			'w'		 => 870,
			'h'		 => 490
		));
		themerex_add_template(array(
			'layout' => 'classic_3',
			'template' => 'masonry',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Classic tile /3 columns/', 'themerex'),
			'thumb_title'  => __('Medium image (crop)', 'themerex'),
			'w'		 => 390,
			'h'		 => 220
		));
		themerex_add_template(array(
			'layout' => 'classic_4',
			'template' => 'masonry',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Classic tile /4 columns/', 'themerex'),
			'thumb_title'  => __('Small image (crop)', 'themerex'),
			'w'		 => 300,
			'h'		 => 170
		));
		// Add template specific scripts
		add_action('themerex_action_blog_scripts', 'themerex_template_masonry_add_scripts');
	}
}

// Add template specific scripts
if (!function_exists('themerex_template_masonry_add_scripts')) {
	//add_action('themerex_action_blog_scripts', 'themerex_template_masonry_add_scripts');
	function themerex_template_masonry_add_scripts($style) {
		if (in_array(themerex_substr($style, 0, 8), array('classic_', 'masonry_'))) {
			themerex_enqueue_script( 'isotope', themerex_get_file_url('js/jquery.isotope.min.js'), array(), null, true );
		}
	}
}

// Template output
if ( !function_exists( 'themerex_template_masonry_output' ) ) {
	function themerex_template_masonry_output($post_options, $post_data) {
		$show_title = !in_array($post_data['post_format'], array('aside', 'status'));
		$parts = explode('_', $post_options['layout']);
		$style = $parts[0];
		$columns = max(1, min(12, empty($post_options['columns_count'])
									? (empty($parts[1]) ? 1 : (int) $parts[1])
									: $post_options['columns_count']
									));
		$tag = themerex_sc_in_shortcode_blogger(true) ? 'div' : 'article';
		?>
		<div class="isotope_item isotope_item_<?php echo esc_attr($style); ?> isotope_item_<?php echo esc_attr($post_options['layout']); ?> isotope_column_<?php echo esc_attr($columns); ?>
        <?php if ( ($post_data['post_video']==false) && ($post_data['post_audio']==false) && ($post_data['post_thumb']==false) &&  ($post_data['post_gallery']==false) )  {echo  ' with_featured_image ';} ?>
					<?php
					if ($post_options['filters'] != '') {
						if ($post_options['filters']=='categories' && !empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_ids))
							echo ' flt_' . join(' flt_', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_ids);
						else if ($post_options['filters']=='tags' && !empty($post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_ids))
							echo ' flt_' . join(' flt_', $post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_ids);
					}
					?>">
			<<?php echo ($tag); ?> class="post_item post_item_<?php echo esc_attr($style); ?> post_item_<?php echo esc_attr($post_options['layout']); ?>
				 <?php echo ' post_format_'.esc_attr($post_data['post_format'])
					. ($post_options['number']%2==0 ? ' even' : ' odd')
					. ($post_options['number']==0 ? ' first' : '')
					. ($post_options['number']==$post_options['posts_on_page'] ? ' last' : '');
				?>">

				<div class="post_content isotope_item_content">

					<?php
					if ($show_title) {
						if (!isset($post_options['links']) || $post_options['links']) {
							?>
							<h4 class="post_title"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo ($post_data['post_title']); ?></a></h4>
							<?php
						} else {
							?>
							<h4 class="post_title"><?php echo ($post_data['post_title']); ?></h4>
							<?php
						}
					}
                    if (!$post_data['post_protected'] && $post_options['info']){
                        ?><div class="masonry_content_center"><?php
                            if (!in_array($post_data['post_format'], array('quote', 'chat', 'aside', 'status')) ) {
                                $info_parts = array( 'date' => true, 'author' => false, 'terms' => false, 'counters' => false );
                                ?><div class="post_info_pluss"><?php require(themerex_get_file_dir('templates/_parts/post-info.php'));?></div><?php
                            }
                            if (!in_array($post_data['post_format'], array('quote', 'chat', 'aside', 'status')) ) {
                                $info_parts = array( 'date' => false, 'author' => false, 'terms' => true, 'counters' => true );
                                ?><div class="post_info_second_pluss"><?php require(themerex_get_file_dir('templates/_parts/post-info.php'));?></div><?php
                            }
                        ?></div><?php
                    }
                    ?>

                    <?php if ($post_data['post_video'] || $post_data['post_audio'] || $post_data['post_thumb'] ||  $post_data['post_gallery']) { ?>
                        <div class="post_featured">
                            <?php require(themerex_get_file_dir('templates/_parts/post-featured.php')); ?>
                        </div>
                    <?php } ?>

                    <div class="post_descr">
						<?php
						if ($post_data['post_protected']) {
							echo ($post_data['post_excerpt']);
						} else {
							if ($post_data['post_excerpt']) {
								echo in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status')) ? $post_data['post_excerpt'] : '<p>'.trim(themerex_strshort($post_data['post_excerpt'], isset($post_options['descr']) ? $post_options['descr'] : themerex_get_custom_option('post_excerpt_maxlength_masonry'))).'</p>';
							}
							if (empty($post_options['readmore'])) $post_options['readmore'] = __('More info', 'themerex');
							if (!themerex_sc_param_is_off($post_options['readmore']) && !in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status'))) {
								echo do_shortcode('[trx_button link="'.esc_url($post_data['post_link']).'" class="post_readmore"]'.trim($post_options['readmore']).'[/trx_button]');
								?>
                            <?php
							}
						}
						?>
					</div>

				</div>				<!-- /.post_content -->
			</<?php echo ($tag); ?>>	<!-- /.post_item -->
		</div>						<!-- /.isotope_item -->
		<?php
	}
}
?>