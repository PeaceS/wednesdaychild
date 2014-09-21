<?php
class Get_config extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
	public function get_policy()
	{
            $query = $this->db->get_where('config', array('parameter' => 'text_policy'));
            return $query->row()->value;
	}
}