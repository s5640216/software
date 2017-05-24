<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . '/controllers/admin/Admin.php';
class Account extends Admin {
	
	function __construct(){
		parent::__construct();
		
	}

	public function index() {
		$this->data['users'] = $this->accountModel->get_all_user();
		$this->layout->view('admin/account/index', $this->data);
	}
	
	


	
}
