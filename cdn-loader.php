<?php
/*
Plugin Name: CDN Loader
Description: This plugin will load your assets from a given CDN instead of the local server.
Author: Danny van Kooten
Version: 1.0
Author URI: https://dannyvankooten.com/
*/

namespace CDN_Loader;

if( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'template_redirect', function() {

	// Don't run if SCRIPT_DEBUG is set to true
	if( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		return;
	}

	// load class
	require_once __DIR__ . '/src/UrlRewriter.php';

	// get url of cdn & site
	$cdn_url = ( defined( 'DVK_CDN_URL' ) ? DVK_CDN_URL : '' );
	$site_url = get_site_url();

	// instantiate class
	$url_rewriter = new UrlRewriter( $cdn_url, $site_url );
	$url_rewriter->add_hooks();
});
