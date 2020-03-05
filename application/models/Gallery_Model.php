<?php 
   class Gallery_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 
   
      public function addGallery($data) {
         if ($this->db->insert("gallery", $data)) { 
            return true; 
         } 
      }  
	  
	  public function delGallery($id) {
		  if ($this->db->delete("gallery", "gid = ".$id)) { 
            return true; 
         } 
	  }
   }