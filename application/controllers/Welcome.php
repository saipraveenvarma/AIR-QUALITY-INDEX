<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function index() {
        $this->load->model('Welcome_model');
        $data['weather_data'] = $this->Welcome_model->get_all_weather_data();

     
        // var_dump($data['weather_data']);

        $this->load->view('welcome_message', $data);
    }

}
?>
