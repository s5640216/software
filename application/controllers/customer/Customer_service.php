<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . '/controllers/common/Common.php';
class Customer_service extends Common {
	
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->layout->view('customer/index');
	}


	
}
