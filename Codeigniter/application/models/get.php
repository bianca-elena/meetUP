<?php

Class Get extends CI_Model{
	
	public function get_locations(){

          $this->db->where('id',$_COOKIE["urweb"] );
          $result = $this->db->get('locations');
          return $result->result_array();
	}
}


?>
