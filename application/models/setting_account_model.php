<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_account_model extends CI_Model{

	private $table; 

	public function __construct(){
		parent::__construct();
		$this->table = 'tbl_user_account';
	}

	public function cek_user_account($data){
		if(is_array($data)){
			$query = $this->db->get_where($this->table,$data);
			if($query){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		else{
			return false;
		}
	}

	public function update_new_password($data){
		if(is_array($data)){
			$this->db->where('username',$data['username']);
			unset($data['username']);
			$query = $this->db->update($this->table,$data);
			if($query){
				return TRUE;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
}
?>