<?php
class Set_confirm extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
        public function insert_confirm($data)
        {
            $this->db->insert('confirm', $data); 
        }
}