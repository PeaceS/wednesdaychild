<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Faq extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
	$this->load->model('get_text');
    }
    public function index()
    {   
        $included['faq'] = true;
        $data['faq'] = $this->get_text->get_faq();
        
        $this->load->helper('url');
        $this->load->view('header', $included);
        $this->load->view('main');
        $this->load->view('faq', $data);
        $this->load->view('list_menu');
    }
}