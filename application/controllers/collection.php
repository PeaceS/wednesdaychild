<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Collection extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
	$this->load->model('get_collection');
    }
    public function index()
    {
        $this->load($this->get_collection->get_latestCollection(), $this->get_collection->list_collection());
    }
    public function view($collection)
    {
        $this->load($collection, $this->get_collection->list_collection());
    }
    
    private function load($collection, $listCollection)
    {
        $directory = "./assets/image/collection/" . $collection . "/";

        $included['collection'] = $collection;
        $data['itemAmount'] = count(glob($directory . "*.jpg"));
        $data['listCollection'] = $listCollection;
        
        $this->load->helper('url');
        $this->load->view('header', $included);
        $this->load->view('main');
        $this->load->view('collection', $data);
        $this->load->view('list_collection', $data);
        $this->load->view('list_menu');
    }
}