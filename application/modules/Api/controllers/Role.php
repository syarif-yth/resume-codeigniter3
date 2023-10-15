<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Role extends RestController 
{
	private $dt_user;
	private $nip;

	private $method;
	private $func;
	private $class;
	function __construct()
	{
		parent::__construct();
		// $auth = $this->auth_token->is_valid();
		// if($auth['code'] === 200) {
		// 	$this->dt_user = $auth['body']['data'];
		// 	$this->nip = $auth['body']['data']['nip'];
		// 	$this->load->model('table_users');
		// } else {
		// 	$this->response($auth['body'], $auth['code']);
		// 	die();
		// }

		$this->method = $this->input->method();
		$this->func = $this->router->fetch_method();
		$this->class = $this->router->fetch_class();

		$this->load->library('permision');
		$this->permision->validate();
	}

	public function index_get()
	{
		$res['status'] = true;
		$res['message'] = 'index get';
		// $res['method'] = $this->method;
		// $res['class'] = $this->class;
		// $res['func'] = $this->func;

		// $res['satu'] = $this->permision->dummy();
		// $res['dua'] = $this->permision->dummy2();

		$res['valid'] = $this->permision->crud();
		$this->response($res);
	}
	public function index_post()
	{
		$res['status'] = true;
		$res['message'] = 'index post';
		$res['method'] = $this->method;
		$res['class'] = $this->class;
		$res['func'] = $this->func;
		$this->response($res);
	}
	public function index_put()
	{
		$res['status'] = true;
		$res['message'] = 'index put';
		$res['method'] = $this->method;
		$res['class'] = $this->class;
		$res['func'] = $this->func;
		$this->response($res);
	}
	public function index_delete()
	{
		$res['status'] = true;
		$res['message'] = 'index delete';
		$res['method'] = $this->method;
		$res['class'] = $this->class;
		$res['func'] = $this->func;
		$this->response($res);
	}

	public function custom_get()
	{
		$res['status'] = true;
		$res['message'] = 'custom';
		$res['method'] = $this->method;
		$res['class'] = $this->class;
		$res['func'] = $this->func;

		$res['valid'] = $this->permision->validate();
		$this->response($res);
	}
}
?>
