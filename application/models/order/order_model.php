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
		foreach ($search_data as $key => $value) {
            switch ($key) {
                case 'city_id':
                    $this->db->where('city_id', $value);
                    break;
                case 'area_id':
                    $this->db->where('area_id', $value);
                    break;
            }
        }
		$this->db->order_by('order_id', "DESC");
        return $this->db->get('order');
    }
	
	function getOrder($order_id){
		$this->db->select('*');
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
		$this->db->insert('order_detail', $data);
		$this->db->trans_complete();
        return $this->db->trans_status();
	}
	
}

?>