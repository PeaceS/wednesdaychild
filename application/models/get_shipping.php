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
            $this->db->where('shipping_country', $country);
            $query = $this->db->get();
            
            return $query->row()->shipping_rate;
	}
}