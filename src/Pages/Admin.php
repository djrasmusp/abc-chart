<?php
/**
 * @package AbcChartParser
 */


namespace ACP\Pages;

use \ACP\Base\BaseController;
use \ACP\API\SettingsApi;
use \ACP\API\Callbacks\SettingsCallbacks;

class Admin extends BaseController {
	public $settings;

	public $callbacks;

	public $pages = array();

	public function register() {
		$this->settings = new SettingsApi();

		$this->callbacks = new SettingsCallbacks();

		$this->setPages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->register();
	}

	public function setPages() {
		$this->pages = array(
			array(
				'parent_slug' => 'edit.php?post_type=chart',
				'page_title'  => 'Chart Settings',
				'menu_title'  => 'Settings',
				'capability'  => 'manage_options',
				'menu_slug'   => 'chart_settings',
				'callback'    => array( $this->callbacks, 'acpSettingsPage' )
			)
		);
	}

	public function setSettings() {
		$args = array(
			array(
				'option_group' => 'acp_settings',
				'option_name'  => 'chart_settings',
				'callback'     => array( $this->callbacks, 'acpSettings' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections() {
		$args = array();

		foreach ( $this->plugin_settings["sections"] as $section ) {
			$args[] = array(
				'id'       => $section['id'],
				'title'    => $section['title'],
				'callback' => array( $this->callbacks, 'acpSettingsSections' ),
				'page'     => 'chart_settings'
			);
		}

		$this->settings->setSections( $args );
	}

	public function setFields() {
		$args = array();

		foreach ( $this->plugin_settings['fields'] as $field ) {
			$args[] = array(
				'id'       => $field['id'],
				'title'    => $field['title'],
				'callback' => array( $this->callbacks, 'textField' ),
				'page'     => 'chart_settings',
				'section'  => $field['section'],
				'args'     => array(
					'option_name' => 'chart_settings',
					'label_for'   => $field['id'],
					'helper_text' => $field['helper_text']
				)
			);
		}

		$this->settings->setFields( $args );
	}
}
