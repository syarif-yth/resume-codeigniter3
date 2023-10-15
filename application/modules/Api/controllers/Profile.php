<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Profile extends RestController 
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
	}

	public function index_get()
	{
		$res['status'] = true;
		$res['data'] = array(
			'login' => $this->dt_user,
			'navigasi' => $this->permision->navigasi($this->rule),
			'profile' => array(
				'aksi' => ['view','edit'],
				'info' => $this->get_data()['data'],
				'skill' => $this->get_data()['data'],
				'pengalaman' => $this->get_data()['data'],
				'sekolah' => $this->get_data()['data']),
		);
		$this->response($res);
	}
	

	private function get_data()
	{
		$this->load->model('model_profile');
		$get = $this->model_profile->get_info($this->nip);
		return $get;
	}


}
?>
