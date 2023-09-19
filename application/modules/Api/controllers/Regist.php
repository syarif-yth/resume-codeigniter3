<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Regist extends RestController 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_auth');
		$this->load->helper('input_helper');
	}

	public function index_post()
	{
		$is_valid = $this->valid_input();
		if($is_valid === true) {
			$email = $this->post('email', true);
			$user = $this->post('username', true);
			$nip = create_nip();
			$pass = $this->post('password', true);
			$key = mt_rand(100000, 999999);

			$data = array(
				'nip' => $nip,
				'email' => $email,
				'username' => $user,
				'password' => encrypt_pass($nip, $pass),
				'kode_aktifasi' => $key);
			
			$regist = $this->model_auth->regist($data);
			if($regist['code'] != 200) {
				$res['status'] = false;
				$res['message'] = $regist['message'];
				$this->response($res, $regist['code']);
			} else {
				$this->load->library('email');
				$send_key = $this->email->send_key($email, $key);
				if($send_key['code'] != 200) {
					$res['status'] = false;
					$res['message'] = 'Send code activation failed!';
					$res['errors'] = $send_key['message'];
					$this->response($res, $send_key['code']);
				} else {
					$this->model_auth->set_exp_aktifasi($email);
					$res['status'] = true;
					$res['message'] = $regist['message'];
					$res['data'] = $regist['data'];
					$this->response($res);
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
			array('field' => 'email',
				'rules' => 'trim|required|min_length[5]|max_length[100]|valid_email|db_email_is_unique'),
      array('field' => 'username',
        'rules' => 'trim|required|min_length[5]|max_length[20]|valid_username|db_username_is_unique'),
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


	




	


	/*
	USE THIS IF REGIST WITH STEP
	public function step_post()
	{
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules(
			'email', 'Email', 'required|min_length[5]|max_length[100]|valid_email');
		if($this->form_validation->run() == false) {
			$res['status'] = false;
			$res['message'] = 'Your request is not valid';
			$res['errors'] = [$this->form_validation->error_array()];
			$this->response($res, 400);
		} else {
			$email = $this->post('email', true);
			$check_mail = $this->model_auth->check_email_regist($email);
			if($check_mail['code'] != 200) {
				$res['status'] = false;
				$res['message'] = $check_mail['message'];
				$this->response($res, $check_mail['code']);
			} else {
				$this->form_validation->set_rules(
					'username', 'Username', 'required|min_length[5]|max_length[20]');
				if($this->form_validation->run() == false) {
					$res['status'] = false;
					$res['message'] = 'Your request is not valid';
					$res['errors'] = [$this->form_validation->error_array()];
					$this->response($res, 400);
				} else {
					$user = $this->post('username', true);
					$check_user = $this->model_auth->check_username_regist($user);
					if($check_user['code'] != 200) {
						$res['status'] = false;
						$res['message'] = $check_user['message'];
						$this->response($res, $check_user['code']);
					} else {
						$this->form_validation->set_rules(
							'password', 'Password', 'required|min_length[5]|trim');
						if($this->form_validation->run() == false) {
							$res['status'] = false;
							$res['message'] = 'Your request is not valid';
							$res['errors'] = [$this->form_validation->error_array()];
							$this->response($res, 400);
						} else {
							$nip = create_nip();
							$pass = $this->post('password', true);
							$key = mt_rand(100000, 999999);

							$send_key = $this->send_key($email, $key);
							if($send_key['code'] != 200) {
								$res['status'] = false;
								$res['message'] = 'send code activation failed!';
								$res['errors'] = $send_key['message'];
								$this->response($res, $send_key['code']);
							} else {
								$data = array(
									'nip' => $nip,
									'email' => $email,
									'username' => $user,
									'password' => encrypt_pass($nip, $pass),
									'kode_aktifasi' => $key);
								
								$regist = $this->model_auth->regist($data);
								if($regist['code'] != 200) {
									$res['status'] = false;
									$res['message'] = $regist['message'];
									$this->response($res, $regist['code']);
								} else {
									$res['status'] = true;
									$res['message'] = $regist['message'];
									$res['data'] = $regist['data'];
									$this->response($res);
								}
							}
						}
					}
				}
			}
		}
	}
	*/
}
?>
