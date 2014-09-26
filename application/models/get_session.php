<?php
class Get_session extends CI_Model{
	public function __construct()
	{
            parent::__construct();
	}
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
}