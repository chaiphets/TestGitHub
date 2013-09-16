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
		$this->db->select('mst_permission.permission_id, mst_permission.controller');
		$this->db->from('rts_position_role');
		$this->db->join('rts_role_permission', 'rts_position_role.role_id = rts_role_permission.role_id');
		$this->db->join('mst_permission', 'mst_permission.permission_id = rts_role_permission.permission_id');
		$this->db->where('rts_position_role.position_id', $posId);
		$queryController = $this->db->get();
		
		$i = 0;
		$controller = null;
		foreach($queryController->result() as $row){
			$permission[$i] = $row->permission_id;
			$controller[$i++] = $row->controller;
		}
		$authorize['controller'] = $controller;
		
		if($controller != null){
			$isFirst = true;
			foreach($permission as $row){
				if($isFirst){
					$this->db->where('permission_id', $row);
					$isFirst = false;
				} else {
					$this->db->or_where('permission_id', $row);
				}
			}
			$this->db->order_by('menu_order', 'asc');
			$queryMenu = $this->db->get('mst_menu');
			$authorize['menu'] = $queryMenu->result();
		} else {
			$authorize['menu'] = null;
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