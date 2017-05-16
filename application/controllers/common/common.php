<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {
	protected $data = array();
	function __construct(){
		parent::__construct();
			date_default_timezone_set("Asia/Taipei");
			$this->load->model('account/account_model', 'accountModel');
			$this->load->model('address/address_model', 'addressModel');
			$this->_check_is_login();
			 $this->CI = & get_instance();
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
	
	public function getCity(){
		$city = $this->addressModel->getCity()->result_array();
		echo json_encode($city);
	}
	
	public function getArea(){
		$area = $this->addressModel->getArea()->result_array();
		echo json_encode($area);
	}
	
	public function getOrderStatusString($status){
		switch($status){
			case ORDER_WAIT:
				echo "等待接收";
				break;
			case ORDER_PROCESSED:
				echo "處理中";
				break;
			case ORDER_TRANSPORT:
				echo "運送中";
				break;
			case ORDER_FINISH:
				echo "完成";
				break;
			case ORDER_CANCEL:
				echo "取消";
				break;
		}
	}
	
}
