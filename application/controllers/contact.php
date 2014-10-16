<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Contact extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
	$this->load->model('get_config');
    }
    public function index()
    {   
        $included['contact'] = true;
        $data['contact'] = $this->get_config->get_contact();
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        
        $this->load->view('header', $included);
        $this->load->view('main', $data);
        $this->load->view('contact');
        $this->load->view('list_menu');
    }
    public function send()
    {
        if (!$this->input->post('name') || !$this->input->post('email') || !$this->input->post('message')) { exit('error'); }
        $this->load->library('email');
        $this->load->model('send_mail');
        
        $this->send_mail->send($this->get_mail());
      
        $this->load->view('thanks');
    }
    
    private function get_mail()
    {
        return array(
            'topic' => 'Question from ' . $this->input->post('name'),
            'email' => $this->get_config->get_email(),
            'from' => $this->input->post('email'),
            'body' => $this->input->post('message')
        );
    }
}