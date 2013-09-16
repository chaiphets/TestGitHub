<?php
class Position extends CI_Model {
	
	function search($position){
		$this->db->from('mst_position');
		$this->db->like('position_name', $position);
		
		return $this->db->get()->result();
	}
	
	function getAllPositions(){
		return $this->db->get_where('mst_position')->result();
	}
	
	function getPositionById($position){
		$query = $this->db->get_where('mst_position', array('position_id'=>$position));
		return $query->row();
	}
	
	function getPositionByName($position_name){
		$query = $this->db->get_where('mst_position', array('position_name'=>$position_name));
		return $query->row();
	}
	
	function getRoleByPosition($position){
		$this->db->select('mst_role.role_id, mst_role.role_name');
		$this->db->from('rts_position_role');
		$this->db->join('mst_role', 'rts_position_role.role_id = mst_role.role_id');
		$this->db->where(array('rts_position_role.position_id'=>$position));
		$this->db->order_by('mst_role.role_id', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function getAvailableRole($selectedRole){
		$this->db->from('mst_role');
		if($selectedRole != null){
			foreach($selectedRole as $role){
				$this->db->where(array('role_id !='=>$role->role_id));
			}
		}
		$this->db->order_by('role_id', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function getRoleBySelectedRole($selectedRole){
		$this->db->from('mst_role');
		if($selectedRole != null){
			$isFirst = true;
			foreach($selectedRole as $role){
				if($isFirst){
					$this->db->where(array('role_id'=>$role));
					$isFirst = false;
				} else {
					$this->db->or_where(array('role_id'=>$role));
				}
			}
		}
		$this->db->order_by('role_id', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	
}
?>