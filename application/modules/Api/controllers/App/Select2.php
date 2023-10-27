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
		$this->load->model('model_app');
	}

	public function param_nav_get()
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

	public function param_class_get()
	{
		$get = $this->model_app->select2_parent_class();
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

	public function param_method_get()
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

	public function param_aksi_get()
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

	public function param_is_child_get($parent = null)
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

	public function param_class_without_get()
	{
		$nama = $this->get('nama', true);
		$get = $this->model_app->select2_parent_class_without($nama);
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

	public function param_rule_get()
	{
		$get = $this->model_app->select2_rule();
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
}
?>
