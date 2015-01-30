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

class Plugin {

	/**
	 * @var string
	 */
	private $cdn_url = '';

	/**
	 * @var string
	 */
	private $site_url = '';

	/**
	 * Constructor
	 *
	 * @param string $cdn_url
	 */
	public function __construct( $cdn_url = '' ) {

		// Don't run if SCRIPT_DEBUG is set to true
		if( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			return;
		}

		// Don't run for admin requests
		if( is_admin() || strpos( $_SERVER['REQUEST_URI'], 'wp-login.php' ) !== false ) {
			return;
		}

		// Don't run if CDN URL is empty
		if( '' === $cdn_url ) {
			return;
		}

		// Store cdn url & site url in property
		$this->site_url = get_site_url();
		$this->cdn_url = $cdn_url;

		// add rewrite filters for plugin & theme assets
		add_filter( 'theme_root_uri', array( $this, 'rewrite' ), 99, 1 );
		add_filter( 'plugins_url', array( $this, 'rewrite' ), 99, 1 );

		// add rewrite filters for misc scripts and styles
		add_filter( 'script_loader_src', array( $this, 'rewrite' ), 99, 1 );
		add_filter( 'style_loader_src', array( $this, 'rewrite' ), 99, 1 );
	}

	/**
	 * @param $url
	 *
	 * @return mixed
	 */
	public function rewrite( $url ) {
		$url = str_replace( $this->site_url, $this->cdn_url, $url );
		return $url;
	}

}

new Plugin( ( defined( 'DVK_CDN_URL' ) ? DVK_CDN_URL : '' ));