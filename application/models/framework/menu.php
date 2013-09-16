<?php
class Menu extends CI_Model {
	
	function getAllMenus(){
		$this->db->order_by('menu_order', 'asc');
		return $this->db->get_where('mst_menu')->result_array();
	}
	
	function getAllMainMenus(){
		$this->db->from('mst_menu');
		$this->db->join('mst_permission', 'mst_menu.permission_id = mst_permission.permission_id');
		$this->db->where(array('menu_order % 100 = '=>0));
		$this->db->order_by('menu_order', 'asc');
		return $this->db->get()->result();
	}
	
	function getMenuByName($name){
		return $this->db->get_where('mst_menu', array('menu_name'=>$name))->row_array();
	}
	
	function getLatestMain(){
		$this->db->order_by('menu_order', 'desc');
		return $this->db->get_where('mst_menu', array('menu_order %100 = '=>0))->row_array();
	}
	
	function getLatestSub($main){
		$mainMenu = $this->getMenuByName($main);
		$this->db->order_by('menu_order', 'desc');
		return $this->db->get_where('mst_menu', array('menu_order >='=>$mainMenu['menu_order'], 'menu_order <'=>$mainMenu['menu_order']+100))->row_array();
	}
	
}
?>