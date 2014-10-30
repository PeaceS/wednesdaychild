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
        $this->load($this->get_collection->get_latestCollection(), $this->get_collection->list_collection());
    }
    public function view($collection)
    {
        $this->load($collection, $this->get_collection->list_collection());
    }
    
    private function load($collection, $listCollection)
    {
        $included['shop'] = true;
        $data['self'] = 'shop';
        $data['collection'] = $collection;
        $data['listCollection'] = $listCollection;
        $data['listProduct'] = $this->get_product->list_product($collection);
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        
        $this->load->view('header', $included);
        $this->load->view('main', $data);
        $this->load->view('shop');
        $this->load->view('list_collection');
        $this->load->view('list_menu');
    }
}