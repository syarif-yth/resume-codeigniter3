<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Select2 extends RestController 
{
	private $rule;
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
		$this->load->model('model_app');
	}

	public function nav_get()
	{
		$get = $this->model_app->select2_nav();
		if($get['code'] !== 200) {
			$res['status'] = false;
			$res['message'] = $get['message'];
			$this->response($res, $get['code']);
		} else {
			$res['status'] = true;
			$res['data'] = $get['data'];
			$this->response($res);
		}
	}

	public function func_get()
	{
		$get = $this->model_app->select2_parent_func();
		if($get['code'] !== 200) {
			$res['status'] = false;
			$res['message'] = $get['message'];
			$this->response($res, $get['code']);
		} else {
			$res['status'] = true;
			$res['data'] = $get['data'];
			$this->response($res);
		}
	}

	public function method_get()
	{
		$get = $this->model_app->select2_method();
		if($get['code'] !== 200) {
			$res['status'] = false;
			$res['message'] = $get['message'];
			$this->response($res, $get['code']);
		} else {
			$res['status'] = true;
			$res['data'] = $get['data'];
			$this->response($res);
		}
	}

	public function aksi_get()
	{
		$get = $this->model_app->select2_aksi();
		if($get['code'] !== 200) {
			$res['status'] = false;
			$res['message'] = $get['message'];
			$this->response($res, $get['code']);
		} else {
			$res['status'] = true;
			$res['data'] = $get['data'];
			$this->response($res);
		}
	}

	public function is_child_get($parent = null)
	{
		if($parent) {
			$get = $this->model_app->select2_child_func($parent);
			if($get['code'] !== 200) {
				$res['status'] = false;
				$res['message'] = $get['message'];
				$this->response($res, $get['code']);
			} else {
				$res['status'] = true;
				$res['data'] = $get['data'];
				$this->response($res);
			}
		} else {
			$res['status'] = false;
			$res['message'] = 'Parent unknown!';
			$this->response($res, 404);
		}
	}
}
?>
