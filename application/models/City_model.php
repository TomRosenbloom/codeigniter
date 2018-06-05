<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City_model extends CI_Model
{

    public function __construct()
    {
        //parent::__construct(); // why?
        $this->load->database();
    }

    public function get_cities() {
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('citys');
        return $query->result_array();
    }
}
