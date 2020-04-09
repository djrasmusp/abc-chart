<?php

namespace ACP\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;

if ( ! class_exists( 'ControllerXls' ) ) {
	class ControllerXls extends ControllerSpotify {

		public function xlsToArray( $data ) {
			$spreadsheet = IOFactory::load( $data );
			$data        = $spreadsheet->getActiveSheet()
			                           ->toArray( null, true, true, true );

			$remove_unessary_data = array_slice( $data, 7 );

			return $remove_unessary_data;
		}

		public function xlsToChartData($request){
			$chart_data = array();

			$converted_data = $this->xlsToArray($request);

			foreach ($converted_data as $track ){
				$chart_data[] = array(
					'position'        => $track['B'],
					'last_week'       => $track['C'],
					'number_of_weeks' => $track['D'],
					'track'           => $track['E'] . ' - ' . $track['H'],
					'spotify' => $this->get_album_art($track['E'] .' '. $track['H'])
				);
			}

			return $chart_data;
		}



	}
}
