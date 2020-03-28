<?php
/**
 * @package AbcChartParser
 */

namespace ACP\Base;

class SettingsLink extends BaseController {
	public function register() {
		add_filter( "plugin_action_links_" . $this->plugin,
		            array( $this, 'settings_link' ) );
	}

	public function settings_link( $links ) {
		$settings_link = '<a href="admin.php?page=chart_settings" title="Settings for ABC Charts">Settings</a>';
		array_push( $links, $settings_link );

		return $links;
	}

}
