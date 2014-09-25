<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Buy extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('get_product');
    }
    public function index()
    {
        if (!$this->input->post('product') ||
            !$this->input->post('qty') ||
            !is_numeric($this->input->post('qty')) ||
            $this->input->post('qty') <= 0 ||
            $this->get_product->get_stock($this->input->post('product')) < $this->input->post('qty')){
            exit(false);
        }
        $this->putInSession($this->input->post('product'), $this->input->post('qty'));
        //exit($this->session->userdata('wednesdaychild_cart'));
    }
    
    private function putInSession($product, $qty){
        try{
            
        $this->load->library('session');
        } catch (Exception $ex) {
            exit($ex);
        }
        exit(true);
        $cart = $this->session->userdata('wednesdaychild_cart') ? $this->session->userdata('wednesdaychild_cart') : '';
        $cart.= ',' . $product . ':' . $qty;
        $this->session->set_userdata('wednesdaychild_cart', $cart);
    }
}