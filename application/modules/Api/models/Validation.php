<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation extends CI_Model
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

	public function is_unique($where)
	{
		$column = array('id');
		$this->db->select($column);
		$this->db->where($where);
		$kueri = $this->db->get_where($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
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
		$column = array('id');
		$this->db->select($column);
		$this->db->where($where);
		$kueri = $this->db->get_where($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
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
