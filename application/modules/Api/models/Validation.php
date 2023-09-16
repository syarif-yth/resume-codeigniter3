<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation extends CI_Model
{
	private $tb_users;
	function __construct()
	{
		parent::__construct();
		$this->tb_users = $this->db->protect_identifiers('users', TRUE);
	}

	public function is_unique($where)
	{
		$column = array('nip');
		$this->db->select($column);
		$this->db->where($where);
		$kueri = $this->db->get($this->tb_users);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 200;
			} else {
				$res['code'] = 400;
			}
			return $res;
		}
	}

	public function is_exist($where)
	{
		$column = array('nip');
		$this->db->select($column);
		$this->db->where($where);
		$kueri = $this->db->get($this->tb_users);
		if(!$kueri) {
			$err = $this->db->error();
			return res_error($err);
		} else {
			if($kueri->num_rows() == 1) {
				$res['code'] = 200;
			} else {
				$res['code'] = 400;
			}
			return $res;
		}
	}


}
