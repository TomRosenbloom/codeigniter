<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct(); // code smell: https://martinfowler.com/bliki/CallSuper.html
        $this->load->database();
    }

    public function record_count()
    {
        return $this->db->count_all('contacts');
    }

    /*
    get single contact - still using 'slug' but will eradicate this shortly
     */
    public function get_contact($slug = FALSE)
    {
        $query = $this->db->get_where('contacts', array('slug' => $slug));
        return $query->row_array();
    }

    public function fetch_contacts($limit, $start)
    {
        $this->db->select('contacts.*, citys.name as city_name, honorifics.name as honorific');
        $this->db->limit($limit, $start);
        $this->db->join('citys', 'citys.id = contacts.city_id');
        $this->db->join('honorifics', 'honorifics.id = contacts.honorific_id');
        $query = $this->db->get('contacts');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function store_contact()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('last_name') . "_" . $this->input->post('id'), 'dash', TRUE);

        // this slug business is a pain - it has to be guaranteed unique so I can't use the name
        // the only unique value is the id but that doesn't exist at this point
        // I could use a random hash, but that isn't 100% guaranteed to be unique since the same random number could be generated

        // DRY!!!!
        if($this->input->post('status') == 'active') {
            $status = 1;
        } else {
            $status = 0;
        }

        $data = array(
            'slug' => $slug,
            'honorific_id' => $this->input->post('honorific_id'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'birth_date' => $this->input->post('birth_date'),
            'addr_1' => $this->input->post('addr_1'),
            'addr_2' => $this->input->post('addr_2'),
            'city_id' => $this->input->post('city_id'),
            'postcode' => $this->input->post('postcode'),
            'tel' => $this->input->post('tel'),
            'email' => $this->input->post('email'),
            'status' => $status
        );

        return $this->db->insert('contacts', $data);
    }

    public function update_contact()
    {
        $slug = url_title($this->input->post('last_name') . "_" . $this->input->post('id'), 'dash', TRUE);

        // DRY!!!!
        if($this->input->post('status') == 'active') {
            $status = 1;
        } else {
            $status = 0;
        }

        $data = array(
            'slug' => $slug,
            'honorific_id' => $this->input->post('honorific_id'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'birth_date' => $this->input->post('birth_date'),
            'addr_1' => $this->input->post('addr_1'),
            'addr_2' => $this->input->post('addr_2'),
            'city_id' => $this->input->post('city_id'),
            'postcode' => $this->input->post('postcode'),
            'tel' => $this->input->post('tel'),
            'email' => $this->input->post('email'),
            'status' => $status
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('contacts', $data);
    }

    public function delete_contact($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('contacts');
        return true;
    }

    public function deactivate_contact($id)
    {
        $this->db->where('id',$id);
        $this->db->update('contacts', array('status' => 0));
        return true;
    }

    public function reactivate_contact($id)
    {
        $this->db->where('id',$id);
        $this->db->update('contacts', array('status' => 1));
        return true;
    }
}
