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
        public function update($data)
        {
            $transaction = array('transaction_status' => $data['status']);
            
            $this->db->where('transaction_reference', $data['ref']);
            $this->db->update('transaction', $transaction);
        }
        public function free($reference)
        {
            $this->db->where('transaction_reference', $reference);
            $this->db->delete('transaction'); 
        }
}