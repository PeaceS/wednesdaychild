<?php
class Get_text extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
	public function get_text($param)
	{
            $query = $this->db->get_where('text_display', array('section' => $param));
            return $query->row()->text;
	}
        public function get_faq()
        {
            $this->db->select('text');
            $this->db->from('text_display');
            $this->db->like('section', 'faq_', 'after');
            $this->db->order_by('section', 'asc');
            $query = $this->db->get();
            
            return $query->result_array();
        }
        public function get_mailNotificationConfirm($data)
        {
            $this->db->select('text');
            $this->db->from('text_display');
            $this->db->where('section', 'mail_notificationConfirm');
            $query = $this->db->get();
            
            return $query->row()->text;
        }
}