<?php
class Get_config extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
	public function get_bankwireDetail()
	{
            $this->db->select('value');
            $this->db->from('config');
            $this->db->like('parameter', 'bankwire_', 'after');
            $this->db->order_by('parameter');
            $query = $this->db->get();
            
            return $query->result_array();
	}
        public function get_paypalAccount()
        {
            $this->db->select('value');
            $this->db->from('config');
            $this->db->where('parameter', 'paypal_account');
            $this->db->order_by('parameter');
            $query = $this->db->get();
            
            return $query->row()->value;
        }
        public function get_email()
        {
            $this->db->select('value');
            $this->db->from('config');
            $this->db->where('parameter', 'owner_email');
            $this->db->order_by('parameter');
            $query = $this->db->get();
            
            return $query->row()->value;
        }
        public function get_contact()
        {
            $contact = array('owner_address', 'owner_email', 'owner_facebook', 'owner_instagram', 'bankwire_0');
            
            $this->db->from('config');
            $this->db->where_in('parameter', $contact);
            $query = $this->db->get();
            
            return $query->result_array();
        }
}