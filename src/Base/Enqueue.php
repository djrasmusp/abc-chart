<?php


namespace ACP\Base;

class Enqueue extends BaseController {
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	function enqueue() {
		wp_enqueue_style( 'abcchartparserstyle',
		                  $this->plugin_url . 'css/style.css' );
		wp_enqueue_script( 'abcchartparserscript',
		                   $this->plugin_url . 'js/script.js' );
	}
}
