<?php 
   class Specialpackage_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 
   
      public function addspepackage($data) {
         if ($this->db->insert("spepackage", $data)) { 
            return true; 
         } 
      }  
	  
	  public function delspepackage($id) {
		  if ($this->db->delete("spepackage", "spid = ".$id)) { 
            return true; 
         } 
	  }
   }