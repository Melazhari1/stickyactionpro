<?php
/*
Plugin Name: Sticky Action Pro
Description: Boost your WordPress website by making important buttons always visible as users scroll. Increase user interaction and conversions easily with StickyActionPro. Give it a try today!
Version: 1.0
Author: MElazhari
Author URI: http//melazhari.com
Requires at least: 5.8
Requires PHP: 5.6.20
License: GPLv2 or later
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'STICKYACTIONPRO__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'STICKYACTIONPRO__PLUGIN_FILE', __FILE__ );

if( is_admin() ){
	require_once( STICKYACTIONPRO__PLUGIN_DIR . 'classes/class.stickyactionpro-admin.php' );
	new StickyactionproAdmin();
}else{
	require_once( STICKYACTIONPRO__PLUGIN_DIR . 'class.stickyactionpro.php' );
	new Stickyactionpro();
}
