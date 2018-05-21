<?php

class Contacts extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('contact_model');
        $this->load->model('honorific_model');
        $this->load->model('city_model');
        $this->load->helper('url_helper');
    }

    public function index($page = 'index')
    {
        if ( ! file_exists(APPPATH.'views/contacts/'.$page.'.php'))
        {
            show_404();
        }

        $data['title'] = "Contacts - $page";
        $data['heading'] = "Contacts";
        $data['contacts'] = $this->contact_model->get_contacts();

        $this->load->view('templates/header', $data);
        $this->load->view('contacts/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function show($slug = NULL)
    {
        $this->load->helper('form'); // for the delete form/button

        $data['contact'] = $this->contact_model->get_contacts($slug);

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
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Contact - create';
        $data['heading'] = 'Add new contact';
        $data['honorifics'] = $this->honorific_model->get_honorifics();
        $data['cities'] = $this->city_model->get_cities();

        $this->form_validation->set_rules('first_name', 'First name', 'required');
        $this->form_validation->set_rules('last_name', 'Last name', 'required');
        $this->form_validation->set_rules('postcode', 'Postcode', 'required');
        $this->form_validation->set_rules('email', 'Email address', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('contacts/create');
            $this->load->view('templates/footer');

        }
        else
        {
            $this->contact_model->store_contact();
            redirect('contacts');
        }
    }

    public function edit($slug)
    {

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['contact'] = $this->contact_model->get_contacts($slug);

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
        }
        else
        {
            $this->contact_model->update_contact($id);
            redirect('contacts');
        }
    }


    public function delete($id) {
        $this->contact_model->delete_contact($id);
        redirect('contacts');
    }
}
