<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . '/controllers/common/Common.php';
class Store extends Common {
	
	function __construct(){
		parent::__construct();
		//載入store_model
		//如有要修改 路徑為\application\models\store\store_model.php
		$this->load->model('store/Store_model', 'storeModel');
	}	

	public function index() {
		$this->layout->view('store/index');
		if($this->session->userdata('purview') == PURVIEW_ADMIN){
			$this->load->view('store/modal/add_store_info_modal');
		}
	}
	
	public function store_product($store_id){
		$search_data = array('store_id' => $store_id);
		$store = $this->storeModel->getStore($search_data);
		if($store->num_rows() > 0){
			$store_name = $store->row()->name;
		} else {
			header("Location:".base_url()."store/store");
		}
		$this->data['store_id'] = $store_id;
		$this->data['store_name'] = $store_name;
		$this->layout->view('store/store_product', $this->data);
		if($this->session->userdata('purview') == PURVIEW_ADMIN){
			$this->load->view('store/modal/add_store_product_modal');
		}
	}
	
	public function ajax_get_store_list($type = 'select'){
		$city_id = ($this->input->post('city_id') != null)? $this->input->post('city_id'): false;
		$area_id = ($this->input->post('area_id') != null)? $this->input->post('area_id'): false;
		$search_data = array('city_id' => $city_id, 'area_id' => $area_id);
		$stores = $this->storeModel->getStore($search_data);
		if($type == 'select'){
			echo json_encode($stores->result_array());
		} else if($type == 'view'){
			$this->data['stores'] = $stores;
			$this->load->view('store/store_list', $this->data);
		}
	}
	
	public function ajax_get_store_product_list($type = 'select'){
		$store_id = $this->input->post('store_id');
		$purview_id = $this->session->userdata('purview');
		$product_status = PRODUCT_SELL;
		switch ($purview_id) {
			case PURVIEW_ADMIN:
				$product_status = false;
				break;
			default:
				$product_status = PRODUCT_SELL;
				break;
		}
		$search_data = array('store_id' => $store_id, 'status' => $product_status);
		$store_product = $this->storeModel->getStoreProduct($search_data);
		if($type == 'select'){
			echo json_encode($store_product->result_array());
		} else if($type == 'view'){
			$this->data['store_products'] = $store_product;
			$this->load->view('store/store_product_list', $this->data);
		}
	}
	
	public function add_store_info(){
		$status = 'fail';
		$message = '';
		if($this->session->userdata('purview') != PURVIEW_ADMIN){
			$message = '並無權限使用';
			echo json_encode(array('status' => $status, 'message' => $message));
			return;
		}
		
		$store_data = array(
			'city_id' => $this->input->post('city_id'),
			'area_id' => $this->input->post('area_id'),
			'name' => $this->input->post('store_name'),
			'describe' => $this->input->post('store_describe')
		);
		$store_id = $this->storeModel->insert_store($store_data);
		$status = 'success';
		$message = '新增店家成功';
		echo json_encode(array('status' => $status, 'message' => $message));
	}
		
	public function del_store_info(){
		$status = 'fail';
		$message = '';
		if($this->session->userdata('purview') != PURVIEW_ADMIN){
			$message = '並無權限使用';
			echo json_encode(array('status' => $status, 'message' => $message));
			return;
		}
		$store_id = $this->input->post('store_id');
		$this->storeModel->delete_store($store_id);
		$status = 'success';
		$message = '刪除店家成功';
		echo json_encode(array('status' => $status, 'message' => $message));
	}
	
	function ajax_add_store_product(){
		$store_id = $this->input->post('store_id');
		$product_name = $this->input->post('product_name');
		$product_price = $this->input->post('product_price');
		$product_status = $this->input->post('product_status');
		$status = 'fail';
		$message = '';
		if($this->session->userdata('purview') != PURVIEW_ADMIN){
			$message = '並無權限使用';
			echo json_encode(array('status' => $status, 'message' => $message));
			return;
		}
		$product_id = $this->storeModel->get_product_max_id($store_id)->row()->product_id;
		$product_data = array(
			'store_id' => $store_id,
			'product_id' => ($product_id + 1),
			'product_name' => $product_name,
			'price' => $product_price,
			'status' => $product_status
		);
		$this->storeModel->insert_store_product($product_data);
		$status = 'success';
		$message = '商品已新增';
		echo json_encode(array('status' => $status, 'message' => $message));
	}
	
	function ajax_update_product_status(){
		$store_id = $this->input->post('store_id');
		$product_id = $this->input->post('product_id');
		$product_status = $this->input->post('product_status');
		$product_data = array('status' => $product_status);
		$res = $this->storeModel->update_product($store_id, $product_id, $product_data);
		$status = 'success';
		$message = '商品狀態已改變';
		echo json_encode(array('status' => $status, 'message' => $message));
	}
}
