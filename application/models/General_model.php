<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model{

	public function getMaxTransaksi(){
		$this->db->select('id_transaksi,tanggal');
		$this->db->from('tbl_transaksi');
		$this->db->order_by('id_transaksi','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$tanggal = substr($query->row()->tanggal,5,2);
			$id_transaksi = (int) substr($query->row()->id_transaksi,9);
			if( date('m') == $tanggal ){
				return $id_transaksi;
			}
			else{
				return 1;
			}
		}
	}

}