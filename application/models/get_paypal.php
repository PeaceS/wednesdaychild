<?php
class Get_paypal extends CI_Model{
	public function __construct()
	{
            parent::__construct();
	}
        public function get_shippingAddress($addressDetail)
        {
            return array(
                'email' => $addressDetail['email'],
                'firs_name' => $addressDetail['first'],
                'last_name' => $addressDetail['last'],
                'address1' => $addressDetail['address'],
                'city' => $addressDetail['city'],
                'zip' => $addressDetail['zip'],
                'country' => $addressDetail['country'],
                'day_phone_b' => $addressDetail['phone']);
        }
        public function get_itemQtyInBag($itemInBag)
        {
            $data = array();
            for ($i = 0; $i < count($itemInBag); $i++){
                $key = 'quantity_' . ($i + 1);
                $data[$key] = $itemInBag[$i]['qty'];
            }
            return $data;
        }
        public function get_itemDetailInBag($data)
        {
            $result = array();
            $counter = 1;
            foreach ($data['itemInBag'] as $item){
                foreach ($data['itemDetail'] as $detail) {
                    if ($item == $detail['product_no']){
                        $result['item_name_' . $counter] = $detail['product_name'];
                        $result['amount_' . $counter] = $detail['product_price'];
                        $result['shipping_' . $counter] = intval($detail['product_weight']) * doubleval($data['shippingRate']);
                        $result['shipping2_' . $counter] = intval($detail['product_weight']) * doubleval($data['shippingRate']);
                    }
                }
                $counter++;
            }
            return $result;
        }
}