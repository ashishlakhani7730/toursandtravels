<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/Tinypng.php');
class Specialpackage extends CI_Controller {

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
			$this->load->view('admin/specialpackage',$data);
		}
	}
	
	private function getdata()
	{
		$this->db->select("*");
		$this->db->from("spepackage");
		$this->db->order_by("spid", "desc");
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function addSpecialpackage()
	{
		$session = $this->session->userdata('isLogin');
		
		if($session == FALSE)
		{
			redirect('admin/Login');
		}
		else if($this->session->userdata('isLoginid') && $this->session->userdata('isLoginusername'))
		{
			 $data['records'] = $this->getdata();
			 
			 $this->form_validation->set_rules('packagetype', 'Package Type', 'required','regex_match[/^[1-2]*$/]');
			
			 if(empty($_FILES['pimage']['name']))
			 {
				$this->form_validation->set_rules('pimage', 'Package Image', 'required');
			 }
			
			 $this->form_validation->set_rules('pname', 'Package Name', 'required|min_length[3]|max_length[50]|regex_match[/^[a-zA-Z\s]*$/]');
			
			 if($this->form_validation->run() == FALSE) 
			 {
				$this->load->view('admin/specialpackage',$data);
			 }
			 else
			 {
				if($_FILES['pimage']['error'] == 0)
				{
						//upload and update the file
						$config['upload_path'] = 'uploads/spepackage/';
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['max_size']	= '2048000';// // Can be set to particular file size , here it is 2

						$this->load->library('upload', $config);

						if(!$this->upload->do_upload('pimage'))
						{
							$this->session->set_flashdata('fail_message', $this->upload->display_errors('', ''));
							redirect('admin/Specialpackage',$data);
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
								redirect('admin/Specialpackage',$data);
							}
							
							/* above code upload image with resize and then now we call to the tinypng api
							   for compress the image file. */
							$tinypng = new TinyPNG(TINY_PNG_KEY);
							$tinypng->tinify_image("uploads/spepackage/".$_FILES['pimage']['name']);
							
							$rename = explode(".",$_FILES['pimage']['name']);
							$thumbname = $rename[0]."_thumb.".$rename[1];
							
							$tinypng->tinify_image("uploads/spepackage/".$thumbname);
							
							$dest_data = array(	
								'pimage' => "uploads/spepackage/".$_FILES['pimage']['name'],
								'pimage_thumb' => "uploads/spepackage/".$thumbname,
								'pname' => $this->input->post('pname'),
								'packagetype' => $this->input->post('packagetype')
							);
							
							$data = $this->Specialpackage_Model->addspepackage($dest_data);
							
							$this->session->set_flashdata('message', 'Your Special Package Added Successfully!');
							redirect('admin/Specialpackage',$data);
						}
				}
			 }
		}
	}
	
	public function delspepackage()
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
			
			$this->Specialpackage_Model->delspepackage($id);
			
			$re_name = explode(".",$imagename);
			$thumb_name = $re_name[0]."_thumb.".$re_name[1];
			
			if (file_exists("uploads/spepackage/".$imagename)) {
					unlink("uploads/spepackage/".$imagename);
			}
			
			if (file_exists("uploads/spepackage/".$thumb_name)) {
					unlink("uploads/spepackage/".$thumb_name);
			}
			
			$this->session->set_flashdata('message', 'Your Special Package Deleted Successfully!');
			redirect('admin/Specialpackage',$data);
		}
	}
}