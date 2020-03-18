<?php

use voku\helper\HtmlDomParser;

public
function parse_html( $file ) {
	$chart = [];

	$dom          = HtmlDomParser::file_get_html( $file );
	$get_elements = $dom->findMulti( 'p' );
}
