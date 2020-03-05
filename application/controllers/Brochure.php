<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brochure extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->db->select("*");
		$this->db->from("brochure");
		$this->db->order_by("bid", "desc");
		$query = $this->db->get();
		
		$data['records'] = $query->result();
		
		$this->load->view('brochure',$data);
	}
}