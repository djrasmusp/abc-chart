<?php
/**
 * @package AbcChartParser
 */

namespace ACP\API\Callbacks;


use ACP\Base\BaseController;

class SettingsCallbacks extends BaseController {
	public function acpSettingsPage() {
		return require_once( $this->plugin_path
		                     . 'templates/admin.php' );
	}

	public function acpSettings( $input ) {
		return $input;
	}

	public function acpSettingsSection() {
		echo 'test';
	}

	public function textField( $args ) {
		$name  = $args['label_for'];
		$helper_text = (isset($args['helper_text']) ? $args['helper_text'] : '');
		$value = get_option( $name );

		$input_field = '<input type="text" class="regular-text" name="' . $name . '" value="' . $value . '" />';
		$helper_text = '<p class="description">'. $helper_text .'</p>';

		echo $input_field . $helper_text;
	}
}
