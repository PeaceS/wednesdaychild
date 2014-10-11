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
        
        if ($this->checkStock($this->get_session->list_itemWithQtyInBag())){
            $this->updateStockAndSaveTransaction($this->get_session->list_itemWithQtyInBag());
            $this->session->unset_userdata('wednesdaychild_cart');
            $status = true;
        }
        if ($method == 'paypal'){
            $this->sendToPaypal();
        }
        
        exit(isset($status));
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
        $data = array(
            'business' => $this->get_config->get_paypalAccount(),
            'invoice' => $this->invoiceNo,
            'item_number' => $this->invoiceNo,
            'amount' => $this->fareDetail['totalPrice'] + $this->fareDetail['shippingCost'],
            
        );
        /*
          <input type="hidden" name="business" value="<?php echo $paypal_account; ?>" />
    <input type="hidden" name="invoice" value="<?php echo $refNo; ?>" />
    <input type="hidden" name="item_number" value="<?php echo $refNo; ?>" />
    <input type="hidden" name="amount" value="<?php echo ($totalCost + $shippingCost); ?>" />
    <input type="hidden" name="email" value="<?php echo $buyer_mail; ?>" />
    <input type="hidden" name="first_name" value="<?php echo $_REQUEST['first_name']; ?>" />
    <input type="hidden" name="last_name" value="<?php echo $_REQUEST['last_name']; ?>" />
    <input type="hidden" name="address1" value="<?php echo $_REQUEST['address1']; ?>" />
    <input type="hidden" name="city" value="<?php echo $_REQUEST['city']; ?>" />
    <input type="hidden" name="state" value="<?php echo $_REQUEST['state']; ?>" />
    <input type="hidden" name="zip" value="<?php echo $_REQUEST['zip']; ?>" />
    <input type="hidden" name="country" value="<?php echo $_REQUEST['country']; ?>" />
    <input type="hidden" name="night_phone_b" value="<?php echo $_REQUEST['night_phone_b']; ?>" />  
         */    
    }
    private function get_invoice() {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}