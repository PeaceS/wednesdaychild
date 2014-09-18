<?php
class Get_product extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
	public function list_product($collection)
	{
            $this->db->select('product.product_no, product_image.image_url');
            $this->db->from('product');
            $this->db->join('product_image', 'product.product_no = product_image.product_no');
            $this->db->like('product.product_no', $collection, 'after');
            $this->db->like('product.product_no', '00', 'before');
            $this->db->where('product_image.image_no', 0);
            $this->db->order_by('product.product_no', 'asc');
            $query = $this->db->get();
            
            return $query->result_array();
	}
        public function get_product($product)
        {
            $this->db->from('product');
            $this->db->where('product_no', $product);
            $query = $this->db->get();
            
            return $query->row_array();
        }
        public function get_image($product)
        {
            $this->db->from('product_image');
            $this->db->where('product_no', $product);
            $query = $this->db->get();
            
            return $query->result_array();
        }
}