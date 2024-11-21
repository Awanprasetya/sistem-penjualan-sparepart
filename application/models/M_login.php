<?php 
 
class M_login extends CI_Model{	
	function status($table,$where){		
		return $this->db->get_where($table,$where);
	}	
	public function get_user_by_username($username) {
        return $this->db->get_where('user', ['username' => $username])->row();
    }
}