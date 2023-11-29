<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Users extends RestController 
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
		$access = $this->access->class($this->rule);
		if($access['code'] !== 200) {
			$this->response($access['body'], $access['code']);
			die();
		}
		$this->load->model('table_users');
		$this->load->helper('input');
		$this->load->helper('datetime');
	}

	public function index_get()
	{
		$disabled = $this->access->action_disabled($this->rule);
		$res['status'] = true;
		$res['data'] = $disabled;
		$this->response($res);
	}

	public function datatable_post()
	{
		$param = array(
			'table' => 'users',
			'post_start' => $this->post('start'),
			'post_length' => $this->post('length'),
			'default_order' => array('username' => 'ASC'),
			'col_order' => array(null, 'nama','username','email','profesi'),
			'post_order' => $this->post('order'),
			'col_search' => array('nama','username','email','profesi'),
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
			$row['username'] = $field['username'];
			$row['email'] = $field['email'];
			$row['profesi'] = $field['profesi'];
			$status = $this->model_dtable->get_status($field['nip']);
			$row['status'] = ucfirst($status);

			$act = $this->access->action_table($this->rule);
			$row['action'] = array_merge(
				array('nip' => $field['nip']), $act);
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

	private function upload($field)
	{
		$time = now('ymdHis');
		$user = $this->post('username', true);
		$file_name = $field.'-'.$user.'-'.$time;

		$config['upload_path'] = 'assets/img/users/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size'] = 2048; //KB
		$config['file_name'] = $file_name;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		if(!$this->upload->do_upload($field)) {
			$res['status'] = false;
			$res['message'] = $this->upload->display_errors('','');
		} else {
			$res['status'] = true;
			$res['data'] = $this->upload->data();
		}
		$res['field'] = $field;
		return $res;
	}

	public function index_post()
	{
		$is_valid = $this->valid_post();
		if($is_valid === true) {
			$cover = $_FILES['cover'];
			$avatar = $_FILES['avatar'];
			$upload = array();
			if($cover['name']) {
				$upload[] = $this->upload('cover');
			} 
			if($avatar['name']) {
				$upload[] = $this->upload('avatar');
			}

			$errors = array();
			$img = array();
			foreach($upload as $key => $val) {
				if($val['status'] == false) {
					$errors[$val['field']] = $val['message'];
				} else {
					$img[$val['field']] = $val['data']['file_name'];
				}
			}

			if($errors) {
				if(!empty($img['cover'])) {
					unlink('assets/img/users/'.$img['cover']);
				}
				if(!empty($img['avatar'])) {
					unlink('assets/img/users/'.$img['avatar']);
				}
				$res['status'] = false;
				$res['message'] = 'Your request not valid';
				$res['errors'] = $errors;
				$this->response($res, 400);
			} else {
				$nip = create_nip();
				$pass = $this->post('password', true);
				$set = array('nip' => $nip,
					'password' => encrypt_pass($nip, $pass));
				
				$post = $this->post();
				unset($post['passconf']);
				$data = array();
				foreach($post as $key => $val) {
					if($val!=='') {
						$data[$key] = $val;
					}
				}
				$merge = array_merge($data, $img, $set);

				$insert = $this->table_users->insert_attr($merge);
				$res['status'] = ($insert['code']!==200) ? false : true;
				$res['message'] = $insert['message'];
				$this->response($res, $insert['code']);
			}
		} else {
			$res['status'] = false;
			$res['message'] = 'Your request not valid';
			$res['errors'] = $is_valid;
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
			$del = $this->table_users->delete_attr($key);
			$res['status'] = ($del['code'] != 200) ? false : true;
			$res['message'] = $del['message'];
			$this->response($res, $del['code']);
		}
	}

	public function close_delete()
	{
		$is_valid = $this->valid_close();
		if($is_valid === true) {
			$res['status'] = true;
			$res['data'] = $this->delete();
			$this->response($res);
		} else {
			$res['status'] = false;
			$res['message'] = 'Your request not valid';
			$res['errors'] = $is_valid;
			$this->response($res, 400);
		}
	}

	public function profesi_get()
	{
		$get = $this->read_json();
		$res['status'] = true;
		$res['data'] = $get['profesi'];
		$this->response($res);
	}

	private function read_json()
	{
		$this->load->helper('path');
		$file = 'assets/json/profesi.json';
		$path = set_realpath($file);
		$get = file_get_contents($path); 
		$decode = json_decode($get);
		$array = (array) $decode;
		return $array;
	}

	private function edit_json($post)
	{
		$this->load->helper('path');
		$file = 'assets/json/profesi.json';
		$path = set_realpath($file);
		$get = file_get_contents($path); 
		$decode = json_decode($get);
		$array = (array) $decode;
		$new = array($post);
		$merge = array_merge($array['profesi'], $new);
		$data = array('profesi' => array_unique($merge));
		$update = file_put_contents($path, json_encode($data));
		return $update ?true :false; 
	}

	private function valid_post()
	{
		$this->form_validation->set_data($this->post());
    $data = array(
			array('field' => 'email',
				'label' => 'Email Address',
        'rules' => 'trim|required|min_length[5]|max_length[100]|no_space|valid_email|db_email_is_unique'),
			array('field' => 'username',
				'label' => 'Username',
        'rules' => 'trim|required|min_length[3]|max_length[50]|no_space|valid_username|db_username_is_unique'),
      array('field' => 'password',
				'label' => 'Password',
        'rules' => 'trim|required|min_length[3]|max_length[50]|valid_password|matches[passconf]'),
			array('field' => 'passconf',
				'label' => 'Confirm Password',
        'rules' => 'trim|required|min_length[3]|max_length[50]|valid_password|matches[password]'),
      array('field' => 'nama',
				'label' => 'Name',
        'rules' => 'trim|min_length[3]|max_length[50]'),
			array('field' => 'no_telp',
				'label' => 'Number Phone',
        'rules' => 'trim|min_length[10]|max_length[15]|is_numeric'),
			array('field' => 'jenis_kelamin',
				'label' => 'Gender',
        'rules' => 'trim|valid_gender'),
			array('field' => 'tgl_lahir',
				'label' => 'Date of Birth',
        'rules' => 'trim|valid_birth'),
			array('field' => 'rule',
				'label' => 'Rule',
        'rules' => 'trim|valid_rule'),
    );

    $this->form_validation->set_rules($data);
		if($this->form_validation->run($this) == false) {
			return $this->form_validation->error_array();
		} else { return true; }
	}

	private function valid_close()
	{
		$this->form_validation->set_data($this->delete());
		$data = array(
			array('field' => 'email',
				'label' => 'Email Address',
        'rules' => 'trim|required|min_length[5]|max_length[100]|no_space|valid_email'),
			array('field' => 'username',
				'label' => 'Username',
        'rules' => 'trim|required|min_length[3]|max_length[50]|no_space|valid_username'),
      array('field' => 'password',
				'label' => 'Password',
        'rules' => 'trim|required|min_length[3]|max_length[50]|valid_password|matches[passconf]'),
			array('field' => 'passconf',
				'label' => 'Confirm Password',
        'rules' => 'trim|required|min_length[3]|max_length[50]|valid_password|matches[password]'),
			array('field' => 'rule',
				'label' => 'Rule',
        'rules' => 'trim|valid_rule'),
    );
		
		$this->form_validation->set_rules($data);
		if($this->form_validation->run($this) == false) {
			return $this->form_validation->error_array();
		} else { return true; }
	}
}
?>
