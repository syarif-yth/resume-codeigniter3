
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Reset extends RestController 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_auth');
		$this->load->helper('input');
	}

	public function index_put($key) 
	{
		$is_valid = $this->validate();
		if($is_valid === true) {
			$is_sha1 = preg_sha1($key);
			if($is_sha1) {
				$check_key = $this->model_auth->check_kode_recovery($key);
				if($check_key['code'] != 200) {
					$res['status'] = false;
					$res['message'] = $check_key['message'];
					$this->response($res, $check_key['code']);
				} else {
					$exp = $check_key['data']['exp_recovery'];
					$now = strtotime('now');
					$sisa = round(abs($now-$exp)/60);
					if($sisa > 0) {
						$nip = $check_key['data']['nip'];
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
							$res['message'] = 'Recovery your account is success, please login with new password';
							$this->response($res);
						}
					} else {
						$res['status'] = false;
						$res['message'] = 'Link expired!';
						$this->response($res, 401);
					}
				}
			} else {
				$res['status'] = false;
				$res['message'] = 'Method undefined';
				$this->response($res, 400);
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
