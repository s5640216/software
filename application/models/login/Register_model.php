<?php

class Register_model extends CI_Model {
	
	function insertAccount($data){
		$this->db->insert('accounts', $data);
        return $this->db->insert_id();
	}
	
	function getUserInfo( $account ) {
		$this->db->select('*');
        $this->db->from( 'accounts' );
		
        if ( $account != false && $account != '' ) {
            $this->db->where( 'account', $account );
        }

        return $this->db->get();
    }
	function getUserInfobyEmail( $email ) {
		$this->db->select('*');
        $this->db->from( 'accounts' );
		
        if ( $email != false && $email != '' ) {
            $this->db->where( 'email', $email );
        }

        return $this->db->get();
    }
	
	function isHasAccount( $account ) {
        return ( $this->getUserInfo( $account )->num_rows() > 0 ) ? true : false;
    }
}

?>