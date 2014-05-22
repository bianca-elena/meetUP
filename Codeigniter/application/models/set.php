<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	Class Set extends CI_Model {

	public function add_user($id,$name){

		$this->db->where('id', $id);
		$result = $this->db->get('users');
		$var = $result->result_array();

		if( is_null($var)) {

			$data = array(
   			'id' => $id ,
   			'name' => $name
			);

		$this->db->insert('users', $data); 
		}
		else {};
	}
}
?>