<?php
class Admin extends CI_Controller {
	
	public function index(){
		redirect('admin/user/search');
	}
	
	public function user($action=null){
		$data = null;
		if($action == 'addEdit'){
		} else if($action == 'save'){
		} else if($action == 'search'){
		} else if($action == 'result'){
			$this->load->model('framework/user');
			$data['result'] = $this->user->search($this->input->post('username'));
		} else {
			$action = 'search';
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