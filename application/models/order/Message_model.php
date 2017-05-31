<?php
class Message_model extends CI_Model {
	function get_order_message($order_id) {
		$this->db->select('*');
		$this->db->join('accounts', 'accounts.uid = chat.uid', 'LEFT');
		$this->db->where('order_id', $order_id);
		$this->db->order_by('message_date', 'DESC');
        return $this->db->get('chat');
    }
	
	/*function update_order_status($order_id, $status){
		$this->db->trans_start();
        $this->db->where('order_id', $order_id);
        $this->db->set('status', $status);
        $this->db->update('order');
        $this->db->trans_complete();

        return $this->db->trans_status();
	}*/
	
	function insert_order_message($data){
		$this->db->insert('chat', $data);
	}
	
	
}

?>