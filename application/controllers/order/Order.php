<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . '/controllers/common/common.php';
class Order extends common {
	
	function __construct(){
		parent::__construct();
		//載入order_model
		//如有要修改 路徑為\application\models\order\order_model.php
		$this->load->model('order/order_model', 'orderModel');
		$this->load->model('store/store_model', 'storeModel');
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
		$city_id = ($this->input->post('city_id') != null)? $this->input->post('city_id'): true;
		$area_id = ($this->input->post('area_id') != null)? $this->input->post('area_id'): true;;
		
		$search_data = array('city_id' => $city_id, 'area_id' => $area_id);
		$this->data['orders'] = $this->orderModel->getReceiveOrder($search_data);
		$this->load->view('order/receive_order_list', $this->data);
	}

	public function receive_order(){
		if($this->session->userdata('purview') != PURVIEW_SERVICE){
			return;
		}
		$uid = $this->session->userdata('uid');
		$order_id = $this->input->post('order_id');
		$order = $this->orderModel->getOrder($order_id)->row();
		
		if($order->receive_uid == null){
			$res = $this->orderModel->update_receive_order($order_id, $uid);
			$res = $this->orderModel->update_order_status($order_id, ORDER_PROCESSED);
			echo json_encode(array('status' => 'success', 'message' => '已接收此訂單'));
		} else {
			echo json_encode(array('fail' => 'success', 'message' => '處理上錯誤'));
		}
	}
	
	public function do_drop_order(){
		$uid = $this->session->userdata('uid');
		$city_id = $this->input->post('city_id');
		$area_id = $this->input->post('area_id');
		$store_id = $this->input->post('store_id');
		$product_id = $this->input->post('product_id');
		$amount = $this->input->post('amount');
		
		$order_data = array(
			'uid' => $uid,
			'city_id' => $city_id,
			'area_id' => $area_id,
			'status' => ORDER_WAIT,
			'order_date' =>date( "Y-m-d  H:i:s" )
		);
		$order_id = $this->orderModel->insert_order($order_data);
		$product_search_data = array('store_id' => $store_id, 'product_id' => $product_id);
		$order_detail = array(
			'order_id' => $order_id,
			'store_id' => $store_id,
			'product_id' => $product_id,
			'price' => $this->storeModel->getStoreProduct($product_search_data)->row()->price,
			'amount' => $amount
		);
		$res = $this->orderModel->insert_order_detail($order_detail);
		
		echo json_encode(array('status' => 'success', 'message' => '訂單成立'));
	}
	
}
