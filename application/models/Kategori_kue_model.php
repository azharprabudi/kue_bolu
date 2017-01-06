<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_kue_model extends CI_Model{


	public function getAllKategori($tbl,$limit,$offset){
		$this->db->limit($limit,$offset);
		// $this->db->order_by('id_kategori','desc');
		$query = $this->db->get($tbl);
		if($query->num_rows() > 0){
			return $query->result();
		}
		return false;
	}

	public function totalRows($tbl){
		return $this->db->count_all_results($tbl);
	}

	public function addNew($data){
		$this->db->insert('tbl_kategori_kue',$data);
	}

	public function deleteId($data){
		$this->db->delete('tbl_kategori_kue',$data);
	}

	public function getDataId($id){
		$this->db->where($id);
		$query = $this->db->get('tbl_kategori_kue');
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return false;
		}
	}

	public function editId($id,$data){
		$this->db->where('id_kategori',$id);
		$this->db->update('tbl_kategori_kue',$data);
		return TRUE;
	}

}