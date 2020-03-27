<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

delete_option( 'abc_parser_settings' );

$charts = get_posts( array( 'post-type' => 'chart', 'numberposts' => - 1 ) );

global $wpdb;
$wp->query( "DELETE FROM wp_posts WHERE post_type = 'chart'" );
$wp->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wp->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );

