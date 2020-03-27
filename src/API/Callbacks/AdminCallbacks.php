<?php
/**
 * @package AbcChartParser
 */

namespace ACP\API\Callbacks;


use ACP\Base\BaseController;

class AdminCallbacks extends BaseController {
	public function adminSettings() {
		return require_once( $this->plugin_path
		                     . 'templates/admin.php' );
	}

	public function acpOptionsGroup( $input ) {
		return $input;
	}

	public function acpAdminSection() {
		echo 'test';
	}

	public function acpSettingApiKey() {
		$value = esc_attr( get_option( 'acp_api_key' ) );
		echo '<input type="text" class="regular-text" name="acp_api_key" value="'
		     . $value . '" placeholder=""/>
			<p class="description">Get API Key for <a
								href="https://rapidapi.com/feelmare/api/cameleonpdf"
								target="_blank">CameleonPDF</a>.</p>';
	}

	public function acpSettingClientId() {
		$value = esc_attr( get_option( 'acp_client_id' ) );
		echo '<input type="text" class="regular-text" name="acp_client_id" value="'
		     . $value . '" placeholder=""/>';
	}

	public function acpSettingClientSecret() {
		$value = esc_attr( get_option( 'acp_client_secret' ) );
		echo '<input type="text" class="regular-text" name="acp_client_secret" value="'
		     . $value . '" placeholder=""/>
		     <p class="description">Get Client ID and Secret for <a
								href="https://developer.spotify.com"
								target="_blank">Spotify</a>.</p>';
	}
}
