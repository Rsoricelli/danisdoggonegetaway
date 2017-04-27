<?php
/*
Plugin Name: ThemeREX Utilities
Plugin URI: http://themerex.net
Description: Utils for files, directories, post type and taxonomies manipulations
Version: 1.0
Author: ThemeREX
Author URI: http://themerex.net
*/

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Current version
if ( ! defined( 'TRX_UTILS_VERSION' ) ) {
	define( 'TRX_UTILS_VERSION', '1.0' );
}

// Register theme required types and taxes
if (!function_exists('themerex_require_data')) {	
	function themerex_require_data($type, $name, $args) {
		if ($type == 'taxonomy')
			register_taxonomy($name, $args['post_type'], $args);
		else
			register_post_type($name, $args);
	}
}

// Register theme required shortcodes
if (!function_exists('themerex_require_shortcode')) {	
	function themerex_require_shortcode($name, $callback) {
		add_shortcode($name, $callback);
	}
}

// Return URL to the file in the plugin directory
if (!function_exists('themerex_plugin_get_file_url')) {	
	function themerex_plugin_get_file_url($file) {
		return plugin_dir_url( __FILE__ ) . $file;
	}
}

// Return path to the file in the plugin directory
if (!function_exists('themerex_plugin_get_file_dir')) {	
	function themerex_plugin_get_file_dir($file) {
		return plugin_dir_path( __FILE__ ) . $file;
	}
}
?>