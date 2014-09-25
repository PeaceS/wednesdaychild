<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Policy extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
	$this->load->model('get_text');
        $this->load->helper('url');
    }
    public function index()
    {   
        $included['policy'] = true;
        $data['policy'] = $this->get_text->get_text('policy');
        
        $this->load->view('header', $included);
        $this->load->view('main');
        $this->load->view('policy', $data);
        $this->load->view('list_menu');
    }
}