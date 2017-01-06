<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_kue extends CI_Controller {

	private $url ; 
	private $model ;

	public function __construct(){
		parent::__construct();
		$this->load->library(array('my_library','pagination','form_validation'));
		$this->url =  $this->router->fetch_class();
		$this->my_library->logged_in();
		$this->load->model('kategori_kue_model');	
		$this->model = $this->kategori_kue_model;
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$totalRows = $this->kategori_kue_model->totalRows('tbl_kategori_kue');
		$limit = 5;
		if($totalRows != 0 ){
			$page = $this->uri->segment(4);
			if(!$page){
				$offset = 0;
			}
			else{
				$offset = $page;
			}
		$link = base_url("index.php/market/kategori_kue/view");
		$this->my_library->pagination($link,$totalRows,$limit);
		$data['allKategori'] = $this->model->getAllKategori('tbl_kategori_kue',$limit,$offset);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('users/'.$this->url.'_view',$data);
		}
	}

	public function addNew(){
		
		if( isset($_POST['submit']) ){
			$this->do_add_new();
		} 	
	}
	public function do_add_new(){
		$data = array();
		$id_kategori = htmlspecialchars($this->input->post('id_kategori'));
		$nama_kategori = htmlspecialchars($this->input->post('nama_kategori'));
		$this->form_validation->set_rules('id_kategori','id kategori','required');
		$this->form_validation->set_rules('nama_kategori','nama kategori','required');
		$this->form_validation->set_message('required','%s input tidak boleh kosong');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fa fa-ban"></i>','<h5></div>');
		if($this->form_validation->run() == TRUE){
			$data = array(
				'id_kategori' => $id_kategori,
				'nama_kategori' => $nama_kategori
				);
			$this->model->addNew($data);
			redirect('market/kategori_kue');
		}
		else{
			redirect('market/kategori_kue');
		}		
	}

	public function delete(){
		$id_kategori =  htmlspecialchars($this->uri->segment(4));
		if($id_kategori != ''){
			$this->do_delete($id_kategori);
		}
	}

	public function do_delete($id_kategori){
		$data = array(
			'id_kategori' => $id_kategori
			);
		$this->model->deleteId($data);
		$this->session->set_flashdata('deleted','<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                    Data Berhasil Di Hapus
                  </div>');
		redirect('market/kategori_kue');
	}

	public function editId(){
		$data = array();
		$id_kategori = htmlspecialchars(($this->input->post('id_kategori')));
		if( $id_kategori != '' ){
			$data = array(
				'id_kategori' => $id_kategori
				);
			$query = $this->model->getDataId($data);
			if($query == TRUE){
				echo json_encode($query);
			}
		}
	}

	public function update(){
		$this->do_update();
	}

	public function do_update(){
		$data = array();
		$id_kategori = htmlspecialchars( $this->input->post('id_kategori') );
		$nama_kategori = htmlspecialchars( $this->input->post('nama_kategori') );
		if( $id_kategori != '' || $nama_kategori != '' ){
			$data = array(
				'nama_kategori' => $nama_kategori
				);
			$query = $this->model->editId($id_kategori,$data);
			if($query == TRUE){
				$this->session->set_flashdata('edit','<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                    Data Berhasil Di Update
                  </div>');
				redirect('market/kategori_kue');
			}
		}
	}

}