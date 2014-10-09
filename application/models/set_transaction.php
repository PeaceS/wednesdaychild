<?php
class Set_transaction extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
        public function insert_transaction($data)
        {
            $this->db->insert('transaction', $data); 
        }
}