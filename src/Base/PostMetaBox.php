<?php


namespace ACP\Base;

use ACP\API\Callbacks\PostMetaBoxCallbacks;

if ( ! class_exists( 'PostMetaBox' ) ) {
	class PostMetaBox {
		public $callbacks;

		public function register() {
			$this->callbacks = new PostMetaBoxCallbacks();
			add_action( 'add_meta_boxes', array( $this, 'setPostMetaBox' ) );
		}

		public function setPostMetaBox() {

			add_meta_box( 'chart_id',
			              'Chart',
			              array( $this->callbacks, 'acpPostMetaBox' ),
			              'chart',
			              'normal',
			              'high' );
		}
	}
}

