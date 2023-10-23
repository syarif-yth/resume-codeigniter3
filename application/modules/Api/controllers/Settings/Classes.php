<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Classes extends RestController 
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

		$this->load->model('table_par_class');
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
			$is_child = $this->post('is_child', true);
			if($is_child) {
				$data = array(
					'nama' => $this->post('nama', true),
					'label' => $this->post('label', true),
					'is_child' => '1',
					'parent' => implode(",", $this->post('parent', true)));
				$insert = $this->table_par_class->insert($data);
				$res['status'] = ($insert['code'] != 200) ? false : true;
				$res['message'] = $insert['message'];
				$this->response($res, $insert['code']);
			} else {
				$data = array(
					'nama' => $this->post('nama', true),
					'label' => $this->post('label', true));
				$insert = $this->table_par_class->insert($data);
				$res['status'] = ($insert['code'] != 200) ? false : true;
				$res['message'] = $insert['message'];
				$this->response($res, $insert['code']);
			}
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
				$is_child = $this->put('is_child', true);
				if(!empty($is_child)) {
					$data = array(
						'nama' => $this->put('nama', true),
						'label' => $this->put('label', true),
						'is_child' => '1',
						'parent' => implode(",", $this->put('parent', true)));
					$update = $this->table_par_class->update($data, $id);
					$res['status'] = ($update['code'] != 200) ? false : true;
					$res['message'] = $update['message'];
					$this->response($res, $update['code']);
				} else {
					$data = array(
						'nama' => $this->put('nama', true),
						'label' => $this->put('label', true),
						'is_child' => '0',
						'parent' => NULL);
					$update = $this->table_par_class->update($data, $id);
					$res['status'] = ($update['code'] != 200) ? false : true;
					$res['message'] = $update['message'];
					$this->response($res, $update['code']);
				}
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
			$del = $this->table_par_class->delete($key);
			$res['status'] = ($del['code'] != 200) ? false : true;
			$res['message'] = $del['message'];
			$this->response($res, $del['code']);
		}
	}

	public function datatable_post()
	{
		$param = array(
			'table' => 'par_class',
			'post_start' => $this->post('start'),
			'post_length' => $this->post('length'),
			'default_order' => array('urutan' => 'ASC'),
			'col_order' => array(null, 'nama', 'label'),
			'post_order' => $this->post('order'),
			'col_search' => array('nama','label'),
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
			$row['nama'] = $field['nama'];
			$row['label'] = $field['label'];
			$row['is_child'] = $field['is_child'];
			$row['parent'] = $field['parent'];

			$label = NULL;
			if($field['parent'] != null) {
				$parent = $field['parent'];
				$exp = explode(',', $parent);
				foreach($exp as $key => $val) {
					$get = $this->model_dtable->label_class($val);
					$last = count($exp)-1;
					$label .= ($key==$last) ? $get : $get.',';
				}
			}
			$row['label_parent'] = $label;

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
			array('field' => 'nama',
				'label' => 'Name',
				'rules' => 'trim|required|min_length[3]|max_length[20]|db_classnama_is_unique|no_space'),
			array('field' => 'label',
				'label' => 'Label',
				'rules' => 'trim|required|min_length[3]|max_length[50]')
		);

		if($this->post('is_child')) {
			$parent = array(array('field' => 'parent[]',
			'label' => 'Parent',
			'rules' => 'trim|required'));
			$data = array_merge($data, $parent);
		}
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
			array('field' => 'nama',
				'label' => 'Name',
				'rules' => 'trim|required|min_length[3]|max_length[20]|valid_classnama[nama_old]|no_space'),
			array('field' => 'label',
				'label' => 'Label',
				'rules' => 'trim|required|min_length[3]|max_length[50]')
		);

		if($this->put('is_child')) {
			$parent = array(array('field' => 'parent[]',
			'label' => 'Parent',
			'rules' => 'trim|required'));
			$data = array_merge($data, $parent);
		}
    $this->form_validation->set_rules($data);
		if($this->form_validation->run($this) == false) {
			return $this->form_validation->error_array();
		} else {
			return true;
		}
  }

}
?>
