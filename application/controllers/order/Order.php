<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . '/controllers/common/common.php';
class Order extends common {
	
	function __construct(){
		parent::__construct();
		//載入order_model
		//如有要修改 路徑為\application\models\order\order_model.php
		$this->load->model('order/order_model', 'orderModel');
	}

	public function index() {
		$this->layout->view('order/index');
		
	}


	
}
