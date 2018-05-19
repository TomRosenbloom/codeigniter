<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model{

    public function __construct()
    {
      $this->load->database();
    }

    public function get_contacts($slug = FALSE)
    {
            if ($slug === FALSE)
            {
                    $query = $this->db->get('contact');
                    return $query->result_array();
            }

            $query = $this->db->get_where('contact', array('slug' => $slug));
            return $query->row_array();
    }
}
