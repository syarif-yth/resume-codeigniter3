<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/third_party/JWT/JWT.php';
require APPPATH . '/third_party/JWT/ExpiredException.php';
require APPPATH . '/third_party/JWT/BeforeValidException.php';
require APPPATH . '/third_party/JWT/SignatureInvalidException.php';
require APPPATH . '/third_party/JWT/JWK.php';
require APPPATH . '/third_party/JWT/Key.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;
use \Firebase\JWT\Key;

class Auth
{
	protected $key;
	protected $algorithm;
	protected $header;
	protected $expire; 

	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->config('jwt');

		$this->key = $this->ci->config->item('jwt_key');
		$this->algorithm = $this->ci->config->item('jwt_algorithm');
		$this->header = $this->ci->config->item('token_header');
		$this->expire = $this->ci->config->item('token_expire_time');
	}

	public function create_token($data = null)
	{
		$rem = $this->ci->input->post('remember');
		if($data AND is_array($data)) {
			$exp = time()+$this->expire;
			$payload = array(
				'exp' => $exp,
				'user' => $data);
			try {
				$token = JWT::encode($payload, $this->key, $this->algorithm);
				$this->set_cookie($token, $data['nip'], $rem);
				$res['code'] = 200;
				$res['data'] = array(
					'token' => $token,
					// 'expired' => date('H:i:s', $exp));
					'expired' => $exp);
			} catch(Exception $err) {
				$res['code'] = 500;
				$res['body'] = array(
					'status' => false,
					'messasge' => $err->getMessage());
			}
		} else {
			$res['code'] = 500;
			$res['message'] = "Undefined token";
		}
		return $res;
	}

	public function is_valid()
	{
		$cookie = $this->get_cookie();
		if($cookie['status'] === true) {
			$res = array();
			try {
				$token = $cookie['body']['token'];
				$decode = $this->decoded($token);
				if(($decode['status'] === true) &&
					(!empty($decode)) && 
					(is_array($decode))) {
					$res['status'] = true;
					$res['code'] = 200;
					$res['body'] = array(
						'status' => true,
						'data' => $decode['data']);
				} else {
					$res = $decode;
				}
			} catch(Exception $err) {
				if($err->getMessage() === 'Expired token') {
					$data['data'] = $this->cookie_nip();
					if(!empty($data['nip'])) {
						$res = $this->create_token($data);
					} else {
						$res['status'] = false;
						$res['code'] = 401;
						$res['body'] = array(
							'status' => false,
							'message' => $err->getMessage());
					}
				} else {
					$res['status'] = false;
					$res['code'] = 401;
					$res['body'] = array(
						'status' => false,
						'message' => $err->getMessage());
				}
			}
			return $res;
		} else {
			return $this->valid_token();
		}
	}

	public function valid_token()
	{
		$head = $this->ci->input->request_headers();
		$exist = $this->token_exist($head);
		if($exist['status'] === false) {
			return $exist;
		} else {
			$res = array();
			try {
				$decode = $this->decoded($exist['token']);
				if(($decode['status'] === true) &&
					(!empty($decode)) && 
					(is_array($decode))) {
					$res['status'] = true;
					$res['code'] = 200;
					$res['body'] = array(
						'status' => true,
						'data' => $decode['data']);
				} else {
					$res = $decode;
				}
			} catch(Exception $err) {
				if($err->getMessage() === 'Expired token') {
					$data['data'] = $this->cookie_nip();
					if(!empty($data['nip'])) {
						$res = $this->create_token($data);
					} else {
						$res['status'] = false;
						$res['code'] = 401;
						$res['body'] = array(
							'status' => false,
							'message' => $err->getMessage());
					}
				} else {
					$res['status'] = false;
					$res['code'] = 401;
					$res['body'] = array(
						'status' => false,
						'message' => $err->getMessage());
				}
			}
			return $res;
		}
	}

	private function cookie_nip()
	{
		$this->ci->load->helper('cookie');
		$nip = get_cookie($this->key_cookie);
		if(empty($nip)) {
			return false;
		} else {
			return $nip;
		}
	}

	private function get_cookie()
	{
		$this->ci->load->helper('cookie');
		$cookie = get_cookie('token');
		if(empty($cookie)) {
			$res['status'] = false;
			$res['code'] = 404;
			$res['body'] = array(
				'status' => false,
				'message' => 'Access Forbidden!');
			return $res;
		} else {
			$res['status'] = true;
			$res['code'] = 200;
			$res['body'] = array(
				'status' => true,
				'token' => $cookie);
			return $res;
		}
	}

	public function set_cookie($token, $nip, $remember = null)
	{
		$this->ci->load->helper('cookie');
		$hari = 86400;
		$expire = ($remember) ? 10*$hari : 1*$hari;

		$cookie_token = array(
			'name' => 'token',
			'value'=> $token,
			'expire' => $expire,
			'secure' => TRUE);
		$this->ci->input->set_cookie($cookie_token);

		$cookie = array(
			'name' => 'nip',
			'value'=> $nip,
			'expire' => $expire,
			'secure' => TRUE);
		$this->ci->input->set_cookie($cookie);
	}

	private function token_exist($head)
	{
		if(!empty($head) && is_array($head)) {
			$res = array();
			$res['status'] = false;
			$res['code'] = 401;
			$res['body'] = array(
				'status' => false,
				'message' => 'Access Forbidden!');
			foreach($head as $key => $val) {
				$lower_key = strtolower(trim($key));
				$lower_head = strtolower(trim($this->header));
				if($lower_key == $lower_head) {
					$token = explode(" ", $val)[1];
					$res['status'] = true;
					$res['token'] = $token;
					unset($res['code']);
					unset($res['body']);
				} 
			}
			return $res;
		} else {
			$res['status'] = false;
			$res['code'] = 401;
			$res['body'] = array(
				'status' => false,
				'message' => 'Undefined token');
			return $res;
		}
	}

	private function decoded($token)
	{
		try {
			$key = new Key($this->key, $this->algorithm);
			$decoded = JWT::decode($token, $key);
			$res['status'] = true;
			$res['data'] = $decoded;
		} catch(Exception $err) {
			$res['status'] = false;
			$res['code'] = 403;
			$res['body'] = array(
				'status' => false,
				'message' => $err->getMessage());
		}
		return $res;
	}

	public function clear()
	{
		$this->ci->load->helper('cookie');
		delete_cookie('nip');
		delete_cookie('token');
	}
}
?>
