<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('activation');
	}
}
?>
