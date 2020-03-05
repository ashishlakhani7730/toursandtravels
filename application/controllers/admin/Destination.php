<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/Tinypng.php');
class Destination extends CI_Controller {

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
			$this->load->view('admin/destination',$data);
		}
	}
	
	private function getdata()
	{
		$this->db->select("*");
		$this->db->from("dest_services");
		$this->db->order_by("dsid", "desc");
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function addDestination()
	{
		$session = $this->session->userdata('isLogin');
		
		if($session == FALSE)
		{
			redirect('admin/Login');
		}
		else if($this->session->userdata('isLoginid') && $this->session->userdata('isLoginusername'))
		{
			 $data['records'] = $this->getdata();
			
			 if(empty($_FILES['cityimage']['name']))
			 {
				$this->form_validation->set_rules('cityimage', 'City Image', 'required');
			 }
			
			 $this->form_validation->set_rules('cityname', 'City Name', 'required|min_length[3]|max_length[50]|regex_match[/^[a-zA-Z\s]*$/]');
			
			 if($this->form_validation->run() == FALSE) 
			 {
				$this->load->view('admin/destination',$data);
			 }
			 else
			 {
				if($_FILES['cityimage']['error'] == 0)
				{
						//upload and update the file
						$config['upload_path'] = 'uploads/';
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['max_size']	= '2048000';// // Can be set to particular file size , here it is 2

						$this->load->library('upload', $config);

						if(!$this->upload->do_upload('cityimage'))
						{
							$this->session->set_flashdata('fail_message', $this->upload->display_errors('', ''));
							redirect('admin/Destination',$data);
						}
						else
						{
							//Image Resizing
							$config['image_library'] = 'gd2';
							$config['quality'] = '100%';
							$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config['maintain_ratio'] = false;
							$config['create_thumb'] = false;
							$config['width'] = 277;
							$config['height'] = 277;

							$this->load->library('image_lib', $config);

							if (!$this->image_lib->resize()){
								$this->session->set_flashdata('fail_message', $this->image_lib->display_errors('', ''));
								redirect('admin/Destination',$data);
							}
							
							/* above code upload image with resize and then now we call to the tinypng api
							   for compress the image file. */
							$tinypng = new TinyPNG(TINY_PNG_KEY);
							$tinypng->tinify_image("uploads/".$_FILES['cityimage']['name']);
							
							$dest_data = array(	
								'city' => $this->input->post('cityname'),
								'image' => "uploads/".$_FILES['cityimage']['name']
							);
							
							$data = $this->Destination_Model->addDestination($dest_data);
							
							$this->session->set_flashdata('message', 'Your City Added Successfully!');
							redirect('admin/Destination',$data);
						}
				}
			 }
		}
	}
	
	public function delDestination()
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
			$imagename = $this->uri->segment(6);
			
			$this->Destination_Model->delDestination($id);
			
			if (file_exists("uploads/".$imagename)) {
					unlink("uploads/".$imagename);
			}
			
			$this->session->set_flashdata('message', 'Your City Deleted Successfully!');
			redirect('admin/Destination',$data);
		}
	}
}