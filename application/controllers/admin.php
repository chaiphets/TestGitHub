<?php
class Admin extends CI_Controller {
	
	public function index(){
		redirect('admin/user/search');
	}
	
	/**********************************************************************************
	 *										User
	 **********************************************************************************/
	public function user($action='search', $addedUsername = null){
		$this->load->model('framework/user');
		$data = null;
		
		if($action == 'add' || $action == 'edit'){
			$save = $this->input->post('save');
			$username = $this->input->post('username');
			$userPosition = $this->input->post('position');
			$userActive = $this->input->post('active');
		}
		
		if($action == 'add'){
			if($save){
				if(strlen($username) <= 0){
					$this->addHeaderMsg('Please enter username', 'error');
					$validate = false;
				}
				
				if(!$userPosition){
					$this->addHeaderMsg('Please select position', 'error');
					$validate = false;
				}
				
				$user = $this->user->getUser($username);
				if(!empty($user)){
					$this->addHeaderMsg('Duplicate username', 'error');
					$validate = false;
				}
				
				if(!isset($validate)){
					$saveData['username'] = $username;
					$saveData['password'] = sha1('admin');		//FIXME
					$saveData['position_id'] = $userPosition;
					$saveData['enable_flag'] = $userActive=='on'?'1':'0';
					$this->db->set('created_date', 'NOW()', FALSE);
					$this->db->insert('mst_user', $saveData);
					$this->addHeaderMsg('Save successfully', 'success');
					redirect(site_url('admin/user/edit/'.$username));
				}
			}
			
			$data['username'] = $username?$username:'';
			$data['userPosition'] = $userPosition;
			$data['userActive'] = ((!$save&&!$userActive)||$userActive=='on')?'on':'off';
		}elseif($action == 'edit'){
			if($addedUsername != null)
				$username = $addedUsername;
			
			$user = $this->user->getUser($username);
			if(!$username || empty($user)){
				$this->addHeaderMsg('Username does not exist for editing', 'error');
				redirect(site_url('admin/user/search'));
			}
			
			if($save){
				if(strlen($username) <= 0){
					$this->addHeaderMsg('Please enter username', 'error');
					$validate = false;
				}
				
				if(!$userPosition){
					$this->addHeaderMsg('Please select position', 'error');
					$validate = false;
				}
				
				if(!isset($validate)){
					$saveData['position_id'] = $userPosition;
					$saveData['enable_flag'] = $userActive=='on'?'1':'0';
					$this->db->where('username', $username);
					$this->db->update('mst_user', $saveData);
					$this->addHeaderMsg('Save successfully', 'success');
				}
			} else {
				$username = $user->username;
				$userPosition = $user->position_id;
				$userActive = $user->enable_flag;
			}
			
			$data['username'] = $username?$username:'';
			$data['userPosition'] = $userPosition;
			$data['userActive'] = $userActive==1||$userActive=='on'?'on':'off';
		} elseif($action == 'search'){
			$search = $this->input->post('username');
			if($search){
				$data['username'] = $search;
				$data['result'] = $this->user->search($search);
			}
		} else {
			$msg = 'Technical error, please contact administrator. <a href="javascript:window.history.back();">Go back</a>';
			show_error($msg, 503);
		}
		
		if($action == 'add' || $action == 'edit'){
			$data['action'] = $action;
			$data['positions'] = $this->user->getAllPositions();
			$action = 'addEdit';
		}
		
		$this->loadView('framework/admin/user/'.$action, $data);
	}
	
	
	
	
	
