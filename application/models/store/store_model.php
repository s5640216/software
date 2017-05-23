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
            }
        }
		return $this->db->get('store_product');
	}
	
	function insert_store($data){
		$this->db->insert('store_info', $data);
        return $this->db->insert_id();
	}
	
	function delete_store($store_id){
		$this->db->where('store_id', $store_id);
		$this->db->delete('store_info');
	}

	
}

?>