<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . '/controllers/admin/admin.php';
class Customer_service extends admin {
	
	function __construct(){
		parent::__construct();
		
	}

	public function index() {
		$this->layout->view('admin/customer/index', $this->data);
	}
	
	


	
}
