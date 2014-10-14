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
        exit(strval($this->get_session->get_itemCountInBag()));
    }
    public function updateBag()
    {
        if (!$this->input->post('products')){ exit('false'); }
        
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