<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Contact extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
	$this->load->model('get_config');
    }
    public function index()
    {   
        $included['contact'] = true;
        $data['contact'] = $this->get_config->get_contact();
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        
        $this->load->view('header', $included);
        $this->load->view('main', $data);
        $this->load->view('contact');
        $this->load->view('list_menu');
    }
}