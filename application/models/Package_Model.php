<?php 
   class Package_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 
   
      public function addPackage($data) {
		 $this->db->set('created_date', 'NOW()', FALSE);
         if ($this->db->insert("package", $data)) { 
            return true; 
         } 
      }  
	  
	  public function delPackage($id) {
		  if ($this->db->delete("package", "pid = ".$id)) { 
            return true; 
         } 
	  }
	  
	  public function updatePackage($data,$id) {
		  $this->db->set('modify_date', 'NOW()', FALSE);
		  $this->db->where('pid', $id);
		  if ( $this->db->update('package', $data)) { 
            return true; 
         } 
	  }
   }