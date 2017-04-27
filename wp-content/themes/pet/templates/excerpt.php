<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_template_excerpt_theme_setup' ) ) {
    add_action( 'themerex_action_before_init_theme', 'themerex_template_excerpt_theme_setup', 1 );
    function themerex_template_excerpt_theme_setup() {
        themerex_add_template(array(
            'layout' => 'excerpt',
            'mode'   => 'blog',
            'title'  => __('Excerpt', 'themerex'),
            'thumb_title'  => __('Large image (crop)', 'themerex'),
            'w'		 => 870,
            'h'		 => 490
        ));
    }
}

// Template output
if ( !function_exists( 'themerex_template_excerpt_output' ) ) {
    function themerex_template_excerpt_output($post_options, $post_data) {
        $show_title = true;	//!in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote'));
        $tag = themerex_sc_in_shortcode_blogger(true) ? 'div' : 'article';
        ?>
        <<?php echo ($tag); ?> <?php post_class('post_item post_item_excerpt post_featured_' . esc_attr($post_options['post_class']) . ' post_format_'.esc_attr($post_data['post_format']) . ($post_options['number']%2==0 ? ' even' : ' odd') . ($post_options['number']==0 ? ' first' : '') . ($post_options['number']==$post_options['posts_on_page']? ' last' : '') . ($post_options['add_view_more'] ? ' viewmore' : '')); ?>>
			<?php
        if ($post_data['post_flags']['sticky']) {
            ?><span class="sticky_label"></span><?php
        }

        if ($show_title && $post_options['location'] == 'center' && !empty($post_data['post_title'])) {
            ?><h3 class="post_title"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo ($post_data['post_title']); ?></a></h3><?php
        }

        if ($post_options['location'] == 'center' && !$post_data['post_protected'] && $post_options['info']){
            if (!in_array($post_data['post_format'], array('quote', 'chat', 'aside', 'status')) ) {
                $info_parts = array( 'date' => true, 'author' => true, 'terms' => false, 'counters' => false );
                ?><div class="post_info_pluss"><?php require(themerex_get_file_dir('templates/_parts/post-info.php'));?></div><?php
            }
            if (!in_array($post_data['post_format'], array('quote', 'chat', 'aside', 'status')) ) {
                $info_parts = array( 'date' => false, 'author' => false, 'terms' => true, 'counters' => true, 'comments' => true  );
                ?><div class="post_info_second_pluss"><?php require(themerex_get_file_dir('templates/_parts/post-info.php'));?></div><?php
            }
        }

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
                    if ($show_title && $post_options['location'] != 'center' && !empty($post_data['post_title'])) {
                        ?><h3 class="post_title"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo ($post_data['post_title']); ?></a></h3><?php
                    }

                    if ($post_options['location'] != 'center' && !$post_data['post_protected'] && $post_options['info']){
                        if (!in_array($post_data['post_format'], array('quote', 'chat', 'aside', 'status')) ) {
                            $info_parts = array( 'date' => true, 'author' => true, 'terms' => false, 'counters' => false );
                            ?><div class="post_info_pluss"><?php require(themerex_get_file_dir('templates/_parts/post-info.php'));?></div><?php
                        }
                        if (!in_array($post_data['post_format'], array('quote', 'chat', 'aside', 'status')) ) {
                            $info_parts = array( 'date' => false, 'author' => false, 'terms' => true, 'counters' => true, 'comments' => true  );
                            ?><div class="post_info_second_pluss"><?php require(themerex_get_file_dir('templates/_parts/post-info.php'));?></div><?php
                        }
                    }
                ?>

				<div class="post_descr">
				<?php
                    if ($post_data['post_protected']) {
                        echo ($post_data['post_excerpt']);
                    } else {
                        if ($post_data['post_excerpt']) {
                            echo in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status')) ? $post_data['post_excerpt'] : '<p>'.trim(themerex_strshort($post_data['post_excerpt'], isset($post_options['descr']) ? $post_options['descr'] : themerex_get_custom_option('post_excerpt_maxlength'))).'</p>';
                        }
                    }
                    if (empty($post_options['readmore'])) $post_options['readmore'] = __('More info', 'themerex');
                    if (!themerex_sc_param_is_off($post_options['readmore']) && !in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status'))) {
                        echo do_shortcode('[trx_button link="'.esc_url($post_data['post_link']).'"]'.($post_options['readmore']).'[/trx_button]');
                    }
                    ?>
				</div>

			</div>	<!-- /.post_content -->

		</<?php echo ($tag); ?>>	<!-- /.post_item -->

	<?php
    }
}
?>