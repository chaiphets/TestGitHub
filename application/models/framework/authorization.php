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
		
		$this->db->select('permission_id, controller');
		$isFirst = true;
		foreach($queryPermission->result() as $row){
			if($isFirst){
				$this->db->where('permission_id', $row->permission_id);
				$isFirst = false;
			} else {
				$this->db->or_where('permission_id', $row->permission_id);
			}
		}
		$this->db->order_by('sorting', 'asc');
		$queryController = $this->db->get('mst_permission');
		$i = 0;
		foreach($queryController->result() as $row){
			$permission[$i] = $row->permission_id;
			$controller[$i++] = $row->controller;
		}
		$authorize['controller'] = $controller;
		
		$isFirst = true;
		foreach($permission as $row){
			if($isFirst){
				$this->db->where('permission_id', $row);
				$isFirst = false;
			} else {
				$this->db->or_where('permission_id', $row);
			}
		}
		$this->db->order_by('menu_id', 'asc');
		$queryMenu = $this->db->get('mst_menu');
		
		$authorize['menu'] = $queryMenu->result();
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
	
	function changePassword($oldpassword, $newpassword){
		$authorize = $this->session->userdata('userSession');
		$username = $authorize['username'];
		$posId = $this->getAuthenticate($username, $oldpassword);
		if($posId == 0){
			$returnMessage['message'] = 'Current password is invalid';
			$returnMessage['type'] = 'error';
			return $returnMessage;
		}
		
		$this->db->update('mst_user', array('password' => sha1($newpassword)), array('username' => $username));
		
		$returnMessage['message'] = 'Change password successfully';
		$returnMessage['type'] = 'success';
		return $returnMessage;
	}
	
}
?>