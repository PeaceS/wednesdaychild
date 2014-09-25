<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Stock extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('get_product');
    }
    public function check($product)
    {
        if ($product == NULL || $product == ''){
            exit(false);
        }
        exit($this->get_product->get_stock($this->input->post('product')) > 0);
    }
}