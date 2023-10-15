<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Tester extends RestController 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('auth_token');
	}

	public function index_get()
	{
		$user_id = '5156165549';
		$exe = $this->auth_token->create($user_id);
		$this->response($exe);
	}

	public function index_post()
	{
		$user_id = '5156165549';
		$exe = $this->auth_token->validate($user_id);
		$this->response($exe);
	}

	public function index_delete()
	{
		$user_id = '5156165549';
		$exe = $this->auth_token->destroy();
		$this->response($exe);
	}
}
?>
