<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('contact_model','honorific_model','city_model', 'postcode_model'));
        $this->load->helper(array('url_helper','form'));
        $this->load->library(array('pagination','form_validation','ion_auth','user_agent','session'));

        // apply authentication universally
        if($this->ion_auth->logged_in() === FALSE)
        {
            redirect('login');
        }
    }


    public function validate_postcode($str)
    {
        if (!($this->postcode_model->valid_postcode($str) || $this->postcode_model->valid_area_code($str)))
        {
            $this->form_validation->set_message('validate_postcode', 'The %s field must contain a valid UK postcode or area code');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }


    public function index()
    {
        $this->session->return_uri = uri_string();

        $data['title'] = "Contacts - home";
        $data['heading'] = "Contacts";

        $per_page = 4;

        $pagination_config = array();
        $pagination_config['base_url'] = base_url();
        $pagination_config['total_rows'] = $this->contact_model->record_count();
        $pagination_config['per_page'] = $per_page;
        //$pagination_config['uri_segment'] = 1; // how is this supposed to be used?
        $uri_segment_page_no = 1; // the part of the uri that contains the pagination page number

        // here is a load of presentation config, which can only be done here in the controller, afaik
        $pagination_config['full_tag_open'] = '<nav><ul class="pagination">';
        $pagination_config['full_tag_close'] = '</nav></ul>';
        $pagination_config['num_tag_open'] = '<li>';
        $pagination_config['num_tag_close'] = '</li>';
        $pagination_config['first_tag_open'] = '<li>';
        $pagination_config['first_tag_close'] = '</li>';
        $pagination_config['last_tag_open'] = '<li>';
        $pagination_config['last_tag_close'] = '</li>';
        $pagination_config['next_tag_open'] = '<li class="pagination-next">';
        $pagination_config['next_tag_close'] = '</li>';
        $pagination_config['prev_tag_open'] = '<li class="pagination-previous">';
        $pagination_config['prev_tag_close'] = '</li>';
        $pagination_config['cur_tag_open'] = '<li class="current">';
        $pagination_config['cur_tag_close'] = '</li>';

        $start_index = ($this->uri->segment($uri_segment_page_no)) ? $this->uri->segment($uri_segment_page_no) : 0;

        $data['contacts'] = $this->contact_model->fetch_contacts($per_page, $start_index);

        $this->pagination->initialize($pagination_config);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('templates/header', $data);
        $this->load->view('contacts/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function show($id)
    {
        $this->session->return_uri = uri_string();

        $data['contact'] = $this->contact_model->get_contact($id);

        if (empty($data['contact']))
        {
            show_404();
        }

        $data['title'] = $data['title'] = 'Contact - show';
        $data['heading'] = 'Contact details';

        $this->load->view('templates/header', $data);
        $this->load->view('contacts/show', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Contact - create';
        $data['heading'] = 'Add new contact';
        $data['honorifics'] = $this->honorific_model->get_honorifics();
        $data['cities'] = $this->city_model->get_cities();

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('contacts/create');
            $this->load->view('templates/footer');

        }
        else
        {
            if($this->contact_model->store_contact()){
                $id = $this->db->insert_id();
                $contact = $this->contact_model->get_contact($id);
                $message = 'Added new contact ' . $contact['first_name'] . " " . $contact['last_name'];
            } else {
                $message = 'There was a problem adding this contact';
            }

            $this->session->set_flashdata('message',$message);

            // work out what page the new contact will be on, based on ordering
            //
            redirect('contacts');
        }
    }

    public function edit($id)
    {
        $data['contact'] = $this->contact_model->get_contact($id);

        if (empty($data['contact']))
        {
            show_404();
        }

        $data['title'] = $data['title'] = 'Contact - edit';
        $data['heading'] = 'Edit contact details';
        $data['honorifics'] = $this->honorific_model->get_honorifics();
        $data['cities'] = $this->city_model->get_cities();

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('contacts/edit', $data);
            $this->load->view('templates/footer');
        } else {
            if($this->contact_model->update_contact($id)) {
                $contact = $this->contact_model->get_contact($id);
                $message = 'Edited contact ' . $contact['first_name'] . " " . $contact['last_name'];
            } else {
                $message = 'There was a problem editing this contact';
            }

            $this->session->set_flashdata('message',$message);

            redirect(base_url() . $this->session->return_uri);
        }
    }


    public function confirm_delete($id)
    {
        if ($this->input->method() === 'post') {
            if($this->input->post('submit') === 'Delete') {
                if($this->contact_model->delete_contact($id)){
                    $contact = $this->contact_model->get_contact($id);
                    $message = 'Deleted contact ' . $contact['first_name'] . " " . $contact['last_name'];
                } else {
                    $message = 'Could not delete contact ' . $contact['first_name'] . " " . $contact['last_name'];
                }
                $this->session->set_flashdata('message',$message);
            }
            redirect('contacts');
        } else {
            $data['contact'] = $this->contact_model->get_contact($id);
            if (empty($data['contact']))
            {
                show_404();
            }

            $data['title'] = $data['title'] = 'Contact - delete';
            $data['heading'] = 'Contact deletion';

            $this->load->view('templates/header', $data);
            $this->load->view('contacts/confirm_delete', $data);
            $this->load->view('templates/footer');
        }

    }


    // have a 'change status' method instead of specific de/re-activate?
    public function confirm_deactivate($id)
    {
        if ($this->input->method() === 'post') {
            if($this->input->post('submit') === 'Deactivate') {
                $this->contact_model->deactivate_contact($id);
            }
            redirect(base_url() . $this->session->return_uri);
        } else {
            $data['contact'] = $this->contact_model->get_contact($id);
            if (empty($data['contact']))
            {
                show_404();
            }

            $data['title'] = $data['title'] = 'Contact - deactivate';
            $data['heading'] = 'Contact deactivation';

            $this->load->view('templates/header', $data);
            $this->load->view('contacts/confirm_deactivate', $data);
            $this->load->view('templates/footer');
        }

    }


    // have a 'change status' method instead of specific de/re-activate?
    public function confirm_reactivate($id)
    {
        if ($this->input->method() === 'post') {
            if($this->input->post('submit') === 'Reactivate') {
                $this->contact_model->reactivate_contact($id);
            }
            redirect(base_url() . $this->session->return_uri);
        } else {
            $data['contact'] = $this->contact_model->get_contact($id);
            if (empty($data['contact']))
            {
                show_404();
            }

            $data['title'] = $data['title'] = 'Contact - reactivate';
            $data['heading'] = 'Contact reactivation';

            $this->load->view('templates/header', $data);
            $this->load->view('contacts/confirm_reactivate', $data);
            $this->load->view('templates/footer');
        }

    }

    // there's an argument for getting rid of these e.g. make 'confirm_delete' the only delete function
    // on the one hand you can argue that confirming a delete and doing it are two different things
    // on the other, having the redirect to contact bound to the deletion is not right and makes things confusing
    // the only reason to have two separate ones really is if you sometimes want to have it without a confirmation
    // (i.e. without a confirmation *page*, you could still use a js dialogue, which is maybe better way anyway)
    // NB don't forget to make this a soft delete
    // NB also re delete, there isn't the same issue because you will always want to return to contacts/index
    // why have deactivate *and* (soft) delete? To allow people to get rid of contacts added in error or duplicates
    public function delete($id) {
        $this->contact_model->delete_contact($id);
        redirect('contacts');
    }

    public function deactivate($id) {
        $this->contact_model->deactivate_contact($id);
        redirect('contacts');
    }

    public function reactivate($id) {
        $this->contact_model->reactivate_contact($id);
        redirect('contacts');
    }
}
