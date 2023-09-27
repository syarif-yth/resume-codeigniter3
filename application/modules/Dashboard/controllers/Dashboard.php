<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$view = $this->data_view();
		$this->load->view('template', $view);
	}

	private function data_view()
	{
		$data['title'] = 'Dashboard';
		$data['avatar'] = 'assets/img/avatar-default.png';
		$data['name_display'] = 'Admin App';
		$data['user_display'] = 'administrator';
		$data['breadcrumb'] = 'Home';
		$data['class_dashboard'] = 'aktif';
		$data['content'] = 'dashboard';
		return $data;
	}
}
?>
