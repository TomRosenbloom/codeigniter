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
        return $this->db->count_all('contact');
    }

    public function get_contacts($slug = FALSE)
    {
        if ($slug === FALSE) // if there is no slug, get all the records
        {
            $this->db->order_by('last_name', 'ASC');
            $query = $this->db->get('contact'); // I'm going to have to change my table names to plurals, this is bugging me
            return $query->result_array();
        }

        // if there is a slug, return just the current record - do I not like this!
        $query = $this->db->get_where('contact', array('slug' => $slug));
        return $query->row_array();
    }

    /*
    this is an alternative to get_contacts which initially at least I'm going to use
    to implement pagination, without breaking get_contacts()
    Longer term, I really don't like the way that the current get_contacts gets either
    all or one contact depending on existence of slug - that is really bad practice
    violates first principle of SOLID
    (where did I get this code from? Not Traversy surely)
     */
    public function fetch_contacts($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get('contact');

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
            'email' => $this->input->post('email')
        );

        return $this->db->insert('contact', $data);
    }

    public function update_contact()
    {
        $slug = url_title($this->input->post('last_name') . "_" . $this->input->post('id'), 'dash', TRUE);

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
            'email' => $this->input->post('email')
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('contact', $data);
    }

    public function delete_contact($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('contact');
        return true;
    }
}
