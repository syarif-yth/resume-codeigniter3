<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Reactivation extends RestController 
{
	function __construct()
	{
		parent::__construct();
		$model = array('model_auth',
			'validation');
		$this->load->model($model);
		$this->load->helper('input_helper');

		$check_time = $this->check_time();
		if($check_time['code'] != 200) {
			$this->response($check_time['body'], $check_time['code']);
			die();
		}
	}

	private function check_time()
	{
		$mail = $this->post('email', true);
		$get = $this->model_auth->get_time_email($mail);
		if($get['code'] != 200) {
			$res['code'] = $get['code'];
			$res['body'] = array(
				'status' => false,
				'message' => $get['message']);
			return $res;
		} else {
			$time_db = $get['data'];
			$time_now = time();
			$sisa = $time_now-$time_db;
			// 30 detik untuk kirim ulang kode
			if($sisa >= 30) {
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
				'email' => $mail,
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
					$send_key = $this->send_key($mail, $key);
					if($send_key['code'] != 200) {
						$res['status'] = false;
						$res['message'] = 'Send code activation failed!';
						$res['errors'] = $send_key['message'];
						$this->response($res, $send_key['code']);
					} else {
						$rekode = $this->model_auth->rekode($where, $key);
						if($rekode['code'] != 200) {
							$res['status'] = false;
							$res['message'] = $rekode['message'];
							$res['cek'] = $where;
							$this->response($res, $rekode['code']);
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
				'rules' => 'trim|required|min_length[5]|max_length[100]|valid_email|callback_email'),
      array('field' => 'username',
        'rules' => 'trim|required|min_length[5]|max_length[20]|callback_username'),
      array('field' => 'password',
        'rules' => 'required|min_length[5]|callback_password')
    );
    $this->form_validation->set_rules($data);
		if($this->form_validation->run($this) == false) {
			return $this->form_validation->error_array();
		} else {
			return true;
		}
  }

	private function send_key($email, $key)
	{
		$this->load->helper('email');
		$this->load->library('email');
		$this->load->config('email');

		$message = '
		<center>
			<h1>Confirm Your Account</h1>
			<h4>Thank you for signing up</h4>
			<p>before you can used application, we need to verify your account. To complete the varification process, please use the code below to log in, this code is valid for 10 minutes.</p>
			<br>
			<center style="color: #333333; font-size: 27px; font-weight: 700; line-height: 27px;">'.$key.'</center>
			<br>
			<p>If you received this email by mistake, <br>please, ignore it or inform us at<br>yth.other@gmail.com</p>
		</center>';

		$this->email->from($this->config->item('smtp_user'), 'Localhost');
		$this->email->to($email);
		$this->email->subject('Confirm Your Account');
		$this->email->message($message);
		
		if($this->config->item('active')) {
			if(!$this->email->send()) {
				$res['code'] = 500;
				$res['message'] = $this->email->get_debugger();
				return $res;
			} else {
				$res['code'] = 200;
				$res['message'] = 'code activate send';
				return $res;
			}
		} else {
			$res['code'] = 200;
			$res['message'] = 'Activation not actived';
			return $res;
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

	public function email($str)
	{
		if($str != '') {
			$where = array('email' => $str);
			$is_exist = $this->validation->is_exist($where);
			if($is_exist['code'] != 200) {
				if($is_exist['code'] == 400) {
					$this->form_validation->set_message('email', 'Email not registed.');
				} else {
					$this->form_validation->set_message('email', $is_exist['message']);
				}
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
