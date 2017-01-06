<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_library {


	function logged_in(){
		$_this =& get_instance();
		if( $_this->session->userdata('logged_in') == NULL ){
			redirect(base_url());
		}
	}

	function pagination($link,$rows,$limit){
		$_this =& get_instance();
		$config['base_url'] = $link;
		$config['total_rows'] = $rows;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['full_tag_open'] = "<ul class='pagination pagination-sm no-margin pull-right'>";
		$config['full_tag_close'] = "</ul>";
		$config['full_tag_open'] = "<ul class='pagination pagination-sm no-margin pull-right'>";
		$config['full_tag_close'] = "</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li><a href='#'>";
		$config['cur_tag_close'] = "</a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tag_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tag_close'] = "</li>";
		$_this->pagination->initialize($config);
	}

}