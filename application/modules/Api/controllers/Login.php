<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Login extends RestController 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');		
		$penalty = $this->check_penalty();
		if($penalty['code'] == 200) {
			$this->load->model('model_auth');
			$this->load->helper('input');
		} else {
			$this->response($penalty['body'], $penalty['code']);
			die();
		}
	}

	private function check_penalty()
	{
		$penalty = $this->session->userdata('penalty_login');
		if(!$penalty) {
			$res['code'] = 200;
			$res['message'] = 'Acces allowed';
		} else {
			$res['code'] = 400;
			$res['body'] = array(
				'status' => false,
				'message' => 'Login errors occur too often, please try again after 6 hours');
		}
		return $res;
	}

	public function index_post()
	{
		$is_valid = $this->valid_input();
		if($is_valid === true) {
			$username = $this->post('username', true);
			$check = $this->model_auth->check_username_login($username);
			if($check['code'] != 200) {
				$mistake = $this->count_mistake($check);
				$res['status'] = false;
				$res['message'] = $mistake['message'];
				$this->response($res, $mistake['code']);
			} else {
				$nip = $check['data'];
				$password = $this->post('password', true);
				$remember = $this->post('remember', true);
				$pass = encrypt_pass($nip, $password);

				$login = $this->model_auth->login($username, $pass);
				if($login['code'] != 200) {
					$mistake = $this->count_mistake($login);
					$res['status'] = false;
					$res['message'] = $mistake['message'];
					$this->response($res, $mistake['code']);
				} else {
					$data_log = $login['data'];
					if($data_log['kode_aktifasi'] != NULL) {
						$res['status'] = false;
						$res['message'] = 'Your account not verify';
						$this->response($res, 400);
					} else {
						$param = array('nip' => $data_log['nip']);
						$create = $this->auth->create_token($param);
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

	private function count_mistake($response)
	{
		if($response['code'] == 400) {
			$attempt = $this->session->userdata('attempt_login');
			$attempt++;
			$this->session->set_userdata('attempt_login', $attempt);
			if($attempt >= 10) {
				$attempt = 0;
				$this->session->set_userdata('attempt_login', $attempt);
				$one_day = 86400;
				$time_penalty = ($one_day/48)/30; // 6JAM
				$this->session->set_tempdata('penalty_login', true, $time_penalty);
				$res['code'] = $response['code'];
				$res['message'] = 'Login errors occur too often, please try again after 6 hours';
				return $res;
			} else {
				return $response;
			}
		} else {
			return $response;
		}
	}

	private function valid_input()
  {
		$this->form_validation->set_data($this->post());
    $data = array(
      array('field' => 'username',
        'rules' => 'trim|required|min_length[5]|max_length[20]|valid_username'),
      array('field' => 'password',
        'rules' => 'required|min_length[5]|valid_password')
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
