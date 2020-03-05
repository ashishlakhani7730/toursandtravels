<?php class Estimate_Model extends CI_Model {
      function __construct() { 
         parent::__construct(); 
      } 
      public function insert($data) { 
	$this->db->set('created_date', 'NOW()', FALSE);
         if ($this->db->insert("estimate", $data)) { 
            return true; 
         } 
      }  
}