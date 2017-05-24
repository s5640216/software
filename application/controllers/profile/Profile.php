<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . '/controllers/common/Common.php';
class Profile extends Common {
	
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$uid = $this->session->userdata('uid');
		$this->data['user'] = $this->accountModel->getUserInfo_by_uid($uid)->row_array();
		$this->layout->view('profile/index', $this->data);
	}
	
	function change_passwd(){
		$oldpasswd = $this->input->post('oldpasswd');
		$newpasswd = $this->input->post('newpasswd');
		$newpasswd2 = $this->input->post('newpasswd2');
		$uid = $this->session->userdata('uid');
		
		if(empty($oldpasswd) || empty($newpasswd) || empty($newpasswd2)){
			$status = 'fail';
			$message = "欄位不能為空。";
			echo json_encode(array('status' => $status, 'message' => $message));
			return;
		}
		$oldpasswd = md5($oldpasswd);
		$newpasswd = md5($newpasswd);
		$newpasswd2 = md5($newpasswd2);
		
		if($oldpasswd != $this->session->userdata('passwd')){
			$status = 'fail';
			$message = "密碼錯誤。";
			echo json_encode(array('status' => $status, 'message' => $message));
			return;
		}
		
		if($newpasswd != $newpasswd2){
			$status = 'fail';
			$message = "兩次的密碼不符合。";
			echo json_encode(array('status' => $status, 'message' => $message));
			return;
		}
		$data = array('passwd' => $newpasswd);
		$res = $this->accountModel->update_account($uid, $data);
		$this->session->set_userdata('passwd', $newpasswd);
		$status = 'success';
		$message = "更改成功。";
		echo json_encode(array('status' => $status, 'message' => $message));
	}
}
