<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recovery extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('recovery');
	}

	public function reset()
	{
		$this->load->view('reset');
	}

	public function success()
	{
		$this->load->view('notify');
	}
}
?>
