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
	
	function getReceiveOrder() {
		$this->db->select('order.*');
		
		$this->db->where('receive_uid', null);
		$this->db->order_by('order_id', "DESC");
        return $this->db->get('order');
    }
	
}

?>