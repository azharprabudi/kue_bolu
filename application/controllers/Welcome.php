<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	private $url ;
	private $model;

	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','my_library'));
		$this->load->model('user_model');
		$this->url = $this->router->fetch_class();
		$this->model = $this->user_model;	
	}

	public function index()
	{
		$this->view();
	}

	public function view(){
		$this->load->view('login');
	}

	public function login(){
		$loggedin = array();
		$username = htmlspecialchars($this->input->post('username'));
		$password = md5(htmlspecialchars($this->input->post('password')));
		if( $username != NULL & $password != NULL ){
			$this->form_validation->set_rules('username','Username','required|trim');
			$this->form_validation->set_rules('password','Password','required|trim');
			$this->form_validation->set_message('required','%s Tidak boleh kosong');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fa fa-ban"></i>','<h5></div>');
			if($this->form_validation->run() == TRUE){
				$cekLoginUser = $this->model->cekLogin($username,$password);
				if($cekLoginUser == TRUE){
					foreach($cekLoginUser as $key => $row){
						$loggedin = array(
						 	'username' => $row->username,
						 	'password' => $row->password,
							'status' => $row->status,
							'logged_in' => 1
							);
						}
					$this->session->set_userdata($loggedin);
					redirect('market/Market_apps');
				}
				else{
					$this->session->set_userdata('username',$username);
					$this->session->set_userdata('password',$password);
					$this->session->set_flashdata('failed','Username & Password Salah');
					$this->view();
				}
			}
			else{
				$this->view();
			}
		}
	}//penutup method login

	public function logout(){
		if($this->session->userdata() == NULL){
			$this->view();
		}
		else{
			$this->session->sess_destroy();
			redirect($this->url/'view');
		}
	}

}

/* 
Develop By Azhar Prabudi 
IG : azhars16
*/
