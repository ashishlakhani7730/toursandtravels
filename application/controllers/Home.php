<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{	
		$this->output->cache(31536000);
		$this->db->select("*");
		$this->db->from("dest_services");
		$this->db->order_by("dsid", "desc");
		$query = $this->db->get();
		
        $data['records'] = $query->result();
		
		$this->load->view('home',$data);
	}
	
	public function getestimate()
	{
		$jsondata = array('code' => 0);

		if((!$this->input->post('name')) || ($this->input->post('name') == ''))
		{
			$jsondata['message'] = 'Please Enter Name';
		}
		else if((!preg_match("/^[A-z ]+$/",$this->input->post('name')))) 
		{
			$jsondata['message'] = 'Please Enter Only Characters In Name';
		}
	 	/* else if((!$this->input->post('email')) || ($this->input->post('email') == ''))
		{
			$jsondata['message'] = 'Please Enter email';
		}
		else if(!preg_match("/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/",$this->input->post('email'))) 
		{
			$jsondata['message'] = 'Please Enter Valid Email';
		} */
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
						'email' => '',
						'mobile' => $this->input->post('phone'),
						'message' => $this->input->post('content'),
						'reqtype' => 1
				);
				
			$message = "Request Type - Estimate <br>Name -".$this->input->post('name')."<br>Mobile -".$this->input->post('phone')."<br>Message -".$this->input->post('content');

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

			$this->email->from('shaktitravels59@gmail.com');
			$list = array('shaktitravels59@gmail.com');
			$this->email->to($list);
			$this->email->subject('Estimate Request');
			$this->email->message($message);
			
			$this->email->send();
				
			$added = $this->Estimate_Model->insert($data);
		
			if($added)
			{
				$jsondata['code'] = 1;
				$jsondata['message'] = 'Your Estimate Request Submitted Successfully We Will Contact You Within 24 Hours Thank You.';
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
