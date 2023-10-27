<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_rules extends CI_Model
{
	private $db_table;
	function __construct()
	{
		parent::__construct();
		$this->db_table = $this->db->protect_identifiers('rules', TRUE);
	}

	public function insert($data)
	{
		$kueri = $this->db->insert($this->db_table, $data);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = "No data has been inserted";
			} else {
				$res['code'] = 200;
				$res['message'] = "New data has been inserted";
				$res['data'] = $data;
			}
			return $res;
		}
	}

	public function delete($nama)
	{
		$this->db->where('nama', $nama);
		$kueri = $this->db->delete($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			$res['code'] = 200;
			if($this->db->affected_rows() == 0) {
				$res['message'] = "No data has been deleted";
			} else {
				$res['message'] = "Data has been deleted";
			}
			return $res;
		}
	}

	public function check_user($rule) 
	{
		$this->db->where('rule', $rule);
		$kueri = $this->db->get('users_attr');
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 200;
				$res['message'] = 'Not found user registed';
			} else {
				$res['code'] = 406;
				$res['message'] = 'Be found user registed!';
			}
			return $res;
		}
	}

	public function nama_is_unique($nama)
	{
		$this->db->where('nama', $nama);
		$kueri = $this->db->get($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 200;
				$res['message'] = 'Name not registed';
			} else {
				$res['code'] = 406;
				$res['message'] = 'Name has been registed!';
			}
			return $res;
		}
	}

	public function update($data, $id)
	{
		$this->db->where('id', $id);
		$kueri = $this->db->update($this->db_table, $data);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			$res['code'] = 200;
			if($this->db->affected_rows() == 0) {
				$res['message'] = "No data has been updateds";
			} else {
				$res['message'] = "Data has been updated";
				$res['data'] = $data;
			}
			return $res;
		}
	}

	public function update_where($data, $where)
	{
		$this->db->where($where);
		$kueri = $this->db->update($this->db_table, $data);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			$res['code'] = 200;
			if($this->db->affected_rows() == 0) {
				$res['message'] = "No data has been updated";
			} else {
				$res['message'] = "Data has been updated";
				$res['data'] = $data;
			}
			return $res;
		}
	}

	public function select_class($where)
	{
		$this->db->select('class');
		$this->db->where($where);
		$kueri = $this->db->get($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 404;
				$res['message'] = 'Data not found!';
			} else {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array()[0]['class'];
			}
			return $res;
		}
	}
}
?>
