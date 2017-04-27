<?php
/**
 * Skin file for the theme.
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('themerex_action_skin_theme_setup')) {
	add_action( 'themerex_action_init_theme', 'themerex_action_skin_theme_setup', 1 );
	function themerex_action_skin_theme_setup() {

		// Add skin fonts in the used fonts list
		add_filter('themerex_filter_used_fonts',			'themerex_filter_skin_used_fonts');
		// Add skin fonts (from Google fonts) in the main fonts list (if not present).
		add_filter('themerex_filter_list_fonts',			'themerex_filter_skin_list_fonts');

		// Add skin stylesheets
		add_action('themerex_action_add_styles',			'themerex_action_skin_add_styles');
		// Add skin inline styles
		add_filter('themerex_filter_add_styles_inline',		'themerex_filter_skin_add_styles_inline');
		// Add skin responsive styles
		add_action('themerex_action_add_responsive',		'themerex_action_skin_add_responsive');
		// Add skin responsive inline styles
		add_filter('themerex_filter_add_responsive_inline',	'themerex_filter_skin_add_responsive_inline');

		// Add skin scripts
		add_action('themerex_action_add_scripts',			'themerex_action_skin_add_scripts');
		// Add skin scripts inline
		add_action('themerex_action_add_scripts_inline',	'themerex_action_skin_add_scripts_inline');

		// Add skin less files into list for compilation
		add_filter('themerex_filter_compile_less',			'themerex_filter_skin_compile_less');


		/* Color schemes
		
		// Accenterd colors
		accent1			- theme accented color 1
		accent1_hover	- theme accented color 1 (hover state)
		accent2			- theme accented color 2
		accent2_hover	- theme accented color 2 (hover state)		
		accent3			- theme accented color 3
		accent3_hover	- theme accented color 3 (hover state)		
		
		// Headers, text and links
		text			- main content
		text_light		- post info
		text_dark		- headers
		inverse_text	- text on accented background
		inverse_light	- post info on accented background
		inverse_dark	- headers on accented background
		inverse_link	- links on accented background
		inverse_hover	- hovered links on accented background
		
		// Block's border and background
		bd_color		- border for the entire block
		bg_color		- background color for the entire block
		bg_image, bg_image_position, bg_image_repeat, bg_image_attachment  - first background image for the entire block
		bg_image2,bg_image2_position,bg_image2_repeat,bg_image2_attachment - second background image for the entire block
		
		// Alternative colors - highlight blocks, form fields, etc.
		alter_text		- text on alternative background
		alter_light		- post info on alternative background
		alter_dark		- headers on alternative background
		alter_link		- links on alternative background
		alter_hover		- hovered links on alternative background
		alter_bd_color	- alternative border
		alter_bd_hover	- alternative border for hovered state or active field
		alter_bg_color	- alternative background
		alter_bg_hover	- alternative background for hovered state or active field 
		alter_bg_image, alter_bg_image_position, alter_bg_image_repeat, alter_bg_image_attachment - background image for the alternative block
		
		*/

		// Add color schemes
		themerex_add_color_scheme('original', array(

			'title'					=> __('Original', 'themerex'),

                // Accent colors
                'accent1'				=> '#fe908b',   /* Pink */
                'accent1_hover'			=> '#e8817d',
                'accent2'				=> '#85d6df',   /* Blue */
    			'accent2_hover'			=> '#5d6e7f',
                'accent3'				=> '#ffd27a',   /* Yellow */
   			    'accent3_hover'			=> '#ffd27a',

                // Headers, text and links colors
                'text'					=> '#a0acb8',
                'text_light'			=> '#ffffff',
                'text_dark'				=> '#344a5f',   /* Dark blue */
                'inverse_text'			=> '#5d6e7f',
                'inverse_light'			=> '#a0acb8',
                'inverse_dark'			=> '#ffffff',
                'inverse_link'			=> '#ffffff',
                'inverse_hover'			=> '#ffffff',

                // Whole block border and background
                'bd_color'				=> '#f0f0f0',
                'bg_color'				=> '#ffffff',
                'bg_image'				=> themerex_get_file_url('images/background-image-1.jpg'),
                'bg_image_position'		=> 'left top',
                'bg_image_repeat'		=> 'repeat',
                'bg_image_attachment'	=> 'scroll',
                'bg_image2'				=> '',
                'bg_image2_position'	=> 'left top',
                'bg_image2_repeat'		=> 'repeat',
                'bg_image2_attachment'	=> 'scroll',

                // Alternative blocks (submenu items, form's fields, etc.)
                'alter_text'			=> '#3b3b42',
                'alter_light'			=> '#a0acb8',
                'alter_dark'			=> '#6a879f',
                'alter_link'			=> '#20c7ca',
                'alter_hover'			=> '#6e7b88',
                'alter_bd_color'		=> '#a0acb8',
                'alter_bd_hover'		=> '#bbbbbb',
                'alter_bg_color'		=> '#344a5f',
                'alter_bg_hover'		=> '#f0f0f0',
                'alter_bg_image'			=>  themerex_get_file_url('images/background-image-2.jpg'),
                'alter_bg_image_position'	=> 'left top',
                'alter_bg_image_repeat'		=> 'repeat',
                'alter_bg_image_attachment'	=> 'scroll',

			)
		);

		// Add color schemes
		themerex_add_color_scheme('dark', array(

			'title'					=> __('Dark', 'themerex'),

			// Accent colors
			'accent1'				=> '#20c7ca',
			'accent1_hover'			=> '#189799',
            'accent2'				=> '#eeeeee',
            'accent2_hover'			=> '',
            'accent3'				=> '#eeeeee',
            'accent3_hover'			=> '',
			
			// Headers, text and links colors
			'text'					=> '#909090',
			'text_light'			=> '#a0a0a0',
			'text_dark'				=> '#e0e0e0',
			'inverse_text'			=> '#f0f0f0',
			'inverse_light'			=> '#e0e0e0',
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#ffffff',
			'inverse_hover'			=> '#e5e5e5',
			
			// Whole block border and background
			'bd_color'				=> '#000000',
			'bg_color'				=> '#333333',
			'bg_image'				=> '',
			'bg_image_position'		=> 'left top',
			'bg_image_repeat'		=> 'repeat',
			'bg_image_attachment'	=> 'scroll',
			'bg_image2'				=> '',
			'bg_image2_position'	=> 'left top',
			'bg_image2_repeat'		=> 'repeat',
			'bg_image2_attachment'	=> 'scroll',
		
			// Alternative blocks (submenu items, form's fields, etc.)
			'alter_text'			=> '#999999',
			'alter_light'			=> '#aaaaaa',
			'alter_dark'			=> '#d0d0d0',
			'alter_link'			=> '#20c7ca',
			'alter_hover'			=> '#29fbff',
			'alter_bd_color'		=> '#909090',
			'alter_bd_hover'		=> '#888888',
			'alter_bg_color'		=> '#666666',
			'alter_bg_hover'		=> '#505050',
			'alter_bg_image'			=> '',
			'alter_bg_image_position'	=> 'left top',
			'alter_bg_image_repeat'		=> 'repeat',
			'alter_bg_image_attachment'	=> 'scroll',
			)
		);


		/* Font slugs:
		h1 ... h6	- headers
		p			- plain text
		link		- links
		info		- info blocks (Posted 15 May, 2015 by John Doe)
		menu		- main menu
		submenu		- dropdown menus
		logo		- logo text
		button		- button's caption
		input		- input fields
		*/

		// Add Custom fonts
		themerex_add_custom_font('h1', array(
			'title'			=> __('Heading 1', 'themerex'),
			'description'	=> '',
			'font-family'	=> 'Grand Hotel',
			'font-size' 	=> '6em',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '1.4em',
			'margin-top'	=> '0.5em',
			'margin-bottom'	=> '0.1em'
			)
		);
		themerex_add_custom_font('h2', array(
			'title'			=> __('Heading 2', 'themerex'),
			'description'	=> '',
			'font-family'	=> 'Grand Hotel',
			'font-size' 	=> '3em',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '1.3em',
			'margin-top'	=> '0.8em',
			'margin-bottom'	=> '0.2em'
			)
		);
		themerex_add_custom_font('h3', array(
			'title'			=> __('Heading 3', 'themerex'),
			'description'	=> '',
			'font-family'	=> 'Grand Hotel',
			'font-size' 	=> '2em',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '1.65em',
			'margin-top'	=> '1.2em',
			'margin-bottom'	=> '0'
			)
		);
		themerex_add_custom_font('h4', array(
			'title'			=> __('Heading 4', 'themerex'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '1.667em',
			'font-weight'	=> '600',
			'font-style'	=> '',
			'line-height'	=> '2em',
			'margin-top'	=> '1.03em',
			'margin-bottom'	=> '0.2em'
			)
		);
		themerex_add_custom_font('h5', array(
			'title'			=> __('Heading 5', 'themerex'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '1.333em',
			'font-weight'	=> '600',
			'font-style'	=> '',
			'line-height'	=> '1.2em',
			'margin-top'	=> '1.9em',
			'margin-bottom'	=> '0.7em'
			)
		);
		themerex_add_custom_font('h6', array(
			'title'			=> __('Heading 6', 'themerex'),
			'description'	=> '',
			'font-family'	=> 'Grand Hotel',
			'font-size' 	=> '1.333em',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '2em',
			'margin-top'	=> '1em',
			'margin-bottom'	=> '0'
			)
		);
        themerex_add_custom_font('page_title', array(
                'title'			=> __('Page title', 'themerex'),
                'description'	=> '',
                'font-family'	=> 'Raleway',
                'font-weight'	=> '600',
                'font-style'	=> ''
            )
        );
		themerex_add_custom_font('p', array(
			'title'			=> __('Text', 'themerex'),
			'description'	=> '',
			'font-family'	=> 'Raleway',
			'font-size' 	=> '15px',
			'font-weight'	=> '500',
			'font-style'	=> '',
			'line-height'	=> '1.67em',
			'margin-top'	=> '',
			'margin-bottom'	=> '1em'
			)
		);
		themerex_add_custom_font('link', array(
			'title'			=> __('Links', 'themerex'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '',
			'font-style'	=> ''
			)
		);
		themerex_add_custom_font('info', array(
			'title'			=> __('Post info', 'themerex'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '',
			'font-style'	=> 'i',
			'line-height'	=> '1.3em',
			'margin-top'	=> '',
			'margin-bottom'	=> '1.5em'
			)
		);
		themerex_add_custom_font('menu', array(
			'title'			=> __('Main menu items', 'themerex'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '600',
			'font-style'	=> '',
			'line-height'	=> '1.3em',
			'margin-top'	=> '1.8em',
			'margin-bottom'	=> '1.1em'
			)
		);
		themerex_add_custom_font('submenu', array(
			'title'			=> __('Dropdown menu items', 'themerex'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '',
			'font-style'	=> '',
			'line-height'	=> '1.3em',
			'margin-top'	=> '',
			'margin-bottom'	=> ''
			)
		);
		themerex_add_custom_font('logo', array(
			'title'			=> __('Logo', 'themerex'),
			'description'	=> '',
			'font-family'	=> 'Grand Hotel',
			'font-size' 	=> '3em',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '.89em',
			'margin-top'	=> '2em',
			'margin-bottom'	=> '1.4em'
			)
		);
		themerex_add_custom_font('button', array(
			'title'			=> __('Buttons', 'themerex'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '',
			'font-style'	=> '',
			'line-height'	=> '1.3em'
			)
		);
		themerex_add_custom_font('input', array(
			'title'			=> __('Input fields', 'themerex'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '',
			'font-style'	=> '',
			'line-height'	=> '1.3em'
			)
		);

	}
}





//------------------------------------------------------------------------------
// Skin's fonts
//------------------------------------------------------------------------------

// Add skin fonts in the used fonts list
if (!function_exists('themerex_filter_skin_used_fonts')) {
	//add_filter('themerex_filter_used_fonts', 'themerex_filter_skin_used_fonts');
	function themerex_filter_skin_used_fonts($theme_fonts) {
		//$theme_fonts['Roboto'] = 1;
		//$theme_fonts['Love Ya Like A Sister'] = 1;
        $theme_fonts['Grand Hotel'] = 1;
        $theme_fonts['Raleway'] = 1;
        $theme_fonts['Varela Round'] = 1;
        $theme_fonts['Lato'] = 1;
		return $theme_fonts;
	}
}

// Add skin fonts (from Google fonts) in the main fonts list (if not present).
// To use custom font-face you not need add it into list in this function
// How to install custom @font-face fonts into the theme?
// All @font-face fonts are located in "theme_name/css/font-face/" folder in the separate subfolders for the each font. Subfolder name is a font-family name!
// Place full set of the font files (for each font style and weight) and css-file named stylesheet.css in the each subfolder.
// Create your @font-face kit by using Fontsquirrel @font-face Generator (http://www.fontsquirrel.com/fontface/generator)
// and then extract the font kit (with folder in the kit) into the "theme_name/css/font-face" folder to install
if (!function_exists('themerex_filter_skin_list_fonts')) {
	//add_filter('themerex_filter_list_fonts', 'themerex_filter_skin_list_fonts');
	function themerex_filter_skin_list_fonts($list) {
		// Example:
		// if (!isset($list['Advent Pro'])) {
		//		$list['Advent Pro'] = array(
		//			'family' => 'sans-serif',																						// (required) font family
		//			'link'   => 'Advent+Pro:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic',	// (optional) if you use Google font repository
		//			'css'    => themerex_get_file_url('/css/font-face/Advent-Pro/stylesheet.css')									// (optional) if you use custom font-face
		//			);
		// }
        if (!isset($list['Grand Hotel']))			$list['Grand Hotel'] = array('family'=>'cursive');
        if (!isset($list['Raleway']))			    $list['Raleway'] = array('family'=>'sans-serif',  'link'=>'Raleway:500,600,400');
        if (!isset($list['Varela Round']))			$list['Varela Round'] = array('family'=>'sans-serif');
        if (!isset($list['Lato']))	                $list['Lato'] = array('family'=>'sans-serif');
		return $list;
	}
}



//------------------------------------------------------------------------------
// Skin's stylesheets
//------------------------------------------------------------------------------
// Add skin stylesheets
if (!function_exists('themerex_action_skin_add_styles')) {
	//add_action('themerex_action_add_styles', 'themerex_action_skin_add_styles');
	function themerex_action_skin_add_styles() {
		// Add stylesheet files
		themerex_enqueue_style( 'themerex-skin-style', themerex_get_file_url('skin.css'), array(), null );
		if (file_exists(themerex_get_file_dir('skin.customizer.css')))
			themerex_enqueue_style( 'themerex-skin-customizer-style', themerex_get_file_url('skin.customizer.css'), array(), null );
	}
}

// Add skin inline styles
if (!function_exists('themerex_filter_skin_add_styles_inline')) {
	//add_filter('themerex_filter_add_styles_inline', 'themerex_filter_skin_add_styles_inline');
	function themerex_filter_skin_add_styles_inline($custom_style) {
		// Todo: add skin specific styles in the $custom_style to override
		//       rules from style.css and shortcodes.css
		// Example:
		//		$scheme = themerex_get_custom_option('body_scheme');
		//		if (empty($scheme)) $scheme = 'original';
		//		$clr = themerex_get_scheme_color('accent1');
		//		if (!empty($clr)) {
		// 			$custom_style .= '
		//				a,
		//				.bg_tint_light a,
		//				.top_panel .content .search_wrap.search_style_regular .search_form_wrap .search_submit,
		//				.top_panel .content .search_wrap.search_style_regular .search_icon,
		//				.search_results .post_more,
		//				.search_results .search_results_close {
		//					color:'.esc_attr($clr).';
		//				}
		//			';
		//		}
		return $custom_style;	
	}
}

// Add skin responsive styles
if (!function_exists('themerex_action_skin_add_responsive')) {
	//add_action('themerex_action_add_responsive', 'themerex_action_skin_add_responsive');
	function themerex_action_skin_add_responsive() {
		$suffix = themerex_sc_param_is_off(themerex_get_custom_option('show_sidebar_outer')) ? '' : '-outer';
		if (file_exists(themerex_get_file_dir('skin.responsive'.($suffix).'.css'))) 
			themerex_enqueue_style( 'theme-skin-responsive-style', themerex_get_file_url('skin.responsive'.($suffix).'.css'), array(), null );
	}
}

// Add skin responsive inline styles
if (!function_exists('themerex_filter_skin_add_responsive_inline')) {
	//add_filter('themerex_filter_add_responsive_inline', 'themerex_filter_skin_add_responsive_inline');
	function themerex_filter_skin_add_responsive_inline($custom_style) {
		return $custom_style;	
	}
}

// Add skin.less into list files for compilation
if (!function_exists('themerex_filter_skin_compile_less')) {
	//add_filter('themerex_filter_compile_less', 'themerex_filter_skin_compile_less');
	function themerex_filter_skin_compile_less($files) {
		if (file_exists(themerex_get_file_dir('skin.less'))) {
		 	$files[] = themerex_get_file_dir('skin.less');
		 	$files[] = themerex_get_file_dir('skin.responsive.less');
		 	$files[] = themerex_get_file_dir('skin.responsive-outer.less');
		}
		return $files;	
	}
}



//------------------------------------------------------------------------------
// Skin's scripts
//------------------------------------------------------------------------------

// Add skin scripts
if (!function_exists('themerex_action_skin_add_scripts')) {
	//add_action('themerex_action_add_scripts', 'themerex_action_skin_add_scripts');
	function themerex_action_skin_add_scripts() {
		if (file_exists(themerex_get_file_dir('skin.js')))
			themerex_enqueue_script( 'theme-skin-script', themerex_get_file_url('skin.js'), array(), null );
		if (themerex_get_theme_option('show_theme_customizer') == 'yes' && file_exists(themerex_get_file_dir('skin.customizer.js')))
			themerex_enqueue_script( 'theme-skin-customizer-script', themerex_get_file_url('skin.customizer.js'), array(), null );
	}
}

// Add skin scripts inline
if (!function_exists('themerex_action_skin_add_scripts_inline')) {
	//add_action('themerex_action_add_scripts_inline', 'themerex_action_skin_add_scripts_inline');
	function themerex_action_skin_add_scripts_inline() {
		// Todo: add skin specific scripts
		// Example:
		// echo '<script type="text/javascript">'
		//	. 'jQuery(document).ready(function() {'
		//	. "if (THEMEREX_GLOBALS['theme_font']=='') THEMEREX_GLOBALS['theme_font'] = '" . themerex_get_custom_font_settings('p', 'font-family') . "';"
		//	. "THEMEREX_GLOBALS['theme_skin_color'] = '" . themerex_get_scheme_color('accent1') . "';"
		//	. "});"
		//	. "< /script>";
	}
}
?>