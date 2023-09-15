<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Login extends RestController 
{
	function __construct()
	{
		parent::__construct();
		$model = array('model_auth',
			'validation');
		$this->load->model($model);
		$this->load->helper('input_helper');
	}

	public function index_post()
	{
		$username = $this->post('username', true);
		$password = $this->post('password', true);
		
		$is_valid = $this->valid_input();
		if($is_valid === true) {
			$check = $this->model_auth->check_username_login($username);
			if($check['code'] != 200) {
				$res['status'] = false;
				$res['message'] = $check['message'];
				$this->response($res, $check['code']);
			} else {
				$nip = $check['data'];
				$pass = encrypt_pass($nip, $password);

				$login = $this->model_auth->login($username, $pass);
				if($login['code'] != 200) {
					$res['status'] = false;
					$res['message'] = $login['message'];
					$this->response($res, $login['code']);
				} else {
					$data_log = $login['data'];
					if($data_log['kode_aktifasi'] != NULL) {
						$res['status'] = false;
						$res['message'] = 'Your account not verify';
						$this->response($res, 400);
					} else {
						$param = array('nip' => $data_log['nip'], 
							'email' => $data_log['email'], 
							'username' => $data_log['username']);
						$create = $this->auth_token->create_token($param);
						if($create['code'] != 200) {
							$res['status'] = false;
							$res['message'] = $create['message'];
							$this->response($res, $create['code']);
						} else {
							unset($data_log['kode_aktifasi']);
							$res['status'] = true;
							$res['data'] = array(
								'user' => $data_log, 
								'auth' => $create['data']);
							$this->response($res);
						}
					}
				}
			}
		} else {
			$res['status'] = false;
			$res['message'] = 'Your request not valid';
			$res['errors'] = [$is_valid];
			$this->response($res, 400);
		}
	}

	private function valid_input()
  {
		$this->form_validation->set_data($this->post());
    $data = array(
      array('field' => 'username',
        'rules' => 'trim|required|min_length[5]|max_length[20]|callback_username'),
      array('field' => 'password',
        'rules' => 'required|min_length[5]callback_password')
    );
    $this->form_validation->set_rules($data);
		if($this->form_validation->run($this) == false) {
			return $this->form_validation->error_array();
		} else {
			return true;
		}
  }

	public function username($str)
	{
		if($str != '') {
			$preg = preg_user($str);
			if(!$preg) {
				$this->form_validation->set_message('username', 'The {field} field may only contain alpha-numeric characters, underscores, and dashes.');
				return false;
			} else {
				return true;
			}
		}
	}

	public function password($str)
	{
		if($str != '') {
			$preg = preg_pass($str);
			if(!$preg) {
				$this->form_validation->set_message('password', 'The {field} field must contain uppercase letters, lowercase letters, numbers and special characters.');
				return false;
			} else {
				return true;
			}
		}
	}
}
?>
