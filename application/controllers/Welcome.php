<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Welcome_model');
    }

 public function index() {
    $data['weather_data'] = $this->get_last_weather_data();
    $data['sixhours_data'] = $this->get_last_6_hours_data();
    $this->load->view('welcome_message', $data);
}


    private function get_last_weather_data() {
        return $this->Welcome_model->get_last_weather_data();
    }

    private function get_last_6_hours_data() {
        return $this->Welcome_model->get_last_6_hours_data();
    }
}
