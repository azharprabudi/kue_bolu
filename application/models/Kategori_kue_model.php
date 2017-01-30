<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_kue_model extends CI_Model{


	public function getAllKategori($tbl,$limit,$offset){
		$this->db->limit($limit,$offset);
		$this->db->order_by('id_kategori','asc');
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
		if($id != '' ){
			$this->db->where('id_kategori',$id);
			$query = $this->db->update('tbl_kategori_kue',$data);
			if($query){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		else{
			return FALSE;
		}
	}

	public function get_data_by_search($data){
		if( is_array($data) ){
			if( $data['id_kategori'] != '' ){
				$this->db->where('id_kategori',$data['id_kategori']);
			}
			if( $data['nama_kategori'] != '' ){
				$this->db->like('nama_kategori',$data['nama_kategori']);
			}			
			$query = $this->db->get('tbl_kategori_kue');
			if( $query->num_rows() > 0 ){
				return $query->result();
			}	
			else{
				return false ; 
			}
		}
		else{
			return false;
		}
	}

	public function get_id_max(){
		$this->db->order_by('id_kategori','DESC');
		$this->db->limit(1);
		$query = $this->db->get('tbl_kategori_kue');
		if($query){
			return ( $query->row()->id_kategori ) + 1;
		}
		else{
			return 0 ;
		}
	}


}