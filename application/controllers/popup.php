<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Popup extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    public function confirm($status)
    {   
        $included['popup'] = true;
        $data['confirm'] = $status == 'confirm';
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        
        $this->load->view('header', $included);
        $this->load->view('main', $data);
        $this->load->view('list_menu');
    }
}