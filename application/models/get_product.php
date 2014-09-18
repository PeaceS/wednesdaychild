<?php
class Get_product extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
	public function list_product($collection)
	{
            //SELECT p.product_no, i.image_url
            //FROM `product` p
            //JOIN product_image i
            //ON p.product_no = i.product_no
            //WHERE p.product_no LIKE 's14%' AND i.image_no = 0
            
            $this->db->select('product_no, image_url');
            $this->db->from('product');
            $this->db->join('product_image', 'product.product_no = product_image.product_no');
            $this->db->like('product_no', $collection, 'after');
            $this->db->where('image_no', 0);
            $this->db->order_by('product_no', 'desc');
            
            $query = $this->db->get();
            
            return $query->result_array();
	}
}