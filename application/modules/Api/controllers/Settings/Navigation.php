<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Navigation extends RestController 
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
		$this->load->library('access');

		$access = $this->access->class($this->rule);
		if($access['code'] !== 200) {
			$this->response($access['body'], $access['code']);
			die();
		}

		$this->load->model('table_nav');
	}

	public function index_get()
	{
		$disabled = $this->access->action_disabled($this->rule);
		$res['status'] = true;
		$res['data'] = $disabled;
		$this->response($res);
	}

	public function index_post()
	{
		$is_valid = $this->valid_post();
		if($is_valid === true) {
			$set = array_filter($this->post());
			$insert = $this->table_nav->insert($set);
			$res['status'] = ($insert['code'] != 200) ? false : true;
			$res['message'] = $insert['message'];
			$this->response($res, $insert['code']);
		} else {
			$res['status'] = false;
			$res['message'] = 'Your request not valid';
			$res['errors'] = [$is_valid];
			$this->response($res, 400);
		}
	}

	public function index_put()
	{
		$is_valid = $this->valid_put();
		if($is_valid === true) {
			$id = $this->put('id', true);
			if($id) {
				$filter = array_filter($this->put());
				unset($filter['id']);
				unset($filter['nama_old']);
				unset($filter['urutan_old']);
				$update = $this->table_nav->update($filter, $id);
				$res['status'] = ($update['code'] != 200) ? false : true;
				$res['message'] = $update['message'];
				$this->response($res, $update['code']);
			} else {
				$res['status'] = false;
				$res['message'] = 'Form key not valid';
				$this->response($res, 400);
			}
		} else {
			$res['status'] = false;
			$res['message'] = 'Your request not valid';
			$res['errors'] = [$is_valid];
			$this->response($res, 400);
		}
	}

	public function index_delete()
	{
		$key = $this->delete('key', true);
		if(!$key) {
			$res['status'] = false;
			$res['message'] = 'Key not found!';
			$this->response($res, 404);
		} else {
			$del = $this->table_nav->delete($key);
			$res['status'] = ($del['code'] != 200) ? false : true;
			$res['message'] = $del['message'];
			$this->response($res, $del['code']);
		}
	}

	public function datatable_post()
	{
		$param = array(
			'table' => 'navigasi',
			'post_start' => $this->post('start'),
			'post_length' => $this->post('length'),
			'default_order' => array('urutan' => 'ASC'),
			'col_order' => array(null, 'group', 
				'nama', 'label', 'url', null, 'urutan'),
			'post_order' => $this->post('order'),
			'col_search' => array('group', 'nama','label'),
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
			$row['group'] = $field['group'];
			$row['nama'] = $field['nama'];
			$row['label'] = $field['label'];
			$row['url'] = $field['url'];
			$row['icon'] = $field['icon'];
			$row['sorting'] = $field['urutan'];

			$act = $this->access->action_table($this->rule);
			$row['action'] = array_merge(array('id' => $field['id']), $act);
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

	private function valid_post()
  {
		$this->form_validation->set_data($this->post());
    $data = array(
      array('field' => 'group',
				'label' => 'Group',
        'rules' => 'trim|required|min_length[3]|max_length[20]'),
      array('field' => 'nama',
				'label' => 'Name',
        'rules' => 'trim|required|min_length[3]|max_length[20]|db_navname_is_unique'),
			array('field' => 'label',
				'label' => 'Label',
        'rules' => 'trim|required|min_length[3]|max_length[20]'),
			array('field' => 'url',
				'label' => 'URL',
        'rules' => 'trim|required|min_length[3]|max_length[50]'),
			array('field' => 'url',
				'label' => 'URL',
        'rules' => 'trim|required|min_length[3]|max_length[50]'),
			array('field' => 'icon',
				'label' => 'Icon',
        'rules' => 'trim|min_length[3]|max_length[20]'),
			array('field' => 'urutan',
				'label' => 'Sorting',
        'rules' => 'trim|required|min_length[1]|max_length[2]|db_urutan_is_unique'),
    );
    $this->form_validation->set_rules($data);
		if($this->form_validation->run($this) == false) {
			return $this->form_validation->error_array();
		} else {
			return true;
		}
  }

	private function valid_put()
  {
		$this->form_validation->set_data($this->put());
    $data = array(
      array('field' => 'group',
				'label' => 'Group',
        'rules' => 'trim|required|min_length[3]|max_length[20]'),
      array('field' => 'nama',
				'label' => 'Name',
        'rules' => 'trim|required|min_length[3]|max_length[20]|valid_navnama[nama_old]'),
			array('field' => 'label',
				'label' => 'Label',
        'rules' => 'trim|required|min_length[3]|max_length[20]'),
			array('field' => 'url',
				'label' => 'URL',
        'rules' => 'trim|required|min_length[3]|max_length[50]'),
			array('field' => 'url',
				'label' => 'URL',
        'rules' => 'trim|required|min_length[3]|max_length[50]'),
			array('field' => 'icon',
				'label' => 'Icon',
        'rules' => 'trim|min_length[3]|max_length[20]'),
			array('field' => 'urutan',
				'label' => 'Sorting',
        'rules' => 'trim|required|min_length[1]|max_length[2]|valid_urutan[urutan_old]'),
    );
    $this->form_validation->set_rules($data);
		if($this->form_validation->run($this) == false) {
			return $this->form_validation->error_array();
		} else {
			return true;
		}
  }
}
?>
