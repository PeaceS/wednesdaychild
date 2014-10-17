<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Buy extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if ($this->get_session->get_itemCountInBag() == 0){ exit('No product'); }
    }
    public function checkInsideBag($step)
    {
        $included['buy'] = $step;
        $data['bag'] = $this->getListItemInBag();
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        if ($included['buy'] == 3){
            if ($this->get_session->check_shippingAddress() == false) { exit('Access deny'); }
            $data['shippingAddress'] = $this->get_session->list_shhippingAddress();
            $data['shippingCost'] = $this->calculateShippingCost($data['bag']);
            $data['totalPrice'] = $this->calculateTotalPrice($data['bag']) + $data['shippingCost'];
        }
        
        $this->loadView($included, $data);
    }
    public function fillInAddress()
    {
        $this->load->model('get_shipping');
        
        $included['buy'] = 2;
        $data['listCountry'] = $this->get_shipping->get_country();
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        $data['shippingAddress'] = $this->get_session->list_shhippingAddress();
        
        $this->loadView($included, $data);
    }
    public function paymentMethod()
    {
        if ($this->get_session->check_shippingAddress() == false){
            $this->fillInAddress();
        }else{
            $included['buy'] = 4;
            $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();

            $this->loadView($included, $data);
        }
    }
    public function bankwireMethod()
    {
        $this->load->model('get_config');
        $included['buy'] = 5;
        
        $bag = $this->getListItemInBag();
        
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        $data['totalAmount'] = number_format($this->calculateShippingCost($bag) + $this->calculateTotalPrice($bag));
        $data['bankDetail'] = $this->get_config->get_bankwireDetail();

        $this->loadView($included, $data);
    }
    
    private function getListItemInBag()
    {
        $this->load->model('get_product');
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
            if ($item['product'] == $item_detail['product_no']) {
                $item['image'] = base_url() . 'assets/image/product/' . substr($item['product'], 0, 3) . '/' . $item_detail['image_url'];
                $item['name'] = $item_detail['product_name'];
                $item['stock'] = $item_detail['product_stock'];
                $item['price'] = $item_detail['product_price'];
                $item['weight'] = $item_detail['product_weight'];
                return $this->addSelectSizeAndColor($item);
            }
        }
    }
    private function addSelectSizeAndColor($item)
    {
        $this->load->model('get_productDetail');
        $item['color'] = $this->get_productDetail->get_color($item['product']);
        $item['size'] = $this->get_productDetail->get_size($item['product']);
        return $item;
    }
    private function calculateShippingCost($items)
    {
        $this->load->model('get_shipping');
        $address = $this->get_session->list_shhippingAddress();
        
        $weight = 0;
        foreach ($items as $item) { $weight += floatval($item['weight']) * intval($item['qty']); }
        
        return $weight * doubleval($this->get_shipping->get_rate($address['country']));
    }
    private function calculateTotalPrice($items)
    {
        $result = 0;
        foreach ($items as $item) { $result += floatval($item['price']) * intval($item['qty']); }
        
        return $result;
    }
    private function loadView($included, $data)
    {
        $this->load->view('header', $included);
        $this->load->view('main', $data);
        $this->load->view('buy_' . $included['buy']);
        $this->load->view('buy_menu');
        $this->load->view('list_menu');
    }
}