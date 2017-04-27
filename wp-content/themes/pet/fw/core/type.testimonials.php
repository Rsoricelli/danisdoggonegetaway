<?php
/**
 * ThemeREX Framework: Testimonial post type settings
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Theme init
if (!function_exists('themerex_testimonial_theme_setup')) {
	add_action( 'themerex_action_before_init_theme', 'themerex_testimonial_theme_setup' );
	function themerex_testimonial_theme_setup() {
	
		// Add item in the admin menu
		add_action('admin_menu',			'themerex_testimonial_add_meta_box');

		// Save data from meta box
		add_action('save_post',				'themerex_testimonial_save_data');

		// Add shortcodes [trx_testimonials] and [trx_testimonials_item]
		add_action('themerex_action_shortcodes_list',		'themerex_testimonials_add_shortcodes');
		add_action('themerex_action_shortcodes_list_vc',	'themerex_testimonials_add_shortcodes_vc');
		add_shortcode('trx_testimonials',					'themerex_sc_testimonials');
		add_shortcode('trx_testimonials_item',				'themerex_sc_testimonials_item');

		// Meta box fields
		global $THEMEREX_GLOBALS;
		$THEMEREX_GLOBALS['testimonial_meta_box'] = array(
			'id' => 'testimonial-meta-box',
			'title' => __('Testimonial Details', 'themerex'),
			'page' => 'testimonial',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				"testimonial_author" => array(
					"title" => __('Testimonial author',  'themerex'),
					"desc" => __("Name of the testimonial's author", 'themerex'),
					"class" => "testimonial_author",
					"std" => "",
					"type" => "text"),
				"testimonial_position" => array(
					"title" => __("Author's position",  'themerex'),
					"desc" => __("Position of the testimonial's author", 'themerex'),
					"class" => "testimonial_author",
					"std" => "",
					"type" => "text"),
				"testimonial_email" => array(
					"title" => __("Author's e-mail",  'themerex'),
					"desc" => __("E-mail of the testimonial's author - need to take Gravatar (if registered)", 'themerex'),
					"class" => "testimonial_email",
					"std" => "",
					"type" => "text"),
				"testimonial_link" => array(
					"title" => __('Testimonial link',  'themerex'),
					"desc" => __("URL of the testimonial source or author profile page", 'themerex'),
					"class" => "testimonial_link",
					"std" => "",
					"type" => "text")
			)
		);
		
		if (function_exists('themerex_require_data')) {
			// Prepare type "Testimonial"
			themerex_require_data( 'post_type', 'testimonial', array(
				'label'               => __( 'Testimonial', 'themerex' ),
				'description'         => __( 'Testimonial Description', 'themerex' ),
				'labels'              => array(
					'name'                => _x( 'Testimonials', 'Post Type General Name', 'themerex' ),
					'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'themerex' ),
					'menu_name'           => __( 'Testimonials', 'themerex' ),
					'parent_item_colon'   => __( 'Parent Item:', 'themerex' ),
					'all_items'           => __( 'All Testimonials', 'themerex' ),
					'view_item'           => __( 'View Item', 'themerex' ),
					'add_new_item'        => __( 'Add New Testimonial', 'themerex' ),
					'add_new'             => __( 'Add New', 'themerex' ),
					'edit_item'           => __( 'Edit Item', 'themerex' ),
					'update_item'         => __( 'Update Item', 'themerex' ),
					'search_items'        => __( 'Search Item', 'themerex' ),
					'not_found'           => __( 'Not found', 'themerex' ),
					'not_found_in_trash'  => __( 'Not found in Trash', 'themerex' ),
				),
				'supports'            => array( 'title', 'editor', 'author', 'thumbnail'),
				'hierarchical'        => false,
				'public'              => false,
				'show_ui'             => true,
				'menu_icon'			  => 'dashicons-cloud',
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => 26,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'capability_type'     => 'page',
				)
			);
			
			// Prepare taxonomy for testimonial
			themerex_require_data( 'taxonomy', 'testimonial_group', array(
				'post_type'			=> array( 'testimonial' ),
				'hierarchical'      => true,
				'labels'            => array(
					'name'              => _x( 'Testimonials Group', 'taxonomy general name', 'themerex' ),
					'singular_name'     => _x( 'Group', 'taxonomy singular name', 'themerex' ),
					'search_items'      => __( 'Search Groups', 'themerex' ),
					'all_items'         => __( 'All Groups', 'themerex' ),
					'parent_item'       => __( 'Parent Group', 'themerex' ),
					'parent_item_colon' => __( 'Parent Group:', 'themerex' ),
					'edit_item'         => __( 'Edit Group', 'themerex' ),
					'update_item'       => __( 'Update Group', 'themerex' ),
					'add_new_item'      => __( 'Add New Group', 'themerex' ),
					'new_item_name'     => __( 'New Group Name', 'themerex' ),
					'menu_name'         => __( 'Testimonial Group', 'themerex' ),
				),
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'testimonial_group' ),
				)
			);
		}
	}
}


// Add meta box
if (!function_exists('themerex_testimonial_add_meta_box')) {
	//add_action('admin_menu', 'themerex_testimonial_add_meta_box');
	function themerex_testimonial_add_meta_box() {
		global $THEMEREX_GLOBALS;
		$mb = $THEMEREX_GLOBALS['testimonial_meta_box'];
		add_meta_box($mb['id'], $mb['title'], 'themerex_testimonial_show_meta_box', $mb['page'], $mb['context'], $mb['priority']);
	}
}

// Callback function to show fields in meta box
if (!function_exists('themerex_testimonial_show_meta_box')) {
	function themerex_testimonial_show_meta_box() {
		global $post, $THEMEREX_GLOBALS;

		// Use nonce for verification
		echo '<input type="hidden" name="meta_box_testimonial_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		
		$data = get_post_meta($post->ID, 'testimonial_data', true);
	
		$fields = $THEMEREX_GLOBALS['testimonial_meta_box']['fields'];
		?>
		<table class="testimonial_area">
		<?php
		if (is_array($fields) && count($fields) > 0) {
			foreach ($fields as $id=>$field) { 
				$meta = isset($data[$id]) ? $data[$id] : '';
				?>
				<tr class="testimonial_field <?php echo esc_attr($field['class']); ?>" valign="top">
					<td><label for="<?php echo esc_attr($id); ?>"><?php echo esc_attr($field['title']); ?></label></td>
					<td><input type="text" name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($meta); ?>" size="30" />
						<br><small><?php echo esc_attr($field['desc']); ?></small></td>
				</tr>
				<?php
			}
		}
		?>
		</table>
		<?php
	}
}


// Save data from meta box
if (!function_exists('themerex_testimonial_save_data')) {
	//add_action('save_post', 'themerex_testimonial_save_data');
	function themerex_testimonial_save_data($post_id) {
		// verify nonce
		if (!isset($_POST['meta_box_testimonial_nonce']) || !wp_verify_nonce($_POST['meta_box_testimonial_nonce'], basename(__FILE__))) {
			return $post_id;
		}

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// check permissions
		if ($_POST['post_type']!='testimonial' || !current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		global $THEMEREX_GLOBALS;

		$data = array();

		$fields = $THEMEREX_GLOBALS['testimonial_meta_box']['fields'];

		// Post type specific data handling
		if (is_array($fields) && count($fields) > 0) {
			foreach ($fields as $id=>$field) { 
				if (isset($_POST[$id])) 
					$data[$id] = stripslashes($_POST[$id]);
			}
		}

		update_post_meta($post_id, 'testimonial_data', $data);
	}
}






// ---------------------------------- [trx_testimonials] ---------------------------------------

/*
[trx_testimonials id="unique_id" style="1|2|3"]
	[trx_testimonials_item user="user_login"]Testimonials text[/trx_testimonials_item]
	[trx_testimonials_item email="" name="" position="" photo="photo_url"]Testimonials text[/trx_testimonials]
[/trx_testimonials]
*/

