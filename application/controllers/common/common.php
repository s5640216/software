<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {
	protected $data = array();
	function __construct(){
		parent::__construct();
			date_default_timezone_set("Asia/Taipei");
			$this->_check_is_login();
	}

	public function index() {

	}

	public function _check_is_login(){
		if(!$this->session->userdata('isLogin')){
			header("Location:".base_url()."login/login");
		}
	}
	
	public function _error_404(){
		$this->layout->view('error_404',$this->data);
	}
	
}
