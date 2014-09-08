<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Shop extends CI_Controller {
    public function index()
    {
        $this->load->helper('url');
        $this->load->view('header');
        $this->load->view('main_top');
        $this->load->view('shop');
        $this->load->view('list_collection');
        $this->load->view('main_bottom');
    }
}

/* Location: ./application/controllers/shop.php */