<?php
class ChangePassword extends CI_Controller {
	
	public function index(){
		$this->loadView('framework/changepassword');
	}
	
	public function change(){
		$oldpassword = $this->input->post('oldpassword');
		$newpassword = $this->input->post('newpassword');
		$repassword = $this->input->post('repassword');
		
		if($oldpassword == null || strlen($oldpassword) <= 0 ||
				$newpassword == null || strlen($newpassword) <= 0 ||
				$repassword == null || strlen($repassword) <= 0){
			$this->addHeaderMsg('Please enter require field', 'error');
			redirect('changepassword');
			return;
		}
		
		if($newpassword != $repassword){
			$this->addHeaderMsg('New password conbiantion is not match', 'error');
			redirect('changepassword');
			return;
		}
		
		$returnMessage = $this->authorization->changepassword($oldpassword, $newpassword);
		$this->addHeaderMsg($returnMessage['message'], $returnMessage['type']);
		redirect('changepassword');
	}
	
}
?>