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
		$this->load->model('model_auth');
		$this->load->helper('input');

		$check_time = $this->check_time();
		if($check_time['code'] != 200) {
			$this->response($check_time['body'], $check_time['code']);
			die();
		}
	}

	private function check_time()
	{
		$mail = $this->post('email', true);
		$get = $this->model_auth->get_exp_aktifasi($mail);
		if($get['code'] != 200) {
			$res['code'] = $get['code'];
			$res['body'] = array(
				'status' => false,
				'message' => $get['message']);
			return $res;
		} else {
			$time_db = $get['data'];
			$time_now = strtotime('now');
			$sisa = round(abs($time_now-$time_db));
			// 30 detik untuk dapat kirim ulang kode
			// tambah kan apabila reactivate lebih dari 5x banned
			if($sisa > 30) {
				$res['code'] = 200;
				$res['message'] = 'Re Activation is ready';
				return $res;
			} else {
				$res['code'] = 400;
				$res['body'] = array(
					'status' => false,
					'message' => 'Re Activation is cooldown');
				return $res;
			}
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
				$res['status'] = false;
				$res['message'] = $check_user['message'];
				$this->response($res, $check_user['code']);
			} else {
				$nip = $check_user['data']['nip'];
				$password = array(
					'password' => encrypt_pass($nip, $pass)
				);
				$where = array_merge($where, $password);
				$reactivate = $this->model_auth->reactivate($where);

				if($reactivate['code'] != 200) {
					$res['status'] = false;
					$res['message'] = $reactivate['message'];
					$this->response($res, $reactivate['code']);
				} else {
					$key = mt_rand(100000, 999999);
					$rekode = $this->model_auth->rekode($where, $key);
					if($rekode['code'] != 200) {
						$res['status'] = false;
						$res['message'] = $rekode['message'];
						$this->response($res, $rekode['code']);
					} else {
						$this->load->library('email');
						$send_key = $this->email->send_key($mail, $key);
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
