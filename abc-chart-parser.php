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

use Symfony\Component\Dotenv\Dotenv;
use voku\helper\HtmlDomParser;

require 'vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load( plugin_dir_path( __FILE__ ) . '/.env' );

require plugin_dir_path( __FILE__ ) . '/requires/pdf-to-html.php';
require plugin_dir_path( __FILE__ ) . '/requires/parse-html.php';

function pdf2html( $data ) {
	$url  = 'https://cameleonpdf.p.rapidapi.com/pdf2html/.';
	$host = 'cameleonpdf.p.rapidapi.com';
	$key  = $_ENV['API_KEY' ];

	$response = wp_remote_post(
		$url,
		array(
			'method'  => 'POST',
			'headers' => array(
				'x-rapidapi-host: ' . $host,
				'x-rapidapi-key: ' . $key,
				'content-type: application/pdf'
			),
			'body'    => array(
				'PDF' => $data
			)
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();

		return 'Something went wrong: ' . $error_message;
	}

	return $response;
}

pdf2html( $_POST );
