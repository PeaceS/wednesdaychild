<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Shipping extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    public function updateAddress()
    {
        if (!$this->input->post('shippingAddress')){ exit('false'); }
        $this->session->set_userdata('wednesdaychild_shippingAddress', $this->convertObjToString());
        
        exit($this->session->userdata('wednesdaychild_shippingAddress'));
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