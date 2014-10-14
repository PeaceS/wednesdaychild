<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Bag extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if (!$this->input->post('products')){ exit('false'); }
    }
    public function putInBag()
    {
        $this->load->model('get_productDetail');
        if (!$this->input->post('qty') || !is_numeric($this->input->post('qty')) || $this->input->post('qty') <= 0 ||
            $this->get_productDetail->get_stock($this->input->post('product')) < $this->input->post('qty')){
            exit(false);
        }
        $this->putInSession($this->input->post('product'), $this->input->post('qty'));
        exit(strval($this->get_session->get_itemCountInBag()));
    }
    public function updateBag()
    {
        $this->get_session->free_itemInCart();
        foreach ($this->input->post('products') as $item) {
            $this->putInSession($item['product'], $item['qty']);
        }
        
        exit(strval($this->get_session->get_itemCountInBag()));
    }
    
    private function putInSession($product, $qty)
    {
        $cart = '';
        if ($this->get_session->get_itemCountInBag() > 0){
            $cart = $this->get_session->get_cartAsText() . ';;';
        }
        $cart .= $product . ':' . $qty;
        
        $this->get_session->save_intoCart($cart);
    }
}