<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Faq extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
	$this->load->model('get_text');
    }
    public function index()
    {   
        $included['faq'] = true;
        $data['faq'] = $this->transform_data($this->get_text->get_faq());
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        
        $this->load->view('header', $included);
        $this->load->view('main', $data);
        $this->load->view('faq');
        $this->load->view('list_menu');
    }

    private function transform_data($data)
    {
        $output = array();

        foreach ($data as $faq) {
            array_push($output, array(
                'question' => explode("??", $faq['text'])[0],
                'answer' => $this->apply_bulletPoint(explode("??", $faq['text'])[1])
            ));
        }

        return $output;
    }
    private function apply_bulletPoint($data)
    {
        if (substr($data, 0, 2) == '- '){
            $output = '<ul>';
            foreach (explode("- ", $data) as $row){
                if (trim($row) != ''){ $output .= '<li>- ' . trim($row) . '</li>'; }
            }
            $output .= '</ul>';
            return $output;
        }

        return $data;
    }
}