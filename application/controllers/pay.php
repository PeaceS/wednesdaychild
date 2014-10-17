<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Pay extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('wednesdaychild_cart') || !$this->session->userdata('wednesdaychild_shippingAddress')){ exit(false); }
        $this->load->model('get_product');
        
        $address = $this->get_session->list_shhippingAddress();
        $this->country = $address['country'];
    }
    public function payment($method)
    {
        $this->method = $method;
        
        if ($this->checkStock($this->get_session->list_itemInBag())){
            $this->updateStock($this->get_session->list_itemWithQtyInBag());
            $this->saveTransaction($this->fareDetail);
            //$this->get_session->free_itemInCart();
            $status = true;
        }
        if ($method == 'paypal' && $status == true){ $this->sendToPaypal(); }
        else{ exit(isset($status)); }
    }
    
    private function checkStock($productInBag)
    {
        $productStock = $this->get_product->get_listStock($productInBag);
        foreach ($productInBag as $product) {
            foreach ($productStock as $productDetail) {
                if ($product['product'] == $productDetail['product_no'] &&
                    intval($product['qty']) > intval($productDetail['product_stock'])){
                    return false;
                }
            }
        }
        return true;
    }
    private function updateStock($productInBag)
    {
        $this->load->model('get_productDetail');
        $this->load->model('set_product');
        $this->fareDetail = array('totalPrice' => 0.0, 'weight' => 0.0);
        $data = array();
        
        foreach ($productInBag as $product) {
            $this->fareDetail['totalPrice'] += doubleval($this->get_productDetail->get_price($product['product']));
            $this->fareDetail['weight'] += doubleval($this->get_productDetail->get_weight($product['product']));
            array_push($data, array('product_no' => $product['product'], 'product_stock' => intval($this->get_productDetail->get_stock($product['product'])) - $product['qty']));
        }
        $this->set_product->update_stock($data);
    }
    private function saveTransaction($fare)
    {
        $this->load->model('set_transaction');
        $this->set_transaction->insert_transaction(array(
            'transaction_reference' => $this->get_invoice(),
            'transaction_products' => $this->session->userdata('wednesdaychild_cart'),
            'transaction_address' => $this->session->userdata('wednesdaychild_shippingAddress'),
            'transaction_fare' => $fare['totalPrice'],
            'transaction_shipping' => $this->calculateShippingCost($fare['weight']),
            'transaction_method' => $this->method
        ));
    }
    private function calculateShippingCost($weight)
    {
        $this->load->model('get_shipping');
        return $weight * doubleval($this->get_shipping->get_rate($this->country));
    }
    private function sendToPaypal()
    {
        $this->load->model('get_config');
        $included['paypal'] = true;
        $data['data'] = $this->prepareDataForPaypal();
        
        $this->load->view('header', $included);
        $this->load->view('paypal', $data);
    }
    private function prepareDataForPaypal()
    {
        $this->load->model('get_paypal');
        return array_merge(
                array('business' => $this->get_config->get_paypalAccount()),
                $this->get_paypal->get_itemQtyInBag($this->get_session->list_itemWithQtyInBag()),
                $this->get_paypal->get_itemDetailInBag($this->get_itemDetail())
                );
    }
    private function get_itemDetail()
    {
        $this->load->model('get_shipping');
        return array(
            'itemInBag' => $this->get_session->list_itemInBag(),
            'itemDetail' => $this->get_product->get_listProduct($this->get_session->list_itemInBag()),
            'shippingRate' => $this->get_shipping->get_rate($this->country)
        );
    }
    private function get_invoice()
    {
        $this->load->model('get_transaction');
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        if ($this->get_transaction->check_duplicate($randomString)){ $randomString = $this->get_invoice(); }
        
        return $randomString;
    }
}