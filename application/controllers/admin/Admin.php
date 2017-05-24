<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . '/controllers/common/Common.php';
class Admin extends Common {
	
	function __construct(){
		parent::__construct();
		$this->_check_is_admin();
	}

	public function index() {
		
	}
	
	private function _check_is_admin(){
		$purview_id = $this->session->userdata('purview');
		if($purview_id != PURVIEW_ADMIN){
			show_error('你尚未有權限使用此模組。');
			exit();
		}
	}


	
}
