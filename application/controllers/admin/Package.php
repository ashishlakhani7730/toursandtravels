<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/Tinypng.php');
class Package extends CI_Controller {

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
			$this->load->view('admin/package',$data);
		}
	}
	
	private function getdata()
	{
		$this->db->select("*");
		$this->db->from("package");
		$this->db->order_by("pid", "desc");
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function addPackage()
	{
		$session = $this->session->userdata('isLogin');
		
		if($session == FALSE)
		{
			redirect('admin/Login');
		}
		else if($this->session->userdata('isLoginid') && $this->session->userdata('isLoginusername'))
		{
			//print_r($_FILES);
			//print_r($this->input->post()); exit;
			 $data['records'] = $this->getdata();
			 
			 $this->form_validation->set_rules('packagetype', 'Package Type', 'required','regex_match[/^[1-2]*$/]');
			
			 if(empty($_FILES['packageimage']['name']))
			 {
				$this->form_validation->set_rules('packageimage', 'Package Image', 'required');
			 }
			
			$this->form_validation->set_rules('packagename', 'Package Name', 'required|min_length[3]|max_length[256]|regex_match[/^[a-zA-Z\s]*$/]',array('regex_match'=>'Enter Only Characters In Package Name!'));
			$this->form_validation->set_rules('placename', 'Place Name', 'required|min_length[3]|max_length[512]|regex_match[/^[a-zA-Z\s]*$/]',array('regex_match'=>'Enter Only Characters In Place Name!'));
			$this->form_validation->set_rules('totalday', 'Total Days', 'regex_match[/^[1-9][0-9]*$/]',array('regex_match'=>'Enter Only Number In Total Days!'));
			$this->form_validation->set_rules('totalnight', 'Total Night', 'regex_match[/^[1-9][0-9]*$/]',array('regex_match'=>'Enter Only Number In Total Nights!'));
			$this->form_validation->set_rules('price', 'Price', 'required');
			$this->form_validation->set_rules('description', 'Description', 'min_length[3]');
			$this->form_validation->set_rules('sdate', 'Package Start Date', 'min_length[3]');
			$this->form_validation->set_rules('edate', 'Package End Date', 'min_length[3]|max_length[50]|regex_match[/^[0-9\/\-]/]',array('regex_match'=>'Enter Valid Date Format IN End date - DD/MM/YYYY !'));
			$this->form_validation->set_rules('pickup', 'Pickup Point', 'min_length[3]|max_length[50]|regex_match[/^[a-zA-Z,()-.\s]*$/]');
			$this->form_validation->set_rules('pdatetime', 'Pickup Date Time', 'min_length[3]|max_length[50]|regex_match[/[0-3][0-9]\/[0-1][0-9]\/[0-9]{4} [0-1][0-9]:[0-5][0-9] [paPA][Mm]/]',array('regex_match'=>'Enter Valid DateTime Format IN Pickup DateTime - (01/01/2000 4:30 AM)!'));
			
			
			 if($this->form_validation->run() == FALSE) 
			 {
				$this->load->view('admin/package',$data);
			 }
			 else
			 {
				if($_FILES['packageimage']['error'] == 0)
				{
						//upload and update the file
						$config['upload_path'] = 'uploads/package/';
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['max_size']	= '2048000';// // Can be set to particular file size , here it is 2

						$this->load->library('upload', $config);

						if(!$this->upload->do_upload('packageimage'))
						{
							$this->session->set_flashdata('fail_message', $this->upload->display_errors('', ''));
							redirect('admin/package',$data);
						}
						else
						{
							//Image Resizing
							$config['image_library'] = 'gd2';
							$config['quality'] = '100%';
							$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config['maintain_ratio'] = false;
							$config['create_thumb'] = false;
							$config['width'] = 358;
							$config['height'] = 198;

							$this->load->library('image_lib', $config);

							if (!$this->image_lib->resize()){
								$this->session->set_flashdata('fail_message', $this->image_lib->display_errors('', ''));
								redirect('admin/package',$data);
							}
							
							/* above code upload image with resize and then now we call to the tinypng api
							   for compress the image file. */
							$tinypng = new TinyPNG(TINY_PNG_KEY);
							$tinypng->tinify_image("uploads/package/".$_FILES['packageimage']['name']);
							
							$pack_data = array(	
								'pimage' => "uploads/package/".$_FILES['packageimage']['name'],
								'pname' => $this->input->post('packagename'),
								'place' => $this->input->post('placename'),
								'days' => $this->input->post('totalday'),
								'nights' => $this->input->post('totalnight'),
								'price' => $this->input->post('price'),
								'description' => $this->input->post('description'),
								'psdate' => $this->input->post('sdate'),
								'pedate' => $this->input->post('edate'),
								'pickuppoint' => $this->input->post('pickup'),
								'pickupdatetime' => $this->input->post('pdatetime'),
								'packagetype' => $this->input->post('packagetype')
							);
							
							$data = $this->Package_Model->addPackage($pack_data);
							
							$this->session->set_flashdata('message', 'Your Package Added Successfully!');
							redirect('admin/package',$data);
						}
				}
			 }
		}
	}
	
	public function getupdata()
	{
		$id = $this->uri->segment(4);
		
		$this->db->select("*");
		$this->db->from("package");
		$this->db->where("pid", $id);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function updatePackage()
	{
		$data['value'] = $this->getupdata();
		
		//echo "<pre>"; print_r($data['value']); exit;
		$this->load->view('admin/updatepackage',$data);
	}
	
	public function upPackage()
	{
		$session = $this->session->userdata('isLogin');
		
		if($session == FALSE)
		{
			redirect('admin/Login');
		}
		else if($this->session->userdata('isLoginid') && $this->session->userdata('isLoginusername'))
		{
			//print_r($_FILES);
			//print_r($this->input->post()); exit;
			$data['value'] = $this->getupdata();
			 
			$this->form_validation->set_rules('packagetype', 'Package Type', 'required','regex_match[/^[1-2]*$/]');
			
			$this->form_validation->set_rules('packagename', 'Package Name', 'required|min_length[3]|max_length[256]|regex_match[/^[a-zA-Z\s]*$/]',array('regex_match'=>'Enter Only Characters In Package Name!'));
			$this->form_validation->set_rules('placename', 'Place Name', 'required|min_length[3]|max_length[512]|regex_match[/^[a-zA-Z\s]*$/]',array('regex_match'=>'Enter Only Characters In Place Name!'));
			$this->form_validation->set_rules('totalday', 'Total Days', 'regex_match[/^[1-9][0-9]*$/]',array('regex_match'=>'Enter Only Number In Total Days!'));
			$this->form_validation->set_rules('totalnight', 'Total Night', 'regex_match[/^[1-9][0-9]*$/]',array('regex_match'=>'Enter Only Number In Total Nights!'));
			$this->form_validation->set_rules('price', 'Price', 'required');
			$this->form_validation->set_rules('description', 'Description', 'min_length[3]');
			$this->form_validation->set_rules('sdate', 'Package Start Date', 'min_length[3]');
			$this->form_validation->set_rules('edate', 'Package End Date', 'min_length[3]|max_length[50]|regex_match[/^[0-9\/\-]/]',array('regex_match'=>'Enter Valid Date Format IN End date - DD/MM/YYYY !'));
			$this->form_validation->set_rules('pickup', 'Pickup Point', 'min_length[3]|max_length[50]|regex_match[/^[a-zA-Z,()-.\s]*$/]');
			$this->form_validation->set_rules('pdatetime', 'Pickup Date Time', 'min_length[3]|max_length[50]|regex_match[/[0-3][0-9]\/[0-1][0-9]\/[0-9]{4} [0-1][0-9]:[0-5][0-9] [paPA][Mm]/]',array('regex_match'=>'Enter Valid DateTime Format IN Pickup DateTime - (01/01/2000 4:30 AM)!'));
			
			
			 if($this->form_validation->run() == FALSE) 
			 {
				$this->load->view('admin/updatepackage',$data);
			 }
			 else
			 {
				if($_FILES['packageimage']['error'] == 0)
				{
						//upload and update the file
						$config['upload_path'] = 'uploads/package/';
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['max_size']	= '2048000';// // Can be set to particular file size , here it is 2

						$this->load->library('upload', $config);

						if(!$this->upload->do_upload('packageimage'))
						{
							$this->session->set_flashdata('fail_message', $this->upload->display_errors('', ''));
							redirect('admin/updatepackage',$data);
						}
						else
						{
							//Image Resizing
							$config['image_library'] = 'gd2';
							$config['quality'] = '100%';
							$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config['maintain_ratio'] = false;
							$config['create_thumb'] = false;
							$config['width'] = 358;
							$config['height'] = 198;

							$this->load->library('image_lib', $config);

							if (!$this->image_lib->resize()){
								$this->session->set_flashdata('fail_message', $this->image_lib->display_errors('', ''));
								redirect('admin/updatepackage',$data);
							}
							
							/* above code upload image with resize and then now we call to the tinypng api
							   for compress the image file. */
							$tinypng = new TinyPNG(TINY_PNG_KEY);
							$tinypng->tinify_image("uploads/package/".$_FILES['packageimage']['name']);
							
							$pack_data = array(	
								'pimage' => "uploads/package/".$_FILES['packageimage']['name'],
								'pname' => $this->input->post('packagename'),
								'place' => $this->input->post('placename'),
								'days' => $this->input->post('totalday'),
								'nights' => $this->input->post('totalnight'),
								'price' => $this->input->post('price'),
								'description' => $this->input->post('description'),
								'psdate' => $this->input->post('sdate'),
								'pedate' => $this->input->post('edate'),
								'pickuppoint' => $this->input->post('pickup'),
								'pickupdatetime' => $this->input->post('pdatetime'),
								'packagetype' => $this->input->post('packagetype')
								
							);
							
							if (file_exists($this->input->post('pimage'))) {
								unlink($this->input->post('pimage'));
							}
							
							$this->Package_Model->updatePackage($pack_data,$this->uri->segment(4));
							
							$this->session->set_flashdata('message', 'Your Package Update Successfully!');
							redirect('admin/package',$data);
						}
				}
				else
				{
					$pack_data = array(	
								'pimage' => $this->input->post('pimage'),
								'pname' => $this->input->post('packagename'),
								'place' => $this->input->post('placename'),
								'days' => $this->input->post('totalday'),
								'nights' => $this->input->post('totalnight'),
								'price' => $this->input->post('price'),
								'description' => $this->input->post('description'),
								'psdate' => $this->input->post('sdate'),
								'pedate' => $this->input->post('edate'),
								'pickuppoint' => $this->input->post('pickup'),
								'pickupdatetime' => $this->input->post('pdatetime'),
								'packagetype' => $this->input->post('packagetype')
							);
							
							$this->Package_Model->updatePackage($pack_data,$this->uri->segment(4));
							
							$this->session->set_flashdata('message', 'Your Package Update Successfully!');
							redirect('admin/package',$data);
				}
			 }
		}
	}
	
	public function delPackage()
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
			
			$this->Package_Model->delPackage($id);
			
			if (file_exists("uploads/package/".$imagename)) {
					unlink("uploads/package/".$imagename);
			}
			
			$this->session->set_flashdata('message', 'Your Package Deleted Successfully!');
			redirect('admin/package',$data);
		}
	}
}
