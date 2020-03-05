<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Request extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{ 
		$session = $this->session->userdata('isLogin');
		
		if($session == FALSE)
		{
			redirect('admin/Login');
		}
		else if($this->session->userdata('isLoginid') && $this->session->userdata('isLoginusername'))
		{
			$data['records'] = $this->getdata();
			$this->load->view('admin/request',$data);
		}
	}
	
	private function getdata()
	{
		$this->db->select("*");
		$this->db->from("estimate");
		$this->db->order_by("eid", "desc");
		$query = $this->db->get();
		
		return $query->result();
	}
}