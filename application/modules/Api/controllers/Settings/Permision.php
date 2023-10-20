<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Permision extends RestController 
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

	public function index_post()
	{
		$param = array(
			'table' => 'rules',
			'post_start' => $_POST['start'],
			'post_length' => $_POST['length'],
			'default_order' => array('id' => 'ASC'),
			'col_order' => array(null, 'nama','label'),
			'post_order' => $_POST['order'],
			'col_search' => array('nama','label'),
			'post_search' => $_POST['search']['value'],
		);

		$this->load->model('model_dtable');
		$list = $this->model_dtable->get_data($param);
		$data = array();
		$no = $_POST['start'];
		foreach($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama;
			$row[] = $field->label;
			$decode = json_decode($field->akses);
			// $row[] = count($decode->navigasi);
			$row[] = $decode->navigasi;
			$array = (array) $decode;
			$row[] = count($array)-1;
			$row[] = '20';
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->model_dtable->count_all($param),
			'recordsFiltered' => $this->model_dtable->count_filtered($param),
			'data' => $data,
		);
		$this->response($output);
	}
}
?>
