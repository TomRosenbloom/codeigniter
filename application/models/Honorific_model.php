<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Honorific_model extends CI_Model
{

    public function __construct()
    {
        //parent::__construct(); // why?
        $this->load->database();
    }

    public function get_honorifics() {
        $query = $this->db->get('honorific');
        return $query->result_array();
    }
}
