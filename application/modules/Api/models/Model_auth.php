<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_auth extends CI_Model
{
	private $tb_users;
	private $tb_attr;
	function __construct()
	{
		parent::__construct();
		$this->tb_users = $this->db->protect_identifiers('users', TRUE);
		$this->tb_attr = $this->db->protect_identifiers('attr_users', TRUE);
		$this->load->helper('db_helper');
	}

	public function check_username_login($username)
	{
		$column = array('nip');
		$this->db->select($column);
		$this->db->where('username', $username);
		$kueri = $this->db->get_where($this->tb_users);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
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
		$column = array('users.nip', 'username', 'users.email', 
			'nama', 'avatar', 'profesi', 'kode_aktifasi');
		$this->db->select($column);
		$this->db->from($this->tb_users);
		$this->db->join($this->tb_attr, 'attr_users.nip = users.nip');
		$this->db->where('username', $user);
		$this->db->where('password', $pass);
		$kueri = $this->db->get_where();
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
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
		$kueri = $this->db->get_where($this->tb_users);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
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
		$kueri = $this->db->get_where($this->tb_users);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
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
		$this->load->helper('array_helper');
		$this->db->trans_begin();
		$user = array_unset($data, 'kode_aktifasi');
		$kueri = $this->db->insert($this->tb_users, $user);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 401;
				$res['message'] = "No user has been registed!";
				return $res;
			} else {
				$attr = array_unset($data, array('username', 'password'));
				$kueri_attr = $this->regist_attr_users($attr);
				if($kueri_attr['code'] != 200) {
					$this->db->trans_rollback();
					$res = $kueri_attr;
				} else {
					$this->db->trans_commit();
					$res['code'] = 200;
					$res['message'] = "Regist new user success";
					$res['data'] = array_unset($data, array('password', 'kode_aktifasi'));
				}
				return $res;
			}
		}
	}

	private function regist_attr_users($data)
	{
		$kueri = $this->db->insert($this->tb_attr, $data);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 401;
				$res['message'] = "No user has been registed!";
			} else {
				$res['code'] = 200;
				$res['message'] = "Regist new user success";
			}
			return $res;
		}
	}

	public function getkode_aktifasi($email)
	{
		$column = array('username', 
			'users.email', 'tgl_regist');
		$this->db->select($column);
		$this->db->from($this->tb_users);
		$this->db->join($this->tb_attr, 'attr_users.nip = users.nip');
		$this->db->where('users.email', $email);
		$this->db->where('kode_aktifasi !=', NULL);
		$kueri = $this->db->get_where();
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
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
		$column = array('users.nip', 'username', 
			'users.email', 'nama');
		$this->db->select($column);
		$this->db->from($this->tb_users);
		$this->db->join($this->tb_attr, 'attr_users.nip = users.nip');
		$this->db->where($where);
		$kueri = $this->db->get_where();
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
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
		$this->db->set('kode_aktifasi', NULL);
		$this->db->set('time_email', NULL);
		$this->db->where('email', $email);
		$kueri = $this->db->update($this->tb_attr);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
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
		$kueri = $this->db->get_where($this->tb_users);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
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
		$kueri = $this->db->get_where($this->tb_users);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
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
		$user = $where['username'];
		$pass = $where['password'];
		$login = $this->login($user, $pass);
		if($login['code'] != 200) {
			return $login;
		} else {
			$nip = $login['data']['nip'];
			$this->load->helper('time_helper');
			$now = now('Y-m-d H:i:s');

			$this->db->set('kode_aktifasi', $key);
			$this->db->set('tgl_regist', $now);
			$this->db->where('nip', $nip);
			$kueri = $this->db->update($this->tb_attr);

			if(!$kueri) {
				$err = $this->db->error();
				return res_error($err);
			} else {
				if($this->db->affected_rows() == 0) {
					$res['code'] = 500;
					$res['message'] = "Internal Server Error";
				} else {
					$res['code'] = 200;
					$res['message'] = "Re activation account success";
					unset($where['password']);
					$res['data'] = res_data($where);
				}
				return $res;
			}
		}
	}

	public function set_token($nip, $key)
	{
		$this->db->set('token', $key);
		$this->db->where('nip', $nip);
		$kueri = $this->db->update($this->tb_attr);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
		} else {
			$where = array('nip' => $nip);
			$this->set_online($nip);
			$res['code'] = 200;
			$res['message'] = "Data has been updated";
			return $res;
		}
	}

	public function del_token($where)
	{
		$this->db->set('token', NULL);
		$this->db->set('online', '0');
		$this->db->where($where);
		$kueri = $this->db->update($this->tb_attr);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
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
		$kueri = $this->db->update($this->tb_attr);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
		} else {
			$res['code'] = 200;
			$res['message'] = "data has been updated";
			return $res;
		}
	}

	public function set_time_email($email)
	{
		$time = time();
		$this->db->set('time_email', $time);
		$this->db->where('email', $email);
		$kueri = $this->db->update($this->tb_attr);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
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
		// $this->db->join($this->tb_attr, 'attr_users.nip = users.nip');
		$this->db->where('email', $email);
		$kueri = $this->db->get_where($this->tb_attr);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
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
