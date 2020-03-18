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


add_action( 'admin_menu', 'abc_chart_parser_menu' );

function abc_chart_parser_menu() {
	//create custom top-level menu
	add_menu_page( 'Quotes Settings',
	               'Quotes Styling',
	               'manage_options',
	               '__FILE__',
	               'abc_chart_parser_settings' );
}

function abc_chart_parser_settings() {
	// load quotes
	$quotes = get_option( 'abc_chart_parser', null );
	$quotes = unserialize( $quotes );

	if ( is_null( $quotes ) ) {
		$quotes = array();
	}

	if ( isset( $_GET['delete'] ) && is_numeric( $_GET['delete'] ) ) {
		unset( $quotes[ $_GET['delete'] ] ); // remove that quote from the array
		$quotes = array_values( $quotes ); // reorder the keys
		update_option( 'abc_chart_parser', serialize( $quotes ) ); // store results
		echo '<p style="font-size:110%;color:green;"><strong>Quote Deleted</strong></p>';
	}

	if ( $_POST && isset( $_POST['random_quote'] )
	     && $_POST['random_quote'] !== ''
	) {
		array_push( $quotes, $_POST['random_quote'] );
		update_option( 'abc_chart_parser', serialize( $quotes ) );
		echo '<p style="font-size:110%;color:green;"><strong>Quote Added</strong></p>';
	}

	?>


	<div class="wrap">
		<h2>Quotes Page</h2>


		<form action="admin.php?page=wse140202.php" method="post">
			Add Quote: <input style="width:600px;" type="textarea"
			                  name="random_quote" value=""/>
			<br/><input type="submit"/>
		</form>
	</div>

	<h3>Current Quotes</h3>
	<ul>
		<?php
		if ( $quotes !== null ) {
			$index = 0;
			foreach ( $quotes as $quote ) {
				echo '<li><strong>[ <a href="admin.php?page=wse140202.php&delete='
				     . $index . '">Delete</a> ]</strong>&nbsp;&nbsp;' . $quote
				     . '</li>';
				$index ++;
			}
		} ?>
	</ul>

	<h3>A Random Quote</h3>

	<? echo dw_get_random_quote();
}


// pdf2html( $_POST );
