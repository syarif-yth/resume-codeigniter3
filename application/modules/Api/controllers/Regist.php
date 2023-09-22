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
			$conf = $this->post('passconf', true);
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
				'label' => 'Email',
				'rules' => 'trim|required|min_length[5]|max_length[100]|valid_email|db_email_is_unique'),
      array('field' => 'username',
				'label' => 'Username',
        'rules' => 'trim|required|min_length[5]|max_length[20]|valid_username|db_username_is_unique'),
      array('field' => 'password',
				'label' => 'Password',
        'rules' => 'required|min_length[5]|valid_password'),
      array('field' => 'passconf',
				'label' => 'Confirm Password',
        'rules' => 'required|min_length[5]|valid_password|matches[password]')
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
