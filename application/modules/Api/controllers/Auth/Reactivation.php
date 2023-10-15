<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Reactivation extends RestController 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$access = $this->check_access();
		if($access['code'] == 200) {
			$this->load->model('model_auth');
			$this->load->helper('input');
		} else {
			$this->response($access['body'], $access['code']);
			die();
		}
	}

	private function check_access()
	{
		$penalty = $this->session->userdata('penalty_reactive');
		if(!$penalty) {
			$expired = $this->session->userdata('send_key');
			if(!$expired) {
				$res['code'] = 200;
				$res['message'] = 'Re Activation is ready';
				return $res; 
			} else {
				$res['code'] = 401;
				$res['body'] = array(
					'status' => false,
					'message' => 'Send code is cooldown, please try again after 2 hours');
				return $res;
			}
		} else {
			$res['code'] = 400;
			$res['body'] = array(
				'status' => false,
				'message' => 'Activation errors occur too often, please try again after 6 hours');
			return $res;
		}
	}

	public function index_post()
	{
		$is_valid = $this->valid_input();
		if($is_valid === true) {
			$mail = $this->post('email', true);
			$user = $this->post('username', true);
			$pass = $this->post('password', true);

			$where = array(
				'users.email' => $mail,
				'username' => $user);

			$check_user = $this->model_auth->check_user_reactive($where);
			if($check_user['code'] != 200) {
				$mistake = $this->count_mistake($check_user);
				$res['status'] = false;
				$res['message'] = $mistake['message'];
				$this->response($res, $mistake['code']);
			} else {
				$nip = $check_user['data']['nip'];
				$password = array(
					'password' => encrypt_pass($nip, $pass)
				);
				$where = array_merge($where, $password);
				$reactivate = $this->model_auth->reactivate($where);

				if($reactivate['code'] != 200) {
					$mistake = $this->count_mistake($reactivate);
					$res['status'] = false;
					$res['message'] = $mistake['message'];
					$this->response($res, $mistake['code']);
				} else {
					$key = mt_rand(100000, 999999);
					$rekode = $this->model_auth->rekode($where, $key);
					if($rekode['code'] != 200) {
						$mistake = $this->count_mistake($rekode);
						$res['status'] = false;
						$res['message'] = $mistake['message'];
						$this->response($res, $mistake['code']);
					} else {
						$this->load->library('email');
						$send_key = $this->email->send_key($mail, $key);
						$one_day = 86400;
						$time_expired = ($one_day/12);
						$this->session->set_tempdata('send_key', true, $time_expired);
						if($send_key['code'] != 200) {
							$res['status'] = false;
							$res['message'] = 'Send code activation failed!';
							$res['errors'] = $send_key['message'];
							$this->response($res, $send_key['code']);
						} else {
							$res['status'] = true;
							$res['message'] = $rekode['message'];
							$res['data'] = $rekode['data'];
							$this->response($res);
						}
					}
				}
			}
		} else {
			$res['status'] = false;
			$res['message'] = 'Your request not valid!';
			$res['errors'] = [$is_valid];
			$this->response($res, 400);
		}
	}

	private function count_mistake($response)
	{
		if($response['code'] == 400) {
			$attempt = $this->session->userdata('attempt_reactive');
			$attempt++;
			$this->session->set_userdata('attempt_reactive', $attempt);
			if($attempt >= 5) {
				$attempt = 0;
				$this->session->set_userdata('attempt_reactive', $attempt);
				$one_day = 86400;
				$time_penalty = ($one_day/4); // 6JAM
				$this->session->set_tempdata('penalty_reactive', true, 30);
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

	private function valid_input()
  {
		$this->form_validation->set_data($this->post());
    $data = array(
			array('field' => 'email',
				'rules' => 'trim|required|min_length[5]|max_length[100]|valid_email|db_email_is_exist'),
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
