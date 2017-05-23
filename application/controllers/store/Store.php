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
		if($this->session->userdata('purview') == PURVIEW_ADMIN){
			$this->load->view('store/modal/add_store_info_modal');
		}
	}
	
	
	public function ajax_get_store_list($type = 'select'){
		// $city_id = $this->input->post('city_id');
		// $area_id = $this->input->post('area_id');
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
	
	public function ajax_get_store_product_list(){
		$store_id = $this->input->post('store_id');
		$search_data = array('store_id' => $store_id);
		$store_product = $this->storeModel->getStoreProduct($search_data)->result_array();
		echo json_encode($store_product);
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

}
