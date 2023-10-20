<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Loginas extends RestController 
{
	private $user;
	function __construct()
	{
		parent::__construct();
		$auth = $this->auth_token->is_valid();
		if($auth['code'] !== 200) {
			$this->response($auth['body'], $auth['code']);
			die();
		}

		$this->user = $auth['body']['user'];
	}

	public function index_get()
	{
		$res['status'] = true;
		$res['data'] = $this->user;
		$this->response($res);
	}
}
?>
