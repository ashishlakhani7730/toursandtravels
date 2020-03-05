<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		if($this->uri->segment(1) == 'domestic-packages')
		{
			$id = 1;
			$this->db->select("*");
			$this->db->from("package");
			$this->db->where("packagetype",$id);
			$this->db->order_by("pid", "desc");
			$query = $this->db->get();
			
			$data['viewpackage'] = 0;
			$data['records'] = $query->result();
			$this->load->view('package',$data);
		}
		else if($this->uri->segment(1) == 'international-packages')
		{
			$id = 2;
			$this->db->select("*");
			$this->db->from("package");
			$this->db->where("packagetype",$id);
			$this->db->order_by("pid", "desc");
			$query = $this->db->get();
			
			$data['viewpackage'] = 0;
			$data['records'] = $query->result();
			$this->load->view('package',$data);
		}
	}
	
	public function viewPackage()
	{
		$id = $this->uri->segment(3);
		
		$this->db->select("*");
		$this->db->from("package");
		$this->db->where('pid', $id);
		$query = $this->db->get();
		$data['viewpackage'] = 1;
		$data['records'] = $query->result();
		
		if($data['records'])
		{
			$this->load->view('package',$data);
		}
		else
		{
			redirect('Handel404');
		}
	}
	
	public function enquiry_now()
	{
		$jsondata = array('code' => 0);
		
		if($this->input->post('package') == '')
		{
			$jsondata['code'] = 0;
			$jsondata['message'] = 'Please Try After Some Time.';
		}
		else 
		{
			$this->db->select('pid,pname,place');
			$this->db->from("package");
			$this->db->where('pid', $this->input->post('package'));
			$query = $this->db->get();
			
			$package = $query->result();
			
			if(!empty($package))
			{
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
							'reqtype' => 2,
							'pid' => $package[0]->pid,
							'pname' => $package[0]->pname,
							'pplace' => $package[0]->place
					);
						
					$added = $this->Estimate_Model->insert($data);

					$message = "Request Type - Book Package<br>Packagename - ".$package[0]->pname."<br>Package Place - ".$package[0]->place."Name - ".$this->input->post('name')."<br>Mobile - ".$this->input->post('phone')."<br>Message - ".$this->input->post('content');

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
					$this->email->subject('Book Package');
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