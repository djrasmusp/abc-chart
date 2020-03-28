<?php


namespace ACP\Base;

if ( ! class_exists( 'BaseController' ) ) {
	class BaseController {
		public $plugin_path;
		public $plugin_url;
		public $plugin;

		public $plugin_settings = array();

		public function __construct() {
			$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
			$this->plugin_url  = plugin_dir_url( dirname( __FILE__, 2 ) );
			$this->plugin      = plugin_basename( dirname( __FILE__, 3 ) )
			                     . '/abc-chart-parser.php';

			$this->plugin_settings = array(
				'sections' => array(
					array(
						'id'    => 'acp_cameleonpdf_setting',
						'title' => 'CameleonPDF API Settings',
					),
					array(
						'id'    => 'acp_spotify_setting',
						'title' => 'Spotify API Settings'
					)
				),
				'fields'   => array(
					array(
						'id'          => 'acp_api_key',
						'title'       => 'API Key',
						'section'     => 'acp_cameleonpdf_setting',
						'helper_text' => 'Get API Key for <a href="https://rapidapi.com/feelmare/api/cameleonpdf" target="_blank">CameleonPDF</a>.'
					),
					array(
						'id'          => 'acp_client_id',
						'title'       => 'Client Id',
						'section'     => 'acp_spotify_setting',
						'helper_text' => ''
					),
					array(
						'id'          => 'acp_client_secret',
						'title'       => 'Client Secret',
						'section'     => 'acp_spotify_setting',
						'helper_text' => 'Get Client ID and Secret for <a href="https://developer.spotify.com" target="_blank">Spotify</a>.'
					),
				)
			);
		}
	}
}

