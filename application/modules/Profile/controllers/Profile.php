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
		$view['content'] = 'profile';
		$view['cover'] = 'assets/img/cover-default.jpg';
		$this->load->view('template', $view);
		$this->load->view('assets/js/profile');
	}

	public function edit()
	{
		$view['content'] = 'edit';
		$view['cover'] = 'assets/img/cover-default.jpg';
		$this->load->view('template', $view);
		$this->load->view('assets/js/profile_edit');
	}
}
?>
