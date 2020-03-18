<?php

public function parse_html( $file ) {
	$chart        = [];
	$search_array = array(
		'ARTIST',
		'Versions:'
	);

	$dom          = HtmlDomParser::file_get_html( $file );
	$get_elements = $dom->findMulti( 'p' );

	$tmp_chart = [];

	foreach ( $get_elements as $element ) {
		$tmp_chart[] = $element;
	}

	$array_keys = array_keys( $tmp_chart );

	foreach ( array_keys( $array_keys ) AS $key ) {
		$current_value = $tmp_chart[ $array_keys[ $key ] ];
		if ( array_key_exists( $key + 1, $tmp_chart ) ) {
			$next_value = $tmp_chart[ $array_keys[ $key + 1 ] ];
		}

		if ( strpos( $current_value, 'left:120pt' ) ) {
			if ( ! strpos_array( $current_value, $search_array ) ) {
				if ( strpos( $next_value, 'left:295pt' ) ) {
					$chart[] = $current_value->plaintext . ' - '
					           . $next_value->plaintext;
				} else {
					$chart[] = $current_value->plaintext;
				}
			}
		}
	}

	return $chart;
}

function strpos_array( $haystack, $needles = array(), $offset = 0 ) {
	$chr = array();
	foreach ( $needles as $needle ) {
		$res = strpos( $haystack, $needle, $offset );
		if ( $res !== false ) {
			$chr[ $needle ] = $res;
		}
	}
	if ( empty( $chr ) ) {
		return false;
	}

	return min( $chr );
}
