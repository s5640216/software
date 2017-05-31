<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . '/controllers/common/Common.php';
class Order extends Common {
	
	function __construct(){
		parent::__construct();
		//載入order_model
		//如有要修改 路徑為\application\models\order\order_model.php
		$this->load->model('order/Order_model', 'orderModel');
		$this->load->model('order/Message_model', 'messageModel');
		$this->load->model('store/Store_model', 'storeModel');
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
		$this->load->view('order/order_list', $this->data);
	}
	
	private function _get_service_order(){
		$uid = $this->session->userdata('uid');
		$this->data['orders'] = $this->orderModel->getServiceOrder($uid);
		$this->load->view('order/order_list', $this->data);
	}
	
	public function drop_order(){
		$this->layout->view('order/drop_order');
	}
	
	public function receive_order_view(){
		$this->layout->view('order/receive_order');
	}
	
	public function get_receive_order_list(){
		$city_id = ($this->input->post('city_id') != null)? $this->input->post('city_id'): false;
		$area_id = ($this->input->post('area_id') != null)? $this->input->post('area_id'): false;
		
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
			echo json_encode(array('status' => 'fail', 'message' => '處理上錯誤'));
		}
	}
	
	public function do_drop_order(){
		$uid = $this->session->userdata('uid');
		$city_id = $this->input->post('city_id');
		$area_id = $this->input->post('area_id');
		$product_array = $this->input->post('product_arr');
		$order_detail_data = array();
		
		
		$order_data = array(
			'uid' => $uid,
			'city_id' => $city_id,
			'area_id' => $area_id,
			'status' => ORDER_WAIT,
			'order_date' =>date( "Y-m-d  H:i:s" )
		);
		$order_id = $this->orderModel->insert_order($order_data);
		
		foreach($product_array as $product){
			$product_search_data = array('store_id' => $product['store_id'], 'product_id' => $product['product_id']);
			$tmp = array(
				'order_id' => $order_id,
				'store_id' => $product['store_id'],
				'product_id' => $product['product_id'],
				'price' => $this->storeModel->getStoreProduct($product_search_data)->row()->price,
				'amount' => $product['amount']
			);
			array_push($order_detail_data, $tmp);
		}
		$res = $this->orderModel->insert_order_detail($order_detail_data);
		
		echo json_encode(array('status' => 'success', 'message' => '訂單成立'));
	}
	
	public function detail($order_id){
		if(!$this->_check_order($order_id)){
			header("Location:" . base_url() . 'order/order'); 
		}
		$this->data['uid'] = $this->session->userdata('uid');
		$order = $this->orderModel->getOrder($order_id)->row();
		$order_detail = $this->orderModel->get_order_detail($order_id)->result();
		$this->data['sub_total'] = 0;
		$this->data['order'] = $order;
		$this->data['order_details'] = $order_detail;
		// echo json_encode($order_detail);
		$this->layout->view('order/order_detail', $this->data);
	}
	
	public function send_message(){
		$uid = $this->session->userdata('uid');
		$order_id = $this->input->post('order_id');
		$message = $this->input->post('message');
		$status = 'success';
		$return_message = '';
		if(!$this->_check_order($order_id)){
			$status = 'fail';
			$return_message = '未知錯誤';
			echo json_encode(array('status' => $status, 'message' => $return_message));
			return;
		}
		$order = $this->orderModel->getOrder($order_id)->row();
		$not_send_message_status = array(ORDER_WAIT, ORDER_FINISH, ORDER_CANCEL); //訂單在這些狀態下無法傳送訊息
		if(in_array($order->status, $not_send_message_status)){
			$status = 'fail';
			$return_message = '此訂單已無法使用訊息';
			echo json_encode(array('status' => $status, 'message' => $return_message));
			return;
		}
		
		$data = array(
			'order_id' => $order_id,
			'uid' => $uid,
			'message' => $message,
			'message_date' => date( "Y-m-d  H:i:s" )
		);
		
		$this->messageModel->insert_order_message($data);
		$status = 'success';
		$return_message = '訊息已傳送';
		echo json_encode(array('status' => $status, 'message' => $return_message));
	}
	
	public function get_order_chat(){
		$order_id = $this->input->post('order_id');
		$this->data['order'] = $this->orderModel->getOrder($order_id)->row();
		$this->data['uid'] = $this->session->userdata('uid');
		$this->data['order_id'] = $order_id;
		$this->data['messages'] = $this->messageModel->get_order_message($order_id);
		$not_send_message_status = array(ORDER_WAIT, ORDER_FINISH, ORDER_CANCEL); //訂單在這些狀態下無法傳送訊息
		$this->data['hide_send_message'] = $not_send_message_status;
		$this->load->view('order/order_chat', $this->data);
	}
	
	public function change_order_status(){
		$uid = $this->session->userdata('uid');
		$order_id = $this->input->post('order_id');
		$order_status = $this->input->post('status');
		$order = $this->orderModel->getOrder($order_id)->row();
		$status = 'fail';
		$message = '';
		
		if(!$this->_check_order($order_id)){
			$status = 'fail';
			$message = '無此權限操作';
			echo json_encode(array('status' => $status, 'message' => $message));
			return;
		}
		
		$order = $this->orderModel->getOrder($order_id)->row();
		switch($order_status){
			case ORDER_TRANSPORT: //轉為運送中
				if($this->session->userdata('purview') == PURVIEW_SERVICE && $order->status == ORDER_PROCESSED){
					$status = 'success';
					$message = '已轉為運送中';
				}
				break;
			case ORDER_WAIT_FINISH: //轉為等待完成
				if($this->session->userdata('purview') == PURVIEW_SERVICE && $order->status == ORDER_TRANSPORT){
					$status = 'success';
					$message = '已轉為等待完成';
				}
				break;
			case ORDER_FINISH: //轉為完成
				if($this->session->userdata('purview') == PURVIEW_MEMBER && $order->status == ORDER_WAIT_FINISH){
					$status = 'success';
					$message = '已轉為完成';
				}
				break;
			case ORDER_WAIT_CANCEL: //轉為取消或等待取消
				if($this->session->userdata('purview') == PURVIEW_MEMBER && $order->status == ORDER_PROCESSED){
					$order_status = ORDER_WAIT_CANCEL;
					$status = 'success';
					$message = '請等待對方取消';
				} else if($this->session->userdata('purview') == PURVIEW_MEMBER && $order->status == ORDER_WAIT){
					$order_status = ORDER_CANCEL;
					$status = 'success';
					$message = '已經取消訂單';
				}
				break;
			case ORDER_CANCEL:
				if($this->session->userdata('purview') == PURVIEW_SERVICE && $order->status == ORDER_WAIT_CANCEL){
					$status = 'success';
					$message = '已經取消訂單';
				}
				break;
		}
		if($status == 'success'){
			$res = $this->orderModel->update_order_status($order_id, $order_status);
			echo json_encode(array('status' => $status, 'message' => $message));
		} else {
			$message = '處理上遇到錯誤';
			echo json_encode(array('status' => $status, 'message' => $message));
		}
		
	}
	
	public function get_order_detail_modal(){
		$order_id = $this->input->post('order_id');
		$order = $this->orderModel->getOrder($order_id)->row();
		$order_detail = $this->orderModel->get_order_detail($order_id)->result();
		$this->data['order'] = $order;
		$this->data['order_detail'] = $order_detail;
		if($order->status == ORDER_WAIT){
			$this->load->view('order/order_detail_by_modal', $this->data);
		} else {
			echo json_encode(array('status' => 'fail', 'message' => '404 Order Not Found'));
		}
		
	}
	
	private function _check_order($order_id){ //檢查有無權限使用訂單
		$uid = $this->session->userdata('uid');
		$order = $this->orderModel->getOrder($order_id)->row();
		$purview = $this->session->userdata('purview');
		switch($purview){
			case PURVIEW_MEMBER:
				if($order->uid == $uid)
					return true;
				else
					return false;
				break;
			case PURVIEW_SERVICE:
				if($order->receive_uid == $uid)
					return true;
				else
					return false;
				break;
			default:
				return true;
				break;
		}
	}
	
}