	/**********************************************************************************
	 *									Position
	 **********************************************************************************/
	public function position($action='search', $addedPosition = null){
		$this->load->model('framework/position');
		$data = null;
		
		if($action == 'add' || $action == 'edit'){
			$save = $this->input->post('save');
			$position_id = $this->input->post('position_id');
			$position_name = $this->input->post('position_name');
			$description = $this->input->post('description');
			$selectedRoles = $this->input->post('selectedRoles');
		}
		
		if($action == 'add'){
			if($save){
				if(strlen($position_name) <= 0){
					$this->addHeaderMsg('Please enter position name', 'error');
					$validate = false;
				}
			
				if(strlen($description) <= 0){
					$this->addHeaderMsg('Please enter position description', 'error');
					$validate = false;
				}
				
				$position_o = $this->position->getPositionByName($position_name);
				if(!empty($position_o)){
					$this->addHeaderMsg('Duplicate position', 'error');
					$validate = false;
				}
				
				if(!isset($validate)){
					$saveData['position_name'] = $position_name;
					$saveData['position_description'] = $description;
					$this->db->insert('mst_position', $saveData);
					
					$position_o = $this->position->getPositionByName($position_name);
					$position_id = $position_o->position_id;
					
					$this->db->delete('rts_position_role', array('position_id' => $position_id));
					if(strlen($selectedRoles) > 0){
						$selectedRoles = explode(',', $selectedRoles);
						foreach($selectedRoles as $role){
							$this->db->insert('rts_position_role', array('position_id' => $position_id, 'role_id' => $role));
						}
					}
					
					$this->addHeaderMsg('Save successfully', 'success');
					redirect(site_url('admin/position/edit/'.$position_id));
				}
			}
			
			if(strlen($selectedRoles) > 0){
				$selectedRoles = explode(',', $selectedRoles);
				$selectedRoles = $this->position->getRoleBySelectedRole($selectedRoles);
			}
			
			$data['position_id'] = $position_id?$position_id:'Auto Generate';
			$data['position_name'] = $position_name?$position_name:'';
			$data['description'] = $description?$description:'';
			$data['selectedRoles'] = $selectedRoles;
			$data['availableRoles'] = $this->position->getAvailableRole($selectedRoles);
		} else if($action == 'edit'){
			if($addedPosition != null)
				$position_id = $addedPosition;
				
			$position_o = $this->position->getPositionById($position_id);
			if(!$position_id || empty($position_o)){
				$this->addHeaderMsg('Position does not exist for editing', 'error');
				redirect(site_url('admin/position/search'));
			}
			
			if($save){
				if(strlen($position_name) <= 0){
					$this->addHeaderMsg('Please enter position name', 'error');
					$validate = false;
				}
					
				if(strlen($description) <= 0){
					$this->addHeaderMsg('Please enter position description', 'error');
					$validate = false;
				}
					
				if(!isset($validate)){
					$saveData['position_name'] = $position_name;
					$saveData['position_description'] = $description;
					$this->db->where('position_id', $position_id);
					$this->db->update('mst_position', $saveData);
					
					$this->db->delete('rts_position_role', array('position_id' => $position_id));
					if(strlen($selectedRoles) > 0){
						$selectedRoles = explode(',', $selectedRoles);
						foreach($selectedRoles as $role){
							$this->db->insert('rts_position_role', array('position_id' => $position_id, 'role_id' => $role));
						}
					}
					$this->addHeaderMsg('Save successfully', 'success');
				}
			} else {
				$position_id = $position_o->position_id;
				$position_name = $position_o->position_name;
				$description = $position_o->position_description;
			}
			
			$selectedRoles = $this->position->getRoleByPosition($position_id);
			
			$data['position_id'] = $position_id?$position_id:'';
			$data['position_name'] = $position_name?$position_name:'';
			$data['description'] = $description?$description:'';
			$data['selectedRoles'] = $selectedRoles;
			$data['availableRoles'] = $this->position->getAvailableRole($selectedRoles);
		} else if($action == 'search'){
			$search = $this->input->post('position');
			if($search){
				$data['position'] = $search;
				$data['result'] = $this->position->search($search);
			}
		} else {
			$msg = 'Technical error, please contact administrator. <a href="javascript:window.history.back();">Go back</a>';
			show_error($msg, 503);
		}
		
		if($action == 'add' || $action == 'edit'){
			$data['action'] = $action;
			$action = 'addEdit';
		}
		
		$this->loadView('framework/admin/position/'.$action, $data);
	}
	
	
	
	
	
