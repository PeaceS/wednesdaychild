<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Pay extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('wednesdaychild_cart') || !$this->session->userdata('wednesdaychild_shippingAddress')){
            exit(false);
        }
        $this->load->model('get_product');
        $this->invoiceNo = $this->get_invoice();
    }
    public function payment($method)
    {
        $this->method = $method;
        
        if ($this->checkStock($this->get_session->list_itemInBag())){
            $this->updateStockAndSaveTransaction($this->get_session->list_itemWithQtyInBag());
            //$this->session->unset_userdata('wednesdaychild_cart');
            $status = true;
        }
        if ($method == 'paypal'){ $this->sendToPaypal(); }
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
    private function updateStockAndSaveTransaction($productInBag)
    {
        $this->load->model('set_product');
        $this->fareDetail = array('totalPrice' => 0.0, 'weight' => 0.0);
        $data = array();
        
        foreach ($productInBag as $product) {
            $this->fareDetail['totalPrice'] += floatval($this->get_product->get_price($product['product']));
            $this->fareDetail['weight'] += floatval($this->get_product->get_weight($product['product']));
            array_push($data, array('product_no' => $product['product'], 'product_stock' => intval($this->get_product->get_stock($product['product'])) - $product['qty']));
        }
        
        $this->set_product->update_stock($data);
        $this->saveTransaction($this->fareDetail);
    }
    private function saveTransaction($fare)
    {
        $this->load->model('set_transaction');
        $shippingCost = $this->calculateShippingCost($fare['weight']);
        $data = array(
            'transaction_products' => $this->session->userdata('wednesdaychild_cart'),
            'transaction_address' => $this->session->userdata('wednesdaychild_shippingAddress'),
            'transaction_fare' => $fare['totalPrice'],
            'transaction_shipping' => $shippingCost,
            'transaction_method' => $this->method
        );
        
        $this->set_transaction->insert_transaction($data);
    }
    private function calculateShippingCost($weight)
    {
        //TODO: Calculate by get_session country
        $result = $weight;
        
        $this->fareDetail['shippingCost'] = $result;
        return $result;
    }
    private function sendToPaypal()
    {
        $this->load->model('get_config');
        $included['paypal'] = true;
        $data = $this->prepareDataForPaypal();
        
        $this->load->view('header', $included);
        $this->load->view('paypal', $data);
    }
    private function prepareDataForPaypal()
    {
        $this->load->model('get_paypal');
        return array_merge(
                array('business' => $this->get_config->get_paypalAccount()),
                $this->get_paypal->get_shippingAddress($this->get_session->list_shhippingAddress()),
                $this->get_paypal->get_itemQtyInBag($this->get_session->list_itemWithQtyInBag()),
                $this->get_paypal->get_itemDetailInBag($this->get_itemDetail())
                );
    }
    private function get_itemDetail()
    {
        $this->load->model('get_shipping');
        $address = $this->get_session->list_shhippingAddress();
        return array(
            'itemInBag' => $this->get_session->list_itemInBag(),
            'itemDetail' => $this->get_product->get_listProduct($this->get_session->list_itemInBag()),
            'shippingRate' => $this->get_shipping->get_rate($address['country'])
        );
    }
    private function get_invoice()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}