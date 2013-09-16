<?php
class Role extends CI_Model {
	
	function search($role){
		$this->db->from('mst_role');
		$this->db->like('role_name', $role);
		
		return $this->db->get()->result();
	}
	
	function getAllRoles(){
		return $this->db->get_where('mst_role')->result();
	}
	
	function getRoleById($role){
		$query = $this->db->get_where('mst_role', array('role_id'=>$role));
		return $query->row();
	}
	
	function getRoleByName($role_name){
		$query = $this->db->get_where('mst_role', array('role_name'=>$role_name));
		return $query->row();
	}
	
	function getPermissionByRole($role){
		$this->db->select('mst_permission.permission_id, mst_permission.permission_name');
		$this->db->from('rts_role_permission');
		$this->db->join('mst_permission', 'rts_role_permission.permission_id = mst_permission.permission_id');
		$this->db->where(array('rts_role_permission.role_id'=>$role));
		$this->db->order_by('mst_permission.permission_id', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function getAvailablePermission($selectedPermission){
		$this->db->from('mst_permission');
		if($selectedPermission != null){
			foreach($selectedPermission as $permission){
				$this->db->where(array('permission_id !='=>$permission->permission_id));
			}
		}
		$this->db->order_by('permission_id', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function getPermissionBySelectedPermission($selectedPermission){
		$this->db->from('mst_permission');
		if($selectedPermission != null){
			$isFirst = true;
			foreach($selectedPermission as $permission){
				if($isFirst){
					$this->db->where(array('permission_id'=>$permission));
					$isFirst = false;
				} else {
					$this->db->or_where(array('permission_id'=>$permission));
				}
			}
		}
		$this->db->order_by('permission_id', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	
}
?>