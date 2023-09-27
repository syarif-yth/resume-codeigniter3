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
		$data['assets_css'] = 'users_css';
		$data['assets_js'] = 'userinsert_js';
		$view = array_merge($default, $data);
		$this->load->view('template', $view);
	}

	public function edit()
	{
		$default = $this->data_view();
		$data['content'] = 'insert';
		$data['assets_css'] = 'users_css';
		$data['assets_js'] = 'userinsert_js';
		$view = array_merge($default, $data);
		$this->load->view('template', $view);
	}

	private function data_view()
	{
		$data['title'] = 'Users';
		$data['avatar'] = 'assets/img/avatar-default.png';
		$data['name_display'] = 'Admin App';
		$data['user_display'] = 'administrator';
		$data['breadcrumb'] = 'Home';
		$data['class_users'] = 'aktif';
		return $data;
	}
}
?>
