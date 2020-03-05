<?php 
   class Login_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 
   
      public function loginMatch($data) {
		  
			$this->db->select("*");
			$this->db->from("tbl_login");
			$this->db->where("EMAIL", $data['EMAIL']);
			$this->db->where("CONTACTNO", $data['CONTACTNO']);
			$this->db->where("PWD", $data['PWD']);
			$query = $this->db->get();
		
			if(!empty($query->result()))
			{
				return $query->result();
			}
			else
			{
				return false;
			}
			
      }  
	  
	  public function delDestination($id) {
		  if ($this->db->delete("dest_services", "dsid = ".$id)) { 
            return true; 
         } 
	  }
   }