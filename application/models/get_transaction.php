<?php
class Get_transaction extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
        public function check_duplicate($reference)
        {
            $this->db->from('transaction');
            $this->db->where('transaction_reference', $reference);
            $query = $this->db->get();
            
            return $query->num_rows() != 0;
        }
}