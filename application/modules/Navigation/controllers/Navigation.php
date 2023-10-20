<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$view['content'] = 'navigation';
		$this->load->view('template', $view);
		$this->load->view('assets/js/navigasi');
	}
}
?>
