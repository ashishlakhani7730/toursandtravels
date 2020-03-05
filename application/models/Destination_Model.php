<?php 
   class Destination_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 
   
      public function addDestination($data) {
         if ($this->db->insert("dest_services", $data)) { 
            return true; 
         } 
      }  
	  
	  public function delDestination($id) {
		  if ($this->db->delete("dest_services", "dsid = ".$id)) { 
            return true; 
         } 
	  }
   }