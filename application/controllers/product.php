<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Product extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
	$this->load->model('get_config');
	$this->load->model('get_collection');
        $this->load->model('get_product');
    }
    public function view($product)
    {
        $included['product'] = true;
        $data['collection'] = $this->get_config->get_collection();
        $data['listCollection'] = $this->get_collection->list_collection();
        $data['product'] = $this->get_product->get_product($product);
        $data['product_image'] = $this->get_product->get_image($product);
        
        $this->load->helper('url');
        $this->load->view('header', $included);
        $this->load->view('main');
        $this->load->view('product', $data);
        $this->load->view('list_collection', $data);
        $this->load->view('list_menu');
    }
}

/* Location: ./application/controllers/shop.php */