	/**********************************************************************************
	 *										Role
	 **********************************************************************************/
	public function role($action='search', $addedRole = null){
		$this->load->model('framework/role');
		$data = null;
		
		if($action == 'add' || $action == 'edit'){
			$save = $this->input->post('save');
			$role_id = $this->input->post('role_id');
			$role_name = $this->input->post('role_name');
			$description = $this->input->post('description');
			$selectedPermissions = $this->input->post('selectedPermissions');
		}
		
		if($action == 'add'){
			if($save){
				if(strlen($role_name) <= 0){
					$this->addHeaderMsg('Please enter role name', 'error');
					$validate = false;
				}
			
				if(strlen($description) <= 0){
					$this->addHeaderMsg('Please enter role description', 'error');
					$validate = false;
				}
				
				$role_o = $this->role->getRoleByName($role_name);
				if(!empty($role_o)){
					$this->addHeaderMsg('Duplicate role', 'error');
					$validate = false;
				}
				
				if(!isset($validate)){
					$saveData['role_name'] = $role_name;
					$saveData['role_description'] = $description;
					$this->db->insert('mst_role', $saveData);
					
					$role_o = $this->role->getRoleByName($role_name);
					$role_id = $role_o->role_id;
					
					$this->db->delete('rts_role_permission', array('role_id' => $role_id));
					if(strlen($selectedPermissions) > 0){
						$selectedPermissions = explode(',', $selectedPermissions);
						foreach($selectedPermissions as $permission){
							$this->db->insert('rts_role_permission', array('role_id' => $role_id, 'permission_id' => $permission));
						}
					}
					
					$this->addHeaderMsg('Save successfully', 'success');
					redirect(site_url('admin/role/edit/'.$role_id));
				}
			}
			
			if(strlen($selectedPermissions) > 0){
				$selectedPermissions = explode(',', $selectedPermissions);
				$selectedPermissions = $this->role->getPermissionBySelectedPermission($selectedPermissions);
			}
			
			$data['role_id'] = $role_id?$role_id:'Auto Generate';
			$data['role_name'] = $role_name?$role_name:'';
			$data['description'] = $description?$description:'';
			$data['selectedPermissions'] = $selectedPermissions;
			$data['availablePermissions'] = $this->role->getAvailablePermission($selectedPermissions);
		} else if($action == 'edit'){
			if($addedRole != null)
				$role_id = $addedRole;
				
			$role_o = $this->role->getRoleById($role_id);
			if(!$role_id || empty($role_o)){
				$this->addHeaderMsg('Role does not exist for editing', 'error');
				redirect(site_url('admin/role/search'));
			}
			
			if($save){
				if(strlen($role_name) <= 0){
					$this->addHeaderMsg('Please enter role name', 'error');
					$validate = false;
				}
					
				if(strlen($description) <= 0){
					$this->addHeaderMsg('Please enter role description', 'error');
					$validate = false;
				}
					
				if(!isset($validate)){
					$saveData['role_name'] = $role_name;
					$saveData['role_description'] = $description;
					$this->db->where('role_id', $role_id);
					$this->db->update('mst_role', $saveData);
					
					$this->db->delete('rts_role_permission', array('role_id' => $role_id));
					if(strlen($selectedPermissions) > 0){
						$selectedPermissions = explode(',', $selectedPermissions);
						foreach($selectedPermissions as $permission){
							$this->db->insert('rts_role_permission', array('role_id' => $role_id, 'permission_id' => $permission));
						}
					}
					$this->addHeaderMsg('Save successfully', 'success');
				}
			} else {
				$role_id = $role_o->role_id;
				$role_name = $role_o->role_name;
				$description = $role_o->role_description;
			}
			
			$selectedPermissions = $this->role->getPermissionByRole($role_id);
			
			$data['role_id'] = $role_id?$role_id:'';
			$data['role_name'] = $role_name?$role_name:'';
			$data['description'] = $description?$description:'';
			$data['selectedPermissions'] = $selectedPermissions;
			$data['availablePermissions'] = $this->role->getAvailablePermission($selectedPermissions);
		} else if($action == 'search'){
			$search = $this->input->post('role');
			if($search){
				$data['role'] = $search;
				$data['result'] = $this->role->search($search);
			}
		} else {
			$msg = 'Technical error, please contact administrator. <a href="javascript:window.history.back();">Go back</a>';
			show_error($msg, 503);
		}
		
		if($action == 'add' || $action == 'edit'){
			$data['action'] = $action;
			$action = 'addEdit';
		}
		
		$this->loadView('framework/admin/role/'.$action, $data);
	}
	
	
	
	
	
