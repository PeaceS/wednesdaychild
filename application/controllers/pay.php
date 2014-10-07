<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Pay extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('get_product');
        $this->load->model('get_config');
        if (!$this->session->userdata('wednesdaychild_cart')){ exit('No product'); }
        if (!$this->session->userdata('wednesdaychild_shippingAddress')){ exit('Access deny'); }
    }
    public function bankwireMethod()
    {
        $included['buy'] = 5;
        
        $bag = $this->getListItemInBag();
        
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        $data['totalAmount'] = $this->calculateShippingCost($bag) + $this->calculateTotalPrice($bag);
        $data['bankDetail'] = $this->get_config->get_bankwireDetail();

        $this->load->view('header', $included);
        $this->load->view('main', $data);
        $this->load->view('buy_' . $included['buy']);
        $this->load->view('buy_menu');
        $this->load->view('list_menu');
    }
    
    private function getListItemInBag()
    {
        $items = $this->get_session->list_itemWithQtyInBag();
        $itemInBag = array();
        
        foreach ($items as $item) {
            $item['price'] = $this->get_product->get_price($item['product']);
            $item['weight'] = $this->get_product->get_weight($item['product']);
            array_push($itemInBag, $item);
        }
        return $itemInBag;
    }
    private function calculateShippingCost($items)
    {
        $weight = 0;
        foreach ($items as $item) {
            $weight += floatval($item['weight']) * intval($item['qty']);
        }
        
        //TODO: get table rate of shipping, for each country
        
        return $weight;
    }
    private function calculateTotalPrice($items)
    {
        $result = 0;
        foreach ($items as $item) {
            $result += floatval($item['price']) * intval($item['qty']);
        }
        
        return $result;
    }
}