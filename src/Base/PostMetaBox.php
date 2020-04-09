<?php


namespace ACP\Base;

use ACP\API\Callbacks\PostMetaBoxCallbacks;

if ( ! class_exists( 'PostMetaBox' ) ) {
	class PostMetaBox {
		public $callbacks;

		public function register() {
			$this->callbacks = new PostMetaBoxCallbacks();
			add_action( 'add_meta_boxes', array( $this, 'setPostMetaBox' ) );
			add_action( 'admin_action_wpse10500', array( $this->callbacks, 'wpse10500_action') );
			add_filter('wp_insert_post_data', array($this->callbacks, 'modify_post_title'), 99, 1);
			add_action('post_edit_form_tag', array($this, 'enctype_form'));
			add_action('save_post_chart', array($this->callbacks, 'save_meta_data_on_update'), 999, 3);
		}

		public function setPostMetaBox() {
			add_meta_box( 'chart_id',
			              'Chart',
			              array( $this->callbacks, 'acpPostMetaBox' ),
			              'chart',
			              'normal',
			              'high' );
		}

		public function enctype_form(){
			global $post;

			if(! $post){
				return;
			}

			if($post->post_type != 'chart'){
				return;
			}

			echo ' enctype="multipart/form-data"';
		}

	}
}

