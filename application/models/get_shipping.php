<?php
class Get_shipping extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
	public function get_rate($country)
	{
            $this->db->select('shipping_rate');
            $this->db->from('shipping');
            $this->db->where('shipping_country', strtolower($country));
            $query = $this->db->get();
            
            return $query->row()->shipping_rate;
	}
        public function get_country()
        {
            $this->db->select('shipping_country');
            $this->db->from('shipping');
            $query = $this->db->get();
            
            return $query->result_array();
        }
}