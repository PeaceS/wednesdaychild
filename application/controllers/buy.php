<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Buy extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('get_product');
        $this->stock = $this->get_product->get_stock($this->input->post('product'));
    }
    public function checkInsideBag()
    {
        if (!$this->session->userdata('wednesdaychild_cart')){ exit('No product'); }
        
        $included['buy'] = 1;
        $data['bag'] = $this->getListItemInBag();
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        $this->loadView($included, $data);
    }
    public function fillInAddress()
    {
        if (!$this->session->userdata('wednesdaychild_cart')){ exit('No product'); }
        
        $included['buy'] = 2;
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        $data['shippingAddress'] = $this->get_session->list_shhippingAddress();
        
        $this->loadView($included, $data);
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
    private function loadView($included, $data)
    {
        $this->load->view('header', $included);
        $this->load->view('main', $data);
        $this->load->view('buy_' . $included['buy']);
        $this->load->view('buy_menu');
        $this->load->view('list_menu');
    }
}