	/**********************************************************************************
	 *									Permission
	 **********************************************************************************/
	public function permission($action='search', $addedPermission = null){
		$this->load->model('framework/permission');
		$data = null;
		
		if($action == 'add' || $action == 'edit'){
			$save = $this->input->post('save');
			$permission_id = $this->input->post('permission_id');
			$permission_name = $this->input->post('permission_name');
			$controller = $this->input->post('controller');
		}
		
		if($action == 'add'){
			if($save){
				if(strlen($permission_name) <= 0){
					$this->addHeaderMsg('Please enter permission name', 'error');
					$validate = false;
				}
					
				if(strlen($controller) <= 0){
					$this->addHeaderMsg('Please enter controller', 'error');
					$validate = false;
				}
		
				$permission_o = $this->permission->getPermissionByName($permission_name);
				if(!empty($permission_o)){
					$this->addHeaderMsg('Duplicate permission', 'error');
					$validate = false;
				}
		
				if(!isset($validate)){
					$saveData['permission_name'] = $permission_name;
					$saveData['controller'] = $controller;
					$this->db->insert('mst_permission', $saveData);
					
					$permission_o = $this->permission->getPermissionByName($permission_name);
					$permission_id = $permission_o->permission_id;
					
					$this->addHeaderMsg('Save successfully', 'success');
					redirect(site_url('admin/permission/edit/'.$permission_id));
				}
			}
				
			$data['permission_id'] = $permission_id?$permission_id:'Auto Generate';
			$data['permission_name'] = $permission_name?$permission_name:'';
			$data['controller'] = $controller?$controller:'';
		} else if($action == 'edit'){
			if($addedPermission != null)
				$permission_id = $addedPermission;
		
			$permission_o = $this->permission->getPermissionById($permission_id);
			if(!$permission_id || empty($permission_o)){
				$this->addHeaderMsg('Permission does not exist for editing', 'error');
				redirect(site_url('admin/permission/search'));
			}
				
			if($save){
				if(strlen($permission_name) <= 0){
					$this->addHeaderMsg('Please enter permission name', 'error');
					$validate = false;
				}
					
				if(strlen($controller) <= 0){
					$this->addHeaderMsg('Please enter controller', 'error');
					$validate = false;
				}
					
				if(!isset($validate)){
					$saveData['permission_name'] = $permission_name;
					$saveData['controller'] = $controller;
					$this->db->where('permission_id', $permission_id);
					$this->db->update('mst_permission', $saveData);
						
					$this->addHeaderMsg('Save successfully', 'success');
				}
			} else {
				$permission_id = $permission_o->permission_id;
				$permission_name = $permission_o->permission_name;
				$controller = $permission_o->controller;
			}
				
			$data['permission_id'] = $permission_id?$permission_id:'';
			$data['permission_name'] = $permission_name?$permission_name:'';
			$data['controller'] = $controller?$controller:'';
		} else if($action == 'search'){
			$search = $this->input->post('permission');
			if($search){
				$data['permission'] = $search;
				$data['result'] = $this->permission->search($search);
			}
		} else {
			$msg = 'Technical error, please contact administrator. <a href="javascript:window.history.back();">Go back</a>';
			show_error($msg, 503);
		}
		
		if($action == 'add' || $action == 'edit'){
			$data['action'] = $action;
			$action = 'addEdit';
		}
		
		$this->loadView('framework/admin/permission/'.$action, $data);
	}
	
	
	
	
	
