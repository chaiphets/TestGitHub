<?php
class User extends CI_Model {
	
	function search($username){
		$this->db->select('username, position_name, enable_flag');
		$this->db->from('mst_user');
		$this->db->join('mst_position', 'mst_position.position_id = mst_user.position_id');
		$this->db->like('username', $username);
		
		return $this->db->get()->result();
	}
	
	function getAllPositions(){
		return $this->db->get_where('mst_position')->result();
	}
	
	function getUser($username){
		$query = $this->db->get_where('mst_user', array('username'=>$username));
		return $query->row();
	}
	
}
?>