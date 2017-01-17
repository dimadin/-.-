<?php
/**
 * Textarea values and attributes for Preslovar form.
 *
 * @package    dimadin\Preslovar
 * @subpackage Fields
 */

namespace dimadin\Preslovar;

/**
 * Textarea values and attributes for Preslovar form.
 *
 * @since 1.0.0
 */
class Fields {
	/**
	 * Value of Cyrillic textarea field.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public static $cyrillic_textarea;

	/**
	 * Value of Latin textarea field.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public static $latin_textarea;

	/**
	 * Additional attributes of Cyrillic textarea field.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public static $cyrillic_attributes;

	/**
	 * Additional attributes of Latin textarea field.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public static $latin_attributes;

	/**
	 * Generate textarea values and attributes.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function setup() {
		// Check if transliteration from Cyrillic to Latin is requested
		if ( isset( $_GET['ћ'] ) && $_GET['ћ'] ) {
			$transliteration = new \Serbian_Transliteration( $_GET['ћ'] );

			static::$latin_attributes = 'autofocus="autofocus" onfocus="this.select()"';
			static::$cyrillic_textarea = $transliteration->original;
			static::$latin_textarea = $transliteration->latin();
		// Check if transliteration from Latin to Cyrillic is requested
		} else if ( isset( $_GET['л'] ) && $_GET['л'] ) {
			$transliteration = new \Serbian_Transliteration( $_GET['л'] );

			static::$cyrillic_attributes = 'autofocus="autofocus" onfocus="this.select()"';
			static::$cyrillic_textarea = $transliteration->cyrillic();
			static::$latin_textarea = $transliteration->original;
		// If nothing is passed, Cyrillic field is focused
		} else {
			static::$cyrillic_attributes = 'autofocus="autofocus"';
		}
	}
}
