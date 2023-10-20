<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Kabupaten extends RestController 
{
	private $rule;
	private $dt_auth;
	function __construct()
	{
		parent::__construct();
		$auth = $this->auth_token->is_valid();
		if($auth['code'] !== 200) {
			$this->response($auth['body'], $auth['code']);
			die();
		}
		$this->rule = $auth['body']['user']['rule'];
		$this->load->library('permision');
	}

	public function index_get()
	{
		$res['status'] = true;
		$res['data'] = $this->rule;
		$this->response($res);
	}

	public function datatable_post()
	{
		
	}
}
?>
