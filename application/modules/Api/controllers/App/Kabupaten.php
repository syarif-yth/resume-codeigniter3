<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Kabupaten extends RestController 
{
	function __construct()
	{
		parent::__construct();
		$auth = $this->auth_token->is_valid();
		if($auth['code'] !== 200) {
			$this->response($auth['body'], $auth['code']);
			die();
		}
		$this->load->model('model_app');
	}

	public function index_get()
	{
		$get = $this->model_app->select2_location();
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

	public function datatable_post()
	{
		$param = array(
			'table' => 'kabupaten',
			'post_start' => $this->post('start'),
			'post_length' => $this->post('length'),
			'default_order' => array('kode' => 'ASC'),
			'col_order' => array(null,'kode','nama'),
			'post_order' => $this->post('order'),
			'col_search' => array('kode','nama'),
			'post_search' => $this->post('search')['value'],
		);

		$this->load->model('model_dtable');
		$list = $this->model_dtable->get($param);

		$data = array();
		$no = $this->post('start');
		foreach($list as $key => $field) {
			$no++;
			$row = array();
			$row['no'] = $no;
			$row['kode'] = $field['kode'];
			$row['nama'] = $field['label'].' '.$field['nama'];
			$data[] = $row;
		}

		$output = array(
			'draw' => $this->post('draw'),
			'recordsTotal' => $this->model_dtable->count($param),
			'recordsFiltered' => $this->model_dtable->filtered($param),
			'data' => $data,
		);
		
		$this->response($output);
	}
}
?>
