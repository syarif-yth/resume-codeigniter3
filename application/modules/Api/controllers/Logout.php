<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Logout extends RestController 
{
	private $dt_user;
	function __construct()
	{
		parent::__construct();
		$auth = $this->auth_token->valid_token();
		if($auth['status'] === true) {
			$data = $auth['body']['data'];
			$this->dt_user = $data->user;
		} else {
			$this->response($auth['body'], $auth['code']);
			die();
		}
	}

	public function index_get()
	{
		$res['status'] = true;
		$res['data'] = $this->dt_user;
		$this->response($res);
	}
}
?>
