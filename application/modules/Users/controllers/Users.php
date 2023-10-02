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
		$view = array_merge($default, $data);
		$this->load->view('template', $view);
	}

	public function add()
	{
		$default = $this->data_view();
		$data['content'] = 'insert';
		$view = array_merge($default, $data);
		$this->load->view('template', $view);
	}

	public function edit()
	{
		$default = $this->data_view();
		$data['content'] = 'edit';
		$view = array_merge($default, $data);
		$this->load->view('template', $view);
	}

	public function view()
	{
		$default = $this->data_view();
		$data['content'] = 'detail';
		$view = array_merge($default, $data);
		$this->load->view('template', $view);
	}

	private function data_view()
	{
		$data['avatar'] = 'assets/img/avatar-default.jpg';
		$data['cover'] = 'assets/img/cover-default.jpg';
		$data['name_display'] = 'Admin App';
		$data['user_display'] = 'administrator';
		$data['breadcrumb'] = 'Main';
		$data['class_users'] = 'aktif';
		return $data;
	}
}
?>
