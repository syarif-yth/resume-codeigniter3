<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Prototype extends RestController
{
	function __construct()
	{
		parent::__construct();
		$auth = $this->auth_token->valid_token();
		if($auth['status'] === false) {
			$this->response($auth['body'], $auth['code']);
			die();
		}
		$this->load->model('model_prototype');
	}

	public function index_get($nip = null)
	{
		if(!$nip) {
			$get = $this->model_prototype->select_all();
		} else {
			$by = array('nip' => $nip);
			$get = $this->model_prototype->select_by($by);
		}

		if($get['code'] != 200) {
			$res['status'] = false;
			$res['message'] = $get['message'];
			$this->response($res, $get['code']);
		} else {
			$res['status'] = true;
			unset($get['code']);
			$res = array_merge($res, $get);
			$this->response($res);
		}
	}

	public function index_post()
	{
		$this->load->helper('input_helper');
		$nip = create_nip();
		$pass = $this->post('password', true);
		$post = array(
			'nip' => $nip,
			'email' => $this->post('email', true),
			'username' => $this->post('username', true),
			'password' => encrypt_pass($nip, $pass));

		$insert = $this->model_prototype->insert($post);
		if($insert['code'] != 200) {
			$res['status'] = false;
			$res['message'] = $insert['message'];
			$this->response($res, $insert['code']);
		} else {
			$res['status'] = true;
			unset($insert['code']);
			$res = array_merge($res, $insert);
			$this->response($res);
		}
	}

	public function index_delete($nip)
	{
		if(!$nip) {
			$res['status'] = false;
			$res['message'] = 'nip not found!';
			$this->response($res, 404);
		} else {
			$del = $this->model_prototype->delete($nip);
			if($del['code'] != 200) {
				$res['status'] = false;
				$res['message'] = $del['message'];
				$this->response($res, $del['code']);
			} else {
				$res['status'] = true;
				unset($del['code']);
				$res = array_merge($res, $del);
				$this->response($res);
			}
		}
	}

	public function index_put($nip)
	{
		if(!$nip) {
			$res['status'] = false;
			$res['message'] = 'nip not found!';
			$this->response($res, 404);
		} else {
			$put = array(
				'nama' => $this->put('nama', true)
			); 
			$update = $this->model_prototype->update($put, $nip);
			if($update['code'] != 200) {
				$res['status'] = false;
				$res['message'] = $update['message'];
				$this->response($res, $update['code']);
			} else {
				$res['status'] = true;
				unset($update['code']);
				$res = array_merge($res, $update);
				$this->response($res);
			}
		}
	}
}
?>
