<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ebrochure extends CI_Controller {

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
			$this->load->view('admin/ebrochure',$data);
		}
	}
	
	private function getdata()
	{
		$this->db->select("*");
		$this->db->from("brochure");
		$this->db->order_by("bid", "desc");
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function addbrochure()
	{
		$session = $this->session->userdata('isLogin');
		
		if($session == FALSE)
		{
			redirect('admin/Login');
		}
		else if($this->session->userdata('isLoginid') && $this->session->userdata('isLoginusername'))
		{
			 $data['records'] = $this->getdata();
			
			 $this->form_validation->set_rules('btitel', 'Brochure Titel', 'required|min_length[3]|max_length[512]');
			 $this->form_validation->set_rules('bdate', 'Brochure Date', 'min_length[3]');
			 $this->form_validation->set_rules('blink', 'Brochure Google Link', 'required|valid_url');
			
			 if($this->form_validation->run() == FALSE) 
			 {
				$this->load->view('admin/ebrochure',$data);
			 }
			 else
			 {
				$dest_data = array(	
					'bgoogleid' => $this->input->post('blink'),
					'btitel' => $this->input->post('btitel'),
					'date' => $this->input->post('bdate')
				);
				
				$data = $this->Ebrochure_Model->addbrochure($dest_data);
				
				$this->session->set_flashdata('message', 'Your E-brochure Added Successfully!');
				redirect('admin/ebrochure',$data);
			 }
		}
	}
	
	public function delbrochure()
	{
		$session = $this->session->userdata('isLogin');
		
		if($session == FALSE)
		{
			redirect('admin/Login');
		}
		else if($this->session->userdata('isLoginid') && $this->session->userdata('isLoginusername'))
		{
			$data['records'] = $this->getdata();
			
			$id = $this->uri->segment(4);
	
			$this->Ebrochure_Model->delbrochure($id);
			
			$this->session->set_flashdata('message', 'Your E-brochure Deleted Successfully!');
			redirect('admin/ebrochure',$data);
		}
	}
}