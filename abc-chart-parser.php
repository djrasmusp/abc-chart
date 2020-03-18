<?php

/**
 * Plugin Name: ABC Chart Parser
 * Version: 1.0.0
 * Plugin URI: http://rasmusp.com
 * Description: Turning chart-pdf-files to html.
 * Author: Rasmus P
 * Author URI: http://www.rasmusp.com
 * Requires at least: 5.0
 * Tested up to: 5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use voku\helper\HtmlDomParser;

require 'vendor/autoload.php';

require plugin_dir_path( __FILE__ ) . '/requires/pdf-to-html.php';
require plugin_dir_path( __FILE__ ) . '/requires/parse-html.php';
require plugin_dir_path( __FILE__ ) . '/requires/abc-settings.php';

register_activation_hook( __FILE__, 'abc_chart_parser_activate' );
function abc_chart_parser_activate() {

	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name      = $wpdb->prefix . 'abc_chart_parser';

	$sql = "CREATE TABLE ". $table_name ." (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		title text,
		type smallint(5) NOT NULL,
		chart longtext,
		UNIQUE KEY id (id)
	) ". $charset_collate .";";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta($sql);
}

// pdf2html( $_POST );
