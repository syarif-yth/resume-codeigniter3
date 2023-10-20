<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resume extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$view['content'] = 'resume';
		$this->load->view('template', $view);
		$this->load->view('assets/js/resume');
	}

	public function detail()
	{
		$view['content'] = 'detail';
		$this->load->view('template', $view);
		$this->load->view('assets/js/resume_detail');
	}
}
