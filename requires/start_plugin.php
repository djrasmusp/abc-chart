<?php

class AbcChartParserPlugin {
	function register() {
		add_action( 'init', array( $this, 'abc_chart_parser_custom_post' ) );
	}

	function activate() {
		$this->abc_chart_parser_custom_post();
		flush_rewrite_rules();
	}







}
