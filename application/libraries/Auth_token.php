<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/third_party/JWT/JWT.php';
require APPPATH.'/third_party/JWT/ExpiredException.php';
require APPPATH.'/third_party/JWT/BeforeValidException.php';
require APPPATH.'/third_party/JWT/SignatureInvalidException.php';
require APPPATH.'/third_party/JWT/JWK.php';
require APPPATH.'/third_party/JWT/Key.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class Auth_token
{
	protected $key;
	protected $algorithm;
	protected $header;
	protected $expire;
	protected $name_cookie;
	protected $key_cookie;
	protected $auto_regen;

	public function __construct() 
	{
		$this->ci =& get_instance();

		$this->token_key = 'JwtSecret';
		$this->token_hash = 'HS256';
		$this->token_header = 'Authorization';
		$this->token_expire = 60*15;
		// EXTRA
		$this->token_cookie = 'resume_token';
		$this->key_cookie = 'resume_user';
		$this->auto_regen = true;
	}

	public function create_token($user_id, $extra = null)
	{
		$device = $this->get_device();
		$exp = time()+$this->token_expire;
		$payload = array(
			'sub' => $device,
			'aud' => $user_id,
			'exp' => $exp);
		if($extra) {
			$payload = array_merge($payload, array('ext' => $extra));
		}

		$encode = $this->encode($payload);
		if($encode['code'] === 200) {
			$token = $encode['body']['token'];
			$this->set_cookie($token, $user_id);
			$user_auth = $this->get_user_auth($user_id);
			$body['user'] = $user_auth['body']['user'];
			$body['auth'] = array('token' => $token,
				'expired' => $exp);
			return $this->res($body);
		} else { return $encode; }
	}

	public function clear()
	{
		// $validate = $this->is_valid();
		// if($validate['code'] !== 200) {
		// 	return $validate;
		// } else {
			$this->ci->load->helper('cookie');
			delete_cookie($this->token_cookie);
			delete_cookie($this->key_cookie);
			return $this->res('Token has been destroy');
		// }
	}

	public function is_valid()
	{
		$cookie = $this->token_cookie();
		if($cookie['code'] == 200) {
			$token = $cookie['body']['token'];
			$verify = $this->verify($token);
			if($verify['code'] == 200) {
				$data = $verify['body']['data'];
				$valid_token = $this->valid_token($data);
				if($valid_token['code'] == 200) {
					$key = $valid_token['body']['data']->aud;
					$this->set_cookie($token, $key);
					return $this->get_user_auth($key);
				} else { return $valid_token; }
			} else {
				if($verify['body']['message'] === 'Expired token') {
					if($this->auto_regen) {
						return $this->re_create($token);
					} else { return $verify; }
				} else { return $verify; }
			}
		} else {
			$head = $this->get_headers();
			if($head['code'] == 200) {
				$token = $head['body']['token'];
				$verify = $this->verify($token);
				if($verify['code'] == 200) {
					$data = $verify['body']['data'];
					$valid_token = $this->valid_token($data);
					if($valid_token['code'] == 200) {
						$key = $valid_token['body']['data']->aud;
						$this->set_cookie($token, $key);
						return $this->get_user_auth($key);
					} else { return $valid_token; }
				} else {
					if($verify['body']['message'] === 'Expired token') {
						if($this->auto_regen) {
							return $this->re_create($token);
						} else { return $verify; }
					} else { return $verify; }
				}
			} else { return $head; }
		}
	}

	/**
	 * PRIVATE is micro function
	 */
	private function get_device()
	{
		$this->ci->load->library('user_agent');
		$ip_address = $this->ci->input->ip_address();
		if(!$this->ci->agent->is_browser()) {
			$string = $this->ci->agent->agent_string();
			$get = $ip_address.'/'.$string;
		} else {
			$version = $this->ci->agent->version();
			$browser = $this->ci->agent->browser();
			$platform = $this->ci->agent->platform();
			$get = $ip_address.'/'.$browser.'/'.$version.'/'.$platform;
		}
		$get = str_replace(' ','/',$get);
		return strtolower($get);
	}

	private function encode($data)
	{
		try {
			$encode = JWT::encode($data, $this->token_key, $this->token_hash);
			$body['token'] = $encode;
			return $this->res($body, 200);
		} catch(Exception $err) {
			return $this->res($err->getMessage(), 500);
		}
	}

	private function set_cookie($token, $user_id)
	{
		$this->ci->load->helper('cookie');
		$remember = $this->input_json('remember');
		$hari = 86400;
		$expire = ($remember) ? 10*$hari : 1*$hari;
		
		$config_token = array(
			'name' => $this->token_cookie,
			'value'=> $token,
			'expire' => $expire,
			'secure' => true,
			'httponly' => true);
		$this->ci->input->set_cookie($config_token);

		$config_user = array(
			'name' => $this->key_cookie,
			'value'=> $user_id,
			'expire' => $expire,
			'secure' => true);
		$this->ci->input->set_cookie($config_user);
	}

	private function input_json($keys)
	{
		$raw = $this->ci->input->raw_input_stream;
		$clean = $this->ci->security->xss_clean($raw);
		$post = json_decode($clean);
		$value = null;
		if(is_array($post)) {
			foreach($post as $key => $val) {
				$value = ($key == $keys) ? $val : null;
			}
		}
		return $value;
	}

	private function token_cookie()
	{
		$this->ci->load->helper('cookie');
		$cookie = get_cookie($this->token_cookie);
		if(empty($cookie)) {
			return $this->res('Token not found', 404);
		} else {
			$body['token'] = $cookie;
			return $this->res($body);
		}
	}

	private function get_headers()
	{
		$head = $this->ci->input->request_headers();
		if(!empty($head) && is_array($head)) {
			$config_head = ucfirst(trim($this->token_header));
			if(empty($head[$config_head])) {
				return $this->res('Token undefined!', 403);
			} else {
				$bearer = $head[$config_head];
				$token = explode(" ", $bearer)[1];
				$body['token'] = $token;
				return $this->res($body);
			}
		} else { return $this->res('Token not found!', 404); }
	}

	private function verify($token)
	{
		try {
			$key = new Key($this->token_key, $this->token_hash);
			$decoded = JWT::decode($token, $key);
			$body['data'] = $decoded;
			return $this->res($body, 200);
		} catch(Exception $err) {
			return $this->res($err->getMessage(), 403);
		}
	}

	private function refresh($user_id, $extra = null)
	{
		$device = $this->get_device();
		$exp = time()+$this->token_expire;
		$payload = array(
			'sub' => $device,
			'aud' => $user_id,
			'exp' => $exp);
		if($extra) {
			$payload = array_merge($payload, array('ext' => $extra));
		}

		$encode = $this->encode($payload);
		if($encode['code'] === 200) {
			$token = $encode['body']['token'];
			$this->set_cookie($token, $user_id);
			$body['data'] = $this->get_user_auth($aud);
			$body['refresh'] = array('token' => $token,
				'expired' => $exp);
			return $this->res($body, 200);
		} else { return $encode; }
	}

	private function re_create($token)
  {
    $key = $this->key_cookie();
    if($key) {
			$decode = $this->decode($token);
			$data = $decode['body']['data'];
			$device = $this->get_device();
			if(($key === $data->aud) && ($device === $data->sub)) {
				$extra = (!empty($data->ext)) ? $data->ext : null;
        return $this->create_token($key, $extra);
			} else { return $this->res('Token not valid!', 403); }
    } else { return $this->res('Refresh key not found!', 404); }
  }

	private function key_cookie()
	{
		$this->ci->load->helper('cookie');
		$key = get_cookie($this->key_cookie);
		return (empty($key)) ? false : $key;
	}

	private function decode($token)
	{
		$explode = explode('.', $token);
    list($headb64, $bodyb64, $cryptob64) = $explode;
    $payload = JWT::jsonDecode(JWT::urlsafeB64Decode($bodyb64));
    $body['data'] = $payload;
    return $this->res($body);
	}

	private function valid_token($decode_token)
	{
		$key = $this->key_cookie();
		if($key) {
			$agent = $this->get_device();
			if(($key == $decode_token->aud) && 
				($agent == $decode_token->sub)) {
				$body['message'] = 'Token is valid';
				$body['data'] = $decode_token;
				return $this->res($body);
			} else { return $this->res('Token not valid!', 403); }
		} else { return $this->res('Refresh key not found!', 404); }
	}

	private function res($data, $code = null)
	{
		if(!$code) {
			$status = array('status' => true);
			$code = 200;
		} else {
			$status = array('status' => ($code != 200) ? false : true);
		}

		$res['code'] = $code;
		if(is_array($data)) {
			$res['body'] = array_merge($status, $data);
		} else {
			$res['body'] = array_merge($status, 
				array('message' => $data));
		}
		return $res;
	}

	private function db_error($err)
	{
		$res['code'] = 500;
		$res['body'] = array('status' => false,
			'message' => $err['message']);
		return $res;
	}

	private function get_user_auth($aud)
	{
		$this->ci->load->database();
		$column = array('users.nip', 'users.email', 'username',  
			'nama', 'avatar', 'profesi', 'users_attr.rule');
		$this->ci->db->select($column);
		$this->ci->db->from('users');
		$this->ci->db->join('users_attr', 'users_attr.nip = users.nip');
		$this->ci->db->where('users.nip', $aud);
		$kueri = $this->ci->db->get();
		if(!$kueri) {
			$err = $this->ci->db->error();
			return $this->db_error($err);
		} else {
			if($kueri->num_rows() == 1) {
				$body['user'] = $kueri->result_array()[0];
				return $this->res($body);
			} else { return $this->res('Access forbidden!', 403); }
		}
	}
}
?>
