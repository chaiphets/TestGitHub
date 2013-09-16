<?php
class Permission extends CI_Model {
	
	function search($permission){
		$this->db->from('mst_permission');
		$this->db->like('permission_name', $permission);
		
		return $this->db->get()->result();
	}
	
	function getAllPermissions(){
		return $this->db->get_where('mst_permission')->result();
	}
	
	function getPermissionById($permission){
		$query = $this->db->get_where('mst_permission', array('permission_id'=>$permission));
		return $query->row();
	}
	
	function getPermissionByName($permission_name){
		$query = $this->db->get_where('mst_permission', array('permission_name'=>$permission_name));
		return $query->row();
	}
	
}
?>