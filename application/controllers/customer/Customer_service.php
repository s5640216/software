<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . '/controllers/common/common.php';
class Customer_service extends common {
	
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->layout->view('customer/index');
	}


	
}
