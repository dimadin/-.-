<?php
/**
 * Scripts and styles used in Preslovar.
 *
 * @package    dimadin\Preslovar
 * @subpackage Dependencies
 */

namespace dimadin\Preslovar;

/**
 * Scripts and styles used in Preslovar.
 *
 * @since 1.0.0
 */
class Dependencies {
	/**
	 * Paths of used CSS files.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public static $styles = [
		'https://unpkg.com/bootstrap@4.0.0-alpha.6/dist/css/bootstrap.min.css',
		'/assets/css/main.min.css?v=1',
	];

	/**
	 * Paths of used JavaScript files.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public static $scripts = [
		'https://unpkg.com/jquery@3.2.1/dist/jquery.slim.min.js',
		'https://unpkg.com/clipboard@1.6.1/dist/clipboard.min.js',
		'https://unpkg.com/tether@1.4.0/dist/js/tether.min.js',
		'https://unpkg.com/bootstrap@4.0.0-alpha.6/dist/js/bootstrap.min.js',
		'https://unpkg.com/serbian-transliteration@1.0.0/dist/serbian-transliteration.min.js',
		'https://unpkg.com/autosize@3.0.20/dist/autosize.min.js',
		'https://unpkg.com/mousetrap@1.6.1/mousetrap.min.js',
		'/assets/js/main.min.js?v=3',
	];

	/**
	 * Add preload link headers with used dependencies.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function header_link_preload() {
		// Add header for styles
		foreach ( static::$styles as $style ) {
			header( "Link: <{$style}>; rel=preload; as=style", false );
		}
	}
}
