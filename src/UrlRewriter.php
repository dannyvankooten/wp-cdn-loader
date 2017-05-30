<?php

namespace CDN_Loader;

class UrlRewriter {
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
	 * @param string $site_url
	 */
	public function __construct( $cdn_url, $site_url ) {
		// Store cdn url & site url in property
		$this->site_url = $site_url;
		$this->cdn_url = $cdn_url;
	}

	public function add_hooks() {
		// add rewrite filters for plugin & theme assets
		add_filter( 'theme_root_uri', array( $this, 'rewrite' ), 99, 1 );
		add_filter( 'plugins_url', array( $this, 'rewrite' ), 99, 1 );

		// add rewrite filters for misc scripts and styles
		add_filter( 'script_loader_src', array( $this, 'rewrite' ), 99, 1 );
		add_filter( 'style_loader_src', array( $this, 'rewrite' ), 99, 1 );
		return true;
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