<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Product extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
	$this->load->model('get_collection');
        $this->load->model('get_product');
        $this->load->model('get_productDetail');
    }
    public function view($product)
    {
        $included['product'] = true;
        $data = $this->load_data($product);
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        if ($data['product'] == null){ exit('product not found'); }
        if (intval($data['product']['product_stock']) == 0){ $data = $this->get_others($data); }
        
        $this->load->view('header', $included);
        $this->load->view('main', $data);
        $this->load->view('product');
        $this->load->view('list_collection');
        $this->load->view('list_menu');
    }
    
    private function load_data($product)
    {
        $data['self']                   = 'shop';
        $data['collection']             = substr($product, 0, 3);
        $data['listCollection']         = $this->get_collection->list_collection();
        $data['product']                = $this->transform_data($product);
        $data['product_no']             = $product;
        $data['product_image']          = $this->get_productDetail->get_image($product);
        $data['product_color']          = $this->get_productDetail->get_color($product);
        $data['product_size']           = $this->get_productDetail->get_size($product);
        $data['product_related']        = $this->get_product->list_related($product);
        
        return $data;
    }
    private function transform_data($product)
    {
        $data                           = $this->get_productDetail->get_product($product);
        if (count($data) == 0){ return null; }
        $data['product_detail']         = $this->apply_bulletPoint($data['product_detail']);
        $data['product_fabric']         = $this->apply_bulletPoint($data['product_fabric']);
        $data['product_fit']            = $this->apply_bulletPoint($data['product_fit']);
        $data['product_measurement']    = $this->apply_table($data['product_measurement']);
        $data['product_price']          = number_format($data['product_price'], 2, '.', ',');
        
        return $data;
    }
    private function apply_bulletPoint($data)
    {
        if (substr($data, 0, 2) == '- '){
            $output = '<ul>';
            foreach (explode("- ", $data) as $row){
                if (trim($row) != ''){ $output .= '<li>- ' . trim($row) . '</li>'; }
            }
            $output .= '</ul>';
            return $output;
        }
        
        return $data;
    }
    private function apply_table($data)
    {
        $output = '<table>';
        foreach (explode(",", $data) as $row) {
            $output .= '<tr>';
            foreach (explode("-", $row) as $col) {
                $output .= '<td>' . trim($col) . '</td>';
            }
            $output .= '</tr>';
        }
        $output .= '</table>';
        return $output;
    }
    private function get_others($data)
    {
        if ($this->check_releaseTransaction($data['product_no'])){
            return $data;
        }else if (count($data['product_size']) > 0){
            redirect('/product/' . $data['product_size'][0]['product_no']);
        }else if (count($data['product_color']) > 0){
            redirect('/product/' . $data['product_color'][0]['product_no']);
        }
        
        $data['outOfStock'] = true;
        return $data;
    }
    private function check_releaseTransaction($product)
    {
        $this->load->model('get_transaction');
        
        $data = $this->get_transaction->out_of_payDate($product);
        if (count($data) == 0){ return false; }
        
        $this->free_transaction($data);
    }
    private function free_transaction($data)
    {
        $this->load->model('set_transaction');
        
        foreach ($data as $item) {
            $this->set_transaction->free($item['transaction_reference']);
            $products = explode(";;", $item['transaction_products']);
            foreach ($products as $product) { $this->get_product->free($product); }
        }
        
        
    }
}