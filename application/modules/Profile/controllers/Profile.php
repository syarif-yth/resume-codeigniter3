<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$default = $this->data_view();
		$data['content'] = 'profile';
		$data['assets_js'] = 'profile_js';
		$view = array_merge($default, $data);
		$this->load->view('template', $view);
	}

	private function data_view()
	{
		$data['title'] = 'Profile';
		$data['avatar'] = 'assets/img/avatar-default.png';
		$data['name_display'] = 'Admin App';
		$data['user_display'] = 'administrator';
		$data['breadcrumb'] = 'Account';
		$data['class_profile'] = 'aktif';
		return $data;
	}
}
?>
