<?php

function pdf2html( $data ) {
	$url  = 'https://cameleonpdf.p.rapidapi.com/pdf2html/.';
	$host = 'cameleonpdf.p.rapidapi.com';
	$key  = get_option('abc_parser_settings');

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
