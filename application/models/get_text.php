<?php
class Get_text extends CI_Model{
	public function __construct()
	{
            parent::__construct();
            $this->load->database();
	}
	public function get_text($param)
	{
            $query = $this->db->get_where('text_display', array('section' => $param));
            return $query->row()->text;
	}
}