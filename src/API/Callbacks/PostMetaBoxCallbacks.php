<?php


namespace ACP\API\Callbacks;

use ACP\Base\BaseController;
use DateTime;

class PostMetaBoxCallbacks extends BaseController {
	public function acpPostMetaBox() {
		return require_once( $this->plugin_path
		                     . 'templates/postmetabox.php' );
	}

	public function wpse10500_action() {
		if ( ! isset( $_POST['make_chart_nonce'] )
		     || ! wp_verify_nonce( $_POST['make_chart_nonce'], 'wpse10500' )
		) {
			return;
		}

		$args = array(
			'ID'         => $_POST['chart_post_id'],
			'post_title' => 'Uge '. date( 'W' ) . ' - ' . date( 'Y' ),
			'post_type'  => 'chart'
		);

		$track = array(
			'chart'  => $_POST['chart_type'],
			'tracks' => array(
				array(
					'position'        => 1,
					'last_week'       => 2,
					'number_of_weeks' => 3,
					'track'           => 'Kongsted - Chuck Norris'
				)
			)
		);

		update_post_meta( $_POST['chart_post_id'], 'chart', $track );

		$term_id = get_term_by('slug', $_POST['chart_type'], 'chart_type');

		wp_set_post_terms($_POST['chart_post_id'], array($term_id->term_id), 'chart_type');

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
}
