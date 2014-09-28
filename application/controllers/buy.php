<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Buy extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('get_product');
        $this->stock = $this->get_product->get_stock($this->input->post('product'));
    }
    public function putInBag()
    {
        //$this->session->unset_userdata('wednesdaychild_cart');
        //exit("Clear");
        if (!$this->input->post('product') || !$this->input->post('qty') ||
            !is_numeric($this->input->post('qty')) || $this->input->post('qty') <= 0 ||
            $this->stock < $this->input->post('qty')){
            exit(false);
        }
        $this->putInSession($this->input->post('product'), $this->input->post('qty'));
        $itemCount = count(explode(",", $this->session->userdata('wednesdaychild_cart')));
        exit(strval($itemCount));
    }
    public function checkInsideBag()
    {
        if (!$this->session->userdata('wednesdaychild_cart')){ exit('No product'); }
        
        $included['buy'] = 1;
        $data['bag'] = $this->getListItemInBag();
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        
        $this->load->view('header', $included);
        $this->load->view('main', $data);
        $this->load->view('buy_1');
        $this->load->view('buy_menu');
        $this->load->view('list_menu');
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
    private function getListItemInBag()
    {
        $items = $this->get_session->list_itemWithQtyInBag();
        $details = $this->get_product->get_listProduct($this->get_session->list_itemInBag());
        $itemInBag = array();
        
        foreach ($items as $item) {
            array_push($itemInBag, $this->getItemDetail($item, $details));
        }
        return $itemInBag;
    }
    private function getItemDetail($item, $details)
    {
        foreach ($details as $item_detail) {
            if ($item['product'] == $item_detail['product_no']){
                $item['image'] = base_url() . 'assets/image/product/' . substr($item['product'], 0, 3) . '/' . $item_detail['image_url'];
                $item['name'] = $item_detail['product_name'];
                $item['stock'] = $item_detail['product_stock'];
                $item['price'] = $item_detail['product_price'];
                return $this->addSelectSizeAndColor($item);
            }
        }
    }
    private function addSelectSizeAndColor($item)
    {
        $item['color'] = $this->get_product->get_color($item['product']);
        $item['size'] = $this->get_product->get_size($item['product']);
        return $item;
    }
}