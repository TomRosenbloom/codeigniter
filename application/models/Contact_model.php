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
        $this->db->where('deleted_at IS NULL'); // this will probably fail when something is undeleted
        $query = $this->db->get($this->table_name);
        return $query->num_rows();
    }

    /**
     * get a single contact
     *
     * @param  integer $id row id (this being php astring will also work)
     * @return array     results array (or false)
     */
    public function get_contact($id)
    {
        $query = $this->db->get_where($this->table_name, array('id' => $id));
        return $query->row_array();
    }

    /**
     * get multiple contacts
     *
     * @param  integer $limit number of rows
     * @param  integer $start start row
     * @return object        CI results object
     */
    public function fetch_contacts($limit, $start)
    {
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

        // DRY!!!!
        if($this->input->post('status') == 'active') {
            $status = 1;
        } else {
            $status = 0;
        }

        $data = array(
            'slug' => '', // don't bother with this for now. To create a unique slug need to use last inserted id
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
        // DRY!!!!
        if($this->input->post('status') == 'active') {
            $status = 1;
        } else {
            $status = 0;
        }

        $data = array(
            'slug' => '',
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
        $this->db->update($this->table_name, $data);

        if($this->db->where('id', $this->input->post('id'))):
            return $this->input->post('id');
        else:
            return false;
        endif;
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
