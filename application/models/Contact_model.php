<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model
{

    private $_table_name;
    private $_soft_delete = FALSE; // NB need to look at using a generic (third party) MY_Model for this kind of thing
    private $_order_by;
    private $_order_direction;

    public function __construct()
    {
        parent::__construct(); // code smell: https://martinfowler.com/bliki/CallSuper.html
        $this->load->database();
        $this->_table_name = 'contacts';
        $this->_soft_delete = TRUE; // currently always true - I'm setting a default on the property *and* in the constructor
                                    // which is non-sensical, but thinking ahead to when this might be an option on a generic controller
        $this->_order_by = 'last_name'; // same deal here, however this can be user-specified
        $this->_order_direction = 'ASC';
    }

    public function record_count()
    {
        $this->db->where('deleted_at IS NULL'); // this will probably fail when something is undeleted
        $query = $this->db->get($this->_table_name);
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
        $query = $this->db->get_where($this->_table_name, array('id' => $id));
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
        $this->db->select($this->_table_name . '.*, citys.name as city_name, honorifics.name as honorific');
        $this->db->limit($limit, $start);
        $this->db->join('citys', 'citys.id = contacts.city_id', 'left');
        $this->db->join('honorifics', 'honorifics.id = contacts.honorific_id', 'left');
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by($this->_order_by, $this->_order_direction);
        $query = $this->db->get($this->_table_name);

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

        return $this->db->insert($this->_table_name, $data);
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
        $this->db->update($this->_table_name, $data);

        if($this->db->where('id', $this->input->post('id'))):
            return $this->input->post('id');
        else:
            return false;
        endif;
    }

    public function delete_contact($id)
    {
        if($this->_soft_delete) {
            $this->db->where('id',$id);
            $this->db->update($this->_table_name, array('deleted_at' => date('Y-m-d H:i:s')));
            return true;
        } else {
            $this->db->where('id',$id);
            $this->db->delete($this->_table_name);
            return true;
        }
    }

    public function deactivate_contact($id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->_table_name, array('status' => 0));
        return true;
    }

    public function reactivate_contact($id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->_table_name, array('status' => 1));
        return true;
    }
}
