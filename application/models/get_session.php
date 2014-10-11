<?php
class Get_session extends CI_Model{
	public function __construct()
	{
            parent::__construct();
	}
        //TODO: GET session here, no GET_SESSION direct anymore
	public function get_itemCountInBag()
	{
            $count = 0; 
            if ($this->session->userdata('wednesdaychild_cart')){
                $items = explode(",", $this->session->userdata('wednesdaychild_cart'));
                $count = count($items);
            }
            
            return $count;
	}
        public function list_itemInBag()
        {
            if (!$this->session->userdata('wednesdaychild_cart')){ return NULL; }
            
            $products = array();
            $items = explode(",", $this->session->userdata('wednesdaychild_cart'));
            foreach ($items as $itemWithQty) {
                $item = explode(":", $itemWithQty);
                array_push($products, $item[0]);
            }
            return $products;
        }
        public function list_itemWithQtyInBag()
        {
            if (!$this->session->userdata('wednesdaychild_cart')){ return NULL; }
            
            $products = array();
            $items = explode(",", $this->session->userdata('wednesdaychild_cart'));
            foreach ($items as $itemWithQty) {
                $item = explode(":", $itemWithQty);
                array_push($products, array('product'=>$item[0], 'qty'=>$item[1]));
            }
            return $products;
        }
        public function list_shhippingAddress()
        {
            if (!$this->session->userdata('wednesdaychild_shippingAddress')){ return NULL; }
            
            $shippingAddress = array();
            $items = explode(",", $this->session->userdata('wednesdaychild_shippingAddress'));
            foreach ($items as $value) {
                $valueWithType = explode(":", $value);
                $shippingAddress[$valueWithType[0]] = $valueWithType[1];
            }
            return $shippingAddress;
        }
}