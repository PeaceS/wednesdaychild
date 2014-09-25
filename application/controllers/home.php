<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Home extends CI_Controller {
    public function index()
    {
        $directory = "./assets/style/banner/";

        $bannerStyleAmount = count(glob($directory . "banner_*.css"));
        $included['home'] = rand(1, $bannerStyleAmount);

        $this->load->view('header', $included);
        $this->load->view('home');
        $this->load->view('list_menu');
    }
}