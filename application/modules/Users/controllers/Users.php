<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$default = $this->data_view();
		$data['content'] = 'users';
		$data['assets_css'] = 'users_css';
		$data['assets_js'] = 'users_js';
		$view = array_merge($default, $data);
		$this->load->view('template', $view);
	}

	public function add()
	{
		$default = $this->data_view();
		$data['content'] = 'insert';
		$data['assets_js'] = 'userInsert_js';
		$view = array_merge($default, $data);
		$this->load->view('template', $view);
	}

	private function data_view()
	{
		$data['title'] = 'Users';
		$data['avatar'] = 'assets/img/avatar-default.png';
		$data['user_display'] = 'Admin';
		$data['breadcrumb'] = 'Home';
		$data['class_users'] = 'aktif';
		return $data;
	}
}
?>
