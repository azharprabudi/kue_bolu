<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_kue_model extends CI_Model{

	public function get_list_like($search){
		if( $search != '' ){
			$this->db->like('nama_kategori',$search);
			$query = $this->db->get('tbl_kategori_kue');
			if( $query->num_rows() > 0 ){
				return $query->result_array();
			}
			else{
				return false ; 
			}
		}
		else{
			return false;
		}
	}

	public function cek_existing_id_kue($id_kue){
		$this->db->where('id_kue',$id_kue);
		$query = $this->db->get('tbl_kue');
		if($query->num_rows() > 0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function addNew($data){
		if(is_array($data)){
			$query = $this->db->insert('tbl_kue',$data);
			if($query){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
	}

	public function get_list_data($limit,$offset){
		$this->db->limit($limit,$offset);
		$this->db->order_by('id_kue','ASC');
		$query = $this->db->get('tbl_kue');
		if($query){
			return $query->result();
		}
	}

	public function total_rows(){
		$query = $this->db->count_all_results('tbl_kue');
		return $query;
	}
	
}