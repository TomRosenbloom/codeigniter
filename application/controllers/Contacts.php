<?php

class Contacts extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('contact_model');
        $this->load->model('honorific_model');
        $this->load->model('city_model');
        $this->load->helper('url_helper');
        $this->load->library('pagination');
        $this->load->library('form_validation');
		$this->load->library('ion_auth');
    }


    /**
     * verifies string is valid full UK postcode OR just the area code e.g. EX4
     *
     * note, this only verifies the format, and not that the post code exists
     * note 2, this needs moving somewhere else in due course, but I think to do that I would
     * need to change the way I am calling it: https://www.codeigniter.com/userguide3/libraries/form_validation.html
     *
     * @param  string $str
     * @return bool
     */
    public function validate_postcode($str)
    {
        if (1 !== preg_match("/^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?([0-9][ABD-HJLNP-UW-Z]{2})?)$/", $str))
        {
            $this->form_validation->set_message('validate_postcode', 'The %s field must contain a valid UK postcode or area code');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }


	public function login()
    {
        $this->data['title'] = "Login";

		$this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() === FALSE)
        {
			$this->load->helper('form');
            $this->render('contacts/login_view');
        }
        else
        {
            $remember = (bool) $this->input->post('remember');
            if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember))
            {
                redirect('contacts/index');
            }
            else
            {
                $_SESSION['auth_message'] = $this->ion_auth->errors();
                $this->session->mark_as_flash('auth_message');
                redirect('contacts/login');
            }
        }
    }

	public function logout()
	{
		$this->ion_auth->logout();
		redirect('dashboard/index');
	}


    public function index()
    {

        $data['title'] = "Contacts - home";
        $data['heading'] = "Contacts";

        $per_page = 4;

        $pagination_config = array();
        $pagination_config['base_url'] = base_url();
        $pagination_config['total_rows'] = $this->contact_model->record_count();
        $pagination_config['per_page'] = $per_page;
        //$pagination_config['uri_segment'] = 1; // how is this supposed to be used?
        $uri_segment_page_no = 1; // the part of the uri that contains the pagination page number

        // here is a load of presentation config, which can only be done here in the controller
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
        //if($start_index == 8) { $start_index = 7; }

        $data['contacts'] = $this->contact_model->fetch_contacts($per_page, $start_index);

        $this->pagination->initialize($pagination_config);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('templates/header', $data);
        $this->load->view('contacts/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function show($slug = NULL)
    {
        $this->load->helper('form'); // for the delete form/button

        $data['contact'] = $this->contact_model->get_contact($slug);

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
            $this->contact_model->store_contact();
            redirect('contacts');
        }
    }

    public function edit($id)
    {

        $this->load->helper('form');

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

    public function deactivate($id) {
        $this->contact_model->deactivate_contact($id);
        redirect('contacts');
    }

    public function reactivate($id) {
        $this->contact_model->reactivate_contact($id);
        redirect('contacts');
    }
}
