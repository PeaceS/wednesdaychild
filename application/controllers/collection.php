<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Collection extends CI_Controller {
    public function index()
    {
        $collection = 's14';
        $directory = "./assets/image/collection/" . $collection . "/";

        $collectionItemAmount = count(glob($directory . "*.jpg"));
        $included['collection'] = $collection;
        $data['itemAmount'] = $collectionItemAmount;
        
        $this->load->helper('url');
        $this->load->view('header', $included);
        $this->load->view('main');
        $this->load->view('collection', $data);
        $this->load->view('list_collection');
        $this->load->view('list_menu');
    }
}

/* Location: ./application/controllers/collection.php */