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
        public function get_listProduct($products)
        {
            $this->db->select('product.product_no, product_image.image_url, product.product_name, product.product_size, product.product_color, product.product_stock, product.product_price, product.product_weight');
            $this->db->from('product');
            $this->db->join('product_image', 'product.product_no = product_image.product_no');
            $this->db->where_in('product.product_no', $products);
            $this->db->where('product_image.image_no', 0);
            $query = $this->db->get();
            
            return $query->result_array();
        }
        public function get_listStock($products)
        {
            $this->db->select('product_no, product_stock');
            $this->db->from('product');
            $this->db->where_in('product_no', $products);
            $query = $this->db->get();
            
            return $query->result_array();
        }
        public function free($product)
        {
            $this->db->set('product_stock', 'product_stock + 1');
            $this->db->where('product_no', $product);
        }
}