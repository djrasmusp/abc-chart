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
		$output = array();

		foreach ($this->plugin_settings[fields] as $field){
			$output[$field['id']] = $input[$field[id]];
		}
		return $output;
	}

	public function acpSettingsSections() {
		echo '';
	}

	public function textField( $args ) {
		$name  = $args['label_for'];
		$option_name = $args['option_name'];
		$value = get_option( $option_name );

		$helper_text = (isset($args['helper_text']) ? $args['helper_text'] : '');

		$input_field = '<input type="text" class="regular-text" name="' . $option_name .'[' . $name .']' . '" value="' . $value[$name] . '" />';
		$helper_text = '<p class="description">'. $helper_text .'</p>';

		echo $input_field . $helper_text;
	}
}
