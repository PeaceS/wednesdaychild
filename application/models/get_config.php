<?php
class Get_config extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
	public function get_config($param)
	{
            $query = $this->db->get_where('config', array('parameter' => $param));
            return $query->row()->value;
	}
}