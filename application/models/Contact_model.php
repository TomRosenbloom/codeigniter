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

    public function store_contact()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('last_name') . "_" . $this->input->post('id'), 'dash', TRUE);

        // this slug business is a pain - it has to be guaranteed unique so I can't use the name
        // the only unique value is the id but that doesn't exist at this point
        // I could use a random hash, but that isn't 100% guaranteed to be unique since the same random number could be generated

        $data = array(
            'slug' => $slug,
            'title_id' => $this->input->post('title_id'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'birth_date' => $this->input->post('birth_date'),
            'addr_1' => $this->input->post('addr_1'),
            'addr_2' => $this->input->post('addr_2'),
            'city_id' => $this->input->post('city_id'),
            'postcode' => $this->input->post('postcode'),
            'tel' => $this->input->post('tel'),
            'email' => $this->input->post('email')
        );

        return $this->db->insert('contact', $data);
    }
}
