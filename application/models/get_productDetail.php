<?php
class Get_productDetail extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
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
            $this->db->select('image_no, image_url, image_zoom');
            $this->db->from('product_image');
            $this->db->like('product_no', substr($product, 0, 6), 'after');
            $query = $this->db->get();
            
            return $query->result_array();
        }
        public function get_color($product)
        {
            $this->db->distinct();
            $this->db->select('product_color, product_no');
            $this->db->from('product');
            $this->db->like('product_no', substr($product, 0, 5), 'after');
            $this->db->where('product_stock >', 0);
            $this->db->group_by('product_color'); 
            $this->db->order_by('product_no', 'asc');
            $query = $this->db->get();
            
            return $query->result_array();
        }
        public function get_size($product)
        {
            $this->db->distinct();
            $this->db->select('product_size, product_no');
            $this->db->from('product');
            $this->db->like('product_no', substr($product, 0, 6), 'after');
            $this->db->where('product_stock >', 0);
            $this->db->group_by('product_size');
            $this->db->order_by('product_no', 'asc');
            $query = $this->db->get();
            
            return $query->result_array();
        }
        public function get_stock($product)
        {
            $this->db->select('product_stock');
            $this->db->from('product');
            $this->db->where('product_no', $product);
            $query = $this->db->get();
            
            return $query->row()->product_stock;
        }
        public function get_price($product)
        {
            $this->db->select('product_price');
            $this->db->from('product');
            $this->db->where('product_no', $product);
            $query = $this->db->get();
            
            return $query->row()->product_price;
        }
        public function get_weight($product)
        {
            $this->db->select('product_weight');
            $this->db->from('product');
            $this->db->where('product_no', $product);
            $query = $this->db->get();
            
            return $query->row()->product_weight;
        }
}