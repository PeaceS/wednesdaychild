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
    //TODO: Move back to buy controller
    public function bankwireMethod()
    {
        $included['buy'] = 5;
        
        $bag = $this->getListItemInBag();
        
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        $data['totalAmount'] = number_format($this->calculateShippingCost($bag) + $this->calculateTotalPrice($bag));
        $data['bankDetail'] = $this->get_config->get_bankwireDetail();

        $this->load->view('header', $included);
        $this->load->view('main', $data);
        $this->load->view('buy_' . $included['buy']);
        $this->load->view('buy_menu');
        $this->load->view('list_menu');
    }
    public function paymentByBankwire()
    {
        if (!$this->session->userdata('wednesdaychild_cart') || !$this->session->userdata('wednesdaychild_shippingAddress')){
            exit(false);
        }
        
        if ($this->checkStock($this->getProductInBag())){
            $this->updateStockAndSaveTransaction($this->getProductInBag(), 'bankwire');
            $this->session->unset_userdata('wednesdaychild_cart');
            exit(true);
        }
        exit(false);
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
    private function getProductInBag()
    {
        $products = array();
        if ($this->session->userdata('wednesdaychild_cart')){
            $items = explode(",", $this->session->userdata('wednesdaychild_cart'));
            foreach ($items as $item) {
                $item_detail = explode(":", $item);
                $product = array('product' => $item_detail[0], 'qty' => $item_detail[1]);
                array_push($products, $product);
            }
        }
        return $products;
    }
    private function checkStock($productInBag)
    {
        $productStock = $this->get_product->get_listStock(array_column($productInBag, 'product'));
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
    private function updateStockAndSaveTransaction($productInBag, $method)
    {
        $this->load->model('set_product');
        $fareDetail = array('totalPrice' => 0.0, 'weight' => 0.0);
        $data = array();
        
        foreach ($productInBag as $product) {
            $fareDetail['totalPrice'] += floatval($this->get_product->get_price($product['product']));
            $fareDetail['weight'] += floatval($this->get_product->get_weight($product['product']));
            array_push($data, array('product_no' => $product['product'], 'product_stock' => intval($this->get_product->get_stock($product['product'])) - $product['qty']));
        }
        
        $this->set_product->update_stock($data);
        $this->saveTransaction($fareDetail, $method);
    }
    private function saveTransaction($fare, $method)
    {
        $this->load->model('set_transaction');
        //TODO: get rate and calculate
        $shippingCost = $fare['weight'];
        $data = array(
            'transaction_products' => $this->session->userdata('wednesdaychild_cart'),
            'transaction_address' => $this->session->userdata('wednesdaychild_shippingAddress'),
            'transaction_fare' => $fare['totalPrice'],
            'transaction_shipping' => $shippingCost,
            'transaction_method' => $method
        );
        
        $this->set_transaction->insert_transaction($data);
    }
}