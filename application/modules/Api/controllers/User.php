<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class User extends RestController 
{
	private $dt_user;
	function __construct()
	{
		parent::__construct();
		$auth = $this->auth_token->valid_token();
		if($auth['status'] === true) {
			$data = $auth['body']['data'];
			$this->dt_user = $data->user;
			$this->load->model('table_users');
		} else {
			$this->response($auth['body'], $auth['code']);
			die();
		}
	}

	public function index_get($nip = null)
	{
		if(!$nip) {
			$get = $this->table_users->select_all();
		} else {
			$by = array('nip' => $nip);
			$get = $this->table_users->select_by($by);
		}

		if($get['code'] != 200) {
			$res['status'] = false;
			$res['message'] = $get['message'];
			$this->response($res, $get['code']);
		} else {
			$res['status'] = true;
			$auth = $this->auth_token->valid_token();
			unset($get['code']);
			$res['user'] = $this->dt_user;
			$res = array_merge($res, $get);
			$this->response($res);
		}
	}
}
