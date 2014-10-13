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
        public function get_itemDetailInBag($itemInBag, $itemDetail)
        {
            $data = array();
            for ($i = 0; $i < count($itemInBag); $i++){
                foreach ($itemDetail as $detail) {
                    if ($itemInBag[$i]['product'] == $detail['product_no']){
                        $data['item_name_' . ($i + 1)] = $detail['product_name'] . '-' . $detail['product_no'];
                        $data['amount_' . ($i + 1)] = $detail['product_price'];
                    }
                }
            }
            return $data;
        }
}