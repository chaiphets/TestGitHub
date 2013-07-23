<?php
class User extends CI_Model {
	
	function search($username){
		$this->db->select('username');
		$this->db->like('username', $username);
		
		return $this->db->get('mst_user')->result();
	}
	
	function save($username){
		
	}
	
}
?>