<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

	public function cekLogin($username,$password){
		$this->db->where(array('username' => $username, 'password' => $password));
		$this->db->from('tbl_user_account');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			return $query->result();
		}
		return false;
	}

}