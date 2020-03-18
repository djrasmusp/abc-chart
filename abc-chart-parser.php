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
require plugin_dir_path(__FILE__) . '/requires/abc-settings.php';

// pdf2html( $_POST );
