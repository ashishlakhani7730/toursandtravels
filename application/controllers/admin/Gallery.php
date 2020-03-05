<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/Tinypng.php');
class Gallery extends CI_Controller {

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
			$this->load->view('admin/gallery',$data);
		}
	}
	
	private function getdata()
	{
		$this->db->select("*");
		$this->db->from("gallery");
		$this->db->order_by("gid", "desc");
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function addGallery()
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
				$this->load->view('admin/Gallery',$data);
			 }
			 else
			 {
				if($_FILES['cityimage']['error'] == 0)
				{
						//upload and update the file
						$config['upload_path'] = 'uploads/gallery/';
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['max_size']	= '2048000';// // Can be set to particular file size , here it is 2

						$this->load->library('upload', $config);

						if(!$this->upload->do_upload('cityimage'))
						{
							$this->session->set_flashdata('fail_message', $this->upload->display_errors('', ''));
							redirect('admin/Gallery',$data);
						}
						else
						{
							//Image Resizing
							$config['image_library'] = 'gd2';
							$config['quality'] = '100%';
							$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config['maintain_ratio'] = false;
							$config['create_thumb'] = true;
							$config['width'] = 270;
							$config['height'] = 270;

							$this->load->library('image_lib', $config);

							if (!$this->image_lib->resize()){
								$this->session->set_flashdata('fail_message', $this->image_lib->display_errors('', ''));
								redirect('admin/Gallery',$data);
							}
							
							/* above code upload image with resize and then now we call to the tinypng api
							   for compress the image file. */
							$tinypng = new TinyPNG(TINY_PNG_KEY);
							$tinypng->tinify_image("uploads/gallery/".$_FILES['cityimage']['name']);
							
							$rename = explode(".",$_FILES['cityimage']['name']);
							$thumbname = $rename[0]."_thumb.".$rename[1];
							
							$tinypng->tinify_image("uploads/gallery/".$thumbname);
							
							$dest_data = array(	
								'city' => $this->input->post('cityname'),
								'image' => "uploads/gallery/".$_FILES['cityimage']['name'],
								'thumbimage' => "uploads/gallery/".$thumbname
							);
							
							$data = $this->Gallery_Model->addGallery($dest_data);
							
							$this->session->set_flashdata('message', 'Your City Added Successfully!');
							redirect('admin/Gallery',$data);
						}
				}
			 }
		}
	}
	
	public function delGallery()
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
			$imagename = $this->uri->segment(7);
			
			$this->Gallery_Model->delGallery($id);
			
			$re_name = explode(".",$imagename);
			$thumb_name = $re_name[0]."_thumb.".$re_name[1];
			
			if (file_exists("uploads/gallery/".$imagename)) {
					unlink("uploads/gallery/".$imagename);
			}
			
			if (file_exists("uploads/gallery/".$thumb_name)) {
					unlink("uploads/gallery/".$thumb_name);
			}
			
			$this->session->set_flashdata('message', 'Your City Deleted Successfully!');
			redirect('admin/Gallery',$data);
		}
	}
}
