<?php

class Contacts extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('contact_model');
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
        $data['contact'] = $this->contact_model->get_contacts($slug);

        if (empty($data['contact']))
        {
            show_404();
        }

        $data['title'] = $data['title'] = 'Contact - show';
        $data['heading'] = $data['contact']['first_name'];

        $this->load->view('templates/header', $data);
        $this->load->view('contacts/show', $data);
        $this->load->view('templates/footer');
    }

}
