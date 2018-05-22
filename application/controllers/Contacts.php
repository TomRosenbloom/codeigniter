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

    /**
     * verifies string is valid UK postcode
     *
     * note, should allow partial postcode e.g. EX4?
     * note 2, this needs moving somewhere else in due course
     *
     * @param  string $str
     * @return bool
     */
    public function validate_postcode($str)
    {
        if (1 !== preg_match("/^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$/", $str))
        {
            $this->form_validation->set_message('validate_postcode', 'The %s field must contain a valid UK postcode');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
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

        $this->form_validation->set_rules('first_name', 'First name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
        $this->form_validation->set_rules('postcode', 'Postcode', 'required|callback_validate_postcode');
        $this->form_validation->set_rules('email', 'Email address', 'required|valid_email');

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
    }

    public function update(){
        $this->contact_model->update_contact();
        redirect('contacts');
    }

    public function delete($id) {
        $this->contact_model->delete_contact($id);
        redirect('contacts');
    }
}
