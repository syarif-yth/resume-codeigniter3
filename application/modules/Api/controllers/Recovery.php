<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Recovery extends RestController 
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
		$expired = $this->session->userdata('send_url');
		if(!$expired) {
			$res['code'] = 200;
			$res['message'] = 'Recovery is ready';
			return $res; 
		} else {
			$res['code'] = 401;
			$res['body'] = array(
				'status' => false,
				'message' => 'Send code is cooldown, please try again after 2 hours');
			return $res;
		}
	}

	public function index_post()
	{
		$is_valid = $this->validpost();
		if($is_valid === true) {
			$email = $this->post('email', true);
			$check = $this->model_auth->check_recovery($email);
			if($check['code'] != 200) {
				$res['status'] = false;
				$res['message'] = $check['message'];
				$this->response($res, $check['code']);
			} else {
				$nip = $check['data']['nip'];
				$username = $check['data']['username'];
				$kode = encrypt_url($nip, $username);
				$where = array('nip' => $nip,
					'email' => $email);
				$insert = $this->model_auth->insert_recovery($kode, $where);
				if($insert['code'] != 200) {
					$res['status'] = false;
					$res['message'] = $insert['message'];
					$this->response($res, $insert['code']);
				} else {
					$url = base_url('recovery/'.$kode);
					$this->load->library('email');
					$send_url = $this->email->send_link($email, $url);
					$one_day = 86400;
					$time_expired = ($one_day/12);
					$this->session->set_tempdata('send_url', true, $time_expired);
					if($send_url['code'] != 200) {
						$res['status'] = false;
						$res['message'] = $send_url['message'];
						$this->response($res, $send_url['code']);
					} else {
						$res['status'] = true;
						$res['message'] = 'Recovery url sent to your email, please check your email and follow the link';
						$this->response($res);
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

	public function index_put($key)
	{
		$is_sha1 = preg_sha1($key);
		if($is_sha1) {
			$check_key = $this->model_auth->check_kode_recovery($key);
			if($check_key['code'] != 200) {
				$res['status'] = false;
				$res['message'] = $check_key['message'];
				$this->response($res);
			} else {
				$nip = $check_key['data']['nip'];
				$exp = $check_key['data']['exp_recovery'];
				$now = strtotime('now');
				$sisa = round(abs($now-$exp)/60);
				if($sisa > 0) {
					$is_valid = $this->validput();
					if($is_valid === true) {
						$password = $this->put('password', true);
						$passconf = $this->put('passconf', true);
						$new_pass = encrypt_pass($nip, $password);
						$reset = $this->model_auth->reset_password($key, $new_pass);
						if($reset['code'] != 200) {
							$res['status'] = false;
							$res['message'] = $reset['message'];
							$this->response($res, $reset['code']);
						} else {
							$this->model_auth->reset_recovery_kode($nip);
							$res['status'] = true;
							$res['message'] = 'Recovery your account is success';
							$this->response($res);
						}
					} else {
						$res['status'] = false;
						$res['message'] = 'Your request not valid';
						$res['errors'] = [$is_valid];
						$this->response($res, 400);
					}
				} else {
					$res['status'] = false;
					$res['message'] = 'Unknown method';
					$this->response($res);
				}
			}
		} else {
			$res['status'] = false;
			$res['message'] = 'Unknown method';
			$this->response($res);
		}
	}

	private function validpost()
	{
		$this->form_validation->set_data($this->post());
    $data = array(
			array('field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|min_length[5]|valid_email|db_email_is_exist')
    );
    $this->form_validation->set_rules($data);
		if($this->form_validation->run($this) == false) {
			return $this->form_validation->error_array();
		} else {
			return true;
		}
	}

	private function validput()
	{
		$this->form_validation->set_data($this->put());
    $data = array(
			array('field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[5]|valid_password'),
      array('field' => 'passconf',
				'label' => 'Confirm Password',
        'rules' => 'trim|required|min_length[5]|valid_password|matches[password]')
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
