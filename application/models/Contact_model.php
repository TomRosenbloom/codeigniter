<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model
{

    private $table_name;
    private $soft_delete = FALSE; // NB need to look at using a generic (third party) MY_Model for this kind of thing

    public function __construct()
    {
        parent::__construct(); // code smell: https://martinfowler.com/bliki/CallSuper.html
        $this->load->database();
        $this->table_name = 'contacts';
        $this->soft_delete = TRUE;
    }

    public function record_count()
    {
        return $this->db->count_all($this->table_name);
    }

    public function get_contact($id)
    {
        $query = $this->db->get_where($this->table_name, array('id' => $id));
        return $query->row_array();
    }

    public function fetch_contacts($limit, $start)
    {

        //echo $limit, $start;
        $this->db->select($this->table_name . '.*, citys.name as city_name, honorifics.name as honorific');
        $this->db->limit($limit, $start);
        $this->db->join('citys', 'citys.id = contacts.city_id', 'left');
        $this->db->join('honorifics', 'honorifics.id = contacts.honorific_id', 'left');
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table_name);

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

        return $this->db->insert($this->table_name, $data);
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
        return $this->db->update($this->table_name, $data);
    }

    public function delete_contact($id)
    {
        if($this->soft_delete) {
            $this->db->where('id',$id);
            $this->db->update($this->table_name, array('deleted_at' => date('Y-m-d H:i:s')));
            return true;
        } else {
            $this->db->where('id',$id);
            $this->db->delete($this->table_name);
            return true;
        }
    }

    public function deactivate_contact($id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->table_name, array('status' => 0));
        return true;
    }

    public function reactivate_contact($id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->table_name, array('status' => 1));
        return true;
    }
}
