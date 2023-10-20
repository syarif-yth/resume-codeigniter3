<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$view['content'] = 'location';
		$this->load->view('template', $view);
		$this->load->view('assets/js/location');
	}
}
?>
