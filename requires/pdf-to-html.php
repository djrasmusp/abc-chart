<?php

public function pdf2html($data){
	$url = 'https://cameleonpdf.p.rapidapi.com/pdf2html/.';
	$host = 'cameleonpdf.p.rapidapi.com';
	$key = $_ENV('API_KEY');

	$response = wp_remote_post(
		$url,
		array(
			'method'    =>  'POST',
			'headers'   =>  array(
				'x-rapidapi-host'   => $host,
				'x-rapidapi-key'    => $key,
				'content-type'      => 'application/pdf'
			),
			'body'      =>  array(
				'PDF'   => $data
			)
		)
	);

	return $response;
}
