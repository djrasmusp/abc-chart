<?php


namespace ACP\API\Callbacks;

use ACP\Base\BaseController;

class PostMetaBoxCallbacks extends BaseController {
	public function acpPostMetaBox() {
		return require_once( $this->plugin_path
		                     . 'templates/postmetabox.php' );
	}
}
