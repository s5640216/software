<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	protected $data = array();
	function __construct(){
		parent::__construct();
			date_default_timezone_set("Asia/Taipei");
			$this->load->model('login/login_model', 'loginModel');
			$this->load->model('login/register_model', 'registerModel');
			$this->_check_is_login();
	}

	public function index() {
		$this->load->view('login/login');
	}

	public function _check_is_login(){
		if($this->session->userdata('isLogin'))
			header("Location:".base_url()."home");
	}
	
	public function dologin($isajax = NULL){
		$account = $this->input->post('account');
		$passwd = $this->input->post('passwd');
		$passwd = md5($passwd);
		$userInfo = $this->loginModel->getUserInfo($account)->row_array(); 
		if($userInfo['account'] == $account && $userInfo['passwd'] == $passwd){
			$status = "success";
			$this->session->set_userdata($userInfo);
			$this->session->set_userdata('isLogin', true); 
		} else {
			$status = "fail";
		}
		
		if($isajax)
			echo json_encode(array('status' => $status));
	}
	
	public function logout(){
		$this->session->sess_destroy();
		header('Location:'.base_url().'home');
	}
	
	function register(){
		$name = $this->input->post('name');
		$account = $this->input->post('account');
		$passwd = $this->input->post('passwd');
		$passwd2 = $this->input->post('passwd2');
		$email = $this->input->post('email');
		$sex = $this->input->post('sex');
		$status = "fail";
		$message = "註冊失敗";
		
		$check_passwd2_status = $this->_check_passwd2($passwd,$passwd2);
		if($check_passwd2_status === false){
			$message = "兩次的密碼不符合。";
		}
		
		$check_account_status = $this->_check_account($account);
		if($check_account_status === false){
			$message = "此帳號已被註冊過。";
		}
		
		// $check_email_status = $this->_check_email($email);
		// if($check_email_status === false){
			// $message = "此email已被註冊過。";
		// }
		
		if($check_account_status === true && $check_passwd2_status === true){
			date_default_timezone_set("Asia/Taipei");
			$data = array(
				'account' => $account,
				'passwd' => md5($passwd),
				'name' => $name,
				'purview' => PURVIEW_MEMBER,
				'email' =>	$email,
				'sex' => $sex,
				'register_date' => date( "Y-m-d  H:i:s" )
			);
			$uid = $this->registerModel->insertAccount($data);
			if($uid){
				$status = "success";
				$message = "註冊成功";
			}
		}
		
		echo json_encode(array('status' => $status, 'message' => $message));
	}
	
	function _check_passwd2($passwd,$passwd2){
		if($passwd == $passwd2)
			return true;
		else
			return false;
	}
	
	function _check_account($account){
		$row_num = $this->registerModel->getUserInfo($account)->num_rows();
		if($row_num == 0)
			return true;
		else
			return false;
	}
	
	function _check_email($email){
		$row_num = $this->registerModel->getUserInfobyEmail($email)->num_rows();
		if($row_num == 0)
			return true;
		else
			return false;
	}
	
}
