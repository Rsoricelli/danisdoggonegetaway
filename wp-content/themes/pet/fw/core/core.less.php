<?php
/**
 * ThemeREX Framework: less manipulations
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


// Theme init
if (!function_exists('themerex_less_theme_setup2')) {
	add_action( 'themerex_action_after_init_theme', 'themerex_less_theme_setup2' );
	function themerex_less_theme_setup2() {
		// Theme first run - compile and save css
		$theme_data = wp_get_theme();
		$slug = str_replace(' ', '_', trim(themerex_strtolower((string) $theme_data->get('Name'))));
		$option_name = 'themerex_'.strip_tags($slug).'_less_compiled';
		if (get_option($option_name, false) === false) {
			add_option($option_name, 1, '', 'yes');
			do_action('themerex_action_compile_less');
		} else if (!is_admin() && themerex_get_theme_option('debug_mode')=='yes') {
			global $THEMEREX_GLOBALS;
			$THEMEREX_GLOBALS['less_check_time'] = true;
			do_action('themerex_action_compile_less');
			$THEMEREX_GLOBALS['less_check_time'] = false;
		}
	}
}



/* LESS
-------------------------------------------------------------------------------- */

// Recompile all LESS files
if (!function_exists('themerex_compile_less')) {	
	function themerex_compile_less($list = array(), $recompile=true) {
	
		// Prepare skin specific LESS-vars (colors, backgrounds, logo height, etc.)
		$vars = apply_filters('themerex_filter_prepare_less', '');

		// Collect .less files in parent and child themes
		$theme_dir = get_template_directory();
		$child_dir = get_stylesheet_directory();
		if (empty($list)) {
			$list = themerex_collect_files($theme_dir, 'less');
			if ($theme_dir != $child_dir) $list = array_merge($list, themerex_collect_files($child_dir, 'less'));
		}
		// Prepare separate array with less utils (not compile it alone - only with main files)
		$utils = '';
		$utils_time = 0;
		if (is_array($list) && count($list) > 0) {
			foreach($list as $k=>$file) {
				$fname = basename($file);
				if ($fname[0]=='_') {
					$utils .= themerex_fgc($file);
					$list[$k] = '';
					$tmp = filemtime($file);
					if ($utils_time < $tmp) $utils_time = $tmp;
				}
			}
		}
		
		// Compile all .less files
		$success = true;
		if (is_array($list) && count($list) > 0) {
		
			// Load and create LESS Parser
			
			// 1: Compiler Lessc
			/*
			require_once( themerex_get_file_dir('lib/lessc/lessc.inc.php') );
			$parser = new lessc;
			if (themerex_get_theme_option('debug_mode')=='no') $parser->setFormatter("compressed");
			*/
			// 2: Compiler Less
			require_once( themerex_get_file_dir('lib/less/Less.php') );

			global $THEMEREX_GLOBALS;

			foreach($list as $file) {
				if (empty($file) || !file_exists($file)) continue;
				$file_css = substr_replace($file , 'css', strrpos($file , '.') + 1);
				
				// Check if time of .css file after .less - skip current .less
				if (!empty($THEMEREX_GLOBALS['less_check_time']) && file_exists($file_css)) {
					$css_time = filemtime($file_css);
					if ($css_time >= filemtime($file) && ($utils_time==0 || $css_time > $utils_time)) continue;
				}
				
				// Compile current .less file
				try {
					// Get separator to split LESS-files
					$less_sep = themerex_get_theme_setting('less_separator');
					// Create Parser
					if (themerex_get_theme_option('debug_mode')=='no')
						$args = array('compress' => true);
					else {
						$args = array('compress' => false);
						/*
						if ($less_sep == '') {
							$args['sourceMap'] = true;
							$args['sourceMapWriteTo'] = $file_css.'.map';
							$args['sourceMapURL'] = str_replace('.less', '.css', themerex_get_file_url(basename($file))) . '.map';
						}
						*/
					}
					$parser = new Less_Parser($args);
					// Parse main file
					if (($text = themerex_fgc($file))!='') {
						$parts = $less_sep != '' ? explode($less_sep, $text) : array($text);
						$css = '';
						for ($i=0; $i<count($parts); $i++) {
							$text = $parts[$i]
								. (!empty($utils) ? $utils : '')			// Add less utils
								. (!empty($vars) ? $vars : '');				// Add less vars (from Theme Options)
							// Get compiled CSS code
							// 1:
							//$css = $parser->compile($text);
							// 2:
							$parser->parse($text);
							$css .= $parser->getCss();
							$parser->Reset();
						}
						// If it main theme style - append CSS after header comments
						if ($file == $theme_dir . '/style.less') {
							// Append to the main Theme Style CSS
							$theme_css = themerex_fgc( get_template_directory() . '/style.css' );
							$css = themerex_substr($theme_css, 0, themerex_strpos($theme_css, '*/')+2) . "\n\n" . $css;
						} else {
							$css =	"/*"
									. "\n"
									. __('Attention! Do not modify this .css-file!', 'themerex') 
									. "\n"
									. __('Please, make all necessary changes in the corresponding .less-file!', 'themerex')
									. "\n"
									. "*/"
									. "\n"
									. '@charset "utf-8";'
									. "\n\n"
									. $css;
						}
						// Save compiled CSS
						themerex_fpc( $file_css, $css);
					}
				} catch (Exception $e) {
					if (themerex_get_theme_option('debug_mode')=='yes') dfl($e->getMessage());
					$success = false;
				}
			}
		}
		
		return $success;
	}
}
?>