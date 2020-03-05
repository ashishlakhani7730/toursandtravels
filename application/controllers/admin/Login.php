<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller 
{
	 function __construct() 
	 {
		parent::__construct(); 
		//$this->load->library('form_validation');
	 } 

	 public function index() 
	 {
		$this->load->view('admin/login');
	 } 
	 
	 public function logging()
	 {
		$this->form_validation->set_rules('username', 'Username', 'required|regex_match[/^[a-zA-Z\s]*$/]');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == FALSE) 
		{
			$this->load->view('admin/login');
		}
		else
		{
			$logindata = array(
							'username' => $this->input->post('username'),
							'password' => md5($this->input->post('password'))
						);
						
			$data = $this->Login_Model->loginMatch($logindata);
			
			//print_r($data); exit;
			if(!empty($data))
			{
				$this->session->set_userdata("isLogin",TRUE);
				$this->session->set_userdata("isLoginid",$data[0]->loginid);
				$this->session->set_userdata("isLoginusername",$data[0]->username);
				
				redirect('admin/Home');
			}
			else if(!$data)
			{
				$this->session->set_flashdata('message', 'Username Or Password Is Not Correct!');
				$this->load->view('admin/login');
			}
		}		
	 }
	 
	 public function logout()
	 {
		 $this->session->unset_userdata('isLogin'); 
		 $this->session->unset_userdata('isLoginid'); 
		 $this->session->unset_userdata('isLoginusername'); 
		 
		 redirect('admin/Home'); 
	 }
}