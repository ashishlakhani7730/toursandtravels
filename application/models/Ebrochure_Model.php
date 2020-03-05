<?php 
   class Ebrochure_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 
   
      public function addbrochure($data) {
         if ($this->db->insert("brochure", $data)) { 
            return true; 
         } 
      }  
	  
	  public function delbrochure($id) {
		  if ($this->db->delete("brochure", "bid = ".$id)) { 
            return true; 
         } 
	  }
   }