<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
	die;
}

delete_option('abc_parser_settings');

global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}abc_charts");
