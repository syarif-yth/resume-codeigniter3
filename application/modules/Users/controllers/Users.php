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
		$view['content'] = 'users';
		$this->load->view('template', $view);
		$this->load->view('assets/js/users');
	}

	public function add()
	{
		$view['content'] = 'insert';
		$this->load->view('template', $view);
		$this->load->view('assets/js/users_insert');
	}

	public function edit()
	{
		$view['content'] = 'edit';
		$this->load->view('template', $view);
		$this->load->view('assets/js/users_edit');
	}

	public function view()
	{
		$view['content'] = 'detail';
		$view['cover'] = 'assets/img/cover-default.jpg';
		$this->load->view('template', $view);
		$this->load->view('assets/js/users_view');
	}
}
?>
