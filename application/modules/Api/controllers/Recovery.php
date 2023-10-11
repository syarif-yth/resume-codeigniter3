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
		$this->with_cooldown = true; // cooldown for loop send mail recorevery
		$this->cooldown_resend =  (86400/24); // 1Hours
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
		if($this->with_cooldown) {
			$expired = $this->session->userdata('send_url');
			if(!$expired) {
				$res['code'] = 200;
				$res['message'] = 'Recovery is ready';
				return $res; 
			} else {
				$minute = floor(($expired-time())/60);
				$res['code'] = 401;
				$res['body'] = array(
					'status' => false,
					'message' => 'Send code is cooldown, please try again after '.$minute.' minutes');
				return $res;
			}
		} else {
			$res['code'] = 200;
			$res['message'] = 'Without cooldown';
			return $res; 
		}
	}

	public function index_post()
	{
		$is_valid = $this->validate();
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
					if($send_url['code'] != 200) {
						$res['status'] = false;
						$res['message'] = $send_url['message'];
						$this->response($res, $send_url['code']);
					} else {
						$send_again = time()+$this->cooldown_resend;
						$this->session->set_tempdata('send_url', $send_again, $this->cooldown_resend);
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

	private function validate()
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
}
?>
