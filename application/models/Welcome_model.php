<?php
class Welcome_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function First()
    {
        $query = $this->db->get('aqf_table');
    
        if ($query->num_rows() > 0) {

            return $query->result_array();
        } else {

            return false;
        }
    }
    
}
?>