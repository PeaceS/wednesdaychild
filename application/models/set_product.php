<?php
class Set_product extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
        public function update_stock($data)
        {
            $this->db->update_batch('product', $data, 'product_no');
        }
}