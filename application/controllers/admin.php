<?php
class Admin extends CI_Controller {
	
	public function index(){
		redirect('admin/user/search');
	}
	
	public function user($action='search'){
		$this->load->model('framework/user');
		$data = null;
		
		if($action == 'addEdit'){
			$data['positions'] = $this->user->getAllPositions();
			
			$username = $this->input->post('username');
			$data['username'] = $username;
			$data['userPosition'] = $this->input->post('position');
			$data['userActive'] = true;
			if($username){
				$user = $this->user->getUser($username);
				if(!empty($user)){
					$data['userPosition'] = $user->position_id;
					$data['userActive'] = $user->enable_flag;
				}
			}
			
			$save = $this->input->post('save');
			if($save){
				$data['userPosition'] = $this->input->post('position');
				$data['userActive'] = $this->input->post('active');
				
				if(strlen($username) <= 0){
					$this->addHeaderMsg('Please enter username', 'error');
					$save = 'error';
				}
				
				if(!$data['userPosition']){
					$this->addHeaderMsg('Please select position', 'error');
					$save = 'error';
				}
			}
			if($save == 'add'){
				if(!empty($user)){
					$this->addHeaderMsg('Duplicate username', 'error');
					$data['username'] = false;
				} else {
					$saveData['username'] = $username;
					$saveData['password'] = sha1('admin');
					$saveData['position_id'] = $data['userPosition'];
					$active = $data['userActive'];
					$saveData['enable_flag'] = ($active=='on'||$active==true||$active==1)?'1':'0';
					$this->db->set('created_date', 'NOW()', FALSE);
					$this->db->insert('mst_user', $saveData);
					$this->addHeaderMsg('Save successfully', 'success');
				}
			} else if($save == 'edit') {
				$saveData['position_id'] = $data['userPosition'];
				$active = $data['userActive'];
				$saveData['enable_flag'] = ($active=='on'||$active==true||$active==1)?'1':'0';
				$this->db->where('username', $username);
				$this->db->update('mst_user', $saveData);
				$this->addHeaderMsg('Save successfully', 'success');
			}
			$action = 'addEdit';
		} else if($action == 'search'){
			$search = $this->input->post('username');
			if($search){
				$data['username'] = $search;
				$data['result'] = $this->user->search($search);
			}
		} else {
			$msg = 'Technical error, please contact administrator. <a href="javascript:window.history.back();">Go back</a>';
			show_error($msg, 503);
		}
		
		$this->loadView('framework/admin/user/'.$action, $data);
	}
	
	public function position($action=null){
		
	}
	
	public function role($action=null){
	
	}
	
	public function permission($action=null){
		
	}
	
}
?>