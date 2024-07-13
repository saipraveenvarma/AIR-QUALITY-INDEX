<?php
class Welcome_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_weather_data() {
        $query = $this->db->get('current_aqi');
        return $query->result();
    }
    
}
?>