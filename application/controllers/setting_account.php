<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_account extends CI_Controller{

	private $url; 
	private $view;
	private $model;

	public function __construct(){
		parent::__construct();
		$this->load->library(array('my_library'));
		$this->my_library->logged_in();
		$this->load->model('setting_account_model');
		$this->model = $this->setting_account_model;
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->load->view('Setting_account');
	}

	public function change_password(){
		$username = $this->input->post('username');
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		$confirmation_password = $this->input->post('confirmation_password');
		if($username != NULL && $old_password != NULL ){
			$data = array(
				'username' => $username,
				'password' => md5($old_password),
				);
			$query = $this->model->cek_user_account($data);
			unset($data);
			if($query == TRUE){
				$data = array(
				'username' => $username,
				'password' => md5($new_password)
					);
				$query = $this->model->update_new_password($data);
				if($query){
					unset($data);
					$data = array(
						'success' => '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                    Password Berhasil Di Update
                  </div>'
						);
					echo json_encode($data);
				}
				else{
					unset($data);
					$data = array(
						'success' => '<div class="alert alert-success alert-dismissable">
	                   	 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
	                    Gagal Update Password
	                  	</div>'
						);
					echo json_encode($data);
				}
			}
			else{
				unset($data);
					$data = array(
						'success' => '<div class="alert alert-success alert-dismissable">
	                   	 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
	                    Gagal Update Password
	                  	</div>'
						);
					echo json_encode($data);
			}
		}
	}

}

?>
