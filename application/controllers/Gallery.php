<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->db->select("*");
		$this->db->from("gallery");
		$this->db->order_by("gid", "desc");
		$query = $this->db->get();
		
		$data['records'] = $query->result();
		
		$this->load->view('gallery',$data);
	}
}