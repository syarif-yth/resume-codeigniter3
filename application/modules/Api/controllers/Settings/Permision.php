<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Permision extends RestController 
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
		$this->load->library('access');

		$access = $this->access->class($this->rule);
		if($access['code'] !== 200) {
			$this->response($access['body'], $access['code']);
			die();
		}

		$this->load->model('table_rules');
	}

	public function index_post()
	{
		$is_valid = $this->valid_post();
		if($is_valid === true) {
			$nama = $this->post('nama', true);
			$label = $this->post('label', true);
			$navi = $this->post('navigasi', true);
			$class = $this->post('class', true);
			$data = array('nama' => $nama,
				'label' => $label);
			if($navi) {
				$data = array_merge($data, 
					array('navigasi' => json_encode($navi)));
			}
			if($class) {
				$data = array_merge($data,
					array('class' => $this->set_insert_class($class)));
			}

			$insert = $this->table_rules->insert($data);
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

	public function index_delete()
	{
		$key = $this->delete('key', true);
		if(!$key) {
			$res['status'] = false;
			$res['message'] = 'Key not found!';
			$this->response($res, 404);
		} else {
			$check = $this->table_rules->check_user($key);
			if($check['code'] != 200) {
				$res['status'] = false;
				$res['message'] = $check['message'];
				$this->response($res, 401);
			} else {
				$del = $this->table_rules->delete($key);
				$res['status'] = ($del['code'] != 200) ? false : true;
				$res['message'] = $del['message'];
				$this->response($res, $del['code']);
			}
		}
	}

	public function index_put()
	{
		$is_valid = $this->valid_put();
		if($is_valid === true) {
			$id = $this->put('id', true);
			if($id) {
				$nama_old = $this->put('nama_old', true);
				$nama = $this->put('nama', true);
				$navi = $this->put('navigasi', true);

				if($nama_old !== $nama) {
					$check = $this->table_rules->check_user($nama_old);
					if($check['code'] !== 200) {
						$res['status'] = false;
						$res['message'] = $check['message'];
						$this->response($res, $check['code']);
					} else {
						$unique = $this->table_rules->nama_is_unique($nama);
						if($unique['code'] !== 200) {
							$res['status'] = false;
							$res['message'] = $unique['message'];
							$this->response($res, $unique['code']);
						} else {
							$data = array('nama' => $nama,
								'label' => $this->put('label', true));
							if($navi) {
								$data = array_merge($data, 
									array('navigasi' => json_encode($navi)));
							}
							$update = $this->table_rules->update($data, $id);
							$res['status'] = ($update['code']!==200) ? false : true;
							$res['message'] = $update['message'];
							$this->response($res, $update['code']);
						}
					}
				} else {
					$data = array('label' => $this->put('label', true));
					if($navi) {
						$data = array_merge($data, 
							array('navigasi' => json_encode($navi)));
					}
					$where = array('nama' => $nama);
					$update = $this->table_rules->update_where($data, $where);
					$res['status'] = ($update['code']!==200) ? false : true;
					$res['message'] = $update['message'];
					$this->response($res, $update['code']);
				}
			} else {
				$res['status'] = false;
				$res['message'] = 'Your form key not valid';
				$this->response($res, 400);
			}
		} else {
			$res['status'] = false;
			$res['message'] = 'Your request not valid';
			$res['errors'] = [$is_valid];
			$this->response($res, 400);
		}
	}

	public function nav_put()
	{
		$rule = $this->put('rule', true);
		if($rule) {
			$navi = $this->put('navigasi', true);
			$data = array('navigasi' => json_encode($navi));
			$where = array('nama' => $rule);
			$update = $this->table_rules->update_where($data, $where);
			$res['status'] = ($update['code']!==200) ? false : true;
			$res['message'] = $update['message'];
			$this->response($res, $update['code']);
		} else {
			$res['status'] = false;
			$res['message'] = 'Your form key not valid';
			$this->response($res, 400);
		}
	}

	public function class_put()
	{
		$rule = $this->put('rule', true);
		if($rule) {
			$data = array('class' => $this->set_update_class($this->put()));
			$where = array('nama' => $rule);
			$update = $this->table_rules->update_where($data, $where);
			$res['status'] = ($update['code']!==200) ? false : true;
			$res['message'] = $update['message'];
			$this->response($res, $update['code']);
		} else {
			$res['status'] = false;
			$res['message'] = 'Your form key not valid';
			$this->response($res, 400);
		}
	}

	public function method_put()
	{
		$rule = $this->put('rule', true);
		if($rule) {
			$class = $this->put('class', true);
			if($class) {
				$set_insert = $this->set_insert_method($this->put());
				$data = array('class' => $set_insert);
				$where = array('nama' => $rule);
				$update = $this->table_rules->update_where($data, $where);
				$res['status'] = ($update['code']!==200) ? false : true;
				$res['message'] = $update['message'];
				$this->response($res, $update['code']);
			} else {
				$res['status'] = false;
				$res['message'] = 'Your form key not valid';
				$this->response($res, 400);
			}
		} else {
			$res['status'] = false;
			$res['message'] = 'Your form key not valid';
			$this->response($res, 400);
		}
	}

	public function detail_post()
	{
		$rule = $this->post('rule', true);
		$class = $this->post('class', true);
		if($rule) {
			if($class) {
				$where = array('nama' => $rule);
				$get = $this->table_rules->select_class($where);
				if($get['code'] !== 200) {
					$res['status'] = false;
					$res['message'] = $get['message'];
					$this->response($res, $get['code']);
				} else {
					$decode = json_decode($get['data']);
					$data = (array) $decode;
					$res['status'] = true;
					$res['data'] = $data[$class];
					$this->response($res);
				}
			} else {
				$res['status'] = false;
				$res['message'] = 'Request not valid';
				$this->response($res, 400);
			}
		} else {
			$res['status'] = false;
			$res['message'] = 'Request not valid';
			$this->response($res, 400);
		}
	}

	private function set_insert_method($put)
	{
		// SET data child
		$set_child = array();
		if(!empty($put['child'])) {
			foreach($put['child'] as $key => $val) {
				$method = [];
				if(!empty($put['method_child'][$key])) {
					$method = $put['method_child'][$key];
				}
				$set_child[] = array($val => $method);
			}
		}

		// merge child by key
		$array_child = array_merge_recursive(...$set_child);
		foreach($array_child as &$key) $key = array_unique($key);

		// set new data for merge with existing data
		$new_data[$put['class']] = array(
			'method' => (empty($put['method'])) ? [] : $put['method'],
			'aksi' => (empty($put['aksi'])) ? [] : $put['aksi'],
			'child' => $array_child);

		// get existing data
		$where = array('nama' => $put['rule']);
		$get = $this->table_rules->select_class($where);
		$decode = json_decode($get['data']);
		$exist = (array) $decode;
		// replace existing data with key same
		unset($exist[$put['class']]);
		
		// merge new data and existing
		$merge = array_merge($new_data, $exist);
		return json_encode($merge);
	}

	public function datatable_post()
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
			$nav = ($field->navigasi!=NULL) ? json_decode($field->navigasi) : [];
			$row[] = $nav;

			$class = array();
			if($field->class != NULL) {
				$dt_class = json_decode($field->class);
				foreach($dt_class as $key => $val) {
					$class[] = $key;
				}
			}
			$row[] = $class;
			$row[] = $this->model_dtable->count_users($field->nama);
			$row[] = $field->id;
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

	private function valid_post()
  {
		$this->form_validation->set_data($this->post());
    $data = array(
      array('field' => 'nama',
        'rules' => 'trim|required|min_length[3]|max_length[15]|db_rulename_is_unique'),
      array('field' => 'label',
        'rules' => 'trim|required|min_length[5]|max_length[50]')
    );
    $this->form_validation->set_rules($data);
		if($this->form_validation->run($this) == false) {
			return $this->form_validation->error_array();
		} else {
			return true;
		}
  }

	private function set_update_class($put)
	{
		// get existing data
		$where = array('nama' => $put['rule']);
		$get = $this->table_rules->select_class($where);
		$decode = json_decode($get['data']);
		$exist = (array) $decode;

		// set new data
		$class = $put['class'];
		$new_data = array();
		foreach($class as $key => $val) {
			if(empty($exist[$val])) {
				// check is empty in existing data and create new
				$new_data[$val] = array('method' => [],
					'aksi' => [],
					'child' => []);
			} else {
				// return existing data
				$new_data[$val] = $exist[$val];
			}
		}

		return json_encode($new_data);
	}

	private function set_insert_class($class_post)
	{
		$array = array();
		foreach($class_post as $key => $val) {
			$array[$val] = array('method' => [],
				'aksi' => [],
				'child' => []);
		}
		return json_encode($array);
	}

	private function valid_put()
  {
		$this->form_validation->set_data($this->put());
    $data = array(
      array('field' => 'nama',
        'rules' => 'trim|required|min_length[3]|max_length[15]'),
      array('field' => 'label',
        'rules' => 'trim|required|min_length[5]|max_length[50]')
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
