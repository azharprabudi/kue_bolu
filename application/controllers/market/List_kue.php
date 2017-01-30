<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_kue extends CI_Controller{

	private $url ; 
	private $model ; 

	public function __construct(){
		parent::__construct();
		$this->load->model('list_kue_model');
		$this->model = $this->list_kue_model;
		$this->url = $this->router->fetch_class();
		$this->load->library(array('my_library','form_validation','pagination'));
		$this->my_library->logged_in();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$total_rows = $this->model->total_rows();
		$limit = 5; 
		if($total_rows != 0 ){
			$page = $this->uri->segment(4);
			if(!$page){
				$offset = 0;
			}
			else{
				$offset = $page;
			}
		$link = base_url("index.php/market/list_kue/view");
		$this->my_library->pagination($link,$total_rows,$limit);
		$data['list_data'] = $this->model->get_list_data($limit,$offset);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('users/list_kue_view',$data);
		}
	}

	public function addNew(){
		if(isset($_POST['submit'])){
			$this->do_addNew();
		}
	}

	public function do_addNew(){
		$id_kue = htmlspecialchars($this->input->post('id_kue'));
		$nama_kue = htmlspecialchars($this->input->post('nama_kue'));
		$id_kategori_kue = htmlspecialchars($this->input->post('kategori_kue'));
		$stok_kue = htmlspecialchars($this->input->post('stok_kue'));
		$harga_kue = htmlspecialchars($this->input->post('harga_kue'));
		// FORM VALIDATION START	
			$this->form_validation->set_rules('id_kue','Id Kue','required|callback_cek_id_kue');
			$this->form_validation->set_rules('nama_kue','Nama Kue','required');
			$this->form_validation->set_rules('kategori_kue','Kategori Kue','required');
			$this->form_validation->set_rules('stok_kue','Stok Kue','required');
			$this->form_validation->set_rules('harga_kue','Harga Kue','required');
			$this->form_validation->set_message('required','%s Inputkan tidak boleh kosong');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fa fa-ban"></i>','<h5></div>');
		// FORM VALIDATION END
		if($this->form_validation->run() == TRUE){
			//upload konfigurasi image
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg';
			$config['max_size'] = 1024;
			//end konfigurasi upload
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('gambar_kue')){
				$data = array(
					'error_upload' => $this->upload->display_errors()
					);
				$this->load->view('users/list_kue_view',$data);
			}
			else{
				$upload_data = $this->upload->data();
				$upload_file = base_url().'/uploads/'.$upload_data['file_name'];
				$data = array(
					'id_kue' => $id_kue,
					'nama_kue' => $nama_kue,
					'id_kategori_kue' => $id_kategori_kue,
					'stok_kue' => $stok_kue,
					'harga_kue' => $harga_kue,
					'image' => $upload_file
					
					);
				$query = $this->model->addNew($data);
				if($query){
					redirect('market/'.$this->url.'/view');
				}
				else{
					$data['error_msg'] = 'Gagal Menambahkan Data';
					$this->load->view('users/list_kue_view',$data);
				}
			}

		}
		else{
			$this->load->view('users/list_kue_view');
		}
	}

	public function get_list_kategori_kue(){
		$search = htmlspecialchars($this->input->post('q'));
		if( $search != '' ){
			$get_list_like = $this->model->get_list_like($search);
			$data = array();
			$data_tmp = array();
			$select2_ajax = array();
			if(	$get_list_like != FALSE ){
				$select2_ajax['kategori_kue'] = $get_list_like;
				echo json_encode($select2_ajax);
			}
			else{
				echo 0 ; 
			}
		}
	}

	public function cek_id_kue($id_kue){
		if( $id_kue != '' ){
			$cek_id_kue = $this->model->cek_existing_id_kue($id_kue);
			//jika cek id kue num rows > 0 true maka return callback false
			if($cek_id_kue){
				$this->form_validation->set_message('Id Kue Existing Sudah Ada, Mohon Gunakan Yang Lain');
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
		else{
			return FALSE;
		}
	}

}