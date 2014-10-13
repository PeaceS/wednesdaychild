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
            for ($i = 0; $i < count($data['itemInBag']); $i++){
                foreach ($data['$itemDetail'] as $detail) {
                    if ($data['itemInBag'][$i]['product'] == $detail['product_no']){
                        $result['item_name_' . ($i + 1)] = $detail['product_name'] . '-' . $detail['product_no'];
                        $result['amount_' . ($i + 1)] = $detail['product_price'];
                        $result['shipping_' . ($i + 1)] = intval($detail['product_weight']) * doubleval($data['shippingRate']);
                        $result['shipping2_' . ($i + 1)] = intval($detail['product_weight']) * doubleval($data['shippingRate']);
                    }
                }
            }
            return $result;
        }
}