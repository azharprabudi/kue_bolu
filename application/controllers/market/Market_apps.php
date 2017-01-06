<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Market_apps extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('my_library');
		$this->my_library->logged_in();
	}

	public function view(){
		$this->load->view('users/dashboard');
	}

	public function index(){
		$this->view();
	}

	public function add_new(){
		$tanggal = $this->input->post('tanggal');
		echo $tanggal;
	}
}