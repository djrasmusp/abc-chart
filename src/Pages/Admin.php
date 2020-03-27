<?php
/**
 * @package AbcChartParser
 */


namespace ACP\Pages;

use \ACP\Base\BaseController;
use \ACP\API\SettingsApi;
use \ACP\API\Callbacks\AdminCallbacks;

class Admin extends BaseController {
	public $settings;

	public $callbacks;

	public $pages = array();

	public function register() {
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

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
				'callback'    => array( $this->callbacks, 'adminSettings' )
			)
		);
	}

	public function setSettings() {
		$args = array(
			array(
				'option_group' => 'acp_settings',
				'option_name'  => 'acp_api_key',
				'callback'     => array( $this->callbacks, 'acpOptionsGroup' )
			),
			array(
				'option_group' => 'acp_settings',
				'option_name'  => 'acp_client_id',
				'callback'     => array( $this->callbacks, 'acpOptionsGroup' )
			),
			array(
				'option_group' => 'acp_settings',
				'option_name'  => 'acp_client_secret',
				'callback'     => array( $this->callbacks, 'acpOptionsGroup' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections() {
		$args = array(
			array(
				'id'       => 'acp_cameleonpdf_settings',
				'title'    => 'CameleonPDF API Settings',
				'callback' => array( $this->callbacks, 'acpAdminSection' ),
				'page'     => 'chart_settings'
			),
			array(
				'id'       => 'acp_spotify_settings',
				'title'    => 'Spotify API Settings',
				'callback' => array( $this->callbacks, 'acpAdminSection' ),
				'page'     => 'chart_settings'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields() {
		$args = array(
			array(
				'id'       => 'acp_api_key',
				'title'    => 'API Key',
				'callback' => array( $this->callbacks, 'acpSettingApiKey' ),
				'page'     => 'chart_settings',
				'section'  => 'acp_cameleonpdf_settings',
				'args'     => array(
					'label_for' => 'acp_api_key'
				)
			),
			array(
				'id'       => 'acp_client_id',
				'title'    => 'Client Id',
				'callback' => array( $this->callbacks, 'acpSettingClientId' ),
				'page'     => 'chart_settings',
				'section'  => 'acp_spotify_settings',
				'args'     => array(
					'label_for' => 'acp_client_id'
				)
			),
			array(
				'id'       => 'acp_client_secret',
				'title'    => 'Client Secret',
				'callback' => array( $this->callbacks, 'acpSettingClientSecret' ),
				'page'     => 'chart_settings',
				'section'  => 'acp_spotify_settings',
				'args'     => array(
					'label_for' => 'acp_client_secret'
				)
			)
		);

		$this->settings->setFields( $args );
	}
}
