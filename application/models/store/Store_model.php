<?php
class Store_model extends CI_Model {
	function getStore($search_data = array() ) {
		$this->db->select('*');
		
		foreach ($search_data as $key => $value) {
            switch ($key) {
                case 'city_id':
					if($value != false)
						$this->db->where('city_id', $value);
                    break;
                case 'area_id':
					if($value != false)
						$this->db->where('area_id', $value);
                    break;
				case 'store_id':
					if($value != false)
						$this->db->where('store_id', $value);
                    break;
            }
        }
        return $this->db->get('store_info');
    }
	
	function getStoreProduct($search_data = array()){
		$this->db->select('*');
		foreach ($search_data as $key => $value) {
            switch ($key) {
                case 'store_id':
					if($value != false)
						$this->db->where('store_id', $value);
                    break;
                case 'product_id':
					if($value != false)
						$this->db->where('product_id', $value);
                    break;
				case 'status':
					if($value != false)
						$this->db->where('status', $value);
                    break;
            }
        }
		return $this->db->get('store_product');
	}
	
	function getStoreAndProduct($store_id){
		$this->db->select('*');
		$this->db->join('store_product', 'store_info.store_id = store_product.store_id');
		
		return $this->db->get('store_info');
	}
	
	function insert_store($data){
		$this->db->insert('store_info', $data);
        return $this->db->insert_id();
	}
	
	function delete_store($store_id){
		$this->db->where('store_id', $store_id);
		$this->db->delete('store_info');
	}

	function insert_store_product($data){
		$this->db->insert('store_product', $data);
	}
	
	function get_product_max_id($store_id){
		$this->db->select('max(product_id) as product_id');
		$this->db->where('store_id', $store_id);
		return $this->db->get('store_product');
	}
	
	function update_product($store_id, $product_id, $data){
		$this->db->trans_start();
        $this->db->where('store_id', $store_id);
		$this->db->where('product_id', $product_id);
        $this->db->update('store_product', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
	}
	
	function update_store_info($store_id, $data){
		$this->db->trans_start();
        $this->db->where('store_id', $store_id);
        $this->db->update('store_info', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
	}
}

?>