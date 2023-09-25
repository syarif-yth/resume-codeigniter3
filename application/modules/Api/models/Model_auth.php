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
	}

	public function check_username_login($username)
	{
		$column = array('nip');
		$this->db->select($column);
		$this->db->where('username', $username);
		$kueri = $this->db->get_where($this->tb_users);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
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
			return db_error($err);
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
			return db_error($err);
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
			return db_error($err);
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
		$this->load->helper('array');
		$this->db->trans_begin();
		$user = array_remove($data, 'kode_aktifasi');
		$kueri = $this->db->insert($this->tb_users, $user);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 401;
				$res['message'] = "No user has been registed!";
				return $res;
			} else {
				$attr = array_remove($data, array('username', 'password'));
				$kueri_attr = $this->regist_attr_users($attr);
				if($kueri_attr['code'] != 200) {
					$this->db->trans_rollback();
					$res = $kueri_attr;
				} else {
					$this->db->trans_commit();
					$res['code'] = 200;
					$res['message'] = "Regist new user success";
					$res['data'] = array_remove($data, array('password', 'kode_aktifasi'));
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
			return db_error($err);
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
		$column = array('users.nip', 'username', 
			'users.email', 'exp_aktifasi');
		$this->db->select($column);
		$this->db->from($this->tb_users);
		$this->db->join($this->tb_attr, 'attr_users.nip = users.nip');
		$this->db->where('users.email', $email);
		$this->db->where('kode_aktifasi !=', NULL);
		$kueri = $this->db->get_where();
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
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
			return db_error($err);
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
		$this->db->set('exp_aktifasi', NULL);
		$this->db->where('email', $email);
		$kueri = $this->db->update($this->tb_attr);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
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
			return db_error($err);
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
			return db_error($err);
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
			$now = strtotime('now');

			$this->db->set('kode_aktifasi', $key);
			$this->db->set('exp_aktifasi', $now);
			$this->db->where('nip', $nip);
			$kueri = $this->db->update($this->tb_attr);

			if(!$kueri) {
				$err = $this->db->error();
				return db_error($err);
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
			return db_error($err);
		} else {
			$where = array('nip' => $nip);
			$this->set_online($where, true);
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
			return db_error($err);
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
			return db_error($err);
		} else {
			$res['code'] = 200;
			$res['message'] = "data has been updated";
			return $res;
		}
	}

	public function set_exp_aktifasi($email)
	{
		// 60 detik * 10 = 10 menit
		$exp = time()+(60*10);
		$this->db->set('exp_aktifasi', $exp);
		$this->db->where('email', $email);
		$kueri = $this->db->update($this->tb_attr);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
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

	public function get_exp_aktifasi($email)
	{
		$column = array('exp_aktifasi');
		$this->db->select($column);
		// $this->db->join($this->tb_attr, 'attr_users.nip = users.nip');
		$this->db->where('email', $email);
		$kueri = $this->db->get_where($this->tb_attr);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = 'The email is incorrect.';
			} else {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array()[0]['exp_aktifasi'];
			}
			return $res;
		}
	}

	public function check_recovery($mail)
	{
		$column = array('nip', 'username');
		$this->db->select($column);
		$this->db->where('email', $mail);
		$kueri = $this->db->get_where($this->tb_users);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = 'Email or username is incorrect.';
			} else {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array()[0];
			}
			return $res;
		}
	}

	public function insert_recovery($kode, $where)
	{
		$exp = strtotime('now')+3600;
		$this->db->set('exp_recovery', $exp);
		$this->db->set('kode_recovery', $kode);
		$this->db->where($where);
		$kueri = $this->db->update($this->tb_attr);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
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

	public function check_kode_recovery($kode)
	{
		$column = array('nip','exp_recovery');
		$this->db->select($column);
		$this->db->where('kode_recovery', $kode);
		$kueri = $this->db->get_where($this->tb_attr);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = 'Unknown method';
			} else {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array()[0];
			}
			return $res;
		}
	}

	public function reset_password($kode, $pass)
	{
		$sql = "UPDATE users
			JOIN attr_users ON users.nip = attr_users.nip
			SET password = ?
			WHERE 1=1
			AND kode_recovery = ?";
		$kueri = $this->db->query($sql, array($pass, $kode));
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			$res['code'] = 200;
			$res['message'] = "data has been updated";
			return $res;
		}
	}

	public function reset_recovery_kode($nip)
	{
		$this->db->set('exp_recovery', NULL);
		$this->db->set('kode_recovery', NULL);
		$this->db->where('nip', $nip);
		$kueri = $this->db->update($this->tb_attr);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
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

	public function resend_code($email, $key)
	{
		$now = strtotime('now');

		$this->db->set('kode_aktifasi', $key);
		$this->db->set('exp_aktifasi', $now);
		$this->db->where('email', $email);
		$kueri = $this->db->update($this->tb_attr);

		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 500;
				$res['message'] = "Internal Server Error";
			} else {
				$res['code'] = 200;
				$res['message'] = "Resend code success";
				$res['data'] = $email;
			}
			return $res;
		}
	}
}
?>
