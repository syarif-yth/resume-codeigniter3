<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intro extends MX_Controller 
{
	public function __constructor()
	{
		parent::__construct();
	}

	public function index()
	{
		var_dump('Welcome');
	}
}
