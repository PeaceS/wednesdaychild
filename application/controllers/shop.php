<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Shop extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
	$this->load->model('get_collection');
        $this->load->model('get_product');
    }
    public function index()
    {
	$this->load->model('get_config');
        $this->load($this->get_config->get_collection(), $this->get_collection->list_collection());
    }
    public function view($collection)
    {
        $this->load($collection, $this->get_collection->list_collection());
    }
    
    private function load($collection, $listCollection)
    {
        $included['shop'] = true;
        $data['collection'] = $collection;
        $data['listCollection'] = $listCollection;
        $data['listProduct'] = $this->get_product->list_product($collection);
        
        $this->load->helper('url');
        $this->load->view('header', $included);
        $this->load->view('main');
        $this->load->view('shop', $data);
        $this->load->view('list_collection', $data);
        $this->load->view('list_menu');
    }
}

/* Location: ./application/controllers/shop.php */