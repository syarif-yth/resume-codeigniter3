<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function is_unique($table, $where)
	{
		$this->db->where($where);
		$kueri = $this->db->get($table);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 200;
			} else {
				$res['code'] = 400;
			}
			return $res;
		}
	}

	public function is_exist($table, $where)
	{
		$this->db->where($where);
		$kueri = $this->db->get($table);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
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
