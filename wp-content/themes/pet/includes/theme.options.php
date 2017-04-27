<?php

/* Theme setup section
-------------------------------------------------------------------- */



// ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
// Framework settings
$THEMEREX_GLOBALS['settings'] = array(
    'less_nested'		=> false,								// Use nested selectors when compiling less - increase .css size, but allow using nested color schemes
    'less_prefix'		=> '',									// any string - Use prefix before each selector when compile less. For example: 'html '
    'less_separator'	=> '/*---LESS_SEPARATOR---*/',			// string - separator inside .less files to split it when compiling to reduce memory usage
    'socials_type'		=> 'icons',								// images|icons - Use this kind of pictograms for all socials: share, social profiles, team members socials, etc.
    'slides_type'		=> 'images'								// images|bg - Use image as slide's content or as slide's background
);



// Default Theme Options
if ( !function_exists( 'themerex_options_settings_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_options_settings_theme_setup', 2 );	// Priority 1 for add themerex_filter handlers
	function themerex_options_settings_theme_setup() {
		global $THEMEREX_GLOBALS;

        // Clear all saved Theme Options on first theme run
        add_action('after_switch_theme', 'themerex_options_reset');

		// Settings 
		$socials_type = themerex_get_theme_setting('socials_type');
				
		// Prepare arrays 
		$THEMEREX_GLOBALS['options_params'] = array(
			'list_fonts'		=> array('$themerex_get_list_fonts' => ''),
			'list_fonts_styles'	=> array('$themerex_get_list_fonts_styles' => ''),
			'list_socials' 		=> array('$themerex_get_list_socials' => ''),
			'list_icons' 		=> array('$themerex_get_list_icons' => ''),
			'list_posts_types' 	=> array('$themerex_get_list_posts_types' => ''),
			'list_categories' 	=> array('$themerex_get_list_categories' => ''),
			'list_menus'		=> array('$themerex_get_list_menus' => ''),
			'list_sidebars'		=> array('$themerex_get_list_sidebars' => ''),
			'list_positions' 	=> array('$themerex_get_list_sidebars_positions' => ''),
			'list_skins'		=> array('$themerex_get_list_skins' => ''),
			'list_color_schemes'=> array('$themerex_get_list_color_schemes' => ''),
			'list_body_styles'	=> array('$themerex_get_list_body_styles' => ''),
			'list_header_styles'=> array('$themerex_get_list_templates_header' => ''),
			'list_blog_styles'	=> array('$themerex_get_list_templates_blog' => ''),
			'list_single_styles'=> array('$themerex_get_list_templates_single' => ''),
			'list_article_styles'=> array('$themerex_get_list_article_styles' => ''),
			'list_animations_in' => array('$themerex_get_list_animations_in' => ''),
			'list_animations_out'=> array('$themerex_get_list_animations_out' => ''),
			'list_filters'		=> array('$themerex_get_list_portfolio_filters' => ''),
			'list_hovers'		=> array('$themerex_get_list_hovers' => ''),
			'list_hovers_dir'	=> array('$themerex_get_list_hovers_directions' => ''),
			'list_sliders' 		=> array('$themerex_get_list_sliders' => ''),
			'list_revo_sliders'	=> array('$themerex_get_list_revo_sliders' => ''),
			'list_bg_image_positions' => array('$themerex_get_list_bg_image_positions' => ''),
			'list_popups' 		=> array('$themerex_get_list_popup_engines' => ''),
			'list_gmap_styles' 	=> array('$themerex_get_list_googlemap_styles' => ''),
			'list_yes_no' 		=> array('$themerex_get_list_yesno' => ''),
			'list_on_off' 		=> array('$themerex_get_list_onoff' => ''),
			'list_show_hide' 	=> array('$themerex_get_list_showhide' => ''),
			'list_sorting' 		=> array('$themerex_get_list_sortings' => ''),
			'list_ordering' 	=> array('$themerex_get_list_orderings' => ''),
			'list_locations' 	=> array('$themerex_get_list_dedicated_locations' => '')
			);


		// Theme options array
		$THEMEREX_GLOBALS['options'] = array(

		
		//###############################
		//#### Customization         #### 
		//###############################
		'partition_customization' => array(
					"title" => __('Customization', 'themerex'),
					"start" => "partitions",
					"override" => "category,services_group,page,post",
					"icon" => "iconadmin-cog-alt",
					"type" => "partition"
					),
		
		
		// Customization -> Body Style
		//-------------------------------------------------
		
		'customization_body' => array(
					"title" => __('Body style', 'themerex'),
					"override" => "category,services_group,post,page",
					"icon" => 'iconadmin-picture',
					"start" => "customization_tabs",
					"type" => "tab"
					),
		
		'info_body_1' => array(
					"title" => __('Body parameters', 'themerex'),
					"desc" => __('Select body style, skin and color scheme for entire site. You can override this parameters on any page, post or category', 'themerex'),
					"override" => "category,services_group,post,page",
					"type" => "info"
					),
					
		'body_style' => array(
					"title" => __('Body style', 'themerex'),
					"desc" => __('Select body style:<br><b>boxed</b> - if you want use background color and/or image,<br><b>wide</b> - page fill whole window with centered content,<br><b>fullwide</b> - page content stretched on the full width of the window (with few left and right paddings),<br><b>fullscreen</b> - page content fill whole window without any paddings', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "wide",
					"options" => $THEMEREX_GLOBALS['options_params']['list_body_styles'],
					"dir" => "horizontal",
					"type" => "radio"
					),

		'theme_skin' => array(
					"title" => __('Select theme skin', 'themerex'),
					"desc" => __('Select skin for the theme decoration', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "default",
					"options" => $THEMEREX_GLOBALS['options_params']['list_skins'],
					"type" => "select"
					),

		"body_scheme" => array(
					"title" => __('Color scheme', 'themerex'),
					"desc" => __('Select predefined color scheme for the entire page', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "original",
					"dir" => "horizontal",
					"options" => $THEMEREX_GLOBALS['options_params']['list_color_schemes'],
					"type" => "checklist"),
		
		'body_filled' => array(
					"title" => __('Fill body', 'themerex'),
					"desc" => __('Fill the page background with the solid color or leave it transparend to show background image (or video background)', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),


		'info_body_2' => array(
					"title" => __('Video background', 'themerex'),
					"desc" => __('Parameters of the video, used as site background', 'themerex'),
					"override" => "category,services_group,post,page",
					"type" => "info"
					),

		'show_video_bg' => array(
					"title" => __('Show video background',  'themerex'),
					"desc" => __("Show video as the site background", 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),

		'video_bg_youtube_code' => array(
					"title" => __('Youtube code for video bg',  'themerex'),
					"desc" => __("Youtube code of video", 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_video_bg' => array('yes')
					),
					"std" => "",
					"type" => "text"
					),

		'video_bg_url' => array(
					"title" => __('Local video for video bg',  'themerex'),
					"desc" => __("URL to video-file (uploaded on your site)", 'themerex'),
					"readonly" =>false,
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_video_bg' => array('yes')
					),
					"before" => array(	'title' => __('Choose video', 'themerex'),
										'action' => 'media_upload',
										'multiple' => false,
										'linked_field' => '',
										'type' => 'video',
										'captions' => array('choose' => __( 'Choose Video', 'themerex'),
															'update' => __( 'Select Video', 'themerex')
														)
								),
					"std" => "",
					"type" => "media"
					),

		'video_bg_overlay' => array(
					"title" => __('Use overlay for video bg', 'themerex'),
					"desc" => __('Use overlay texture for the video background', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_video_bg' => array('yes')
					),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),

        'info_body_2_1' => array(
                    "title" => __('Style 404 Page', 'themerex'),
                    "desc" => __('Select style from Page 404', 'themerex'),
                    "override" => "",
                    "type" => "info"
                    ),

        "style_404" => array(
                "title" => __('Style', 'themerex'),
                "desc" => __('Select if you want to change the style of 404 pages', 'themerex'),
                "override" => "",
                "std" => "white",
                "options" => array(
                    'white'  => __('White', 'themerex'),
                    'color' => __('Color', 'themerex')
                ),
                "type" => "checklist"),

		
		
		
		// Customization -> Header
		//-------------------------------------------------
		
		'customization_header' => array(
					"title" => __("Header", 'themerex'),
					"override" => "category,services_group,post,page",
					"icon" => 'iconadmin-window',
					"type" => "tab"),
		
		"info_header_1" => array(
					"title" => __('Top panel', 'themerex'),
					"desc" => __('Top panel settings. It include user menu area (with contact info, cart button, language selector, login/logout menu and user menu) and main menu area (with logo and main menu).', 'themerex'),
					"override" => "category,services_group,post,page",
					"type" => "info"),
		
		"top_panel_style" => array(
					"title" => __('Top panel style', 'themerex'),
					"desc" => __('Select desired style of the page header', 'themerex'),
					"override" => "category,services_group,page",
					"std" => "header_6",
					"options" => $THEMEREX_GLOBALS['options_params']['list_header_styles'],
					"style" => "list",
					"type" => "images"),
		
		"top_panel_position" => array( 
					"title" => __('Top panel position', 'themerex'),
					"desc" => __('Select position for the top panel with logo and main menu', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "above",
					"options" => array(
						'hide'  => __('Hide', 'themerex'),
						'above' => __('Above slider', 'themerex'),
						'below' => __('Below slider', 'themerex'),
						'over'  => __('Over slider', 'themerex')
					),
					"type" => "checklist"),

		"top_panel_scheme" => array(
					"title" => __('Top panel color scheme', 'themerex'),
					"desc" => __('Select predefined color scheme for the top panel', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "original",
					"dir" => "horizontal",
					"options" => $THEMEREX_GLOBALS['options_params']['list_color_schemes'],
					"type" => "checklist"),

        "show_top_panel_decoration" => array(
                    "title" => __('Show Decorative Pattern', 'themerex'),
                    "desc" => __('Show a decorative pattern at the top panel', 'themerex'),
                    "override" => "category,services_group,post,page",
                    "std" => "no",
                    "options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
                    "type" => "switch"),

		"show_page_title" => array(
					"title" => __('Show Page title', 'themerex'),
					"desc" => __('Show post/page/category title', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_breadcrumbs" => array(
					"title" => __('Show Breadcrumbs', 'themerex'),
					"desc" => __('Show path to current category (post, page)', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"breadcrumbs_max_level" => array(
					"title" => __('Breadcrumbs max nesting', 'themerex'),
					"desc" => __("Max number of the nested categories in the breadcrumbs (0 - unlimited)", 'themerex'),
					"dependency" => array(
						'show_breadcrumbs' => array('yes')
					),
					"std" => "0",
					"min" => 0,
					"max" => 100,
					"step" => 1,
					"type" => "spinner"),

		
		
		
		"info_header_2" => array( 
					"title" => __('Main menu style and position', 'themerex'),
					"desc" => __('Select the Main menu style and position', 'themerex'),
					"override" => "category,services_group,post,page",
					"type" => "info"),
		
		"menu_main" => array( 
					"title" => __('Select main menu',  'themerex'),
					"desc" => __('Select main menu for the current page',  'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "default",
					"options" => $THEMEREX_GLOBALS['options_params']['list_menus'],
					"type" => "select"),
		
		"menu_attachment" => array( 
					"title" => __('Main menu attachment', 'themerex'),
					"desc" => __('Attach main menu to top of window then page scroll down', 'themerex'),
					"std" => "fixed",
					"options" => array(
						"fixed"=>__("Fix menu position", 'themerex'), 
						"none"=>__("Don't fix menu position", 'themerex')
					),
					"dir" => "vertical",
					"type" => "radio"),

		"menu_slider" => array( 
					"title" => __('Main menu slider', 'themerex'),
					"desc" => __('Use slider background for main menu items', 'themerex'),
					"std" => "yes",
					"type" => "switch",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no']),

		"menu_animation_in" => array( 
					"title" => __('Submenu show animation', 'themerex'),
					"desc" => __('Select animation to show submenu ', 'themerex'),
					"std" => "bounceIn",
					"type" => "select",
					"options" => $THEMEREX_GLOBALS['options_params']['list_animations_in']),

		"menu_animation_out" => array( 
					"title" => __('Submenu hide animation', 'themerex'),
					"desc" => __('Select animation to hide submenu ', 'themerex'),
					"std" => "fadeOutDown",
					"type" => "select",
					"options" => $THEMEREX_GLOBALS['options_params']['list_animations_out']),
		
		"menu_relayout" => array( 
					"title" => __('Main menu relayout', 'themerex'),
					"desc" => __('Allow relayout main menu if window width less then this value', 'themerex'),
					"std" => 960,
					"min" => 320,
					"max" => 1024,
					"type" => "spinner"),
		
		"menu_responsive" => array( 
					"title" => __('Main menu responsive', 'themerex'),
					"desc" => __('Allow responsive version for the main menu if window width less then this value', 'themerex'),
					"std" => 650,
					"min" => 320,
					"max" => 1024,
					"type" => "spinner"),
		
		"menu_width" => array( 
					"title" => __('Submenu width', 'themerex'),
					"desc" => __('Width for dropdown menus in main menu', 'themerex'),
					"step" => 5,
					"std" => "",
					"min" => 180,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"),
		
		
		
		"info_header_3" => array(
					"title" => __("User's menu area components", 'themerex'),
					"desc" => __("Select parts for the user's menu area", 'themerex'),
					"override" => "category,services_group,page,post",
					"type" => "info"),
		
		"show_top_panel_top" => array(
					"title" => __('Show user menu area', 'themerex'),
					"desc" => __('Show user menu area on top of page', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"menu_user" => array(
					"title" => __('Select user menu',  'themerex'),
					"desc" => __('Select user menu for the current page',  'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_top_panel_top' => array('yes')
					),
					"std" => "default",
					"options" => $THEMEREX_GLOBALS['options_params']['list_menus'],
					"type" => "select"),
		
		"show_languages" => array(
					"title" => __('Show language selector', 'themerex'),
					"desc" => __('Show language selector in the user menu (if WPML plugin installed and current page/post has multilanguage version)', 'themerex'),
					"dependency" => array(
						'show_top_panel_top' => array('yes')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_login" => array( 
					"title" => __('Show Login/Logout buttons', 'themerex'),
					"desc" => __('Show Login and Logout buttons in the user menu area', 'themerex'),
					"dependency" => array(
						'show_top_panel_top' => array('yes')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_bookmarks" => array(
					"title" => __('Show bookmarks', 'themerex'),
					"desc" => __('Show bookmarks selector in the user menu', 'themerex'),
					"dependency" => array(
						'show_top_panel_top' => array('yes')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_socials" => array( 
					"title" => __('Show Social icons', 'themerex'),
					"desc" => __('Show Social icons in the user menu area', 'themerex'),
					"dependency" => array(
						'show_top_panel_top' => array('yes')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		

		
		"info_header_4" => array( 
					"title" => __("Table of Contents (TOC)", 'themerex'),
					"desc" => __("Table of Contents for the current page. Automatically created if the page contains objects with id starting with 'toc_'", 'themerex'),
					"override" => "category,services_group,page,post",
					"type" => "info"),
		
		"menu_toc" => array( 
					"title" => __('TOC position', 'themerex'),
					"desc" => __('Show TOC for the current page', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "float",
					"options" => array(
						'hide'  => __('Hide', 'themerex'),
						'fixed' => __('Fixed', 'themerex'),
						'float' => __('Float', 'themerex')
					),
					"type" => "checklist"),
		
		"menu_toc_home" => array(
					"title" => __('Add "Home" into TOC', 'themerex'),
					"desc" => __('Automatically add "Home" item into table of contents - return to home page of the site', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'menu_toc' => array('fixed','float')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"menu_toc_top" => array( 
					"title" => __('Add "To Top" into TOC', 'themerex'),
					"desc" => __('Automatically add "To Top" item into table of contents - scroll to top of the page', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'menu_toc' => array('fixed','float')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		
		
		
		'info_header_5' => array(
					"title" => __('Main logo', 'themerex'),
					"desc" => __("Select or upload logos for the site's header and select it position", 'themerex'),
					"override" => "category,services_group,post,page",
					"type" => "info"
					),

		'favicon' => array(
					"title" => __('Favicon', 'themerex'),
					"desc" => __("Upload a 16px x 16px image that will represent your website's favicon.<br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading. (<a href='http://www.favicon.cc/'>www.favicon.cc</a>)</em>", 'themerex'),
					"std" => "",
					"type" => "media"
					),

		'logo' => array(
					"title" => __('Logo image', 'themerex'),
					"desc" => __('Main logo image', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "",
					"type" => "media"
					),

		'logo_fixed' => array(
					"title" => __('Logo image (fixed header)', 'themerex'),
					"desc" => __('Logo image for the header (if menu is fixed after the page is scrolled)', 'themerex'),
					"override" => "category,services_group,post,page",
					"divider" => false,
					"std" => "",
					"type" => "media"
					),

		'logo_text' => array(
					"title" => __('Logo text', 'themerex'),
					"desc" => __('Logo text - display it after logo image', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => '',
					"type" => "text"
					),

		'logo_slogan' => array(
					"title" => __('Logo slogan', 'themerex'),
					"desc" => __('Logo slogan - display it under logo image (instead the site tagline)', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => '',
					"type" => "text"
					),

		'logo_height' => array(
					"title" => __('Logo height', 'themerex'),
					"desc" => __('Height for the logo in the header area', 'themerex'),
					"override" => "category,services_group,post,page",
					"step" => 1,
					"std" => '',
					"min" => 10,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"
					),

		'logo_offset' => array(
					"title" => __('Logo top offset', 'themerex'),
					"desc" => __('Top offset for the logo in the header area', 'themerex'),
					"override" => "category,services_group,post,page",
					"step" => 1,
					"std" => '',
					"min" => 0,
					"max" => 99,
					"mask" => "?99",
					"type" => "spinner"
					),
		
		
		
		
		
		
		
		// Customization -> Slider
		//-------------------------------------------------
		
		"customization_slider" => array( 
					"title" => __('Slider', 'themerex'),
					"icon" => "iconadmin-picture",
					"override" => "category,services_group,page",
					"type" => "tab"),
		
		"info_slider_1" => array(
					"title" => __('Main slider parameters', 'themerex'),
					"desc" => __('Select parameters for main slider (you can override it in each category and page)', 'themerex'),
					"override" => "category,services_group,page",
					"type" => "info"),
					
		"show_slider" => array(
					"title" => __('Show Slider', 'themerex'),
					"desc" => __('Do you want to show slider on each page (post)', 'themerex'),
					"override" => "category,services_group,page",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"slider_display" => array(
					"title" => __('Slider display', 'themerex'),
					"desc" => __('How display slider: boxed (fixed width and height), fullwide (fixed height) or fullscreen', 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes')
					),
					"std" => "fullwide",
					"options" => array(
						"boxed"=>__("Boxed", 'themerex'),
						"fullwide"=>__("Fullwide", 'themerex'),
						"fullscreen"=>__("Fullscreen", 'themerex')
					),
					"type" => "checklist"),
		
		"slider_height" => array(
					"title" => __("Height (in pixels)", 'themerex'),
					"desc" => __("Slider height (in pixels) - only if slider display with fixed height.", 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes')
					),
					"std" => '',
					"min" => 100,
					"step" => 10,
					"type" => "spinner"),
		
		"slider_engine" => array(
					"title" => __('Slider engine', 'themerex'),
					"desc" => __('What engine use to show slider?', 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes')
					),
					"std" => "revo",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sliders'],
					"type" => "radio"),
		
		"slider_alias" => array(
					"title" => __('Revolution Slider: Select slider',  'themerex'),
					"desc" => __("Select slider to show (if engine=revo in the field above)", 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('revo')
					),
					"std" => "",
					"options" => $THEMEREX_GLOBALS['options_params']['list_revo_sliders'],
					"type" => "select"),
		
		"slider_category" => array(
					"title" => __('Posts Slider: Category to show', 'themerex'),
					"desc" => __('Select category to show in Flexslider (ignored for Revolution and Royal sliders)', 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "",
					"options" => themerex_array_merge(array(0 => __('- Select category -', 'themerex')), $THEMEREX_GLOBALS['options_params']['list_categories']),
					"type" => "select",
					"multiple" => true,
					"style" => "list"),
		
		"slider_posts" => array(
					"title" => __('Posts Slider: Number posts or comma separated posts list',  'themerex'),
					"desc" => __("How many recent posts display in slider or comma separated list of posts ID (in this case selected category ignored)", 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "5",
					"type" => "text"),
		
		"slider_orderby" => array(
					"title" => __("Posts Slider: Posts order by",  'themerex'),
					"desc" => __("Posts in slider ordered by date (default), comments, views, author rating, users rating, random or alphabetically", 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "date",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sorting'],
					"type" => "select"),
		
		"slider_order" => array(
					"title" => __("Posts Slider: Posts order", 'themerex'),
					"desc" => __('Select the desired ordering method for posts', 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "desc",
					"options" => $THEMEREX_GLOBALS['options_params']['list_ordering'],
					"size" => "big",
					"type" => "switch"),
					
		"slider_interval" => array(
					"title" => __("Posts Slider: Slide change interval", 'themerex'),
					"desc" => __("Interval (in ms) for slides change in slider", 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => 7000,
					"min" => 100,
					"step" => 100,
					"type" => "spinner"),
		
		"slider_pagination" => array(
					"title" => __("Posts Slider: Pagination", 'themerex'),
					"desc" => __("Choose pagination style for the slider", 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "no",
					"options" => array(
						'no'   => __('None', 'themerex'),
						'yes'  => __('Dots', 'themerex'), 
						'over' => __('Titles', 'themerex')
					),
					"type" => "checklist"),
		
		"slider_infobox" => array(
					"title" => __("Posts Slider: Show infobox", 'themerex'),
					"desc" => __("Do you want to show post's title, reviews rating and description on slides in slider", 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "slide",
					"options" => array(
						'no'    => __('None',  'themerex'),
						'slide' => __('Slide', 'themerex'), 
						'fixed' => __('Fixed', 'themerex')
					),
					"type" => "checklist"),
					
		"slider_info_category" => array(
					"title" => __("Posts Slider: Show post's category", 'themerex'),
					"desc" => __("Do you want to show post's category on slides in slider", 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"slider_info_reviews" => array(
					"title" => __("Posts Slider: Show post's reviews rating", 'themerex'),
					"desc" => __("Do you want to show post's reviews rating on slides in slider", 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"slider_info_descriptions" => array(
					"title" => __("Posts Slider: Show post's descriptions", 'themerex'),
					"desc" => __("How many characters show in the post's description in slider. 0 - no descriptions", 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_slider' => array('yes'),
						'slider_engine' => array('swiper')
					),
					"std" => 0,
					"min" => 0,
					"step" => 10,
					"type" => "spinner"),
		
		
		
		
		
		// Customization -> Sidebars
		//-------------------------------------------------
		
		"customization_sidebars" => array( 
					"title" => __('Sidebars', 'themerex'),
					"icon" => "iconadmin-indent-right",
					"override" => "category,services_group,post,page",
					"type" => "tab"),
		
		"info_sidebars_1" => array( 
					"title" => __('Custom sidebars', 'themerex'),
					"desc" => __('In this section you can create unlimited sidebars. You can fill them with widgets in the menu Appearance - Widgets', 'themerex'),
					"type" => "info"),
		
		"custom_sidebars" => array(
					"title" => __('Custom sidebars',  'themerex'),
					"desc" => __('Manage custom sidebars. You can use it with each category (page, post) independently',  'themerex'),
					"std" => "",
					"cloneable" => true,
					"type" => "text"),
		
		"info_sidebars_2" => array(
					"title" => __('Main sidebar', 'themerex'),
					"desc" => __('Show / Hide and select main sidebar', 'themerex'),
					"override" => "category,services_group,post,page",
					"type" => "info"),
		
		'show_sidebar_main' => array( 
					"title" => __('Show main sidebar',  'themerex'),
					"desc" => __('Select position for the main sidebar or hide it',  'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "right",
					"options" => $THEMEREX_GLOBALS['options_params']['list_positions'],
					"dir" => "horizontal",
					"type" => "checklist"),

		"sidebar_main_scheme" => array(
					"title" => __("Color scheme", 'themerex'),
					"desc" => __('Select predefined color scheme for the main sidebar', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_sidebar_main' => array('left', 'right')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => $THEMEREX_GLOBALS['options_params']['list_color_schemes'],
					"type" => "checklist"),
		
		"sidebar_main" => array( 
					"title" => __('Select main sidebar',  'themerex'),
					"desc" => __('Select main sidebar content',  'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_sidebar_main' => array('left', 'right')
					),
					"std" => "sidebar_main",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sidebars'],
					"type" => "select"),
		
		"info_sidebars_3" => array(
					"title" => __('Outer sidebar', 'themerex'),
					"desc" => __('Show / Hide and select outer sidebar (sidemenu, logo, etc.', 'themerex'),
					"override" => "category,services_group,post,page",
					"type" => "info"),
		
		'show_sidebar_outer' => array( 
					"title" => __('Show outer sidebar',  'themerex'),
					"desc" => __('Select position for the outer sidebar or hide it',  'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "hide",
					"options" => $THEMEREX_GLOBALS['options_params']['list_positions'],
					"dir" => "horizontal",
					"type" => "checklist"),

		"sidebar_outer_scheme" => array(
					"title" => __("Color scheme", 'themerex'),
					"desc" => __('Select predefined color scheme for the outer sidebar', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_sidebar_outer' => array('left', 'right')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => $THEMEREX_GLOBALS['options_params']['list_color_schemes'],
					"type" => "checklist"),
		
		"sidebar_outer_show_logo" => array( 
					"title" => __('Show Logo', 'themerex'),
					"desc" => __('Show Logo in the outer sidebar', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_sidebar_outer' => array('left', 'right')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"sidebar_outer_show_socials" => array( 
					"title" => __('Show Social icons', 'themerex'),
					"desc" => __('Show Social icons in the outer sidebar', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_sidebar_outer' => array('left', 'right')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"sidebar_outer_show_menu" => array( 
					"title" => __('Show Menu', 'themerex'),
					"desc" => __('Show Menu in the outer sidebar', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_sidebar_outer' => array('left', 'right')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"menu_side" => array(
					"title" => __('Select menu',  'themerex'),
					"desc" => __('Select menu for the outer sidebar',  'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_sidebar_outer' => array('left', 'right'),
						'sidebar_outer_show_menu' => array('yes')
					),
					"std" => "default",
					"options" => $THEMEREX_GLOBALS['options_params']['list_menus'],
					"type" => "select"),
		
		"sidebar_outer_show_widgets" => array( 
					"title" => __('Show Widgets', 'themerex'),
					"desc" => __('Show Widgets in the outer sidebar', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_sidebar_outer' => array('left', 'right')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"sidebar_outer" => array( 
					"title" => __('Select outer sidebar',  'themerex'),
					"desc" => __('Select outer sidebar content',  'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'sidebar_outer_show_widgets' => array('yes'),
						'show_sidebar_outer' => array('left', 'right')
					),
					"std" => "sidebar_outer",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sidebars'],
					"type" => "select"),
		
		
		
		
		// Customization -> Footer
		//-------------------------------------------------
		
		'customization_footer' => array(
					"title" => __("Footer", 'themerex'),
					"override" => "category,services_group,post,page",
					"icon" => 'iconadmin-window',
					"type" => "tab"),
		
		
		"info_footer_1" => array(
					"title" => __("Footer components", 'themerex'),
					"desc" => __("Select components of the footer, set style and put the content for the user's footer area", 'themerex'),
					"override" => "category,services_group,page,post",
					"type" => "info"),
		
		"show_sidebar_footer" => array(
					"title" => __('Show footer sidebar', 'themerex'),
					"desc" => __('Select style for the footer sidebar or hide it', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"sidebar_footer_scheme" => array(
					"title" => __("Color scheme", 'themerex'),
					"desc" => __('Select predefined color scheme for the footer', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_sidebar_footer' => array('yes')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => $THEMEREX_GLOBALS['options_params']['list_color_schemes'],
					"type" => "checklist"),
		
		"sidebar_footer" => array( 
					"title" => __('Select footer sidebar',  'themerex'),
					"desc" => __('Select footer sidebar for the blog page',  'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_sidebar_footer' => array('yes')
					),
					"std" => "sidebar_footer",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sidebars'],
					"type" => "select"),
		
		"sidebar_footer_columns" => array( 
					"title" => __('Footer sidebar columns',  'themerex'),
					"desc" => __('Select columns number for the footer sidebar',  'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_sidebar_footer' => array('yes')
					),
					"std" => 4,
					"min" => 1,
					"max" => 6,
					"type" => "spinner"),
		
		
		"info_footer_2" => array(
					"title" => __('Testimonials in Footer', 'themerex'),
					"desc" => __('Select parameters for Testimonials in the Footer', 'themerex'),
					"override" => "category,services_group,page,post",
					"type" => "info"),

		"show_testimonials_in_footer" => array(
					"title" => __('Show Testimonials in footer', 'themerex'),
					"desc" => __('Show Testimonials slider in footer. For correct operation of the slider (and shortcode testimonials) you must fill out Testimonials posts on the menu "Testimonials"', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"testimonials_scheme" => array(
					"title" => __("Color scheme", 'themerex'),
					"desc" => __('Select predefined color scheme for the testimonials area', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_testimonials_in_footer' => array('yes')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => $THEMEREX_GLOBALS['options_params']['list_color_schemes'],
					"type" => "checklist"),

		"testimonials_count" => array( 
					"title" => __('Testimonials count', 'themerex'),
					"desc" => __('Number testimonials to show', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_testimonials_in_footer' => array('yes')
					),
					"std" => 3,
					"step" => 1,
					"min" => 1,
					"max" => 10,
					"type" => "spinner"),
		
		
		"info_footer_3" => array(
					"title" => __('Twitter in Footer', 'themerex'),
					"desc" => __('Select parameters for Twitter stream in the Footer (you can override it in each category and page)', 'themerex'),
					"override" => "category,services_group,page,post",
					"type" => "info"),

		"show_twitter_in_footer" => array(
					"title" => __('Show Twitter in footer', 'themerex'),
					"desc" => __('Show Twitter slider in footer. For correct operation of the slider (and shortcode twitter) you must fill out the Twitter API keys on the menu "Appearance - Theme Options - Socials"', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"twitter_scheme" => array(
					"title" => __("Color scheme", 'themerex'),
					"desc" => __('Select predefined color scheme for the twitter area', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_twitter_in_footer' => array('yes')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => $THEMEREX_GLOBALS['options_params']['list_color_schemes'],
					"type" => "checklist"),

		"twitter_count" => array( 
					"title" => __('Twitter count', 'themerex'),
					"desc" => __('Number twitter to show', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_twitter_in_footer' => array('yes')
					),
					"std" => 3,
					"step" => 1,
					"min" => 1,
					"max" => 10,
					"type" => "spinner"),

        "info_footer_8" => array(
                    "title" => __('Prices area in Footer', 'themerex'),
                    "desc" => __('Select parameters for Prices area in the Footer', 'themerex'),
                    "override" => "category,services_group,post,page",
                    "type" => "info"),

        "show_price_in_footer" => array(
                    "title" => __('Show Prices area in footer', 'themerex'),
                    "desc" => __('Show Prices area in footer.', 'themerex'),
                    "override" => "category,services_group,post,page",
                    "std" => "no",
                    "options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
                    "type" => "switch"),

        "price_scheme" => array(
                    "title" => __("Color scheme", 'themerex'),
                    "desc" => __('Select predefined color scheme for the prices area', 'themerex'),
                    "override" => "category,services_group,post,page",
                    "dependency" => array(
                        'show_price_in_footer' => array('yes')
                    ),
                    "std" => "original",
                    "dir" => "horizontal",
                    "options" => $THEMEREX_GLOBALS['options_params']['list_color_schemes'],
                    "type" => "checklist"),

        "price_count" => array(
                    "title" => __('Prices area count', 'themerex'),
                    "desc" => __('Number prices to show', 'themerex'),
                    "override" => "category,services_group,post,page",
                    "dependency" => array(
                        'show_price_in_footer' => array('yes')
                    ),
                    "std" => 1,
                    "step" => 1,
                    "min" => 1,
                    "max" => 3,
                    "type" => "spinner"),

        "title_1" => array(
                    "title" => __("Title Price 1", "themerex"),
                    "desc" => __("Title for the first price", "themerex"),
                    "override" => "category,services_group,post,page",
                    "dependency" => array(
                        'show_price_in_footer' => array('yes'),
                        'price_count' => array('1', '2', '3')
                    ),
                    "std" => "",
                    "type" => "text"
                ),
                "link_1" => array(
                    "title" => __("Link URL", "themerex"),
                    "desc" => __("URL for link from button (at bottom of the block)", "themerex"),
                    "override" => "category,services_group,post,page",
                    "divider" => false,
                    "dependency" => array(
                        'show_price_in_footer' => array('yes'),
                        'price_count' => array('1', '2', '3')
                    ),
                    "std" => "",
                    "type" => "text"
                ),
                "money_1" => array(
                    "title" => __("Money", "themerex"),
                    "desc" => __("Money value (dot or comma separated)", "themerex"),
                    "override" => "category,services_group,post,page",
                    "divider" => false,
                    "dependency" => array(
                        'show_price_in_footer' => array('yes'),
                        'price_count' => array('1', '2', '3')
                    ),
                    "std" => "",
                    "type" => "text"
                ),
                "currency_1" => array(
                    "title" => __("Currency", "themerex"),
                    "desc" => __("Currency character", "themerex"),
                    "override" => "category,services_group,post,page",
                    "divider" => false,
                    "dependency" => array(
                        'show_price_in_footer' => array('yes'),
                        'price_count' => array('1', '2', '3')
                    ),
                    "std" => "$",
                    "type" => "text"
                ),
                "price_content_1" => array(
                    "title" => __("Description", "themerex"),
                    "desc" => __("Description for this price block", "themerex"),
                    "override" => "category,services_group,post,page",
                    "divider" => false,
                    "rows" => 4,
                    "dependency" => array(
                        'show_price_in_footer' => array('yes'),
                        'price_count' => array('1', '2', '3')
                    ),
                    "std" => "",
//                    "rows" => 3,
//                    "type" => "textarea"
                    "allow_html" => true,
                    "allow_js" => true,
                    "type" => "editor"
                ),

            "title_2" => array(
                "title" => __("Title Price 2", "themerex"),
                "desc" => __("Title for the second price", "themerex"),
                "override" => "category,services_group,post,page",
                "dependency" => array(
                    'show_price_in_footer' => array('yes'),
                    'price_count' => array( '2', '3')
                ),
                "std" => "",
                "type" => "text"
            ),
            "link_2" => array(
                "title" => __("Link URL", "themerex"),
                "desc" => __("URL for link from button (at bottom of the block)", "themerex"),
                "override" => "category,services_group,post,page",
                "divider" => false,
                "dependency" => array(
                    'show_price_in_footer' => array('yes'),
                    'price_count' => array( '2', '3')
                ),
                "std" => "",
                "type" => "text"
            ),
            "money_2" => array(
                "title" => __("Money", "themerex"),
                "desc" => __("Money value (dot or comma separated)", "themerex"),
                "override" => "category,services_group,post,page",
                "divider" => false,
                "dependency" => array(
                    'show_price_in_footer' => array('yes'),
                    'price_count' => array( '2', '3')
                ),
                "std" => "",
                "type" => "text"
            ),
            "currency_2" => array(
                "title" => __("Currency", "themerex"),
                "desc" => __("Currency character", "themerex"),
                "override" => "category,services_group,post,page",
                "divider" => false,
                "dependency" => array(
                    'show_price_in_footer' => array('yes'),
                    'price_count' => array( '2', '3')
                ),
                "std" => "$",
                "type" => "text"
            ),
            "price_content_2" => array(
                "title" => __("Description", "themerex"),
                "desc" => __("Description for this price block", "themerex"),
                "override" => "category,services_group,post,page",
                "divider" => false,
                "rows" => 4,
                "dependency" => array(
                    'show_price_in_footer' => array('yes'),
                    'price_count' => array( '2', '3')
                ),
                "std" => "",
//                "rows" => 3,
//                "type" => "textarea"
                "allow_html" => true,
                "allow_js" => true,
                "type" => "editor"
            ),

            "title_3" => array(
                "title" => __("Title Price 3", "themerex"),
                "desc" => __("Title for a third the price", "themerex"),
                "override" => "category,services_group,post,page",
                "dependency" => array(
                    'show_price_in_footer' => array('yes'),
                    'price_count' => array( '2', '3')
                ),
                "std" => "",
                "type" => "text"
            ),
            "link_3" => array(
                "title" => __("Link URL", "themerex"),
                "desc" => __("URL for link from button (at bottom of the block)", "themerex"),
                "override" => "category,services_group,post,page",
                "divider" => false,
                "dependency" => array(
                    'show_price_in_footer' => array('yes'),
                    'price_count' => array( '3')
                ),
                "std" => "",
                "type" => "text"
            ),
            "money_3" => array(
                "title" => __("Money", "themerex"),
                "desc" => __("Money value (dot or comma separated)", "themerex"),
                "override" => "category,services_group,post,page",
                "divider" => false,
                "dependency" => array(
                    'show_price_in_footer' => array('yes'),
                    'price_count' => array( '3')
                ),
                "std" => "",
                "type" => "text"
            ),
            "currency_3" => array(
                "title" => __("Currency", "themerex"),
                "desc" => __("Currency character", "themerex"),
                "override" => "category,services_group,post,page",
                "divider" => false,
                "dependency" => array(
                    'show_price_in_footer' => array('yes'),
                    'price_count' => array( '3')
                ),
                "std" => "$",
                "type" => "text"
            ),
            "price_content_3" => array(
                "title" => __("Description", "themerex"),
                "desc" => __("Description for this price block", "themerex"),
                "override" => "category,services_group,post,page",
                "divider" => false,
                "rows" => 4,
                "dependency" => array(
                    'show_price_in_footer' => array('yes'),
                    'price_count' => array( '3')
                ),
                "std" => "",
//                "rows" => 3,
//                "type" => "textarea"
                "allow_html" => true,
                "allow_js" => true,
                "type" => "editor"
        ),

		"info_footer_4" => array(
					"title" => __('Google map parameters', 'themerex'),
					"desc" => __('Select parameters for Google map (you can override it in each category and page)', 'themerex'),
					"override" => "category,services_group,page,post",
					"type" => "info"),
					
		"show_googlemap" => array(
					"title" => __('Show Google Map', 'themerex'),
					"desc" => __('Do you want to show Google map on each page (post)', 'themerex'),
					"override" => "category,services_group,page,post",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"googlemap_height" => array(
					"title" => __("Map height", 'themerex'),
					"desc" => __("Map height (default - in pixels, allows any CSS units of measure)", 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => 400,
					"min" => 100,
					"step" => 10,
					"type" => "spinner"),
		
		"googlemap_address" => array(
					"title" => __('Address to show on map',  'themerex'),
					"desc" => __("Enter address to show on map center", 'themerex'),
					"override" => "category,services_group,page,post",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => "",
					"type" => "text"),
		
		"googlemap_latlng" => array(
					"title" => __('Latitude and Longtitude to show on map',  'themerex'),
					"desc" => __("Enter coordinates (separated by comma) to show on map center (instead of address)", 'themerex'),
					"override" => "category,services_group,page,post",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => "",
					"type" => "text"),
		
		"googlemap_title" => array(
					"title" => __('Title to show on map',  'themerex'),
					"desc" => __("Enter title to show on map center", 'themerex'),
					"override" => "category,services_group,page,post",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => "",
					"type" => "text"),
		
		"googlemap_description" => array(
					"title" => __('Description to show on map',  'themerex'),
					"desc" => __("Enter description to show on map center", 'themerex'),
					"override" => "category,services_group,page,post",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => "",
					"type" => "text"),
		
		"googlemap_zoom" => array(
					"title" => __('Google map initial zoom',  'themerex'),
					"desc" => __("Enter desired initial zoom for Google map", 'themerex'),
					"override" => "category,services_group,page,post",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => 16,
					"min" => 1,
					"max" => 20,
					"step" => 1,
					"type" => "spinner"),
		
		"googlemap_style" => array(
					"title" => __('Google map style',  'themerex'),
					"desc" => __("Select style to show Google map", 'themerex'),
					"override" => "category,services_group,page,post",
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => 'blue_grey',
					"options" => $THEMEREX_GLOBALS['options_params']['list_gmap_styles'],
					"type" => "select"),
		
		"googlemap_marker" => array(
					"title" => __('Google map marker',  'themerex'),
					"desc" => __("Select or upload png-image with Google map marker", 'themerex'),
					"dependency" => array(
						'show_googlemap' => array('yes')
					),
					"std" => '',
					"type" => "media"),
		
		
		
		"info_footer_5" => array(
					"title" => __("Contacts area", 'themerex'),
					"desc" => __("Show/Hide contacts area in the footer", 'themerex'),
					"override" => "category,services_group,page,post",
					"type" => "info"),
		
		"show_contacts_in_footer" => array(
					"title" => __('Show Contacts in footer', 'themerex'),
					"desc" => __('Show contact information area in footer: site logo, contact info and large social icons', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"contacts_scheme" => array(
					"title" => __("Color scheme", 'themerex'),
					"desc" => __('Select predefined color scheme for the contacts area', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_contacts_in_footer' => array('yes')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => $THEMEREX_GLOBALS['options_params']['list_color_schemes'],
					"type" => "checklist"),


		'logo_footer' => array(
					"title" => __('Logo image for footer', 'themerex'),
					"desc" => __('Logo image in the footer (in the contacts area)', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_contacts_in_footer' => array('yes')
					),
					"std" => "",
					"type" => "hidden"  //"media"
					),
		
		'logo_footer_height' => array(
					"title" => __('Logo height', 'themerex'),
					"desc" => __('Height for the logo in the footer area (in the contacts area)', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_contacts_in_footer' => array('yes')
					),
					"step" => 1,
					"std" => 30,
					"min" => 10,
					"max" => 300,
					"mask" => "?999",
					"type" => "hidden" //"spinner"
					),

        "info_footer_5.1" => array(
                    "title" => __("Contacts form area", 'themerex'),
                    "desc" => __("Show/Hide contacts form area in the footer", 'themerex'),
                    "override" => "category,services_group,page,post",
                    "type" => "info"),

        "show_contacts_form_in_footer" => array(
                    "title" => __('Show Contacts Form in footer', 'themerex'),
                    "desc" => __('Show contact form area in footer', 'themerex'),
                    "override" => "category,services_group,post,page",
                    "std" => "no",
                    "options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
                    "type" => "switch"),
        "contacts_form_scheme" => array(
                    "title" => __("Color scheme", 'themerex'),
                    "desc" => __('Select predefined color scheme for the contacts area', 'themerex'),
                    "override" => "category,services_group,post,page",
                    "dependency" => array(
                        'show_contacts_form_in_footer' => array('yes')
                    ),
                    "std" => "original",
                    "dir" => "horizontal",
                    "options" => $THEMEREX_GLOBALS['options_params']['list_color_schemes'],
                    "type" => "checklist"),

		"info_footer_6" => array(
					"title" => __("Copyright and footer menu", 'themerex'),
					"desc" => __("Show/Hide copyright area in the footer", 'themerex'),
					"override" => "category,services_group,page,post",
					"type" => "info"),

		"show_copyright_in_footer" => array(
					"title" => __('Show Copyright area in footer', 'themerex'),
					"desc" => __('Show area with copyright information, footer menu and small social icons in footer', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "socials",
					"options" => array(
						'none' => __('Hide', 'themerex'),
						'text' => __('Text', 'themerex'),
						'menu' => __('Text and menu', 'themerex'),
						'socials' => __('Text and Social icons', 'themerex')
					),
					"type" => "checklist"),

		"copyright_scheme" => array(
					"title" => __("Color scheme", 'themerex'),
					"desc" => __('Select predefined color scheme for the copyright area', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_copyright_in_footer' => array('text', 'menu', 'socials')
					),
					"std" => "original",
					"dir" => "horizontal",
					"options" => $THEMEREX_GLOBALS['options_params']['list_color_schemes'],
					"type" => "checklist"),
		
		"menu_footer" => array( 
					"title" => __('Select footer menu',  'themerex'),
					"desc" => __('Select footer menu for the current page',  'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "default",
					"dependency" => array(
						'show_copyright_in_footer' => array('menu')
					),
					"options" => $THEMEREX_GLOBALS['options_params']['list_menus'],
					"type" => "select"),

		"footer_copyright" => array(
					"title" => __('Footer copyright text',  'themerex'),
					"desc" => __("Copyright text to show in footer area (bottom of site)", 'themerex'),
					"override" => "category,services_group,page,post",
					"dependency" => array(
						'show_copyright_in_footer' => array('text', 'menu', 'socials')
					),
					"std" => "ThemeREX &copy; 2014 All Rights Reserved ",
					"rows" => "10",
					"type" => "editor"),




		// Customization -> Other
		//-------------------------------------------------
		
		'customization_other' => array(
					"title" => __('Other', 'themerex'),
					"override" => "category,services_group,page,post",
					"icon" => 'iconadmin-cog',
					"type" => "tab"
					),

		'info_other_1' => array(
					"title" => __('Theme customization other parameters', 'themerex'),
					"desc" => __('Animation parameters and responsive layouts for the small screens', 'themerex'),
					"type" => "info"
					),

		'show_theme_customizer' => array(
					"title" => __('Show Theme customizer', 'themerex'),
					"desc" => __('Do you want to show theme customizer in the right panel? Your website visitors will be able to customise it yourself.', 'themerex'),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),

		"customizer_demo" => array(
					"title" => __('Theme customizer panel demo time', 'themerex'),
					"desc" => __('Timer for demo mode for the customizer panel (in milliseconds: 1000ms = 1s). If 0 - no demo.', 'themerex'),
					"dependency" => array(
						'show_theme_customizer' => array('yes')
					),
					"std" => "0",
					"min" => 0,
					"max" => 10000,
					"step" => 500,
					"type" => "spinner"),
		
		'css_animation' => array(
					"title" => __('Extended CSS animations', 'themerex'),
					"desc" => __('Do you want use extended animations effects on your site?', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),

		'remember_visitors_settings' => array(
					"title" => __("Remember visitor's settings", 'themerex'),
					"desc" => __('To remember the settings that were made by the visitor, when navigating to other pages or to limit their effect only within the current page', 'themerex'),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),
					
		'responsive_layouts' => array(
					"title" => __('Responsive Layouts', 'themerex'),
					"desc" => __('Do you want use responsive layouts on small screen or still use main layout?', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),
		


		'info_other_2' => array(
					"title" => __('Additional CSS and HTML/JS code', 'themerex'),
					"desc" => __('Put here your custom CSS and JS code', 'themerex'),
					"override" => "category,services_group,page,post",
					"type" => "info"
					),
					
		'custom_css_html' => array(
					"title" => __('Use custom CSS/HTML/JS', 'themerex'),
					"desc" => __('Do you want use custom HTML/CSS/JS code in your site? For example: custom styles, Google Analitics code, etc.', 'themerex'),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),
		
		"gtm_code" => array(
					"title" => __('Google tags manager or Google analitics code',  'themerex'),
					"desc" => __('Put here Google Tags Manager (GTM) code from your account: Google analitics, remarketing, etc. This code will be placed after open body tag.',  'themerex'),
					"dependency" => array(
						'custom_css_html' => array('yes')
					),
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"type" => "textarea"),
		
		"gtm_code2" => array(
					"title" => __('Google remarketing code',  'themerex'),
					"desc" => __('Put here Google Remarketing code from your account. This code will be placed before close body tag.',  'themerex'),
					"dependency" => array(
						'custom_css_html' => array('yes')
					),
					"divider" => false,
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"type" => "textarea"),
		
		'custom_code' => array(
					"title" => __('Your custom HTML/JS code',  'themerex'),
					"desc" => __('Put here your invisible html/js code: Google analitics, counters, etc',  'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'custom_css_html' => array('yes')
					),
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"type" => "textarea"
					),
		
		'custom_css' => array(
					"title" => __('Your custom CSS code',  'themerex'),
					"desc" => __('Put here your css code to correct main theme styles',  'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'custom_css_html' => array('yes')
					),
					"divider" => false,
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"type" => "textarea"
					),
		
		
		
		
		
		
		
		
		
		//###############################
		//#### Blog and Single pages #### 
		//###############################
		"partition_blog" => array(
					"title" => __('Blog &amp; Single', 'themerex'),
					"icon" => "iconadmin-docs",
					"override" => "category,services_group,post,page",
					"type" => "partition"),
		
		
		
		// Blog -> Stream page
		//-------------------------------------------------
		
		'blog_tab_stream' => array(
					"title" => __('Stream page', 'themerex'),
					"start" => 'blog_tabs',
					"icon" => "iconadmin-docs",
					"override" => "category,services_group,post,page",
					"type" => "tab"),
		
		"info_blog_1" => array(
					"title" => __('Blog streampage parameters', 'themerex'),
					"desc" => __('Select desired blog streampage parameters (you can override it in each category)', 'themerex'),
					"override" => "category,services_group,post,page",
					"type" => "info"),
		
		"blog_style" => array(
					"title" => __('Blog style', 'themerex'),
					"desc" => __('Select desired blog style', 'themerex'),
					"override" => "category,services_group,page",
					"std" => "excerpt",
					"options" => $THEMEREX_GLOBALS['options_params']['list_blog_styles'],
					"type" => "select"),
		
		"hover_style" => array(
					"title" => __('Hover style', 'themerex'),
					"desc" => __('Select desired hover style (only for Blog style = Portfolio)', 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'blog_style' => array('portfolio','grid','square','colored')
					),
					"std" => "square effect_shift",
					"options" => $THEMEREX_GLOBALS['options_params']['list_hovers'],
					"type" => "select"),
		
		"hover_dir" => array(
					"title" => __('Hover dir', 'themerex'),
					"desc" => __('Select hover direction (only for Blog style = Portfolio and Hover style = Circle or Square)', 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'blog_style' => array('portfolio','grid','square','colored'),
						'hover_style' => array('square','circle')
					),
					"std" => "left_to_right",
					"options" => $THEMEREX_GLOBALS['options_params']['list_hovers_dir'],
					"type" => "select"),
		
		"article_style" => array(
					"title" => __('Article style', 'themerex'),
					"desc" => __('Select article display method: boxed or stretch', 'themerex'),
					"override" => "category,services_group,page",
					"std" => "stretch",
					"options" => $THEMEREX_GLOBALS['options_params']['list_article_styles'],
					"size" => "medium",
					"type" => "switch"),
		
		"dedicated_location" => array(
					"title" => __('Dedicated location', 'themerex'),
					"desc" => __('Select location for the dedicated content or featured image in the "excerpt" blog style', 'themerex'),
					"override" => "category,services_group,page,post",
					"dependency" => array(
						'blog_style' => array('excerpt')
					),
					"std" => "center",
					"options" => $THEMEREX_GLOBALS['options_params']['list_locations'],
					"type" => "select"),
		
		"show_filters" => array(
					"title" => __('Show filters', 'themerex'),
					"desc" => __('What taxonomy use for filter buttons', 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'blog_style' => array('portfolio','grid','square','colored')
					),
					"std" => "hide",
					"options" => $THEMEREX_GLOBALS['options_params']['list_filters'],
					"type" => "checklist"),
		
		"blog_sort" => array(
					"title" => __('Blog posts sorted by', 'themerex'),
					"desc" => __('Select the desired sorting method for posts', 'themerex'),
					"override" => "category,services_group,page",
					"std" => "date",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sorting'],
					"dir" => "vertical",
					"type" => "radio"),
		
		"blog_order" => array(
					"title" => __('Blog posts order', 'themerex'),
					"desc" => __('Select the desired ordering method for posts', 'themerex'),
					"override" => "category,services_group,page",
					"std" => "desc",
					"options" => $THEMEREX_GLOBALS['options_params']['list_ordering'],
					"size" => "big",
					"type" => "switch"),
		
		"posts_per_page" => array(
					"title" => __('Blog posts per page',  'themerex'),
					"desc" => __('How many posts display on blog pages for selected style. If empty or 0 - inherit system wordpress settings',  'themerex'),
					"override" => "category,services_group,page",
					"std" => "12",
					"mask" => "?99",
					"type" => "text"),
		
		"post_excerpt_maxlength" => array(
					"title" => __('Excerpt maxlength for streampage',  'themerex'),
					"desc" => __('How many characters from post excerpt are display in blog streampage (only for Blog style = Excerpt). 0 - do not trim excerpt.',  'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'blog_style' => array('excerpt', 'portfolio', 'grid', 'square', 'related')
					),
					"std" => "250",
					"mask" => "?9999",
					"type" => "text"),
		
		"post_excerpt_maxlength_masonry" => array(
					"title" => __('Excerpt maxlength for classic and masonry',  'themerex'),
					"desc" => __('How many characters from post excerpt are display in blog streampage (only for Blog style = Classic or Masonry). 0 - do not trim excerpt.',  'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'blog_style' => array('masonry', 'classic')
					),
					"std" => "150",
					"mask" => "?9999",
					"type" => "text"),
		
		
		
		
		// Blog -> Single page
		//-------------------------------------------------
		
		'blog_tab_single' => array(
					"title" => __('Single page', 'themerex'),
					"icon" => "iconadmin-doc",
					"override" => "category,services_group,post,page",
					"type" => "tab"),
		
		
		"info_single_1" => array(
					"title" => __('Single (detail) pages parameters', 'themerex'),
					"desc" => __('Select desired parameters for single (detail) pages (you can override it in each category and single post (page))', 'themerex'),
					"override" => "category,services_group,page,post",
					"type" => "info"),
		
		"single_style" => array(
					"title" => __('Single page style', 'themerex'),
					"desc" => __('Select desired style for single page', 'themerex'),
					"override" => "category,services_group,page,post",
					"std" => "single-standard",
					"options" => $THEMEREX_GLOBALS['options_params']['list_single_styles'],
					"dir" => "horizontal",
					"type" => "radio"),

		"icon" => array(
					"title" => __('Select post icon', 'themerex'),
					"desc" => __('Select icon for output before post/category name in some layouts', 'themerex'),
					"override" => "services_group,page,post",
					"std" => "",
					"options" => $THEMEREX_GLOBALS['options_params']['list_icons'],
					"style" => "select",
					"type" => "hidden"  //"icons"
					),
		
		"show_featured_image" => array(
					"title" => __('Show featured image before post',  'themerex'),
					"desc" => __("Show featured image (if selected) before post content on single pages", 'themerex'),
					"override" => "category,services_group,page,post",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_title" => array(
					"title" => __('Show post title', 'themerex'),
					"desc" => __('Show area with post title on single pages', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_title_on_quotes" => array(
					"title" => __('Show post title on links, chat, quote, status', 'themerex'),
					"desc" => __('Show area with post title on single and blog pages in specific post formats: links, chat, quote, status', 'themerex'),
					"override" => "category,services_group,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_info" => array(
					"title" => __('Show post info', 'themerex'),
					"desc" => __('Show area with post info on single pages', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_text_before_readmore" => array(
					"title" => __('Show text before "Read more" tag', 'themerex'),
					"desc" => __('Show text before "Read more" tag on single pages', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"show_post_author" => array(
					"title" => __('Show post author details',  'themerex'),
					"desc" => __("Show post author information block on single post page", 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_tags" => array(
					"title" => __('Show post tags',  'themerex'),
					"desc" => __("Show tags block on single post page", 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_related" => array(
					"title" => __('Show related posts',  'themerex'),
					"desc" => __("Show related posts block on single post page", 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"post_related_count" => array(
					"title" => __('Related posts number',  'themerex'),
					"desc" => __("How many related posts showed on single post page", 'themerex'),
					"dependency" => array(
						'show_post_related' => array('yes')
					),
					"override" => "category,services_group,post,page",
					"std" => "3",
					"step" => 1,
					"min" => 2,
					"max" => 8,
					"type" => "spinner"),

		"post_related_columns" => array(
					"title" => __('Related posts columns',  'themerex'),
					"desc" => __("How many columns used to show related posts on single post page. 1 - use scrolling to show all related posts", 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'show_post_related' => array('yes')
					),
					"std" => "3",
					"step" => 1,
					"min" => 1,
					"max" => 4,
					"type" => "spinner"),
		
		"post_related_sort" => array(
					"title" => __('Related posts sorted by', 'themerex'),
					"desc" => __('Select the desired sorting method for related posts', 'themerex'),
		//			"override" => "category,services_group,page",
					"dependency" => array(
						'show_post_related' => array('yes')
					),
					"std" => "date",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sorting'],
					"type" => "select"),
		
		"post_related_order" => array(
					"title" => __('Related posts order', 'themerex'),
					"desc" => __('Select the desired ordering method for related posts', 'themerex'),
		//			"override" => "category,services_group,page",
					"dependency" => array(
						'show_post_related' => array('yes')
					),
					"std" => "desc",
					"options" => $THEMEREX_GLOBALS['options_params']['list_ordering'],
					"size" => "big",
					"type" => "switch"),
		
		"show_post_comments" => array(
					"title" => __('Show comments',  'themerex'),
					"desc" => __("Show comments block on single post page", 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		
		
		// Blog -> Other parameters
		//-------------------------------------------------
		
		'blog_tab_other' => array(
					"title" => __('Other parameters', 'themerex'),
					"icon" => "iconadmin-newspaper",
					"override" => "category,services_group,page",
					"type" => "tab"),
		
		"info_blog_other_1" => array(
					"title" => __('Other Blog parameters', 'themerex'),
					"desc" => __('Select excluded categories, substitute parameters, etc.', 'themerex'),
					"type" => "info"),
		
		"exclude_cats" => array(
					"title" => __('Exclude categories', 'themerex'),
					"desc" => __('Select categories, which posts are exclude from blog page', 'themerex'),
					"std" => "",
					"options" => $THEMEREX_GLOBALS['options_params']['list_categories'],
					"multiple" => true,
					"style" => "list",
					"type" => "select"),
		
		"blog_pagination" => array(
					"title" => __('Blog pagination', 'themerex'),
					"desc" => __('Select type of the pagination on blog streampages', 'themerex'),
					"std" => "pages",
					"override" => "category,services_group,page",
					"options" => array(
						'pages'    => __('Standard page numbers', 'themerex'),
						'viewmore' => __('"View more" button', 'themerex'),
						'infinite' => __('Infinite scroll', 'themerex')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"blog_pagination_style" => array(
					"title" => __('Blog pagination style', 'themerex'),
					"desc" => __('Select pagination style for standard page numbers', 'themerex'),
					"override" => "category,services_group,page",
					"dependency" => array(
						'blog_pagination' => array('pages')
					),
					"std" => "pages",
					"options" => array(
						'pages'  => __('Page numbers list', 'themerex'),
						'slider' => __('Slider with page numbers', 'themerex')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"blog_counters" => array(
					"title" => __('Blog counters', 'themerex'),
					"desc" => __('Select counters, displayed near the post title', 'themerex'),
					"override" => "category,services_group,page",
					"std" => "views",
					"options" => array(
						'views' => __('Views', 'themerex'),
						'likes' => __('Likes', 'themerex'),
						'rating' => __('Rating', 'themerex'),
						'comments' => __('Comments', 'themerex')
					),
					"dir" => "vertical",
					"multiple" => true,
					"type" => "checklist"),
		
		"close_category" => array(
					"title" => __("Post's category announce", 'themerex'),
					"desc" => __('What category display in announce block (over posts thumb) - original or nearest parental', 'themerex'),
					"override" => "category,services_group,page",
					"std" => "parental",
					"options" => array(
						'parental' => __('Nearest parental category', 'themerex'),
						'original' => __("Original post's category", 'themerex')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"show_date_after" => array(
					"title" => __('Show post date after', 'themerex'),
					"desc" => __('Show post date after N days (before - show post age)', 'themerex'),
					"override" => "category,services_group,page",
					"std" => "30",
					"mask" => "?99",
					"type" => "text"),
		
		
		
		
		
		//###############################
		//#### Reviews               #### 
		//###############################
		"partition_reviews" => array(
					"title" => __('Reviews', 'themerex'),
					"icon" => "iconadmin-newspaper",
					"override" => "category,services_group,services_group",
					"type" => "partition"),
		
		"info_reviews_1" => array(
					"title" => __('Reviews criterias', 'themerex'),
					"desc" => __('Set up list of reviews criterias. You can override it in any category.', 'themerex'),
					"override" => "category,services_group,services_group",
					"type" => "info"),
		
		"show_reviews" => array(
					"title" => __('Show reviews block',  'themerex'),
					"desc" => __("Show reviews block on single post page and average reviews rating after post's title in stream pages", 'themerex'),
					"override" => "category,services_group,services_group",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"reviews_max_level" => array(
					"title" => __('Max reviews level',  'themerex'),
					"desc" => __("Maximum level for reviews marks", 'themerex'),
					"std" => "5",
					"options" => array(
						'5'=>__('5 stars', 'themerex'), 
						'10'=>__('10 stars', 'themerex'), 
						'100'=>__('100%', 'themerex')
					),
					"type" => "radio",
					),
		
		"reviews_style" => array(
					"title" => __('Show rating as',  'themerex'),
					"desc" => __("Show rating marks as text or as stars/progress bars.", 'themerex'),
					"std" => "stars",
					"options" => array(
						'text' => __('As text (for example: 7.5 / 10)', 'themerex'), 
						'stars' => __('As stars or bars', 'themerex')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"reviews_criterias_levels" => array(
					"title" => __('Reviews Criterias Levels', 'themerex'),
					"desc" => __('Words to mark criterials levels. Just write the word and press "Enter". Also you can arrange words.', 'themerex'),
					"std" => __("bad,poor,normal,good,great", 'themerex'),
					"type" => "tags"),
		
		"reviews_first" => array(
					"title" => __('Show first reviews',  'themerex'),
					"desc" => __("What reviews will be displayed first: by author or by visitors. Also this type of reviews will display under post's title.", 'themerex'),
					"std" => "author",
					"options" => array(
						'author' => __('By author', 'themerex'),
						'users' => __('By visitors', 'themerex')
						),
					"dir" => "horizontal",
					"type" => "radio"),
		
		"reviews_second" => array(
					"title" => __('Hide second reviews',  'themerex'),
					"desc" => __("Do you want hide second reviews tab in widgets and single posts?", 'themerex'),
					"std" => "show",
					"options" => $THEMEREX_GLOBALS['options_params']['list_show_hide'],
					"size" => "medium",
					"type" => "switch"),
		
		"reviews_can_vote" => array(
					"title" => __('What visitors can vote',  'themerex'),
					"desc" => __("What visitors can vote: all or only registered", 'themerex'),
					"std" => "all",
					"options" => array(
						'all'=>__('All visitors', 'themerex'), 
						'registered'=>__('Only registered', 'themerex')
					),
					"dir" => "horizontal",
					"type" => "radio"),
		
		"reviews_criterias" => array(
					"title" => __('Reviews criterias',  'themerex'),
					"desc" => __('Add default reviews criterias.',  'themerex'),
					"override" => "category,services_group,services_group",
					"std" => "",
					"cloneable" => true,
					"type" => "text"),

		// Don't remove this parameter - it used in admin for store marks
		"reviews_marks" => array(
					"std" => "",
					"type" => "hidden"),
		





		//###############################
		//#### Media                #### 
		//###############################
		"partition_media" => array(
					"title" => __('Media', 'themerex'),
					"icon" => "iconadmin-picture",
					"override" => "category,services_group,post,page",
					"type" => "partition"),
		
		"info_media_1" => array(
					"title" => __('Media settings', 'themerex'),
					"desc" => __('Set up parameters to show images, galleries, audio and video posts', 'themerex'),
					"override" => "category,services_group,services_group",
					"type" => "info"),
					
		"retina_ready" => array(
					"title" => __('Image dimensions', 'themerex'),
					"desc" => __('What dimensions use for uploaded image: Original or "Retina ready" (twice enlarged)', 'themerex'),
					"std" => "1",
					"size" => "medium",
					"options" => array(
						"1" => __("Original", 'themerex'), 
						"2" => __("Retina", 'themerex')
					),
					"type" => "switch"),
		
		"substitute_gallery" => array(
					"title" => __('Substitute standard Wordpress gallery', 'themerex'),
					"desc" => __('Substitute standard Wordpress gallery with our slider on the single pages', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"gallery_instead_image" => array(
					"title" => __('Show gallery instead featured image', 'themerex'),
					"desc" => __('Show slider with gallery instead featured image on blog streampage and in the related posts section for the gallery posts', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"gallery_max_slides" => array(
					"title" => __('Max images number in the slider', 'themerex'),
					"desc" => __('Maximum images number from gallery into slider', 'themerex'),
					"override" => "category,services_group,post,page",
					"dependency" => array(
						'gallery_instead_image' => array('yes')
					),
					"std" => "5",
					"min" => 2,
					"max" => 10,
					"type" => "spinner"),
		
		"popup_engine" => array(
					"title" => __('Popup engine to zoom images', 'themerex'),
					"desc" => __('Select engine to show popup windows with images and galleries', 'themerex'),
					"std" => "pretty",
					"options" => $THEMEREX_GLOBALS['options_params']['list_popups'],
					"type" => "select"),
		
		"substitute_audio" => array(
					"title" => __('Substitute audio tags', 'themerex'),
					"desc" => __('Substitute audio tag with source from soundcloud to embed player', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"substitute_video" => array(
					"title" => __('Substitute video tags', 'themerex'),
					"desc" => __('Substitute video tags with embed players or leave video tags unchanged (if you use third party plugins for the video tags)', 'themerex'),
					"override" => "category,services_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"use_mediaelement" => array(
					"title" => __('Use Media Element script for audio and video tags', 'themerex'),
					"desc" => __('Do you want use the Media Element script for all audio and video tags on your site or leave standard HTML5 behaviour?', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		
		
		
		//###############################
		//#### Socials               #### 
		//###############################
		"partition_socials" => array(
					"title" => __('Socials', 'themerex'),
					"icon" => "iconadmin-users",
					"override" => "category,services_group,page,post",
					"type" => "partition"),
		
		"info_socials_1" => array(
					"title" => __('Social networks', 'themerex'),
					"desc" => __("Social networks list for site footer and Social widget", 'themerex'),
					"type" => "info"),
		
		"social_icons" => array(
					"title" => __('Social networks',  'themerex'),
					"desc" => __('Select icon and write URL to your profile in desired social networks.',  'themerex'),
					"std" => array(array('url'=>'', 'icon'=>'')),
					"cloneable" => true,
					"size" => "small",
					"style" => $socials_type,
					"options" => $socials_type=='images' ? $THEMEREX_GLOBALS['options_params']['list_socials'] : $THEMEREX_GLOBALS['options_params']['list_icons'],
					"type" => "socials"),
		
		"info_socials_2" => array(
					"title" => __('Share buttons', 'themerex'),
					"desc" => __("Add button's code for each social share network.<br>
					In share url you can use next macro:<br>
					<b>{url}</b> - share post (page) URL,<br>
					<b>{title}</b> - post title,<br>
					<b>{image}</b> - post image,<br>
					<b>{descr}</b> - post description (if supported)<br>
					For example:<br>
					<b>Facebook</b> share string: <em>http://www.facebook.com/sharer.php?u={link}&amp;t={title}</em><br>
					<b>Delicious</b> share string: <em>http://delicious.com/save?url={link}&amp;title={title}&amp;note={descr}</em>", 'themerex'),
					"override" => "category,services_group,page",
					"type" => "info"),
		
		"show_share" => array(
					"title" => __('Show social share buttons',  'themerex'),
					"desc" => __("Show social share buttons block", 'themerex'),
					"override" => "category,services_group,page,post",//services_group,page,post
					"std" => "horizontal",
					"options" => array(
						'hide'		=> __('Hide', 'themerex'),
						'vertical'	=> __('Vertical', 'themerex'),
						'horizontal'=> __('Horizontal', 'themerex')
					),
					"type" => "checklist"),

		"show_share_counters" => array(
					"title" => __('Show share counters',  'themerex'),
					"desc" => __("Show share counters after social buttons", 'themerex'),
					"override" => "category,services_group,page,post",
					"dependency" => array(
						'show_share' => array('vertical', 'horizontal')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"share_caption" => array(
					"title" => __('Share block caption',  'themerex'),
					"desc" => __('Caption for the block with social share buttons',  'themerex'),
					"override" => "category,services_group,page,post",
					"dependency" => array(
						'show_share' => array('vertical', 'horizontal')
					),
					"std" => __('Share:', 'themerex'),
					"type" => "text"),
		
		"share_buttons" => array(
					"title" => __('Share buttons',  'themerex'),
					"desc" => __('Select icon and write share URL for desired social networks.<br><b>Important!</b> If you leave text field empty - internal theme link will be used (if present).',  'themerex'),
					"dependency" => array(
						'show_share' => array('vertical', 'horizontal')
					),
					"std" => array(array('url'=>'', 'icon'=>'')),
					"cloneable" => true,
					"size" => "small",
					"style" => $socials_type,
					"options" => $socials_type=='images' ? $THEMEREX_GLOBALS['options_params']['list_socials'] : $THEMEREX_GLOBALS['options_params']['list_icons'],
					"type" => "socials"),
		
		
		"info_socials_3" => array(
					"title" => __('Twitter API keys', 'themerex'),
					"desc" => __("Put to this section Twitter API 1.1 keys.<br>
					You can take them after registration your application in <strong>https://apps.twitter.com/</strong>", 'themerex'),
					"type" => "info"),
		
		"twitter_username" => array(
					"title" => __('Twitter username',  'themerex'),
					"desc" => __('Your login (username) in Twitter',  'themerex'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_consumer_key" => array(
					"title" => __('Consumer Key',  'themerex'),
					"desc" => __('Twitter API Consumer key',  'themerex'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_consumer_secret" => array(
					"title" => __('Consumer Secret',  'themerex'),
					"desc" => __('Twitter API Consumer secret',  'themerex'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_token_key" => array(
					"title" => __('Token Key',  'themerex'),
					"desc" => __('Twitter API Token key',  'themerex'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_token_secret" => array(
					"title" => __('Token Secret',  'themerex'),
					"desc" => __('Twitter API Token secret',  'themerex'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		
		
		
		
		//###############################
		//#### Contact info          #### 
		//###############################
		"partition_contacts" => array(
					"title" => __('Contact info', 'themerex'),
					"icon" => "iconadmin-mail",
					"type" => "partition"),
		
		"info_contact_1" => array(
					"title" => __('Contact information', 'themerex'),
					"desc" => __('Company address, phones and e-mail', 'themerex'),
					"type" => "info"),
		
		"contact_info" => array(
					"title" => __('Contacts in the header', 'themerex'),
					"desc" => __('String with contact info in the left side of the site header', 'themerex'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-home'),
					"type" => "text"),

		"contact_open_hours" => array(
					"title" => __('Open hours (Part 1)', 'themerex'),
					"desc" => __('String with open hours in the site header', 'themerex'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-clock'),
					"type" => "text"),

        "contact_open_hours2" => array(
                    "title" => __('Open hours (Part 2)', 'themerex'),
                    "desc" => __('String with open hours in the site header', 'themerex'),
                    "std" => "",
                    "before" => array('icon'=>'iconadmin-clock'),
                    "type" => "text"),

        "contact_open_hours3" => array(
                    "title" => __('Open hours (Part 3)', 'themerex'),
                    "desc" => __('String with open hours in the site header', 'themerex'),
                    "std" => "",
                    "before" => array('icon'=>'iconadmin-clock'),
                    "type" => "text"),

		"contact_email" => array(
					"title" => __('Contact form email', 'themerex'),
					"desc" => __('E-mail for send contact form and user registration data', 'themerex'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-mail'),
					"type" => "text"),
		

		"contact_phone" => array(
					"title" => __('Phone', 'themerex'),
					"desc" => __('Phone number', 'themerex'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-phone'),
					"type" => "text"),
		
		"contact_fax" => array(
					"title" => __('Fax', 'themerex'),
					"desc" => __('Fax number', 'themerex'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-phone'),
					"type" => "text"),

        "contact_address_1" => array(
                    "title" => __('Company address', 'themerex'),
                    "desc" => __('Company country, post code and city', 'themerex'),
                    "std" => "",
                    "before" => array('icon'=>'iconadmin-home'),
                    "type" => "text"),

        'show_googlemap_in_contacts' => array(
                "title" => __('Show google map in contact area', 'themerex'),
                "desc" => __('To display the fill field: "Company adress"', 'themerex'),
                "std" => "yes",
                "options" => array(
                    'yes' => __("Yes", 'themerex'),
                    'no'=> __("No", 'themerex')),
                "type" => "switch"),

		"info_contact_2" => array(
					"title" => __('Contact and Comments form', 'themerex'),
					"desc" => __('Maximum length of the messages in the contact form shortcode and in the comments form', 'themerex'),
					"type" => "info"),
		
		"message_maxlength_contacts" => array(
					"title" => __('Contact form message', 'themerex'),
					"desc" => __("Message's maxlength in the contact form shortcode", 'themerex'),
					"std" => "1000",
					"min" => 0,
					"max" => 10000,
					"step" => 100,
					"type" => "spinner"),
		
		"message_maxlength_comments" => array(
					"title" => __('Comments form message', 'themerex'),
					"desc" => __("Message's maxlength in the comments form", 'themerex'),
					"std" => "1000",
					"min" => 0,
					"max" => 10000,
					"step" => 100,
					"type" => "spinner"),

		
		"info_contact_3" => array(
					"title" => __('Default mail function', 'themerex'),
					"desc" => __('What function you want to use for sending mail: the built-in Wordpress wp_mail() or standard PHP mail() function? Attention! Some plugins may not work with one of them and you always have the ability to switch to alternative.', 'themerex'),
					"type" => "info"),
		
		"mail_function" => array(
					"title" => __("Mail function", 'themerex'),
					"desc" => __("What function you want to use for sending mail?", 'themerex'),
					"std" => "wp_mail",
					"size" => "medium",
					"options" => array(
						'wp_mail' => __('WP mail', 'themerex'),
						'mail' => __('PHP mail', 'themerex')
					),
					"type" => "switch"),
		
		
		
		
		
		
		
		//###############################
		//#### Search parameters     #### 
		//###############################
		"partition_search" => array(
					"title" => __('Search', 'themerex'),
					"icon" => "iconadmin-search",
					"type" => "partition"),
		
		"info_search_1" => array(
					"title" => __('Search parameters', 'themerex'),
					"desc" => __('Enable/disable AJAX search and output settings for it', 'themerex'),
					"type" => "info"),
		
		"show_search" => array(
					"title" => __('Show search field', 'themerex'),
					"desc" => __('Show search field in the top area and side menus', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"use_ajax_search" => array(
					"title" => __('Enable AJAX search', 'themerex'),
					"desc" => __('Use incremental AJAX search for the search field in top of page', 'themerex'),
					"dependency" => array(
						'show_search' => array('yes')
					),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"ajax_search_min_length" => array(
					"title" => __('Min search string length',  'themerex'),
					"desc" => __('The minimum length of the search string',  'themerex'),
					"dependency" => array(
						'show_search' => array('yes'),
						'use_ajax_search' => array('yes')
					),
					"std" => 4,
					"min" => 3,
					"type" => "spinner"),
		
		"ajax_search_delay" => array(
					"title" => __('Delay before search (in ms)',  'themerex'),
					"desc" => __('How much time (in milliseconds, 1000 ms = 1 second) must pass after the last character before the start search',  'themerex'),
					"dependency" => array(
						'show_search' => array('yes'),
						'use_ajax_search' => array('yes')
					),
					"std" => 500,
					"min" => 300,
					"max" => 1000,
					"step" => 100,
					"type" => "spinner"),
		
		"ajax_search_types" => array(
					"title" => __('Search area', 'themerex'),
					"desc" => __('Select post types, what will be include in search results. If not selected - use all types.', 'themerex'),
					"dependency" => array(
						'show_search' => array('yes'),
						'use_ajax_search' => array('yes')
					),
					"std" => "",
					"options" => $THEMEREX_GLOBALS['options_params']['list_posts_types'],
					"multiple" => true,
					"style" => "list",
					"type" => "select"),
		
		"ajax_search_posts_count" => array(
					"title" => __('Posts number in output',  'themerex'),
					"dependency" => array(
						'show_search' => array('yes'),
						'use_ajax_search' => array('yes')
					),
					"desc" => __('Number of the posts to show in search results',  'themerex'),
					"std" => 5,
					"min" => 1,
					"max" => 10,
					"type" => "spinner"),
		
		"ajax_search_posts_image" => array(
					"title" => __("Show post's image", 'themerex'),
					"dependency" => array(
						'show_search' => array('yes'),
						'use_ajax_search' => array('yes')
					),
					"desc" => __("Show post's thumbnail in the search results", 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"ajax_search_posts_date" => array(
					"title" => __("Show post's date", 'themerex'),
					"dependency" => array(
						'show_search' => array('yes'),
						'use_ajax_search' => array('yes')
					),
					"desc" => __("Show post's publish date in the search results", 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"ajax_search_posts_author" => array(
					"title" => __("Show post's author", 'themerex'),
					"dependency" => array(
						'show_search' => array('yes'),
						'use_ajax_search' => array('yes')
					),
					"desc" => __("Show post's author in the search results", 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"ajax_search_posts_counters" => array(
					"title" => __("Show post's counters", 'themerex'),
					"dependency" => array(
						'show_search' => array('yes'),
						'use_ajax_search' => array('yes')
					),
					"desc" => __("Show post's counters (views, comments, likes) in the search results", 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		
		
		
		
		//###############################
		//#### Service               #### 
		//###############################
		
		"partition_service" => array(
					"title" => __('Service', 'themerex'),
					"icon" => "iconadmin-wrench",
					"type" => "partition"),
		
		"info_service_1" => array(
					"title" => __('Theme functionality', 'themerex'),
					"desc" => __('Basic theme functionality settings', 'themerex'),
					"type" => "info"),
		
		"notify_about_new_registration" => array(
					"title" => __('Notify about new registration', 'themerex'),
					"desc" => __('Send E-mail with new registration data to the contact email or to site admin e-mail (if contact email is empty)', 'themerex'),
					"divider" => false,
					"std" => "no",
					"options" => array(
						'no'    => __('No', 'themerex'),
						'both'  => __('Both', 'themerex'),
						'admin' => __('Admin', 'themerex'),
						'user'  => __('User', 'themerex')
					),
					"dir" => "horizontal",
					"type" => "checklist"),
		
		"use_ajax_views_counter" => array(
					"title" => __('Use AJAX post views counter', 'themerex'),
					"desc" => __('Use javascript for post views count (if site work under the caching plugin) or increment views count in single page template', 'themerex'),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"allow_editor" => array(
					"title" => __('Frontend editor',  'themerex'),
					"desc" => __("Allow authors to edit their posts in frontend area)", 'themerex'),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"admin_add_filters" => array(
					"title" => __('Additional filters in the admin panel', 'themerex'),
					"desc" => __('Show additional filters (on post formats, tags and categories) in admin panel page "Posts". <br>Attention! If you have more than 2.000-3.000 posts, enabling this option may cause slow load of the "Posts" page! If you encounter such slow down, simply open Appearance - Theme Options - Service and set "No" for this option.', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"show_overriden_taxonomies" => array(
					"title" => __('Show overriden options for taxonomies', 'themerex'),
					"desc" => __('Show extra column in categories list, where changed (overriden) theme options are displayed.', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"show_overriden_posts" => array(
					"title" => __('Show overriden options for posts and pages', 'themerex'),
					"desc" => __('Show extra column in posts and pages list, where changed (overriden) theme options are displayed.', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"admin_dummy_data" => array(
					"title" => __('Enable Dummy Data Installer', 'themerex'),
					"desc" => __('Show "Install Dummy Data" in the menu "Appearance". <b>Attention!</b> When you install dummy data all content of your site will be replaced!', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"admin_dummy_timeout" => array(
					"title" => __('Dummy Data Installer Timeout',  'themerex'),
					"desc" => __('Web-servers set the time limit for the execution of php-scripts. By default, this is 30 sec. Therefore, the import process will be split into parts. Upon completion of each part - the import will resume automatically! The import process will try to increase this limit to the time, specified in this field.',  'themerex'),
					"std" => 1200,
					"min" => 30,
					"max" => 1800,
					"type" => "spinner"),
		
		"admin_emailer" => array(
					"title" => __('Enable Emailer in the admin panel', 'themerex'),
					"desc" => __('Allow to use ThemeREX Emailer for mass-volume e-mail distribution and management of mailing lists in "Appearance - Emailer"', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"admin_po_composer" => array(
					"title" => __('Enable PO Composer in the admin panel', 'themerex'),
					"desc" => __('Allow to use "PO Composer" for edit language files in this theme (in the "Appearance - PO Composer")', 'themerex'),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"debug_mode" => array(
					"title" => __('Debug mode', 'themerex'),
					"desc" => __('In debug mode we are using unpacked scripts and styles, else - using minified scripts and styles (if present). <b>Attention!</b> If you have modified the source code in the js or css files, regardless of this option will be used latest (modified) version stylesheets and scripts. You can re-create minified versions of files using on-line services (for example <a href="http://yui.2clics.net/" target="_blank">http://yui.2clics.net/</a>) or utility <b>yuicompressor-x.y.z.jar</b>', 'themerex'),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

        "info_service_3" => array(
                "title" => esc_html__('API Keys', 'themerex'),
                "desc" => wp_kses_data( __('API Keys for some Web services', 'themerex') ),
                "type" => "info"),
        'api_google' => array(
                "title" => esc_html__('Google API Key', 'themerex'),
                "desc" => wp_kses_data( __("Insert Google API Key for browsers into the field above to generate Google Maps", 'themerex') ),
                "std" => "",
                "type" => "text"),
		
		"info_service_2" => array(
					"title" => __('Clear Wordpress cache', 'themerex'),
					"desc" => __('For example, it recommended after activating the WPML plugin - in the cache are incorrect data about the structure of categories and your site may display "white screen". After clearing the cache usually the performance of the site is restored.', 'themerex'),
					"type" => "info"),
		
		"clear_cache" => array(
					"title" => __('Clear cache', 'themerex'),
					"desc" => __('Clear Wordpress cache data', 'themerex'),
					"divider" => false,
					"icon" => "iconadmin-trash",
					"action" => "clear_cache",
					"type" => "button")
		);



		
		
		
		//###############################################
		//#### Hidden fields (for internal use only) #### 
		//###############################################
		/*
		$THEMEREX_GLOBALS['options']["custom_stylesheet_file"] = array(
			"title" => __('Custom stylesheet file', 'themerex'),
			"desc" => __('Path to the custom stylesheet (stored in the uploads folder)', 'themerex'),
			"std" => "",
			"type" => "hidden");
		
		$THEMEREX_GLOBALS['options']["custom_stylesheet_url"] = array(
			"title" => __('Custom stylesheet url', 'themerex'),
			"desc" => __('URL to the custom stylesheet (stored in the uploads folder)', 'themerex'),
			"std" => "",
			"type" => "hidden");
		*/

		
		
	}
}


// Update all temporary vars (start with $themerex_) in the Theme Options with actual lists
if ( !function_exists( 'themerex_options_settings_theme_setup2' ) ) {
	add_action( 'themerex_action_after_init_theme', 'themerex_options_settings_theme_setup2', 1 );
	function themerex_options_settings_theme_setup2() {
		if (themerex_options_is_used()) {
			global $THEMEREX_GLOBALS;
			// Replace arrays with actual parameters
			$lists = array();
			if (count($THEMEREX_GLOBALS['options']) > 0) {
				foreach ($THEMEREX_GLOBALS['options'] as $k=>$v) {
					if (isset($v['options']) && is_array($v['options']) && count($v['options']) > 0) {
						foreach ($v['options'] as $k1=>$v1) {
							if (themerex_substr($k1, 0, 10) == '$themerex_' || themerex_substr($v1, 0, 10) == '$themerex_') {
								$list_func = themerex_substr(themerex_substr($k1, 0, 10) == '$themerex_' ? $k1 : $v1, 1);
								unset($THEMEREX_GLOBALS['options'][$k]['options'][$k1]);
								if (isset($lists[$list_func]))
									$THEMEREX_GLOBALS['options'][$k]['options'] = themerex_array_merge($THEMEREX_GLOBALS['options'][$k]['options'], $lists[$list_func]);
								else {
									if (function_exists($list_func)) {
										$THEMEREX_GLOBALS['options'][$k]['options'] = $lists[$list_func] = themerex_array_merge($THEMEREX_GLOBALS['options'][$k]['options'], $list_func == 'themerex_get_list_menus' ? $list_func(true) : $list_func());
								   	} else
								   		echo sprintf(__('Wrong function name %s in the theme options array', 'themerex'), $list_func);
								}
							}
						}
					}
				}
			}
		}
	}
}

// Reset old Theme Options while theme first run
if ( !function_exists( 'themerex_options_reset' ) ) {
	function themerex_options_reset($clear=true) {
		$theme_data = wp_get_theme();
		$slug = str_replace(' ', '_', trim(themerex_strtolower((string) $theme_data->get('Name'))));
		$option_name = 'themerex_'.strip_tags($slug).'_options_reset';
		if ( get_option($option_name, false) === false ) {	// && (string) $theme_data->get('Version') == '1.0'
			if ($clear) {
				// Remove Theme Options from WP Options
				global $wpdb;
				$wpdb->query('delete from '.esc_sql($wpdb->options).' where option_name like "themerex_%"');
				// Add Templates Options
				if (file_exists(themerex_get_file_dir('demo/templates_options.txt'))) {
					$theme_options_txt = themerex_fgc(themerex_get_file_dir('demo/templates_options.txt'));
					$data = unserialize( base64_decode( $theme_options_txt) );
					// Replace upload url in options
					if (is_array($data) && count($data) > 0) {
						foreach ($data as $k=>$v) {
							if (is_array($v) && count($v) > 0) {
								foreach ($v as $k1=>$v1) {
									$v[$k1] = themerex_replace_uploads_url(themerex_replace_uploads_url($v1, 'uploads'), 'imports');
								}
							}
							add_option( $k, $v, '', 'yes' );
						}
					}
				}
			}
			add_option($option_name, 1, '', 'yes');
		}
	}
}
?>