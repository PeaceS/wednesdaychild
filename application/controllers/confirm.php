<?php if ( ! defined('BASEPATH')){ exit('No direct script access allowed'); }

class Confirm extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->helper('form');

        $included['confirm'] = true;
        $data['itemCountInBag'] = $this->get_session->get_itemCountInBag();
        
        $this->load->view('header', $included);
        $this->load->view('main', $data);
        $this->load->view('confirm');
        $this->load->view('list_menu');
    }
    public function send()
    {
        $this->load->library('upload', $this->load_config());

        if (!$this->upload->do_upload('image')){
            $error = array('error' => $this->upload->display_errors());
            $status = 'error';
        } else {
            $data = $this->prepare_result($this->upload->data());
            $this->save_record($data);
            $this->send_notification($data);
            $status = 'sent';
        }

        redirect('/popup/confirm/' . $status, 'refresh');
    }
    public function update($reference, $status)
    {
        $this->load->model('set_transaction');
        $this->set_transaction->update(array(
            'ref' => $reference,
            'status' => $status
        ));
    }
    
    private function load_config()
    {
        return array(
            'upload_path' => './confirm_payments/',
            'allowed_types' => 'gif|jpg|png',
            'file_name' => $this->input->post('reference'),
            'overwrite' => true,
            'max_size' => '100',
            'max_width' => '1024',
            'max_height' => '768'
        );
    }
    private function prepare_result($result)
    {
        $detail = $this->input->post('name') . ';;';
        $detail .= $this->input->post('account') . ';;';
        $detail .= $this->input->post('bank') . ';;';
        $detail .= $this->input->post('time') . ';;';
        return array(
            'confirm_file' => substr($result['full_path'], 1),
            'confirm_reference' => $result['raw_name'],
            'confirm_detail' => $detail
        );
    }
    private function save_record($data)
    {
        $this->load->model('set_confirm');
        $this->set_confirm->insert_confirm($data);
    }
    private function send_notification($data)
    {
        $this->load->library('email');
        $this->load->model('get_config');
        $this->load->model('get_text');
        $this->load->model('send_mail');
        
        $mail = array(
            'topic' => 'Confirm bankwire on ' . $data['confirm_reference'],
            'email' => $this->get_config->get_email(),
            'body' => $this->get_text->get_mailNotificationConfirm($data)
        );
        $this->send_mail->send($mail);
    }
}