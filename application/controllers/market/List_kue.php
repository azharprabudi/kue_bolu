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
		$this->load->library(array('my_library'));
	}

	public function index(){
		$this->view();
	}

	public function view(){
		
	}

}