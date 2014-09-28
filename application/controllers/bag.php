<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Bag extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('get_product');
        $this->stock = $this->input->post('product') ? $this->get_product->get_stock($this->input->post('product')) : NULL;
    }
    public function putInBag()
    {
        if (!$this->input->post('product') || !$this->input->post('qty') ||
            !is_numeric($this->input->post('qty')) || $this->input->post('qty') <= 0 ||
            $this->stock < $this->input->post('qty')){
            exit(false);
        }
        $this->putInSession($this->input->post('product'), $this->input->post('qty'));
        $itemCount = count(explode(",", $this->session->userdata('wednesdaychild_cart')));
        exit(strval($itemCount));
    }
    public function updateBag()
    {
        if (!$this->input->post('products')){ exit('false'); }
        
        $this->session->unset_userdata('wednesdaychild_cart');
        foreach ($this->input->post('products') as $item) {
            $this->putInSession($item['product'], $item['qty']);
        }
        
        $itemCount = count(explode(",", $this->session->userdata('wednesdaychild_cart')));
        exit(strval($itemCount));
    }
    
    private function putInSession($product, $qty)
    {
        if ($this->checkProductInSession($product)){
            $cart = $this->updateProductInSession($product, $qty);
        }else{
            $cart = $this->session->userdata('wednesdaychild_cart') ? $this->session->userdata('wednesdaychild_cart') . ',' : '';
            $cart.= $product . ':' . $qty;
        }
        $this->session->set_userdata('wednesdaychild_cart', $cart);
    }
    private function checkProductInSession($product)
    {
        if ($this->session->userdata('wednesdaychild_cart')){
            $items = explode(",", $this->session->userdata('wednesdaychild_cart'));
            foreach ($items as $item) {
                $item_detail = explode(":", $item);
                if ($product == $item_detail[0]){
                    return true;
                }
            }
        }
        return false;
    }
    private function updateProductInSession($product, $qty)
    {
        $cart = '';
        $items = explode(",", $this->session->userdata('wednesdaychild_cart'));
        foreach ($items as $item) {
            $item = $this->checkUpdateProduct($product, $qty, $item);
            $cart = $cart == '' ? $item : $cart . ',' . $item;
        }
        return $cart;
    }
    private function checkUpdateProduct($product, $qty, $item)
    {
        $item_detail = explode(":", $item);
        if ($product == $item_detail[0]){
            $amount = intval($item_detail[1]) + $qty;
            if ($amount > $this->stock){
                exit(false);
            }
            return $product . ":" . $amount;
        }
        return $item;
    }
}