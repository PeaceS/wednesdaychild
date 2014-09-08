<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Collection extends CI_Controller {
    public function index()
    {
        $this->load->helper('url');
        $this->load->view('header');
        $this->load->view('main_top');
        $this->load->view('collection');
        $this->load->view('list_collection');
        $this->load->view('main_bottom');
    }
}

/* Location: ./application/controllers/collection.php */