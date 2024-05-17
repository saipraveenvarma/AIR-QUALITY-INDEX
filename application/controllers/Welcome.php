<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{



	public function index()
	{
		$this->load->helper('url');
		$this->load->model('Welcome_model');
		$data['aqf_data'] = $this->Welcome_model->First();


		

		$pm25 = array();
		$pm25_std = array();

		foreach ($data['aqf_data'] as $entry) {

			$year[] = $entry['year'];
			$day[] = $entry['day'];
			$month[] = $entry['mn'];
			$hour[] = $entry['hr'];


			$pm25[] = $entry['PM2.5'];
			$pm25_std[] = $entry['PM2.5_std'];

			$pm10[] = $entry['PM10'];
			$pm10_std[] = $entry['PM10_std'];


			$co[] = $entry['co'];
			$co_std [] = $entry['co_std'];

			$no2[] = $entry['no2'];
			$no2_std[] = $entry['no2_std'];

			$o3[] = $entry['o3'];
			$o3_std[] = $entry['o3_std'];

			$so2[] = $entry['so2'];
			$so3_std[] = $entry['so2_std'];


		}

		$data['year'] = $year;
		$data['day'] = $day;
		$data['mn'] = $month;
		$data['hr'] = $hour;


		$data['pm25'] = $pm25;
		$data['pm25_std'] = $pm25_std;

		$data['pm10'] = $pm10;
		$data['pm10_std'] = $pm10_std;

		$data['co'] = $co;
		$data['co_std'] = $co_std;

		$data['no2'] = $no2;
		$data['no2_std'] = $no2_std;


		$data['o3'] = $o3;
		$data['o3_std'] = $o3_std;

		$data['so2'] = $so2;
		$data['so2_std'] = $so3_std;
		// Log the data to the console
// echo '<pre>';
// var_dump($data['hr']);
// echo '</pre>';
		$this->load->view('welcome_message', $data);

	}

}
