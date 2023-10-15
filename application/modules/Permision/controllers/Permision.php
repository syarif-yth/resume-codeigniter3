<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permision extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$default = $this->data_view();
		$data['content'] = 'permision';
		$view = array_merge($default, $data);
		$this->load->view('template', $view);
		$this->load->view('assets/js/permision');
	}

	private function data_view()
	{
		$data['avatar'] = 'assets/img/avatar-default.jpg';
		$data['cover'] = 'assets/img/cover-default.jpg';
		$data['name_display'] = 'Admin App';
		$data['user_display'] = 'administrator';
		$data['breadcrumb'] = 'Main';
		return $data;
	}
}
?>
