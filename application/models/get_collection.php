<?php
class Get_collection extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
	public function list_collection()
	{
            $this->db->select('collection_code, collection_name');
            $this->db->from('collection');
            $this->db->limit(5);
            $this->db->order_by('release_date', 'desc');
            $query = $this->db->get();
            
            return $query->result_array();
	}
}