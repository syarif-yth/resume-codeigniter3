<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Activation extends RestController 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$penalty = $this->check_penalty();
		if($penalty['code'] == 200) {
			$this->load->model('model_auth');
		} else {
			$this->response($penalty['body'], $penalty['code']);
			die();
		}
	}

	private function check_penalty()
	{
		$penalty = $this->session->userdata('penalty_activation');
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

	public function resend_post()
	{
		$expired = $this->session->userdata('send_key');
		if(!$expired) {
			$is_valid = $this->valid_resend();
			if($is_valid === true) {
				$mail = $this->post('email', true);
				$key = mt_rand(100000, 999999);
				$rekode = $this->model_auth->resend_code($mail, $key);
				if($rekode['code'] != 200) {
					$res['status'] = false;
					$res['message'] = $rekode['message'];
					$this->response($res, $rekode['code']);
				} else {
					$this->load->library('email');
					$send_key = $this->email->send_key($mail, $key);
					$this->session->set_tempdata('send_key', true, 60);
					if($send_key['code'] != 200) {
						$res['status'] = false;
						$res['message'] = 'Send code activation failed!';
						$res['errors'] = $send_key['message'];
						$this->response($res, $send_key['code']);
					} else {
						$res['status'] = true;
						$res['message'] = 'Send code activation success!';
						$this->response($res);
					}
				}
			} else {
				$res['status'] = false;
				$res['message'] = 'Your request not valid';
				$res['errors'] = $is_valid;
				$this->response($res, 400);
			}
		} else {
			$res['status'] = false;
			$res['message'] = 'Send code is cooldown, please try again after 1 minutes';
			$this->response($res, 400);
		}
	}

	public function index_post()
	{
		$is_valid = $this->valid_input();
		if($is_valid === true) {
			$email = $this->post('email', true);
			$get = $this->model_auth->getkode_aktifasi($email);
			if($get['code'] != 200) {
				$res['status'] = false;
				$res['message'] = $get['message'];
				$this->response($res, $get['code']);
			} else {
				$data = $get['data'];
				$exp_aktifasi = $data['exp_aktifasi'];
				$check_time = $this->check_time($exp_aktifasi);

				if(!$check_time) {
					$res['status'] = false;
					$res['message'] = 'Code activation has been expired!';
					$this->response($res, 404);
				} else {
					$kode = $this->post('kode_aktifasi', true);
					$where = array('users.email' => $email,
						'username' => $data['username'],
						'kode_aktifasi' => $kode);
					$activate = $this->model_auth->activate($where);
					if($activate['code'] != 200) {
						$mistake = $this->count_mistake($activate);
						$res['status'] = false;
						$res['message'] = $mistake['message'];
						$this->response($res, $mistake['code']);
					} else {
						$set_active = $this->model_auth->set_active($email);
						if($set_active['code'] != 200) {
							$res['status'] = false;
							$res['message'] = $set_active['message'];
							$this->response($res, $set_active['code']);
						} else {
							$param = array('nip' => $data['nip']);
							$create = $this->auth->create_token($param);
							if($create['code'] != 200) {
								$res['status'] = false;
								$res['message'] = $create['message'];
								$this->response($res, $create['code']);
							} else {
								$res['status'] = true;
								$res['message'] = 'Your account has been activated!';
								$res['data'] = array('user' => $activate['data'],
									'auth' => $create['data']);
								$this->response($res);
							}
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
			$attempt = $this->session->userdata('attempt_activation');
			$attempt++;
			$this->session->set_userdata('attempt_activation', $attempt);
			if($attempt >= 10) {
				$attempt = 0;
				$this->session->set_userdata('attempt_activation', $attempt);
				$one_day = 86400;
				$time_penalty = ($one_day/48)/30; // 6JAM
				$this->session->set_tempdata('penalty_activation', true, $time_penalty);
				$res['code'] = $response['code'];
				$res['message'] = 'Activation errors occur too often, please try again after 6 hours';
				return $res;
			} else {
				return $response;
			}
		} else {
			return $response;
		}
	}

	private function check_time($exp)
	{
		$str_now = strtotime('now');
		$selisih = round(abs($exp - $str_now)/60);
		// 10 menit kode aktifasi berlaku
		if($selisih == 0) {
			return false;
		} else {
			return true;
		}
	}

	private function valid_input()
  {
		$this->form_validation->set_data($this->post());
    $data = array(
      array('field' => 'email',
				'label' => 'Email',
        'rules' => 'required|min_length[5]|max_length[100]|valid_email|db_email_is_exist'),
      array('field' => 'kode_aktifasi',
				'label' => 'Code Activation',
        'rules' => 'required|min_length[6]|max_length[6]')
    );
    $this->form_validation->set_rules($data);
		if($this->form_validation->run($this) == false) {
			return $this->form_validation->error_array();
		} else {
			return true;
		}
  }

	private function valid_resend()
	{
		$this->form_validation->set_data($this->post());
    $data = array(
      array('field' => 'email',
				'label' => 'Email',
        'rules' => 'required|min_length[5]|max_length[100]|valid_email|db_email_is_exist')
    );
    $this->form_validation->set_rules($data);
		if($this->form_validation->run($this) == false) {
			$this->form_validation->set_error_delimiters('', '');
			return $this->form_validation->error_string();
		} else {
			return true;
		}
	}
}
?>
