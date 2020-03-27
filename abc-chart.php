<?php

/**
 * @package AbcChartParser
 */

/**
 * Plugin Name: ABC Charts
 * Version: 1.0.0
 * Plugin URI: http://rasmusp.com
 * Description: Turning chart-pdf-files to html.
 * Author: Rasmus P
 * Author URI: http://www.rasmusp.com
 * Requires at least: 5.0
 * Tested up to: 5.0
 * License: GPLv2 or later
 * Text Domain: abc-chart-parser
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

defined( 'ABSPATH' ) or exit();

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once 'vendor/autoload.php';
}

use ACP\Base\Activate;
use ACP\Base\Deactivate;

function activate_acp_plugin() {
	Activate::activate();
}

function deactivate_acp_plugin() {
	Deactivate::deactivate();
}

register_activation_hook( __FILE__, 'activate_acp_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_acp_plugin' );

if ( class_exists( 'ACP\\Init' ) ) {
	ACP\Init::register_services();
}




