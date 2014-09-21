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
            $this->db->select('image_no, image_url, image_zoom');
            $this->db->from('product_image');
            $this->db->where('product_no', $product);
            $query = $this->db->get();
            
            return $query->result_array();
        }
        public function get_color($product)
        {
            $this->db->distinct();
            $this->db->select('product_color');
            $this->db->select('product_no');
            $this->db->from('product');
            $this->db->like('product_no', substr($product, 0, 5), 'after');
            $query = $this->db->get();
            
            return $query->result_array();
        }
        public function get_size($product)
        {
            $this->db->distinct();
            $this->db->select('product_size');
            $this->db->select('product_no');
            $this->db->from('product');
            $this->db->like('product_no', substr($product, 0, 6), 'after');
            $query = $this->db->get();
            
            return $query->result_array();
        }
	public function list_related($product)
	{
            $this->db->select('product_related.related_no, product_image.image_url');
            $this->db->from('product_related');
            $this->db->join('product_image', 'product_related.related_no = product_image.product_no');
            $this->db->where('product_related.product_no', $product);
            $this->db->where('product_image.image_no', 0);
            $this->db->order_by('product_related.related_no', 'asc');
            $query = $this->db->get();
            
            return $query->result_array();
	}
}