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
		$penalty = $this->session->userdata('penalty');
		if(!$penalty) {
			$this->load->model('model_auth');
		} else {
			$res['status'] = false;
			$res['message'] = 'Activation errors occur too often, try again after 6 hours';
			$this->response($res, 401);
			die();
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
							$res['status'] = true;
							$res['message'] = 'Your account has been activated!';
							$res['data'] = $activate['data'];
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
			$attempt = $this->session->userdata('attempt');
			$attempt++;
			$this->session->set_userdata('attempt', $attempt);
			if($attempt >= 5) {
				$attempt = 0;
				$this->session->set_userdata('attempt', $attempt);
				$one_day = 86400;
				$time_penalty = ($one_day/4); // 6JAM
				$this->session->set_tempdata('penalty', true, $time_penalty);
				$res['code'] = $response['code'];
				$res['message'] = 'Activation errors occur too often, try again after 6 hours';
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
        'rules' => 'required|min_length[5]|max_length[100]|valid_email|db_email_is_exist'),
      array('field' => 'kode_aktifasi',
        'rules' => 'required|min_length[6]|max_length[6]')
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
