<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestingDB extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('TestingDB_model');
        $this->dummy_table = new TestingDB_model(); // Corrected model name
    }

    public function index() {
        $data['data'] = $this->dummy_table->get_dummy(); // Assuming this function exists in the model
        print_r($data);
    }
}
?>
