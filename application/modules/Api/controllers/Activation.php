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
		$this->load->model('model_auth');
	}

	public function index_post()
	{
		$email = $this->post('email', true);
		
		$is_valid = $this->valid_input();
		if($is_valid === true) {
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
					// tambahkan apabila salah 5x akan dibanned 1 jam untuk reactivation
					$kode = $this->post('kode_aktifasi', true);
					$where = array('users.email' => $email,
						'username' => $data['username'],
						'kode_aktifasi' => $kode);
					$activate = $this->model_auth->activate($where);
					if($activate['code'] != 200) {
						$res['status'] = false;
						$res['message'] = $activate['message'];
						$this->response($res, $activate['code']);
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
