<?php
class Address_model extends CI_Model {
	
	function getCity(){
		$this->db->select('*');
		return $this->db->get('taiwan_city');	
	}
	
	function getArea(){
		$this->db->select('*');
		return $this->db->get('taiwan_area');	
	}

}

?>