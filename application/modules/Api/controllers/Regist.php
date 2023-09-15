<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Regist extends RestController 
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
		$is_valid = $this->valid_input();
		if($is_valid === true) {
			$email = $this->post('email', true);
			$user = $this->post('username', true);
			$nip = create_nip();
			$pass = $this->post('password', true);
			$key = mt_rand(100000, 999999);

			$send_key = $this->send_key($email, $key);
			if($send_key['code'] != 200) {
				$res['status'] = false;
				$res['message'] = 'Send code activation failed!';
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
					$this->model_auth->set_time_email($email);
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

	private function send_key($email, $key)
	{
		$this->load->library('email');
		$this->load->config('email');

		$message = '<center>
			<h1>Confirm Your Account</h1>
			<h4>Thank you for signing up</h4>
			<p>before you can used application, we need to verify your account. To complete the varification process, please use the code below to log in, this code is valid for 10 minutes.</p>
			<br>
			<center style="color: #333333; font-size: 27px; font-weight: 700; line-height: 27px;">'.$key.'</center>
			<br>
			<p>If you received this email by mistake, <br>please, ignore it or inform us at<br>yth.other@gmail.com</p>
		</div>';

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

	public function username($str)
	{
		if($str != '') {
			$preg = preg_user($str);
			if(!$preg) {
				$this->form_validation->set_message('username', 'The {field} field may only contain alpha-numeric characters, underscores, and dashes.');
				return false;
			} else {
				$where = array('username' => $str);
				$is_unique = $this->validation->is_unique($where);
				if($is_unique['code'] != 200) {
					if($is_unique['code'] == 400) {
						$this->form_validation->set_message('username', 'The {field} field must contain a unique value.');
					} else {
						$this->form_validation->set_message('username', $is_unique['message']);
					}
					return false;
				} else {
					return true;
				}
			}
		}
	}

	public function email($str)
	{
		if($str != '') {
			$where = array('email' => $str);
			$is_unique = $this->validation->is_unique($where);
			if($is_unique['code'] != 200) {
				if($is_unique['code'] == 400) {
					$this->form_validation->set_message('email', 'The {field} field must contain a unique value.');
				} else {
					$this->form_validation->set_message('email', $is_unique['message']);
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


	




	



	// USE THIS IF REGIST WITH STEP
	// public function step_post()
	// {
	// 	$this->form_validation->set_data($this->post());
	// 	$this->form_validation->set_rules(
	// 		'email', 'Email', 'required|min_length[5]|max_length[100]|valid_email');
	// 	if($this->form_validation->run() == false) {
	// 		$res['status'] = false;
	// 		$res['message'] = 'Your request is not valid';
	// 		$res['errors'] = [$this->form_validation->error_array()];
	// 		$this->response($res, 400);
	// 	} else {
	// 		$email = $this->post('email', true);
	// 		$check_mail = $this->model_auth->check_email_regist($email);
	// 		if($check_mail['code'] != 200) {
	// 			$res['status'] = false;
	// 			$res['message'] = $check_mail['message'];
	// 			$this->response($res, $check_mail['code']);
	// 		} else {
	// 			$this->form_validation->set_rules(
	// 				'username', 'Username', 'required|min_length[5]|max_length[20]');
	// 			if($this->form_validation->run() == false) {
	// 				$res['status'] = false;
	// 				$res['message'] = 'Your request is not valid';
	// 				$res['errors'] = [$this->form_validation->error_array()];
	// 				$this->response($res, 400);
	// 			} else {
	// 				$user = $this->post('username', true);
	// 				$check_user = $this->model_auth->check_username_regist($user);
	// 				if($check_user['code'] != 200) {
	// 					$res['status'] = false;
	// 					$res['message'] = $check_user['message'];
	// 					$this->response($res, $check_user['code']);
	// 				} else {
	// 					$this->form_validation->set_rules(
	// 						'password', 'Password', 'required|min_length[5]|trim');
	// 					if($this->form_validation->run() == false) {
	// 						$res['status'] = false;
	// 						$res['message'] = 'Your request is not valid';
	// 						$res['errors'] = [$this->form_validation->error_array()];
	// 						$this->response($res, 400);
	// 					} else {
	// 						$nip = create_nip();
	// 						$pass = $this->post('password', true);
	// 						$key = mt_rand(100000, 999999);

	// 						$send_key = $this->send_key($email, $key);
	// 						if($send_key['code'] != 200) {
	// 							$res['status'] = false;
	// 							$res['message'] = 'send code activation failed!';
	// 							$res['errors'] = $send_key['message'];
	// 							$this->response($res, $send_key['code']);
	// 						} else {
	// 							$data = array(
	// 								'nip' => $nip,
	// 								'email' => $email,
	// 								'username' => $user,
	// 								'password' => encrypt_pass($nip, $pass),
	// 								'kode_aktifasi' => $key);
								
	// 							$regist = $this->model_auth->regist($data);
	// 							if($regist['code'] != 200) {
	// 								$res['status'] = false;
	// 								$res['message'] = $regist['message'];
	// 								$this->response($res, $regist['code']);
	// 							} else {
	// 								$res['status'] = true;
	// 								$res['message'] = $regist['message'];
	// 								$res['data'] = $regist['data'];
	// 								$this->response($res);
	// 							}
	// 						}
	// 					}
	// 				}
	// 			}
	// 		}
	// 	}
	// }
}
?>