	/**********************************************************************************
	 *									Menu
	 **********************************************************************************/
	public function menu($action = 'reorder'){
		$this->load->model('framework/menu');
		$this->load->model('framework/permission');
		$data = null;
		
		if($action == 'reorder'){
			if($this->input->post('save')){
				$mains = $this->input->post('mainName');
				$subs = $this->input->post('subName');
				$permissionsMain = $this->input->post('mainPermission');
				$permissionsSub = $this->input->post('subPermission');
				$subMainName = $this->input->post('subMainName');
				
				$rm = 100;
				for($i=0;$i<sizeof($mains);$i++){
					$main = $mains[$i];
					$saveData['menu_order'] = $rm;
					$this->db->where('menu_name', $main);
					$this->db->update('mst_menu', $saveData);
					
					$rs = 1;
					for($j=0;$j<sizeof($subs);$j++){
						$sub = $subs[$j];
						if($main == $subMainName[$j]){
							$saveData['menu_order'] = $rm+($rs++);
							$this->db->where('menu_name', $sub);
							$this->db->update('mst_menu', $saveData);
						}
					}
					$rm+=100;
				}
				$this->addHeaderMsg('Save successfully', 'success');
			}
			
			$data['menus'] = array();
			foreach($this->menu->getAllMenus() as $menu){
				if($menu['menu_order'] % 100 == 0){
					$menu['sub'] = array();
					array_push($data['menus'], $menu);
				} else {
					$main = array_pop($data['menus']);
					array_push($main['sub'], $menu);
					array_push($data['menus'], $main);
				}
			}
		} else if($action == 'main'){
			$permission = $this->input->post('permission');
			$menuName = $this->input->post('menuName');
			$ppath = $this->input->post('ppath');
			$path = $this->input->post('path');
			$subMenu = $this->input->post('subMenu');
			
			if($this->input->post('save')){
				if($permission == 0){
					$this->addHeaderMsg('Please select permission', 'error');
					$validate = false;
				}
				
				if(strlen($menuName) <= 0){
					$this->addHeaderMsg('Please enter menu name', 'error');
					$validate = false;
				}
				
				$menu = $this->menu->getMenuByName($menuName);
				if(!empty($menu)){
					$this->addHeaderMsg('Duplicate menu name', 'error');
					$validate = false;
				}
					
				if(!isset($validate)){
					$saveData['permission_id'] = $permission;
					$saveData['menu_name'] = $menuName;
					$saveData['showSubMenu'] = $subMenu=='on'?1:0;
					$saveData['menu_order'] = $this->menu->getLatestMain()['menu_order']+100;
					$saveData['path'] = $ppath.$path;
					$this->db->insert('mst_menu', $saveData);
				
					$this->addHeaderMsg('Save successfully', 'success');
					redirect(site_url('admin/menu/reorder'));
				}
			}
			
			$data['permissions'] = $this->permission->getAllPermissions();
			$data['menuName'] = $menuName?$menuName:'';
			$data['permission'] = $permission;
			$data['path'] = $path?$path:'';
			$data['subMenu'] = $subMenu=='on'?'on':'off';
		} else if($action == 'sub'){
			$main = $this->input->post('main');
			$menuName = $this->input->post('menuName');
			$ppath = $this->input->post('ppath');
			$path = $this->input->post('path');
			
			if($this->input->post('save')){
				if(!$main){
					$this->addHeaderMsg('Please select main menu', 'error');
					$validate = false;
				}
			
				if(strlen($menuName) <= 0){
					$this->addHeaderMsg('Please enter menu name', 'error');
					$validate = false;
				}
			
				$menu = $this->menu->getMenuByName($menuName);
				if(!empty($menu)){
					$this->addHeaderMsg('Duplicate menu name', 'error');
					$validate = false;
				}
				
				if(strlen($path) <= 0){
					$this->addHeaderMsg('Please enter path', 'error');
					$validate = false;
				}
					
				if(!isset($validate)){
					$menu = $this->menu->getMenuByName($main);
					
					$saveData['permission_id'] = $menu['permission_id'];
					$saveData['menu_name'] = $menuName;
					$saveData['showSubMenu'] = 0;
					$saveData['menu_order'] = $this->menu->getLatestSub($main)['menu_order']+1;
					$saveData['path'] = $ppath.$path;
					$this->db->insert('mst_menu', $saveData);
			
					$data['dump_var'] = $saveData;
					
					$this->addHeaderMsg('Save successfully', 'success');
					redirect(site_url('admin/menu/reorder'));
				}
			}
			
			$data['mainMenus'] = $this->menu->getAllMainMenus();
			$data['main'] = $main?$main:'';
			$data['menuName'] = $menuName?$menuName:'';
			$data['path'] = $path?$path:'';
		} else if($action == 'edit'){
			$menuOrders = $this->input->post('menuOrders');
			
			if($this->input->post('save')){
				
			}
			
		} else {
			$msg = 'Technical error, please contact administrator. <a href="javascript:window.history.back();">Go back</a>';
			show_error($msg, 503);
		}
		
		$this->loadView('framework/admin/menu/'.$action, $data);
	}
}
?>