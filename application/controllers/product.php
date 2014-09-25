<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Product extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
	$this->load->model('get_collection');
        $this->load->model('get_product');
        $this->load->helper('url');
    }
    public function view($product)
    {
        $included['product'] = true;
        $data = $this->load_data($product);
        if ($data['product'] == null){ exit('product not found'); }
        
        $this->load->view('header', $included);
        $this->load->view('main');
        $this->load->view('product', $data);
        $this->load->view('list_collection', $data);
        $this->load->view('list_menu');
    }
    
    private function load_data($product)
    {
        $data['collection'] = substr($product, 0, 3);
        $data['listCollection'] = $this->get_collection->list_collection();
        $data['product'] = $this->transform_data($product);
        $data['product_no'] = $product;
        $data['product_image'] = $this->get_product->get_image($product);
        $data['product_color'] = $this->get_product->get_color($product);
        $data['product_size'] = $this->get_product->get_size($product);
        $data['product_related'] = $this->get_product->list_related($product);
        
        return $data;
    }
    private function transform_data($product)
    {
        $data = $this->get_product->get_product($product);
        if (count($data) == 0){ return null; }
        $data['product_detail'] = $this->apply_bulletPoint($data['product_detail']);
        $data['product_fabric'] = $this->apply_bulletPoint($data['product_fabric']);
        $data['product_fit'] = $this->apply_bulletPoint($data['product_fit']);
        $data['product_price'] = number_format($data['product_price'], 2, '.', ',');
        
        return $data;
    }
    private function apply_bulletPoint($data)
    {
        if (strpos($data, ',-')){
            $output = '<ul>';
            foreach (explode(',', $data) as $row ){
                $output .= '<li>' . $row . '</li>';
            }
            $output .= '</ul>';
            return $output;
        }
        
        return $data;
    }
}