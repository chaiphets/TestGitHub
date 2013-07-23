<?php
class Authentication extends CI_Controller {
	
	public function index(){
		$this->loadView('framework/login');
	}
	
	public function login(){
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		
		if($user == null || $pass == null || strlen($user) == 0 || strlen($pass) == 0){
			redirect('authentication');
			return;
		}
		
		$posId = $this->authorization->getAuthenticate($user, $pass);
		if($posId == 0){
			$this->addHeaderMsg('Incorrect username or password / ใส่รหัสไม่ถูกต้อง', 'error');
			redirect('authentication');
			return;
		}
		
		$authorize = $this->authorization->getAuthorize($posId);
		$authorize['username'] = $user;
		$this->session->set_userdata('userSession', $authorize);
		
// 		TODO redirect to your home page after authentication successfully
// 		redirect('your_controller');
		redirect('admin/user');
	}
	
	public function logout(){
		$this->session->unset_userdata('userSession');
		redirect();
	}
}
?>