<?php
class Send_mail extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
        public function send($data)
        {
            $this->email->initialize($this->get_config());
            $this->email->from('no-reply@wednesday-child.com');
            $this->email->to($data['email']);

            $this->email->subject($data['topic']);
            $this->email->message($data['body']);

            $this->email->send();
        }
        
        private function get_config()
        {
            return array(
                'mailtype' => 'html',
                'priority' => 2
            );
        }
}