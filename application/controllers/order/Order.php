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
	
	public function get_order_list(){
		if($this->session->userdata('purview') == PURVIEW_MEMBER){
			$this->_get_member_order();
		} else if($this->session->userdata('purview') == PURVIEW_SERVICE){
			$this->_get_service_order();
		}
	}
	
	private function _get_member_order(){
		$uid = $this->session->userdata('uid');
		$this->data['orders'] = $this->orderModel->getMemberOrder($uid);
		$this->load->view('order/member_order', $this->data);
	}
	
	private function _get_service_order(){
		$uid = $this->session->userdata('uid');
		$this->data['orders'] = $this->orderModel->getServiceOrder($uid);
		$this->load->view('order/service_order', $this->data);
	}
	
	public function drop_order(){
		$this->layout->view('order/drop_order');
	}
	
	public function receive_order_view(){
		$this->layout->view('order/receive_order');
	}
	
	public function get_receive_order_list(){
		$this->data['orders'] = $this->orderModel->getReceiveOrder();
		$this->load->view('order/receive_order_list', $this->data);
	}

	public function receive_order(){
		$order_id = $this->input->post(order_id);
	}
	
}
