<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Users extends RestController 
{
	private $dt_user;
	private $nip;
	private $rule;

	function __construct()
	{
		parent::__construct();
		$auth = $this->auth_token->is_valid();
		if($auth['code'] !== 200) {
			$this->response($auth['body'], $auth['code']);
			die();
		}
		
		$this->dt_user = $auth['body']['data'];
		$this->nip = $this->dt_user['nip'];
		$this->rule = $this->dt_user['rule'];
		$this->load->model('table_users');
		$this->load->library('permision');

		// $permision = $this->permision->method($this->rule);
		// if($permision['code'] !== 200) {
			// $this->response($permision['body'], $permision['code']);
			// die();
		// }
	}

	private function set_data($extra = null)
	{
		$aksi = array('aksi' => $this->permision->action($this->rule));
		$users = ($extra) ? array_merge($aksi, $extra) : $aksi;
		$data = array('login' => $this->dt_user,
			'navigasi' => $this->permision->navigasi($this->rule),
			'users' => $users
		);
		return $data;
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
			$extra['table'] = $get['data'];
			
			$res['status'] = true;
			$res['data'] = $this->set_data($extra);
			$this->response($res);
		}
	}

	public function index_post()
	{
		$akses = array(
			"users" => array(
				"aksi" => array("add","edit","delete"),
				"method" => array("get","post","put"),
				"child" => array(
					"dataTables" => array(
						"aksi" => array("search","paginate","sorting"),
						"method" => array("post","get")
					),
					"chart" => array("post","get"),
					"pdf" => array("get","delete")
				) 
			),
			"navigasi" => array("profile","resume","users")
		);
		$post = $this->post();
		$this->response($akses);
	}

	public function index_put()
	{
		$post = $this->put();
		$this->response($post);
	}

	public function index_delete()
	{
		$post = 'deleted';
		$this->response($post);
	}

	public function datatables_get()
	{
		$dummy = $this->permision->dataDummy();
		$this->response(json_decode($dummy));
	}
}
