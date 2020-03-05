<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spepackage extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		if($this->uri->segment(1) == 'spe-dom-package')
		{
			$this->db->select("*");
			$this->db->from("spepackage");
			$this->db->where("packagetype",1);
			$this->db->order_by("spid", "desc");
			$query = $this->db->get();
			
			$data['records'] = $query->result();
			
			$this->load->view('spepackage',$data);
		}
		else if($this->uri->segment(1) == 'spe-int-package')
		{
			$this->db->select("*");
			$this->db->from("spepackage");
			$this->db->where("packagetype",2);
			$this->db->order_by("spid", "desc");
			$query = $this->db->get();
			
			$data['records'] = $query->result();
			
			$this->load->view('spepackage',$data);
		}
	}
}