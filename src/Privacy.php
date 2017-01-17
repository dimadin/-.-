<?php
/**
 * Privacy information.
 *
 * @package    dimadin\Preslovar
 * @subpackage Privacy
 */

namespace dimadin\Preslovar;

/**
 * Privacy information.
 *
 * @since 1.0.0
 */
class Privacy {
	/**
	 * Get privacy.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string $privacy Privacy.
	 */
	public static function get_privacy() {
		$privacy = '';

		// Check if there is custom privacy
		if ( defined( 'PRESLOVAR_PRIVACY' ) && PRESLOVAR_PRIVACY ) {
			$privacy = PRESLOVAR_PRIVACY;
		}

		// Add basic privacy
		$privacy .= static::get_basic_privacy();

		// Add Google privacy privacy
		$privacy .= static::get_google_analytics_privacy();

		return $privacy;
	}

	/**
	 * Get basic privacy.
	 *
	 * It is used only if there is a constant set.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string $privacy Basic privacy.
	 */
	public static function get_basic_privacy() {
		if ( ! defined( 'PRESLOVAR_USE_BASIC_PRIVACY' ) || ! PRESLOVAR_USE_BASIC_PRIVACY ) {
			return;
		}

		return '
		<h5>Пресловљавање</h5>
		<ul>
			<li>У случају да вам је Јаваскрипт укључен, што значи да се пресловљавање дешава у истом тренутку док куцате, никакви подаци не напуштају ваш уређај.</li>
			<li>У случају да вам Јаваскрипт није укључен, пресловљавање се обавља на серверу. Приликом пресловљавања на серверу подаци се не чувају трајно, сем приликом серверске грешке када могу да се чувају неко време на серверу. Пренос података у оба правца се обавља преко безбедне везе коју није могуће прислушкивати.</li>
		</ul>
		';
	}

	/**
	 * Get privacy for Google Analytics.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string $privacy Privacy is Google Analytics is used. Default empty.
	 */
	public static function get_google_analytics_privacy() {
		if ( ! GoogleAnalytics::get_google_analytics_id() ) {
			return;
		}

		return '
		<h5>Гуглова аналитика</h5>
		<ul>
			<li>За праћење статистике посете користи се Гуглова аналитика која има <a href="https://support.google.com/analytics/answer/6004245?hl=sr">сопствену политику приватности</a>. Уколико не желите да вас она прати, можете је <a href="https://support.google.com/analytics/answer/181881?hl=sr">онемогућити</a>.</li>
			<li>Приликом слања података Гуглу користи се маскирање IP адресе и захтева да се колачићи не складиште у вашем прегледачу.</li>
		</ul>
		';
	}
}
