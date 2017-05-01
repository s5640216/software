<?php
class Login_model extends CI_Model {
	
	function getUserInfo( $account ) {
		$this->db->select('accounts.*');
		$this->db->select('purview.name as purview_name');
		$this->db->select('purview.describe');
		$this->db->join('purview','accounts.purview = purview.id');
        if ( $account != false && $account != '' ) {
            $this->db->where( 'account', $account );
        }
		
        return $this->db->get('accounts');
    }
}

?>