<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . '/controllers/common/common.php';
class Store extends common {
	
	function __construct(){
		parent::__construct();
		//載入store_model
		//如有要修改 路徑為\application\models\store\store_model.php
		$this->load->model('store/store_model', 'storeModel');
	}

	public function index() {
		$this->layout->view('store/index');
	}


	
}
