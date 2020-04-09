<?php


namespace ACP\Controllers;

use SpotifyWebAPI;

if ( ! class_exists( 'ControllerSpotify' ) ) {
	class ControllerSpotify {
		public $spotify;
		public $session;

		public function __construct() {
			$this->spotify = new SpotifyWebAPI\SpotifyWebAPI();
			$this->session = new SpotifyWebAPI\Session( get_option('chart_settings')['acp_client_id'], get_option('chart_settings')['acp_client_secret'] );

			$this->session->requestCredentialsToken();
			$accessToken = $this->session->getAccessToken();

			$this->spotify->setAccessToken( $accessToken );
		}

		public function remove_illegal_characters( $string ) {
			$illegal_characters = array(
				' - ',
				'feat.',
				' x ',
				'&',
				'vs.',
				'vs'
			);

			return str_replace( $illegal_characters, '', $string );
		}

		public function get_album_art( $string ) {
			$results
				= $this->spotify->search( urldecode( $this->remove_illegal_characters( $string ) ),
				                          'track' );

			if ( $results->tracks->total == 0 ) {
				return array(
					'id' => '',
					'url' => 'https://radioabc.dk/wp-content/plugins/top50/images/nocover.jpg'
				);
			}

			foreach ( $results->tracks->items as $item ) {
				return array(
					'id' => $item->album->id,
					'url' => $item->album->images[1]->url
				);
			}
		}

		public function get_specific_album_art( $string ){
			$results = $this->spotify->getAlbum($string);

			if(!isset($results->error)){
				return array(
					'id' => $results->id,
					'url' => $results->images[1]->url
				);
			}
		}

	}
}

