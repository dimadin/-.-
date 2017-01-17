<?php
/**
 * Bootstrap Preslovar.
 *
 * @package    dimadin\Preslovar
 * @subpackage Main
 */

namespace dimadin\Preslovar;

/**
 * Bootstrap Preslovar.
 *
 * @since 1.0.0
 */
class Main {
	/**
	 * Start required methods.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function load() {
		// Load config file
		static::load_config();

		// Setup textarea fields
		Fields::setup();

		// Add header preloads
		Dependencies::header_link_preload();
	}

	/**
	 * Load config file if it exists in same or parent directory.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function load_config() {
		if ( file_exists( PRESLOVAR_PATH . '/preslovar-config.php' ) ) {
			require_once( PRESLOVAR_PATH . 'preslovar-config.php' );
		} elseif ( @file_exists( dirname( PRESLOVAR_PATH ) . '/preslovar-config.php' ) ) {
			require_once( dirname( PRESLOVAR_PATH ) . '/preslovar-config.php' );
		}
	}
}
