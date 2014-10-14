<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Shipping extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    public function updateAddress()
    {
        if (!$this->input->post('shippingAddress')){ exit('false'); }
        $this->get_session->save_shippingAddress($this->convertObjToString());
    }
    
    private function convertObjToString()
    {
        $shippingAddress = '';
        foreach ($this->input->post('shippingAddress') as $type => $detail) {
            $shippingAddress .= $shippingAddress != '' ? ';;' : '';
            $shippingAddress .= $type . ':' . $detail;
        }
        return $shippingAddress;
    }
}