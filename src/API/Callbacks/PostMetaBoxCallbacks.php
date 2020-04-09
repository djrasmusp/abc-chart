<?php


namespace ACP\API\Callbacks;

use \ACP\Base\BaseController;
use \ACP\Controllers\ControllerXls;
use \ACP\Controllers\ControllerSpotify;
use DateTime;

class PostMetaBoxCallbacks extends BaseController {
	public $xls_controller;
	public $spotify;

	public function acpPostMetaBox() {
		return require_once( $this->plugin_path . 'templates/postmetabox.php' );
	}

	public function wpse10500_action() {
		if ( ! isset( $_POST['make_chart_nonce'] )
		     || ! wp_verify_nonce( $_POST['make_chart_nonce'], 'wpse10500' )
		) {
			return;
		}

		$args = array(
			'ID'         => $_POST['chart_post_id'],
			'post_title' => 'Uge ' . date( 'W' ) . ' - ' . date( 'Y' ),
			'post_type'  => 'chart'
		);

		$this->xls_controller = new ControllerXls();

		$track = array(
			'chart'  => $_POST['chart_type'],
			'tracks' => $this->xls_controller->xlsToChartData( $_FILES['file']['tmp_name'] )
		);


		update_post_meta( $_POST['chart_post_id'], 'chart', $track );

		$term_id = get_term_by( 'slug', $_POST['chart_type'], 'chart_type' );

		wp_set_post_terms( $_POST['chart_post_id'],
		                   array( $term_id->term_id ),
		                   'chart_type' );

		wp_insert_post( $args );

		wp_redirect( 'post.php?post=' . $_POST['chart_post_id']
		             . '&action=edit' );
		exit();
	}

	public function modify_post_title( $data ) {
		if ( $data['post_type'] == 'chart' ) {
			$date               = new DateTime( $data['post_date'] );
			$data['post_title'] = 'Uge ' . $date->format( 'W' ) . ' - '
			                      . $date->format( 'Y' );
			$data['post_name']  = $date->format( 'W' ) . $date->format( 'Y' );
		}

		return $data;
	}

	function save_meta_data_on_update( $post_id, $post, $update ) {
		if ( $post->post_status == 'auto-draft'
		     || $post->post_status == 'draft'
		) {
		} else {
			$this->spotify = new ControllerSpotify();

			$tracks   = array();
			$position = 1;

			foreach ( $_POST['tracks'] as $track ) {
				if ( $track['update'] == '' ) {
					$tracks[] = array(
						'position'        => $position,
						'last_week'       => $track['last_week'],
						'number_of_weeks' => $track['number_of_weeks'],
						'track'           => $track['track'],
						'spotify'         => array(
							'id'  => $track['album_id'],
							'url' => $track['album_url']
						)
					);
				}else{
					$tracks[] = array(
						'position'        => $position,
						'last_week'       => $track['last_week'],
						'number_of_weeks' => $track['number_of_weeks'],
						'track'           => $track['track'],
						'spotify'         => $this->spotify->get_specific_album_art($track['update'])
					);
				}
			}

			$chart = array(
				'chart'  => $_POST['chart_type'],
				'tracks' => $tracks
			);

			update_post_meta( $post_id, 'chart', $chart );
		}
	}
}
