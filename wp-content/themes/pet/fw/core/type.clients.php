<?php
/**
 * ThemeREX Framework: Clients post type settings
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Theme init
if (!function_exists('themerex_clients_theme_setup')) {
	add_action( 'themerex_action_before_init_theme', 'themerex_clients_theme_setup' );
	function themerex_clients_theme_setup() {

		// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
		add_filter('themerex_filter_get_blog_type',			'themerex_clients_get_blog_type', 9, 2);
		add_filter('themerex_filter_get_blog_title',		'themerex_clients_get_blog_title', 9, 2);
		add_filter('themerex_filter_get_current_taxonomy',	'themerex_clients_get_current_taxonomy', 9, 2);
		add_filter('themerex_filter_is_taxonomy',			'themerex_clients_is_taxonomy', 9, 2);
		add_filter('themerex_filter_get_stream_page_title',	'themerex_clients_get_stream_page_title', 9, 2);
		add_filter('themerex_filter_get_stream_page_link',	'themerex_clients_get_stream_page_link', 9, 2);
		add_filter('themerex_filter_get_stream_page_id',	'themerex_clients_get_stream_page_id', 9, 2);
		add_filter('themerex_filter_query_add_filters',		'themerex_clients_query_add_filters', 9, 2);
		add_filter('themerex_filter_detect_inheritance_key','themerex_clients_detect_inheritance_key', 9, 1);

		// Extra column for clients lists
		if (themerex_get_theme_option('show_overriden_posts')=='yes') {
			add_filter('manage_edit-clients_columns',			'themerex_post_add_options_column', 9);
			add_filter('manage_clients_posts_custom_column',	'themerex_post_fill_options_column', 9, 2);
		}

		// Add shortcodes [trx_clients] and [trx_clients_item]
		add_action('themerex_action_shortcodes_list',		'themerex_clients_add_shortcodes');
		add_action('themerex_action_shortcodes_list_vc',	'themerex_clients_add_shortcodes_vc');
		add_shortcode('trx_clients',						'themerex_sc_clients');
		add_shortcode('trx_clients_item',					'themerex_sc_clients_item');
		
		if (function_exists('themerex_require_data')) {
			// Prepare type "Clients"
			themerex_require_data( 'post_type', 'clients', array(
				'label'               => __( 'Clients', 'themerex' ),
				'description'         => __( 'Clients Description', 'themerex' ),
				'labels'              => array(
					'name'                => _x( 'Clients', 'Post Type General Name', 'themerex' ),
					'singular_name'       => _x( 'Client', 'Post Type Singular Name', 'themerex' ),
					'menu_name'           => __( 'Clients', 'themerex' ),
					'parent_item_colon'   => __( 'Parent Item:', 'themerex' ),
					'all_items'           => __( 'All Clients', 'themerex' ),
					'view_item'           => __( 'View Item', 'themerex' ),
					'add_new_item'        => __( 'Add New Client', 'themerex' ),
					'add_new'             => __( 'Add New', 'themerex' ),
					'edit_item'           => __( 'Edit Item', 'themerex' ),
					'update_item'         => __( 'Update Item', 'themerex' ),
					'search_items'        => __( 'Search Item', 'themerex' ),
					'not_found'           => __( 'Not found', 'themerex' ),
					'not_found_in_trash'  => __( 'Not found in Trash', 'themerex' ),
				),
				'supports'            => array( 'title', 'excerpt', 'editor', 'author', 'thumbnail', 'comments', 'custom-fields'),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'menu_icon'			  => 'dashicons-admin-users',
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => 25,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'query_var'           => true,
				'capability_type'     => 'page',
				'rewrite'             => true
				)
			);
			
			// Prepare taxonomy for clients
			themerex_require_data( 'taxonomy', 'clients_group', array(
				'post_type'			=> array( 'clients' ),
				'hierarchical'      => true,
				'labels'            => array(
					'name'              => _x( 'Clients Group', 'taxonomy general name', 'themerex' ),
					'singular_name'     => _x( 'Group', 'taxonomy singular name', 'themerex' ),
					'search_items'      => __( 'Search Groups', 'themerex' ),
					'all_items'         => __( 'All Groups', 'themerex' ),
					'parent_item'       => __( 'Parent Group', 'themerex' ),
					'parent_item_colon' => __( 'Parent Group:', 'themerex' ),
					'edit_item'         => __( 'Edit Group', 'themerex' ),
					'update_item'       => __( 'Update Group', 'themerex' ),
					'add_new_item'      => __( 'Add New Group', 'themerex' ),
					'new_item_name'     => __( 'New Group Name', 'themerex' ),
					'menu_name'         => __( 'Clients Group', 'themerex' ),
				),
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'clients_group' ),
				)
			);
		}
	}
}

if ( !function_exists( 'themerex_clients_settings_theme_setup2' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_clients_settings_theme_setup2', 3 );
	function themerex_clients_settings_theme_setup2() {
		// Add post type 'clients' and taxonomy 'clients_group' into theme inheritance list
		themerex_add_theme_inheritance( array('clients' => array(
			'stream_template' => 'blog-clients',
			'single_template' => 'single-client',
			'taxonomy' => array('clients_group'),
			'taxonomy_tags' => array(),
			'post_type' => array('clients'),
			'override' => 'page'
			) )
		);
	}
}


if (!function_exists('themerex_clients_after_theme_setup')) {
	add_action( 'themerex_action_after_init_theme', 'themerex_clients_after_theme_setup' );
	function themerex_clients_after_theme_setup() {
		// Update fields in the meta box
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['post_meta_box']) && $THEMEREX_GLOBALS['post_meta_box']['page']=='clients') {
			// Meta box fields
			$THEMEREX_GLOBALS['post_meta_box']['title'] = __('Client Options', 'themerex');
			$THEMEREX_GLOBALS['post_meta_box']['fields'] = array(
				"mb_partition_clients" => array(
					"title" => __('Clients', 'themerex'),
					"override" => "page,post",
					"divider" => false,
					"icon" => "iconadmin-users",
					"type" => "partition"),
				"mb_info_clients_1" => array(
					"title" => __('Client details', 'themerex'),
					"override" => "page,post",
					"divider" => false,
					"desc" => __('In this section you can put details for this client', 'themerex'),
					"class" => "course_meta",
					"type" => "info"),
				"client_name" => array(
					"title" => __('Contact name',  'themerex'),
					"desc" => __("Name of the contacts manager", 'themerex'),
					"override" => "page,post",
					"class" => "client_name",
					"std" => '',
					"type" => "text"),
				"client_position" => array(
					"title" => __('Position',  'themerex'),
					"desc" => __("Position of the contacts manager", 'themerex'),
					"override" => "page,post",
					"class" => "client_position",
					"std" => '',
					"type" => "text"),
				"client_show_link" => array(
					"title" => __('Show link',  'themerex'),
					"desc" => __("Show link to client page", 'themerex'),
					"override" => "page,post",
					"class" => "client_show_link",
					"std" => "no",
					"options" => themerex_get_list_yesno(),
					"type" => "switch"),
				"client_link" => array(
					"title" => __('Link',  'themerex'),
					"desc" => __("URL of the client's site. If empty - use link to this page", 'themerex'),
					"override" => "page,post",
					"class" => "client_link",
					"std" => '',
					"type" => "text")
			);
		}
	}
}


// Return true, if current page is clients page
if ( !function_exists( 'themerex_is_clients_page' ) ) {
	function themerex_is_clients_page() {
		return get_query_var('post_type')=='clients' || is_tax('clients_group') || (is_page() && themerex_get_template_page_id('blog-clients')==get_the_ID());
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'themerex_clients_detect_inheritance_key' ) ) {
	//add_filter('themerex_filter_detect_inheritance_key',	'themerex_clients_detect_inheritance_key', 9, 1);
	function themerex_clients_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return themerex_is_clients_page() ? 'clients' : '';
	}
}

// Filter to detect current page slug
if ( !function_exists( 'themerex_clients_get_blog_type' ) ) {
	//add_filter('themerex_filter_get_blog_type',	'themerex_clients_get_blog_type', 9, 2);
	function themerex_clients_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		if ($query && $query->is_tax('clients_group') || is_tax('clients_group'))
			$page = 'clients_category';
		else if ($query && $query->get('post_type')=='clients' || get_query_var('post_type')=='clients')
			$page = $query && $query->is_single() || is_single() ? 'clients_item' : 'clients';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'themerex_clients_get_blog_title' ) ) {
	//add_filter('themerex_filter_get_blog_title',	'themerex_clients_get_blog_title', 9, 2);
	function themerex_clients_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		if ( themerex_strpos($page, 'clients')!==false ) {
			if ( $page == 'clients_category' ) {
				$term = get_term_by( 'slug', get_query_var( 'clients_group' ), 'clients_group', OBJECT);
				$title = $term->name;
			} else if ( $page == 'clients_item' ) {
				$title = themerex_get_post_title();
			} else {
				$title = __('All clients', 'themerex');
			}
		}

		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'themerex_clients_get_stream_page_title' ) ) {
	//add_filter('themerex_filter_get_stream_page_title',	'themerex_clients_get_stream_page_title', 9, 2);
	function themerex_clients_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (themerex_strpos($page, 'clients')!==false) {
			if (($page_id = themerex_clients_get_stream_page_id(0, $page=='clients' ? 'blog-clients' : $page)) > 0)
				$title = themerex_get_post_title($page_id);
			else
				$title = __('All clients', 'themerex');				
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'themerex_clients_get_stream_page_id' ) ) {
	//add_filter('themerex_filter_get_stream_page_id',	'themerex_clients_get_stream_page_id', 9, 2);
	function themerex_clients_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (themerex_strpos($page, 'clients')!==false) $id = themerex_get_template_page_id('blog-clients');
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'themerex_clients_get_stream_page_link' ) ) {
	//add_filter('themerex_filter_get_stream_page_link',	'themerex_clients_get_stream_page_link', 9, 2);
	function themerex_clients_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (themerex_strpos($page, 'clients')!==false) {
			$id = themerex_get_template_page_id('blog-clients');
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'themerex_clients_get_current_taxonomy' ) ) {
	//add_filter('themerex_filter_get_current_taxonomy',	'themerex_clients_get_current_taxonomy', 9, 2);
	function themerex_clients_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( themerex_strpos($page, 'clients')!==false ) {
			$tax = 'clients_group';
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'themerex_clients_is_taxonomy' ) ) {
	//add_filter('themerex_filter_is_taxonomy',	'themerex_clients_is_taxonomy', 9, 2);
	function themerex_clients_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else 
			return $query && $query->get('clients_group')!='' || is_tax('clients_group') ? 'clients_group' : '';
	}
}

// Add custom post type and/or taxonomies arguments to the query
if ( !function_exists( 'themerex_clients_query_add_filters' ) ) {
	//add_filter('themerex_filter_query_add_filters',	'themerex_clients_query_add_filters', 9, 2);
	function themerex_clients_query_add_filters($args, $filter) {
		if ($filter == 'clients') {
			$args['post_type'] = 'clients';
		}
		return $args;
	}
}





// ---------------------------------- [trx_clients] ---------------------------------------

/*
[trx_clients id="unique_id" columns="3" style="clients-1|clients-2|..."]
	[trx_clients_item name="client name" position="director" image="url"]Description text[/trx_clients_item]
	...
[/trx_clients]
*/
if ( !function_exists( 'themerex_sc_clients' ) ) {
	//add_shortcode('trx_clients', 'themerex_sc_clients');
	function themerex_sc_clients($atts, $content=null){	
		if (themerex_sc_in_shortcode_blogger()) return '';
		extract(themerex_sc_html_decode(shortcode_atts(array(
			// Individual params
			"style" => "clients-1",
			"columns" => 4,
			"slider" => "no",
			"controls" => "no",
			"interval" => "",
			"autoheight" => "no",
			"custom" => "no",
			"ids" => "",
			"cat" => "",
			"count" => 3,
			"offset" => "",
			"orderby" => "date",
			"order" => "desc",
			"title" => "",
			"subtitle" => "",
			"description" => "",
			"link_caption" => __('Learn more', 'themerex'),
			"link" => '',
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"width" => "",
			"height" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));

		if (empty($id)) $id = "sc_clients_".str_replace('.', '', mt_rand());
		if (empty($width)) $width = "100%";
		if (!empty($height) && themerex_sc_param_is_on($autoheight)) $autoheight = "no";
		if (empty($interval)) $interval = mt_rand(5000, 10000);

		$ms = themerex_get_css_position_from_values($top, $right, $bottom, $left);
		$ws = themerex_get_css_position_from_values('', '', '', '', $width);
		$hs = themerex_get_css_position_from_values('', '', '', '', '', $height);
		$css .= ($ms) . ($hs) . ($ws);

		if (themerex_sc_param_is_on($slider)) themerex_enqueue_slider('swiper');
	
		$columns = max(1, min(12, $columns));
		$count = max(1, (int) $count);
		if (themerex_sc_param_is_off($custom) && $count < $columns) $columns = $count;

		global $THEMEREX_GLOBALS;
		$THEMEREX_GLOBALS['sc_clients_id'] = $id;
		$THEMEREX_GLOBALS['sc_clients_style'] = $style;
		$THEMEREX_GLOBALS['sc_clients_counter'] = 0;
		$THEMEREX_GLOBALS['sc_clients_columns'] = $columns;
		$THEMEREX_GLOBALS['sc_clients_slider'] = $slider;
		$THEMEREX_GLOBALS['sc_clients_css_wh'] = $ws . $hs;

		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
						. ' class="sc_clients sc_clients_style_'.esc_attr($style)
							. ' ' . esc_attr(themerex_get_template_property($style, 'container_classes'))
							. ' ' . esc_attr(themerex_get_slider_controls_classes($controls))
							. (!empty($class) ? ' '.esc_attr($class) : '')
							. (themerex_sc_param_is_on($slider)
								? ' sc_slider_swiper swiper-slider-container'
									. (themerex_sc_param_is_on($autoheight) ? ' sc_slider_height_auto' : '')
									. ($hs ? ' sc_slider_height_fixed' : '')
								: '')
						.'"'
						. (!empty($width) && themerex_strpos($width, '%')===false ? ' data-old-width="' . esc_attr($width) . '"' : '')
						. (!empty($height) && themerex_strpos($height, '%')===false ? ' data-old-height="' . esc_attr($height) . '"' : '')
						. ((int) $interval > 0 ? ' data-interval="'.esc_attr($interval).'"' : '')
						. ($columns > 1 ? ' data-slides-per-view="' . esc_attr($columns) . '"' : '')
						. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
						. (!themerex_sc_param_is_off($animation) ? ' data-animation="'.esc_attr(themerex_sc_get_animation_classes($animation)).'"' : '')
					. '>'
					. (!empty($subtitle) ? '<h6 class="sc_clients_subtitle sc_item_subtitle">' . trim(themerex_strmacros($subtitle)) . '</h6>' : '')
					. (!empty($title) ? '<h2 class="sc_clients_title sc_item_title">' . trim(themerex_strmacros($title)) . '</h2>' : '')
					. (!empty($description) ? '<div class="sc_clients_descr sc_item_descr">' . trim(themerex_strmacros($description)) . '</div>' : '')
					. (themerex_sc_param_is_on($slider) 
						? '<div class="slides swiper-wrapper">' 
						: ($columns > 1 
							? '<div class="sc_columns columns_wrap">' 
							: '')
						);
	
		$content = do_shortcode($content);
	
		if (themerex_sc_param_is_on($custom) && $content) {
			$output .= $content;
		} else {
			global $post;
	
			if (!empty($ids)) {
				$posts = explode(',', $ids);
				$count = count($posts);
			}
			
			$args = array(
				'post_type' => 'clients',
				'post_status' => 'publish',
				'posts_per_page' => $count,
				'ignore_sticky_posts' => true,
				'order' => $order=='asc' ? 'asc' : 'desc',
			);
		
			if ($offset > 0 && empty($ids)) {
				$args['offset'] = $offset;
			}
		
			$args = themerex_query_add_sort_order($args, $orderby, $order);
			$args = themerex_query_add_posts_and_cats($args, $ids, 'clients', $cat, 'clients_group');

			$query = new WP_Query( $args );
	
			$post_number = 0;
				
			while ( $query->have_posts() ) { 
				$query->the_post();
				$post_number++;
				$args = array(
					'layout' => $style,
					'show' => false,
					'number' => $post_number,
					'posts_on_page' => ($count > 0 ? $count : $query->found_posts),
					"descr" => themerex_get_custom_option('post_excerpt_maxlength'.($columns > 1 ? '_masonry' : '')),
					"orderby" => $orderby,
					'content' => false,
					'terms_list' => false,
					'columns_count' => $columns,
					'slider' => $slider,
					'tag_id' => $id ? $id . '_' . $post_number : '',
					'tag_class' => '',
					'tag_animation' => '',
					'tag_css' => '',
					'tag_css_wh' => $ws . $hs
				);
				$post_data = themerex_get_post_data($args);
				$post_meta = get_post_meta($post_data['post_id'], 'post_custom_options', true);
				$thumb_sizes = themerex_get_thumb_sizes(array('layout' => $style));
				$args['client_name'] = $post_meta['client_name'];
				$args['client_position'] = $post_meta['client_position'];
				$args['client_image'] = $post_data['post_thumb'];
				$args['client_link'] = themerex_sc_param_is_on('client_show_link')
					? (!empty($post_meta['client_link']) ? $post_meta['client_link'] : $post_data['post_link'])
					: '';
				$output .= themerex_show_post_layout($args, $post_data);
			}
			wp_reset_postdata();
		}
	
		if (themerex_sc_param_is_on($slider)) {
			$output .= '</div>'
				. '<div class="sc_slider_controls_wrap"><a class="sc_slider_prev" href="#"></a><a class="sc_slider_next" href="#"></a></div>'
				. '<div class="sc_slider_pagination_wrap"></div>';
		} else if ($columns > 1) {
			$output .= '</div>';
		}

		$output .= (!empty($link) ? '<div class="sc_clients_button sc_item_button">'.do_shortcode('[trx_button link="'.esc_url($link).'" icon="icon-right"]'.esc_html($link_caption).'[/trx_button]').'</div>' : '')
			. '</div>';
	
		return apply_filters('themerex_shortcode_output', $output, 'trx_clients', $atts, $content);
	}
}


if ( !function_exists( 'themerex_sc_clients_item' ) ) {
	//add_shortcode('trx_clients_item', 'themerex_sc_clients_item');
	function themerex_sc_clients_item($atts, $content=null) {
		if (themerex_sc_in_shortcode_blogger()) return '';
		extract(themerex_sc_html_decode(shortcode_atts( array(
			// Individual params
			"name" => "",
			"position" => "",
			"image" => "",
			"link" => "",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => ""
		), $atts)));
	
		global $THEMEREX_GLOBALS;
		$THEMEREX_GLOBALS['sc_clients_counter']++;
	
		$id = $id ? $id : ($THEMEREX_GLOBALS['sc_clients_id'] ? $THEMEREX_GLOBALS['sc_clients_id'] . '_' . $THEMEREX_GLOBALS['sc_clients_counter'] : '');
	
		$descr = trim(chop(do_shortcode($content)));
	
		$thumb_sizes = themerex_get_thumb_sizes(array('layout' => $THEMEREX_GLOBALS['sc_clients_style']));

		if ($image > 0) {
			$attach = wp_get_attachment_image_src( $image, 'full' );
			if (isset($attach[0]) && $attach[0]!='')
				$image = $attach[0];
		}
		$image = themerex_get_resized_image_tag($image, $thumb_sizes['w'], $thumb_sizes['h']);

		$post_data = array(
			'post_title' => $name,
			'post_excerpt' => $descr
		);
		$args = array(
			'layout' => $THEMEREX_GLOBALS['sc_clients_style'],
			'number' => $THEMEREX_GLOBALS['sc_clients_counter'],
			'columns_count' => $THEMEREX_GLOBALS['sc_clients_columns'],
			'slider' => $THEMEREX_GLOBALS['sc_clients_slider'],
			'show' => false,
			'descr'  => 0,
			'tag_id' => $id,
			'tag_class' => $class,
			'tag_animation' => $animation,
			'tag_css' => $css,
			'tag_css_wh' => $THEMEREX_GLOBALS['sc_clients_css_wh'],
			'client_position' => $position,
			'client_link' => $link,
			'client_image' => $image
		);
		$output = themerex_show_post_layout($args, $post_data);
		return apply_filters('themerex_shortcode_output', $output, 'trx_clients_item', $atts, $content);
	}
}
// ---------------------------------- [/trx_clients] ---------------------------------------



// Add [trx_clients] and [trx_clients_item] in the shortcodes list
if (!function_exists('themerex_clients_add_shortcodes')) {
	//add_filter('themerex_action_shortcodes_list',	'themerex_clients_add_shortcodes');
	function themerex_clients_add_shortcodes() {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['shortcodes'])) {

			$users = themerex_get_list_users();
			$members = themerex_get_list_posts(false, array(
				'post_type'=>'clients',
				'orderby'=>'title',
				'order'=>'asc',
				'return'=>'title'
				)
			);
			$clients_groups = themerex_get_list_terms(false, 'clients_group');
			$clients_styles = themerex_get_list_templates('clients');
			$controls 		= themerex_get_list_slider_controls();

			themerex_array_insert_after($THEMEREX_GLOBALS['shortcodes'], 'trx_chat', array(

				// Clients
				"trx_clients" => array(
					"title" => __("Clients", "themerex"),
					"desc" => __("Insert clients list in your page (post)", "themerex"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"title" => array(
							"title" => __("Title", "themerex"),
							"desc" => __("Title for the block", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"subtitle" => array(
							"title" => __("Subtitle", "themerex"),
							"desc" => __("Subtitle for the block", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"description" => array(
							"title" => __("Description", "themerex"),
							"desc" => __("Short description for the block", "themerex"),
							"value" => "",
							"type" => "textarea"
						),
						"style" => array(
							"title" => __("Clients style", "themerex"),
							"desc" => __("Select style to display clients list", "themerex"),
							"value" => "clients-1",
							"type" => "select",
							"options" => $clients_styles
						),
						"columns" => array(
							"title" => __("Columns", "themerex"),
							"desc" => __("How many columns use to show clients", "themerex"),
							"value" => 3,
							"min" => 2,
							"max" => 6,
							"step" => 1,
							"type" => "spinner"
						),
						"slider" => array(
							"title" => __("Slider", "themerex"),
							"desc" => __("Use slider to show clients", "themerex"),
							"value" => "yes",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"controls" => array(
							"title" => __("Controls", "themerex"),
							"desc" => __("Slider controls style and position", "themerex"),
							"dependency" => array(
								'slider' => array('yes')
							),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $controls
						),
						"interval" => array(
							"title" => __("Slides change interval", "themerex"),
							"desc" => __("Slides change interval (in milliseconds: 1000ms = 1s)", "themerex"),
							"dependency" => array(
								'slider' => array('yes')
							),
							"value" => 7000,
							"step" => 500,
							"min" => 0,
							"type" => "spinner"
						),
						"autoheight" => array(
							"title" => __("Autoheight", "themerex"),
							"desc" => __("Change whole slider's height (make it equal current slide's height)", "themerex"),
							"dependency" => array(
								'slider' => array('yes')
							),
							"value" => "yes",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"custom" => array(
							"title" => __("Custom", "themerex"),
							"desc" => __("Allow get team members from inner shortcodes (custom) or get it from specified group (cat)", "themerex"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"cat" => array(
							"title" => __("Categories", "themerex"),
							"desc" => __("Select categories (groups) to show team members. If empty - select team members from any category (group) or from IDs list", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"divider" => true,
							"value" => "",
							"type" => "select",
							"style" => "list",
							"multiple" => true,
							"options" => themerex_array_merge(array(0 => __('- Select category -', 'themerex')), $clients_groups)
						),
						"count" => array(
							"title" => __("Number of posts", "themerex"),
							"desc" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => 3,
							"min" => 1,
							"max" => 100,
							"type" => "spinner"
						),
						"offset" => array(
							"title" => __("Offset before select posts", "themerex"),
							"desc" => __("Skip posts before select next part.", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => 0,
							"min" => 0,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Post order by", "themerex"),
							"desc" => __("Select desired posts sorting method", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "title",
							"type" => "select",
							"options" => $THEMEREX_GLOBALS['sc_params']['sorting']
						),
						"order" => array(
							"title" => __("Post order", "themerex"),
							"desc" => __("Select desired posts order", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "asc",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['ordering']
						),
						"ids" => array(
							"title" => __("Post IDs list", "themerex"),
							"desc" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "",
							"type" => "text"
						),
						"link" => array(
							"title" => __("Button URL", "themerex"),
							"desc" => __("Link URL for the button at the bottom of the block", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"link_caption" => array(
							"title" => __("Button caption", "themerex"),
							"desc" => __("Caption for the button at the bottom of the block", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_clients_item",
						"title" => __("Client", "themerex"),
						"desc" => __("Single client (custom parameters)", "themerex"),
						"container" => true,
						"params" => array(
							"name" => array(
								"title" => __("Name", "themerex"),
								"desc" => __("Client's name", "themerex"),
								"divider" => true,
								"value" => "",
								"type" => "text"
							),
							"position" => array(
								"title" => __("Position", "themerex"),
								"desc" => __("Client's position", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"link" => array(
								"title" => __("Link", "themerex"),
								"desc" => __("Link on client's personal page", "themerex"),
								"divider" => true,
								"value" => "",
								"type" => "text"
							),
							"image" => array(
								"title" => __("Image", "themerex"),
								"desc" => __("Client's image", "themerex"),
								"value" => "",
								"readonly" => false,
								"type" => "media"
							),
							"_content_" => array(
								"title" => __("Description", "themerex"),
								"desc" => __("Client's short description", "themerex"),
								"divider" => true,
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $THEMEREX_GLOBALS['sc_params']['id'],
							"class" => $THEMEREX_GLOBALS['sc_params']['class'],
							"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
							"css" => $THEMEREX_GLOBALS['sc_params']['css']
						)
					)
				)

			));
		}
	}
}


// Add [trx_clients] and [trx_clients_item] in the VC shortcodes list
if (!function_exists('themerex_clients_add_shortcodes_vc')) {
	//add_filter('themerex_action_shortcodes_list_vc',	'themerex_clients_add_shortcodes_vc');
	function themerex_clients_add_shortcodes_vc() {
		global $THEMEREX_GLOBALS;

		$clients_groups = themerex_get_list_terms(false, 'clients_group');
		$clients_styles = themerex_get_list_templates('clients');
		$controls		= themerex_get_list_slider_controls();

		// Clients
		vc_map( array(
				"base" => "trx_clients",
				"name" => __("Clients", "themerex"),
				"description" => __("Insert clients list", "themerex"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_clients',
				"class" => "trx_sc_columns trx_sc_clients",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"as_parent" => array('only' => 'trx_clients_item'),
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => __("Clients style", "themerex"),
						"description" => __("Select style to display clients list", "themerex"),
						"class" => "",
						"admin_label" => true,
						"value" => array_flip($clients_styles),
						"type" => "dropdown"
					),
					array(
						"param_name" => "columns",
						"heading" => __("Columns", "themerex"),
						"description" => __("How many columns use to show clients", "themerex"),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "slider",
						"heading" => __("Slider", "themerex"),
						"description" => __("Use slider to show testimonials", "themerex"),
						"admin_label" => true,
						"group" => __('Slider', 'themerex'),
						"class" => "",
						"std" => "yes",
						"value" => array_flip($THEMEREX_GLOBALS['sc_params']['yes_no']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "controls",
						"heading" => __("Controls", "themerex"),
						"description" => __("Slider controls style and position", "themerex"),
						"admin_label" => true,
						"group" => __('Slider', 'themerex'),
						'dependency' => array(
							'element' => 'slider',
							'value' => 'yes'
						),
						"class" => "",
						"std" => "no",
						"value" => array_flip($controls),
						"type" => "dropdown"
					),
					array(
						"param_name" => "interval",
						"heading" => __("Slides change interval", "themerex"),
						"description" => __("Slides change interval (in milliseconds: 1000ms = 1s)", "themerex"),
						"group" => __('Slider', 'themerex'),
						'dependency' => array(
							'element' => 'slider',
							'value' => 'yes'
						),
						"class" => "",
						"value" => "7000",
						"type" => "textfield"
					),
					array(
						"param_name" => "autoheight",
						"heading" => __("Autoheight", "themerex"),
						"description" => __("Change whole slider's height (make it equal current slide's height)", "themerex"),
						"group" => __('Slider', 'themerex'),
						'dependency' => array(
							'element' => 'slider',
							'value' => 'yes'
						),
						"class" => "",
						"value" => array("Autoheight" => "yes" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "custom",
						"heading" => __("Custom", "themerex"),
						"description" => __("Allow get clients from inner shortcodes (custom) or get it from specified group (cat)", "themerex"),
						"class" => "",
						"value" => array("Custom clients" => "yes" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "title",
						"heading" => __("Title", "themerex"),
						"description" => __("Title for the block", "themerex"),
						"admin_label" => true,
						"group" => __('Captions', 'themerex'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "subtitle",
						"heading" => __("Subtitle", "themerex"),
						"description" => __("Subtitle for the block", "themerex"),
						"group" => __('Captions', 'themerex'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "description",
						"heading" => __("Description", "themerex"),
						"description" => __("Description for the block", "themerex"),
						"group" => __('Captions', 'themerex'),
						"class" => "",
						"value" => "",
						"type" => "textarea"
					),
					array(
						"param_name" => "cat",
						"heading" => __("Categories", "themerex"),
						"description" => __("Select category to show clients. If empty - select clients from any category (group) or from IDs list", "themerex"),
						"group" => __('Query', 'themerex'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => array_flip(themerex_array_merge(array(0 => __('- Select category -', 'themerex')), $clients_groups)),
						"type" => "dropdown"
					),
					array(
						"param_name" => "count",
						"heading" => __("Number of posts", "themerex"),
						"description" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "themerex"),
						"group" => __('Query', 'themerex'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "3",
						"type" => "textfield"
					),
					array(
						"param_name" => "offset",
						"heading" => __("Offset before select posts", "themerex"),
						"description" => __("Skip posts before select next part.", "themerex"),
						"group" => __('Query', 'themerex'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "0",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => __("Post sorting", "themerex"),
						"description" => __("Select desired posts sorting method", "themerex"),
						"group" => __('Query', 'themerex'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => array_flip($THEMEREX_GLOBALS['sc_params']['sorting']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => __("Post order", "themerex"),
						"description" => __("Select desired posts order", "themerex"),
						"group" => __('Query', 'themerex'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => array_flip($THEMEREX_GLOBALS['sc_params']['ordering']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "ids",
						"heading" => __("client's IDs list", "themerex"),
						"description" => __("Comma separated list of client's ID. If set - parameters above (category, count, order, etc.)  are ignored!", "themerex"),
						"group" => __('Query', 'themerex'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "link",
						"heading" => __("Button URL", "themerex"),
						"description" => __("Link URL for the button at the bottom of the block", "themerex"),
						"group" => __('Captions', 'themerex'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "link_caption",
						"heading" => __("Button caption", "themerex"),
						"description" => __("Caption for the button at the bottom of the block", "themerex"),
						"group" => __('Captions', 'themerex'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					$THEMEREX_GLOBALS['vc_params']['margin_top'],
					$THEMEREX_GLOBALS['vc_params']['margin_bottom'],
					$THEMEREX_GLOBALS['vc_params']['margin_left'],
					$THEMEREX_GLOBALS['vc_params']['margin_right'],
					$THEMEREX_GLOBALS['vc_params']['id'],
					$THEMEREX_GLOBALS['vc_params']['class'],
					$THEMEREX_GLOBALS['vc_params']['animation'],
					$THEMEREX_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxColumnsView'
			) );
			
			
		vc_map( array(
				"base" => "trx_clients_item",
				"name" => __("Client", "themerex"),
				"description" => __("Client - all data pull out from it account on your site", "themerex"),
				"show_settings_on_create" => true,
				"class" => "trx_sc_item trx_sc_column_item trx_sc_clients_item",
				"content_element" => true,
				"is_container" => false,
				'icon' => 'icon_trx_clients_item',
				"as_child" => array('only' => 'trx_clients'),
				"as_parent" => array('except' => 'trx_clients'),
				"params" => array(
					array(
						"param_name" => "name",
						"heading" => __("Name", "themerex"),
						"description" => __("Client's name", "themerex"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "position",
						"heading" => __("Position", "themerex"),
						"description" => __("Client's position", "themerex"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "link",
						"heading" => __("Link", "themerex"),
						"description" => __("Link on client's personal page", "themerex"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "image",
						"heading" => __("Client's image", "themerex"),
						"description" => __("Clients's image", "themerex"),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					$THEMEREX_GLOBALS['vc_params']['id'],
					$THEMEREX_GLOBALS['vc_params']['class'],
					$THEMEREX_GLOBALS['vc_params']['animation'],
					$THEMEREX_GLOBALS['vc_params']['css']
				)
			) );
			
		class WPBakeryShortCode_Trx_Clients extends THEMEREX_VC_ShortCodeColumns {}
		class WPBakeryShortCode_Trx_Clients_Item extends THEMEREX_VC_ShortCodeItem {}

	}
}
?>