if (!function_exists('themerex_sc_testimonials')) {
	//add_shortcode('trx_testimonials', 'themerex_sc_testimonials');
	function themerex_sc_testimonials($atts, $content=null){	
		if (themerex_sc_in_shortcode_blogger()) return '';
		extract(themerex_sc_html_decode(shortcode_atts(array(
			// Individual params
			"style" => "testimonials-1",
			"columns" => 1,
			"slider" => "yes",
			"controls" => "no",
			"interval" => "",
			"autoheight" => "no",
			"align" => "",
			"custom" => "no",
			"ids" => "",
			"cat" => "",
			"count" => "3",
			"offset" => "",
			"orderby" => "date",
			"order" => "desc",
			"scheme" => "",
			"bg_color" => "",
			"bg_image" => "",
			"bg_overlay" => "",
			"bg_texture" => "",
			"title" => "",
			"subtitle" => "",
			"description" => "",
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
	
		if (empty($id)) $id = "sc_testimonials_".str_replace('.', '', mt_rand());
		if (empty($width)) $width = "100%";
		if (!empty($height) && themerex_sc_param_is_on($autoheight)) $autoheight = "no";
		if (empty($interval)) $interval = mt_rand(5000, 10000);
	
		if ($bg_image > 0) {
			$attach = wp_get_attachment_image_src( $bg_image, 'full' );
			if (isset($attach[0]) && $attach[0]!='')
				$bg_image = $attach[0];
		}
	
		if ($bg_overlay > 0) {
			if ($bg_color=='') $bg_color = themerex_get_scheme_color('bg');
			$rgb = themerex_hex2rgb($bg_color);
		}
		
		$ms = themerex_get_css_position_from_values($top, $right, $bottom, $left);
		$ws = themerex_get_css_position_from_values('', '', '', '', $width);
		$hs = themerex_get_css_position_from_values('', '', '', '', '', $height);
		$css .= ($ms) . ($hs) . ($ws);

		$count = max(1, (int) $count);
		$columns = max(1, min(12, (int) $columns));
		if (themerex_sc_param_is_off($custom) && $count < $columns) $columns = $count;
		
		global $THEMEREX_GLOBALS;
		$THEMEREX_GLOBALS['sc_testimonials_id'] = $id;
		$THEMEREX_GLOBALS['sc_testimonials_style'] = $style;
		$THEMEREX_GLOBALS['sc_testimonials_columns'] = $columns;
		$THEMEREX_GLOBALS['sc_testimonials_counter'] = 0;
		$THEMEREX_GLOBALS['sc_testimonials_slider'] = $slider;
		$THEMEREX_GLOBALS['sc_testimonials_css_wh'] = $ws . $hs;

		if (themerex_sc_param_is_on($slider)) themerex_enqueue_slider('swiper');
	
		$output = ($bg_color!='' || $bg_image!='' || $bg_overlay>0 || $bg_texture>0 || themerex_strlen($bg_texture)>2 || ($scheme && !themerex_sc_param_is_off($scheme) && !themerex_sc_param_is_inherit($scheme))
					? '<div class="sc_testimonials_wrap sc_section'
							. ($scheme && !themerex_sc_param_is_off($scheme) && !themerex_sc_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '') 
							. '"'
						.' style="'
							. ($bg_color !== '' && $bg_overlay==0 ? 'background-color:' . esc_attr($bg_color) . ';' : '')
							. ($bg_image !== '' ? 'background-image:url(' . esc_url($bg_image) . ');' : '')
							. '"'
						. (!themerex_sc_param_is_off($animation) ? ' data-animation="'.esc_attr(themerex_sc_get_animation_classes($animation)).'"' : '')
						. '>'
						. '<div class="sc_section_overlay'.($bg_texture>0 ? ' texture_bg_'.esc_attr($bg_texture) : '') . '"'
								. ' style="' . ($bg_overlay>0 ? 'background-color:rgba('.(int)$rgb['r'].','.(int)$rgb['g'].','.(int)$rgb['b'].','.min(1, max(0, $bg_overlay)).');' : '')
									. (themerex_strlen($bg_texture)>2 ? 'background-image:url('.esc_url($bg_texture).');' : '')
									. '"'
									. ($bg_overlay > 0 ? ' data-overlay="'.esc_attr($bg_overlay).'" data-bg_color="'.esc_attr($bg_color).'"' : '')
									. '>' 
					: '')
				. '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
				. ' class="sc_testimonials sc_testimonials_style_'.esc_attr($style)
 					. ' ' . esc_attr(themerex_get_template_property($style, 'container_classes'))
					. ' ' . esc_attr(themerex_get_slider_controls_classes($controls))
 					. (themerex_sc_param_is_on($slider)
						? ' sc_slider_swiper swiper-slider-container'
							. (themerex_sc_param_is_on($autoheight) ? ' sc_slider_height_auto' : '')
							. ($hs ? ' sc_slider_height_fixed' : '')
						: '')
					. (!empty($class) ? ' '.esc_attr($class) : '')
					. ($align!='' && $align!='none' ? ' align'.esc_attr($align) : '')
					. '"'
				. ($bg_color=='' && $bg_image=='' && $bg_overlay==0 && ($bg_texture=='' || $bg_texture=='0') && !themerex_sc_param_is_off($animation) ? ' data-animation="'.esc_attr(themerex_sc_get_animation_classes($animation)).'"' : '')
				. (!empty($width) && themerex_strpos($width, '%')===false ? ' data-old-width="' . esc_attr($width) . '"' : '')
				. (!empty($height) && themerex_strpos($height, '%')===false ? ' data-old-height="' . esc_attr($height) . '"' : '')
				. ((int) $interval > 0 ? ' data-interval="'.esc_attr($interval).'"' : '')
				. ($columns > 1 ? ' data-slides-per-view="' . esc_attr($columns) . '"' : '')
				. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
			. '>'
			. (!empty($subtitle) ? '<h6 class="sc_testimonials_subtitle sc_item_subtitle">' . trim(themerex_strmacros($subtitle)) . '</h6>' : '')
			. (!empty($title) ? '<h2 class="sc_testimonials_title sc_item_title">' . trim(themerex_strmacros($title)) . '</h2>' : '')
			. (!empty($description) ? '<div class="sc_testimonials_descr sc_item_descr">' . trim(themerex_strmacros($description)) . '</div>' : '')
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
				'post_type' => 'testimonial',
				'post_status' => 'publish',
				'posts_per_page' => $count,
				'ignore_sticky_posts' => true,
				'order' => $order=='asc' ? 'asc' : 'desc',
			);
		
			if ($offset > 0 && empty($ids)) {
				$args['offset'] = $offset;
			}
		
			$args = themerex_query_add_sort_order($args, $orderby, $order);
			$args = themerex_query_add_posts_and_cats($args, $ids, 'testimonial', $cat, 'testimonial_group');
	
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
				$post_meta = get_post_meta($post_data['post_id'], 'testimonial_data', true);
				$thumb_sizes = themerex_get_thumb_sizes(array('layout' => $style));
				$args['author'] = $post_meta['testimonial_author'];
				$args['position'] = $post_meta['testimonial_position'];
				$args['link'] = !empty($post_meta['testimonial_link']) ? $post_meta['testimonial_link'] : '';	//$post_data['post_link'];
				$args['email'] = $post_meta['testimonial_email'];
				$args['photo'] = $post_data['post_thumb'];
				if (empty($args['photo']) && !empty($args['email'])) $args['photo'] = get_avatar($args['email'], $thumb_sizes['w']*min(2, max(1, themerex_get_theme_option("retina_ready"))));
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

		$output .= '</div>'
					. ($bg_color!='' || $bg_image!='' || $bg_overlay>0 || $bg_texture>0 || themerex_strlen($bg_texture)>2
						?  '</div></div>'
						: '');

		return apply_filters('themerex_shortcode_output', $output, 'trx_testimonials', $atts, $content);
	}
}
	
	
if (!function_exists('themerex_sc_testimonials_item')) {
	//add_shortcode('trx_testimonials_item', 'themerex_sc_testimonials_item');
	function themerex_sc_testimonials_item($atts, $content=null){	
		if (themerex_sc_in_shortcode_blogger()) return '';
		extract(themerex_sc_html_decode(shortcode_atts(array(
			// Individual params
			"author" => "",
			"position" => "",
			"link" => "",
			"photo" => "",
			"email" => "",
			// Common params
			"id" => "",
			"class" => "",
			"css" => "",
		), $atts)));

		global $THEMEREX_GLOBALS;
		$THEMEREX_GLOBALS['sc_testimonials_counter']++;
	
		$id = $id ? $id : ($THEMEREX_GLOBALS['sc_testimonials_id'] ? $THEMEREX_GLOBALS['sc_testimonials_id'] . '_' . $THEMEREX_GLOBALS['sc_testimonials_counter'] : '');
	
		$thumb_sizes = themerex_get_thumb_sizes(array('layout' => $THEMEREX_GLOBALS['sc_testimonials_style']));

		if (empty($photo)) {
			if (!empty($email))
				$photo = get_avatar($email, $thumb_sizes['w']*min(2, max(1, themerex_get_theme_option("retina_ready"))));
		} else {
			if ($photo > 0) {
				$attach = wp_get_attachment_image_src( $photo, 'full' );
				if (isset($attach[0]) && $attach[0]!='')
					$photo = $attach[0];
			}
			$photo = themerex_get_resized_image_tag($photo, $thumb_sizes['w'], $thumb_sizes['h']);
		}

		$post_data = array(
			'post_content' => do_shortcode($content)
		);
		$args = array(
			'layout' => $THEMEREX_GLOBALS['sc_testimonials_style'],
			'number' => $THEMEREX_GLOBALS['sc_testimonials_counter'],
			'columns_count' => $THEMEREX_GLOBALS['sc_testimonials_columns'],
			'slider' => $THEMEREX_GLOBALS['sc_testimonials_slider'],
			'show' => false,
			'descr'  => 0,
			'tag_id' => $id,
			'tag_class' => $class,
			'tag_animation' => '',
			'tag_css' => $css,
			'tag_css_wh' => $THEMEREX_GLOBALS['sc_testimonials_css_wh'],
			'author' => $author,
			'position' => $position,
			'link' => $link,
			'email' => $email,
			'photo' => $photo
		);
		$output = themerex_show_post_layout($args, $post_data);

		return apply_filters('themerex_shortcode_output', $output, 'trx_testimonials_item', $atts, $content);
	}
}
// ---------------------------------- [/trx_testimonials] ---------------------------------------



// Add [trx_testimonials] and [trx_testimonials_item] in the shortcodes list
if (!function_exists('themerex_testimonials_add_shortcodes')) {
	//add_filter('themerex_action_shortcodes_list',	'themerex_testimonials_add_shortcodes');
	function themerex_testimonials_add_shortcodes() {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['shortcodes'])) {

			$testimonials_groups = themerex_get_list_terms(false, 'testimonial_group');
			$testimonials_styles = themerex_get_list_templates('testimonials');
			$controls = themerex_get_list_slider_controls();

			themerex_array_insert_before($THEMEREX_GLOBALS['shortcodes'], 'trx_title', array(
			
				// Testimonials
				"trx_testimonials" => array(
					"title" => __("Testimonials", "themerex"),
					"desc" => __("Insert testimonials into post (page)", "themerex"),
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
							"title" => __("Testimonials style", "themerex"),
							"desc" => __("Select style to display testimonials", "themerex"),
							"value" => "testimonials-1",
							"type" => "select",
							"options" => $testimonials_styles
						),
						"columns" => array(
							"title" => __("Columns", "themerex"),
							"desc" => __("How many columns use to show testimonials", "themerex"),
							"value" => 3,
							"min" => 1,
							"max" => 6,
							"step" => 1,
							"type" => "spinner"
						),
						"slider" => array(
							"title" => __("Slider", "themerex"),
							"desc" => __("Use slider to show testimonials", "themerex"),
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
						"align" => array(
							"title" => __("Alignment", "themerex"),
							"desc" => __("Alignment of the testimonials block", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						),
						"custom" => array(
							"title" => __("Custom", "themerex"),
							"desc" => __("Allow get testimonials from inner shortcodes (custom) or get it from specified group (cat)", "themerex"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"cat" => array(
							"title" => __("Categories", "themerex"),
							"desc" => __("Select categories (groups) to show testimonials. If empty - select testimonials from any category (group) or from IDs list", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"divider" => true,
							"value" => "",
							"type" => "select",
							"style" => "list",
							"multiple" => true,
							"options" => themerex_array_merge(array(0 => __('- Select category -', 'themerex')), $testimonials_groups)
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
							"value" => "date",
							"type" => "select",
							"options" => $THEMEREX_GLOBALS['sc_params']['sorting']
						),
						"order" => array(
							"title" => __("Post order", "themerex"),
							"desc" => __("Select desired posts order", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "desc",
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
						"scheme" => array(
							"title" => __("Color scheme", "themerex"),
							"desc" => __("Select color scheme for this block", "themerex"),
							"value" => "",
							"type" => "checklist",
							"options" => $THEMEREX_GLOBALS['sc_params']['schemes']
						),
						"bg_color" => array(
							"title" => __("Background color", "themerex"),
							"desc" => __("Any background color for this section", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"bg_image" => array(
							"title" => __("Background image URL", "themerex"),
							"desc" => __("Select or upload image or write URL from other site for the background", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_overlay" => array(
							"title" => __("Overlay", "themerex"),
							"desc" => __("Overlay color opacity (from 0.0 to 1.0)", "themerex"),
							"min" => "0",
							"max" => "1",
							"step" => "0.1",
							"value" => "0",
							"type" => "spinner"
						),
						"bg_texture" => array(
							"title" => __("Texture", "themerex"),
							"desc" => __("Predefined texture style from 1 to 11. 0 - without texture.", "themerex"),
							"min" => "0",
							"max" => "11",
							"step" => "1",
							"value" => "0",
							"type" => "spinner"
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
						"name" => "trx_testimonials_item",
						"title" => __("Item", "themerex"),
						"desc" => __("Testimonials item (custom parameters)", "themerex"),
						"container" => true,
						"params" => array(
							"author" => array(
								"title" => __("Author", "themerex"),
								"desc" => __("Name of the testimonmials author", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"link" => array(
								"title" => __("Link", "themerex"),
								"desc" => __("Link URL to the testimonmials author page", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"email" => array(
								"title" => __("E-mail", "themerex"),
								"desc" => __("E-mail of the testimonmials author (to get gravatar)", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"photo" => array(
								"title" => __("Photo", "themerex"),
								"desc" => __("Select or upload photo of testimonmials author or write URL of photo from other site", "themerex"),
								"value" => "",
								"type" => "media"
							),
							"_content_" => array(
								"title" => __("Testimonials text", "themerex"),
								"desc" => __("Current testimonials text", "themerex"),
								"divider" => true,
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $THEMEREX_GLOBALS['sc_params']['id'],
							"class" => $THEMEREX_GLOBALS['sc_params']['class'],
							"css" => $THEMEREX_GLOBALS['sc_params']['css']
						)
					)
				)

			));
		}
	}
}


// Add [trx_testimonials] and [trx_testimonials_item] in the VC shortcodes list
if (!function_exists('themerex_testimonials_add_shortcodes_vc')) {
	//add_filter('themerex_action_shortcodes_list_vc',	'themerex_testimonials_add_shortcodes_vc');
	function themerex_testimonials_add_shortcodes_vc() {
		global $THEMEREX_GLOBALS;

		$testimonials_groups = themerex_get_list_terms(false, 'testimonial_group');
		$testimonials_styles = themerex_get_list_templates('testimonials');
		$controls			 = themerex_get_list_slider_controls();
			
		// Testimonials			
		vc_map( array(
				"base" => "trx_testimonials",
				"name" => __("Testimonials", "themerex"),
				"description" => __("Insert testimonials slider", "themerex"),
				"category" => __('Content', 'js_composer'),
				'icon' => 'icon_trx_testimonials',
				"class" => "trx_sc_collection trx_sc_testimonials",
				"content_element" => true,
				"is_container" => true,
				"show_settings_on_create" => true,
				"as_parent" => array('only' => 'trx_testimonials_item'),
				"params" => array(
					array(
						"param_name" => "style",
						"heading" => __("Testimonials style", "themerex"),
						"description" => __("Select style to display testimonials", "themerex"),
						"class" => "",
						"admin_label" => true,
						"value" => array_flip($testimonials_styles),
						"type" => "dropdown"
					),
					array(
						"param_name" => "columns",
						"heading" => __("Columns", "themerex"),
						"description" => __("How many columns use to show testimonials", "themerex"),
						"admin_label" => true,
						"class" => "",
						"value" => "3",
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
						"param_name" => "align",
						"heading" => __("Alignment", "themerex"),
						"description" => __("Alignment of the testimonials block", "themerex"),
						"class" => "",
						"value" => array_flip($THEMEREX_GLOBALS['sc_params']['align']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "custom",
						"heading" => __("Custom", "themerex"),
						"description" => __("Allow get testimonials from inner shortcodes (custom) or get it from specified group (cat)", "themerex"),
						"class" => "",
						"value" => array("Custom slides" => "yes" ),
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
						"description" => __("Select categories (groups) to show testimonials. If empty - select testimonials from any category (group) or from IDs list", "themerex"),
						"group" => __('Query', 'themerex'),
						'dependency' => array(
							'element' => 'custom',
							'is_empty' => true
						),
						"class" => "",
						"value" => array_flip(themerex_array_merge(array(0 => __('- Select category -', 'themerex')), $testimonials_groups)),
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
						"heading" => __("Post IDs list", "themerex"),
						"description" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "themerex"),
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
						"param_name" => "scheme",
						"heading" => __("Color scheme", "themerex"),
						"description" => __("Select color scheme for this block", "themerex"),
						"group" => __('Colors and Images', 'themerex'),
						"class" => "",
						"value" => array_flip($THEMEREX_GLOBALS['sc_params']['schemes']),
						"type" => "dropdown"
					),
					array(
						"param_name" => "bg_color",
						"heading" => __("Background color", "themerex"),
						"description" => __("Any background color for this section", "themerex"),
						"group" => __('Colors and Images', 'themerex'),
						"class" => "",
						"value" => "",
						"type" => "colorpicker"
					),
					array(
						"param_name" => "bg_image",
						"heading" => __("Background image URL", "themerex"),
						"description" => __("Select background image from library for this section", "themerex"),
						"group" => __('Colors and Images', 'themerex'),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "bg_overlay",
						"heading" => __("Overlay", "themerex"),
						"description" => __("Overlay color opacity (from 0.0 to 1.0)", "themerex"),
						"group" => __('Colors and Images', 'themerex'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "bg_texture",
						"heading" => __("Texture", "themerex"),
						"description" => __("Texture style from 1 to 11. Empty or 0 - without texture.", "themerex"),
						"group" => __('Colors and Images', 'themerex'),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					themerex_vc_width(),
					themerex_vc_height(),
					$THEMEREX_GLOBALS['vc_params']['margin_top'],
					$THEMEREX_GLOBALS['vc_params']['margin_bottom'],
					$THEMEREX_GLOBALS['vc_params']['margin_left'],
					$THEMEREX_GLOBALS['vc_params']['margin_right'],
					$THEMEREX_GLOBALS['vc_params']['id'],
					$THEMEREX_GLOBALS['vc_params']['class'],
					$THEMEREX_GLOBALS['vc_params']['animation'],
					$THEMEREX_GLOBALS['vc_params']['css']
				)
		) );
			
			
		vc_map( array(
				"base" => "trx_testimonials_item",
				"name" => __("Testimonial", "themerex"),
				"description" => __("Single testimonials item", "themerex"),
				"show_settings_on_create" => true,
				"class" => "trx_sc_single trx_sc_testimonials_item",
				"content_element" => true,
				"is_container" => false,
				'icon' => 'icon_trx_testimonials_item',
				"as_child" => array('only' => 'trx_testimonials'),
				"as_parent" => array('except' => 'trx_testimonials'),
				"params" => array(
					array(
						"param_name" => "author",
						"heading" => __("Author", "themerex"),
						"description" => __("Name of the testimonmials author", "themerex"),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "link",
						"heading" => __("Link", "themerex"),
						"description" => __("Link URL to the testimonmials author page", "themerex"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "email",
						"heading" => __("E-mail", "themerex"),
						"description" => __("E-mail of the testimonmials author", "themerex"),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "photo",
						"heading" => __("Photo", "themerex"),
						"description" => __("Select or upload photo of testimonmials author or write URL of photo from other site", "themerex"),
						"class" => "",
						"value" => "",
						"type" => "attach_image"
					),
					array(
						"param_name" => "content",
						"heading" => __("Testimonials text", "themerex"),
						"description" => __("Current testimonials text", "themerex"),
						"class" => "",
						"value" => "",
						"type" => "textarea_html"
					),
					$THEMEREX_GLOBALS['vc_params']['id'],
					$THEMEREX_GLOBALS['vc_params']['class'],
					$THEMEREX_GLOBALS['vc_params']['css']
				),
				'js_view' => 'VcTrxTextView'
		) );
			
		class WPBakeryShortCode_Trx_Testimonials extends THEMEREX_VC_ShortCodeColumns {}
		class WPBakeryShortCode_Trx_Testimonials_Item extends THEMEREX_VC_ShortCodeSingle {}
		
	}
}
?>