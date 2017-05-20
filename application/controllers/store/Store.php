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
	
	
	public function ajax_get_store_list(){
		$city_id = $this->input->post('city_id');
		$area_id = $this->input->post('area_id');
		$search_data = array('city_id' => $city_id, 'area_id' => $area_id);
		$this->data['stores'] = $this->storeModel->getStore($search_data);
		// echo json_encode($stores);
		
		$this->load->view('store/store_list', $this->data);
	}
	
	public function ajax_get_store_product_list(){
		$store_id = $this->input->post('store_id');
		$search_data = array('store_id' => $store_id);
		$this->data['stores'] = $this->storeModel->getStoreProduct($search_data);
		print_r(search_data);
	
		//$this->load->view('store/store_list', $this->data);
		//echo json_encode($store_product);
	}


	
}
