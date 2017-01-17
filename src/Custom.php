<?php
/**
 * Custom, per site additional HTML code.
 *
 * @package    dimadin\Preslovar
 * @subpackage Custom
 */

namespace dimadin\Preslovar;

/**
 * Custom, per site additional HTML code.
 *
 * @since 1.0.0
 */
class Custom {
	/**
	 * Display additional code.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function display() {
		// Check if there is custom privacy
		if ( defined( 'PRESLOVAR_CUSTOM_CODE' ) && PRESLOVAR_CUSTOM_CODE ) {
			echo PRESLOVAR_CUSTOM_CODE;
		}

		// Show Google Analytics
		GoogleAnalytics::code();
	}
}
