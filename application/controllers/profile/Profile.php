<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . '/controllers/common/common.php';
class Profile extends common {
	
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$uid = $this->session->userdata('uid');
		$this->data['user'] = $this->accountModel->getUserInfo_by_uid($uid)->row_array();
		// print_r($this->data['user'] );
		$this->layout->view('profile/index', $this->data);
	}


	
}
