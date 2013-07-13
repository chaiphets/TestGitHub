<?php
class Authorization extends CI_Model {
	
	function getAuthenticate($username, $password){
		$this->db->select('position_id');
		$where = array('username'=>$username, 'password'=>sha1($password), 'enable_flag'=>1);
		$query = $this->db->get_where('mst_user', $where);

		if($query->num_rows() != 1){
			return 0;
		}
		
		$posId = $query->row()->position_id;
		
		$this->db->set('last_login', 'NOW()', FALSE);
		$this->db->where('username', $username);
		$this->db->update('mst_user');
		
		return $posId;
	}
	
	function getAuthorize($posId){
		$this->db->select('role_id');
		$queryRole = $this->db->get_where('rts_position_role', array('position_id'=>$posId));
		
		$this->db->select('permission_id');
		$isFirst = true;
		foreach($queryRole->result() as $row){
			if($isFirst){
				$this->db->where('role_id', $row->role_id);
				$isFirst = false;
			} else {
				$this->db->or_where('role_id', $row->role_id);
			}
		}
		$queryPermission = $this->db->get('rts_role_permission');
		
		$this->db->select('controller');
		$isFirst = true;
		foreach($queryPermission->result() as $row){
			if($isFirst){
				$this->db->where('permission_id', $row->permission_id);
				$isFirst = false;
			} else {
				$this->db->or_where('permission_id', $row->permission_id);
			}
		}
		$queryController = $this->db->get('mst_permission');
		$i = 0;
		foreach($queryController->result() as $row){
			$authorize[$i++] = $row->controller;
		}
		return $authorize;
	}
	
	function checkAuthorize($controller){
		$query = $this->db->get_where('mst_permission', array('controller'=>$controller));
		if($query->num_rows() > 0){
			return true;
		} else {
			return false;
		}
	}
	
}
?>