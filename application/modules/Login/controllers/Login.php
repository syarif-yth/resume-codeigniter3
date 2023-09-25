<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// var_dump('loginpage');
		$this->load->view('login');
	}
}
?>
