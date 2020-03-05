<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->output->cache(31536000);
		$this->load->view('contacts');
	}
	
	public function send_mail()
	{		
		$jsondata = array('code' => 1);

		if((!$this->input->post('name')) || ($this->input->post('name') == ''))
		{
			$jsondata['message'] = 'Please Enter Name';
		}
		else if((!preg_match("/^[A-z ]+$/",$this->input->post('name')))) 
		{
			$jsondata['message'] = 'Please Enter Only Characters In Name';
		}
	 	else if((!$this->input->post('email')) || ($this->input->post('email') == ''))
		{
			$jsondata['message'] = 'Please Enter email';
		}
		else if((!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL))) 
		{
			$jsondata['message'] = 'Please Enter Valid Email';
		}
		else if((!$this->input->post('phone')) || ($this->input->post('phone') == ''))
		{
			$jsondata['message'] = 'Please Enter Mobile Number';
		}
		else if(!preg_match("/^((?!(0))[0-9]{10})$/",$this->input->post('phone'))) 
		{
			$jsondata['message'] = 'Please Enter Valid Mobile Number';
		}
		else if((!$this->input->post('content')) || ($this->input->post('content') == ''))
		{
			$jsondata['message'] = 'Please Enter Message';
		}
		else if(!preg_match("/^[ A-Za-z0-9.,-]*$/",$this->input->post('content'))) 
		{
			$jsondata['message'] = 'Please Enter Characters,Numbers and Symbol like .,- Only';
		}
		else 
		{
		
		$data = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'mobile' => $this->input->post('phone'),
						'message' => $this->input->post('content'),
						'reqtype' => 3
				);
				
			$added = $this->Estimate_Model->insert($data);

			$message = "Request Type - Contact<br>Name -".$this->input->post('name')."<br>Mobile -".$this->input->post('phone')."<br>Message -".$this->input->post('content');

			//$ci = get_instance();
			$this->load->library('email');
			$config['protocol'] = "smtp";
			$config['smtp_host'] = "smtp.gmail.com";		
			$config['smtp_port'] = "587";
			$config['smtp_user'] = "ashish7730@gmail.com"; 
			$config['smtp_pass'] = "r@nd@l9737134341";
			$config['smtp_crypto'] = "tls";
			$config['charset'] = "utf-8";
			$config['mailtype'] = "html";
			$config['newline'] = "\r\n";

			$this->email->initialize($config);

			$this->email->from($this->input->post('email'));
			$list = array('shaktitravels59@gmail.com');
			$this->email->to($list);
			$this->email->subject('ContactUs');
			$this->email->message($message);

			if($this->email->send() && $added)
			{
				$jsondata['code'] = 1;
				$jsondata['message'] = 'Your Request Submitted Successfully We Will Contact You As Soon As Possible Thank You.';
			}
			else
			{
				$jsondata['code'] = 0;
				$jsondata['message'] = 'Please Try After Some Time.';
			}
		}
			
			$this->output->set_content_type('application/json')->set_output(json_encode($jsondata));
	}
}