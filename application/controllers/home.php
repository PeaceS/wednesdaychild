<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Home extends CI_Controller {
    public function index()
    {
        $directory = "./assets/style/banner/";

        $bannerStyleAmount = count(glob($directory . "banner_*.css"));
        $data['noStyleBanner'] = rand(1, $bannerStyleAmount);

        $this->load->helper('url');
        $this->load->view('header');
        $this->load->view('home', $data);
    }
}

/* Location: ./application/controllers/home.php */