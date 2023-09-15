<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_auth extends CI_Model
{
	private $db_table;
	function __construct()
	{
		parent::__construct();
		$this->db_table = $this->db->protect_identifiers('users', TRUE);
	}

	private function res_error($err)
	{
		$res['code'] = 500;
		$res['message'] = $err['message'];
		return $res;
	}

	public function check_username_login($username)
	{
		$column = array('nip');
		$this->db->select($column);
		$this->db->where('username', $username);
		$kueri = $this->db->get_where($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = 'The username or password is incorrect.';
			} else {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array()[0]['nip'];
			}
			return $res;
		}
	}

	public function login($user, $pass)
	{
		$column = array('nip', 'username', 'email', 
			'nama', 'avatar', 'profesi', 'kode_aktifasi');
		$this->db->select($column);
		$this->db->where('username', $user);
		$this->db->where('password', $pass);
		$kueri = $this->db->get_where($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = 'The username or password is incorrect.';
			} else {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array()[0];
			}
			return $res;
		}
	}

	public function check_email_regist($email)
	{
		$column = array('nip');
		$this->db->select($column);
		$this->db->where('email', $email);
		$kueri = $this->db->get_where($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($kueri->num_rows() > 0) {
				$res['code'] = 400;
				$res['message'] = 'Email has been registed!';
			} else {
				$res['code'] = 200;
				$res['message'] = 'Email is ready';
			}
			return $res;
		}
	}

	public function check_username_regist($username)
	{
		$column = array('nip');
		$this->db->select($column);
		$this->db->where('username', $username);
		$kueri = $this->db->get_where($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($kueri->num_rows() > 0) {
				$res['code'] = 400;
				$res['message'] = 'Username has been registed!';
			} else {
				$res['code'] = 200;
				$res['message'] = 'Username is ready';
			}
			return $res;
		}
	}

	public function regist($data)
	{
		$kueri = $this->db->insert($this->db_table, $data);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 401;
				$res['message'] = "No user has been registed!";
			} else {
				$res['code'] = 200;
				$res['message'] = "Regist new user success";
				unset($data['password']);
				unset($data['kode_aktifasi']);
				$res['data'] = $data;
			}
			return $res;
		}
	}

	public function getkode_aktifasi($email)
	{
		$column = array('nip', 'username', 
			'email', 'tgl_regist');
		$this->db->select($column);
		$this->db->where('email', $email);
		$this->db->where('kode_aktifasi !=', NULL);
		$kueri = $this->db->get_where($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($kueri->num_rows() == 1) {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array()[0];
			} else {
				$res['code'] = 400;
				$res['message'] = 'Your account has been actived!';
			}
			return $res;
		}
	}

	public function activate($where)
	{
		$column = array('nip', 'username', 
			'email', 'nama');
		$this->db->select($column);
		$this->db->where($where);
		$kueri = $this->db->get_where($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($kueri->num_rows() == 1) {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array()[0];
			} else {
				$res['code'] = 400;
				$res['message'] = 'Code activation not valid!';
			}
			return $res;
		}
	}

	public function set_active($email)
	{
		$this->db->where('email', $email);
		$this->db->set('kode_aktifasi', NULL);
		$this->db->set('time_email', NULL);
		$kueri = $this->db->update($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 500;
				$res['message'] = "no data has been updated";
			} else {
				$res['code'] = 200;
				$res['message'] = "data has been updated";
			}
			return $res;
		}
	}

	public function check_user_reactive($where)
	{
		$column = array('nip');
		$this->db->select($column);
		$this->db->where($where);
		$kueri = $this->db->get_where($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($kueri->num_rows() == 1) {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array()[0];
			} else {
				$res['code'] = 400;
				$res['message'] = 'Email, username or password not valid!';
			}
			return $res;
		}
	}

	public function reactivate($where)
	{
		$column = array('nip');
		$this->db->select($column);
		$this->db->where($where);
		$kueri = $this->db->get_where($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($kueri->num_rows() == 1) {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array()[0];
			} else {
				$res['code'] = 400;
				$res['message'] = 'Email, username or password not valid!';
			}
			return $res;
		}
	}

	public function rekode($where, $key)
	{
		$this->load->helper('time_helper');
		$now = now('Y-m-d H:i:s');
		$this->db->set('kode_aktifasi', $key);
		$this->db->set('tgl_regist', $now);
		$this->db->where($where);
		$kueri = $this->db->update($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 500;
				$res['message'] = "Internal Server Error";
			} else {
				$res['code'] = 200;
				$res['message'] = "Re activation account success";
				unset($where['password']);
				$res['data'] = $where;
			}
			return $res;
		}
	}

	public function set_token($nip, $key)
	{
		$this->db->set('token', $key);
		$this->db->set('online', '1');
		$this->db->where('nip', $nip);
		$kueri = $this->db->update($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 500;
				$res['message'] = "No data has been updated";
			} else {
				$res['code'] = 200;
				$res['message'] = "Data has been updated";
			}
			return $res;
		}
	}

	public function del_token($where)
	{
		$this->db->set('token', NULL);
		$this->db->set('online', '0');
		$this->db->where($where);
		$kueri = $this->db->update($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 500;
				$res['message'] = "no data has been updated";
			} else {
				$res['code'] = 200;
				$res['message'] = "data has been updated";
			}
			return $res;
		}
	}

	public function set_online($where, $online = null)
	{
		if(!$online) {
			$this->db->set('online', '0');
			$this->db->set('token', NULL);
		} else {
			$this->db->set('online', '1');
		}
		$this->db->where($where);
		$kueri = $this->db->update($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 500;
				$res['message'] = "no data has been updated";
			} else {
				$res['code'] = 200;
				$res['message'] = "data has been updated";
			}
			return $res;
		}
	}

	public function set_time_email($email)
	{
		$time = time();
		$this->db->set('time_email', $time);
		$this->db->where('email', $email);
		$kueri = $this->db->update($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 500;
				$res['message'] = "no data has been updated";
			} else {
				$res['code'] = 200;
				$res['message'] = "data has been updated";
			}
			return $res;
		}
	}

	public function get_time_email($email)
	{
		$column = array('time_email');
		$this->db->select($column);
		$this->db->where('email', $email);
		$kueri = $this->db->get_where($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = 'The email is incorrect.';
			} else {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array()[0]['time_email'];
			}
			return $res;
		}
	}
}
?>
