<?php
class Order_model extends CI_Model {
	function getMemberOrder($uid) {
		$this->db->select('order.*');
		
		$this->db->where('uid', $uid);
        return $this->db->get('order');
    }
	
	function getServiceOrder($uid) {
		$this->db->select('order.*');
		
		$this->db->where('receive_uid', $uid);
        return $this->db->get('order');
    }
	
	function getReceiveOrder($search_data = array()) {
		$this->db->select('order.*');
		
		$this->db->where('receive_uid', null);
		$this->db->where('status', ORDER_WAIT);
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
            }
        }
		$this->db->order_by('order_id', "DESC");
        return $this->db->get('order');
    }
	
	function getOrder($order_id){
		$this->db->select('order.*,
							accounts.name,
							accounts.email,
							accounts.sex,
							accounts.phone,
							taiwan_city.city_name,
							taiwan_area.area_name,
							receive_account.name as receive_name,
							receive_account.email as receive_email,
							receive_account.sex as receive_sex,
							receive_account.phone as receive_phone');
		$this->db->join('accounts','accounts.uid = order.uid', 'LEFT');
		$this->db->join('accounts as receive_account','receive_account.uid = order.receive_uid', 'LEFT');
		$this->db->join('taiwan_city', 'taiwan_city.city_id = order.city_id', 'LEFT');
		$this->db->join('taiwan_area', 'taiwan_area.area_id = order.area_id', 'LEFT');
		$this->db->where('order_id', $order_id);
        return $this->db->get('order');
	}
	
	function update_receive_order($order_id, $uid){
		$this->db->trans_start();
        $this->db->where('order_id', $order_id);
        $this->db->set('receive_uid', $uid);
        $this->db->update('order');
        $this->db->trans_complete();

        return $this->db->trans_status();
	}
	
	function update_order_status($order_id, $status){
		$this->db->trans_start();
        $this->db->where('order_id', $order_id);
        $this->db->set('status', $status);
        $this->db->update('order');
        $this->db->trans_complete();

        return $this->db->trans_status();
	}
	
	function insert_order($data){
		$this->db->insert('order', $data);

        return $this->db->insert_id();
	}
	
	function insert_order_detail($data){
		$this->db->trans_start();
		$this->db->insert_batch('order_detail', $data);
		$this->db->trans_complete();
        return $this->db->trans_status();
	}
	
	function get_order_detail($order_id){
		$this->db->select('order_detail.*,
							store_product.*,
							store_info.name as store_name,
							store_city.city_name as store_city_name,
							store_area.area_name as store_area_name,
							(store_product.price * order_detail.amount)as sub_total');
		
		
		$this->db->join('store_info', 'store_info.store_id = order_detail.store_id', 'LEFT');
		$this->db->join('taiwan_city as store_city', 'store_city.city_id = store_info.city_id', 'LEFT');
		$this->db->join('taiwan_area as store_area', 'store_area.area_id = store_info.area_id', 'LEFT');
		$this->db->join('store_product','store_product.store_id = order_detail.store_id AND
						store_product.product_id = order_detail.product_id', 'LEFT');
		
		$this->db->where('order_id', $order_id);
        $this->db->order_by('order_detail.store_id', 'ASC');
		$this->db->order_by('order_detail.product_id', 'ASC');
		return $this->db->get('order_detail');
	}
	
}

?>