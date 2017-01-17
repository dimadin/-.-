<?php
/**
 * Google Analytics integration.
 *
 * @package    dimadin\Preslovar
 * @subpackage GoogleAnalytics
 */

namespace dimadin\Preslovar;

/**
 * Google Analytics integration.
 *
 * @since 1.0.0
 */
class GoogleAnalytics {
	/**
	 * Get Google Analytics JavaScript code.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function code() {
		$id = static::get_google_analytics_id();

		if ( ! $id ) {
			return;
		}

		?>
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo $id; ?>', {
			'storage': 'none'
		});
		<?php if ( isset( $_GET['ћ'] ) ) : ?>
			ga('set', 'location', '/?ћ');
		<?php elseif ( isset( $_GET['л'] ) ) : ?>
			ga('set', 'location', '/?л');
		<?php endif; ?>
		ga('set', 'anonymizeIp', true);
		ga('set', 'forceSSL', true);
		ga('send', 'pageview');
		</script>
		<?php
	}

	/**
	 * Get Google Analytics ID.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string $id Unique site ID in Google Analytics.
	 */
	public static function get_google_analytics_id() {
		static $id = '';

		if ( empty( $id ) && defined( 'PRESLOVAR_GOOGLE_ANALYTICS_ID' ) && PRESLOVAR_GOOGLE_ANALYTICS_ID ) {
			$id = PRESLOVAR_GOOGLE_ANALYTICS_ID;
		}

		return $id;
	}
}
