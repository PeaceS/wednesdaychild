<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Home extends CI_Controller {
    public function index()
    {
        $directory = "./assets/image/home/";

        $bannerImage = count(glob($directory . "home_*.jpg"));
        $included['home'] = "home_" . rand(1, $bannerImage) . ".jpg";

        $this->load->view('header', $included);
        $this->load->view('home');
        $this->load->view('list_menu');
    }
}