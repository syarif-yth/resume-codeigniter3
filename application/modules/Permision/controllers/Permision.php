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
		$view['content'] = 'permision';
		$this->load->view('template', $view);
		$this->load->view('assets/js/permision');
	}
}
?>
