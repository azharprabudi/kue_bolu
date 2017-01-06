<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_return extends CI_Controller{

	private $model ; 
	private $url ; 

	public function __construct(){
		parent::__construct();
		$this->load->model('general_model');
		$this->model = $this->general_model;
		$this->url = $this->router->fetch_class();
	}

	public function getNomorTransaksi(){
		$tmp = array();
		$query = $this->model->getMaxTransaksi();
		if($query == TRUE){
			$id_transaksi = "TRX-".date('md')."-".str_pad($query+1,3,0,STR_PAD_LEFT);
		// 	$tmp = array(
		// 		'id_transaksi' => $id_transaksi);
		// 	echo json_encode($tmp);
		echo $id_transaksi;
		}
	}
}