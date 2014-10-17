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
        public function out_of_payDate($product)
        {
            return array_merge(
                $this->out_of_payDate_paypal($product),
                $this->out_of_payDate_bankwire($product)
            );
        }
        
        private function out_of_payDate_paypal($product)
        {
            $this->db->select('transaction_reference, transaction_products');
            $this->db->from('transaction');
            $this->db->like('transaction_products', $product);
            $this->db->where('transaction_status', 0);
            $this->db->where('transaction_method', 'paypal');
            $this->db->where('transaction_date <', 'NOW() + INTERVAL 4 HOUR');
            $query = $this->db->get();
            
            return $query->result_array();
        }
        private function out_of_payDate_bankwire($product)
        {
            $this->db->select('transaction_reference, transaction_products');
            $this->db->from('transaction');
            $this->db->like('transaction_products', $product);
            $this->db->where('transaction_status', 0);
            $this->db->where('transaction_method', 'bankwire');
            $this->db->where('transaction_date <', 'NOW() + INTERVAL 48 HOUR');
            $query = $this->db->get();
            
            return $query->result_array();
        }
}