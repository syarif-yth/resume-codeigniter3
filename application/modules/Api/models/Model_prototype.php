<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_prototype extends CI_Model
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

	public function select_all($column = null)
	{
		if($column) $this->db->select($column);
		$kueri = $this->db->get($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 404;
				$res['message'] = 'Data not found!';
			} else {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array();
			}
			return $res;
		}
	}

	public function select_id($id, $column = null)
	{
		if($column) $this->db->select($column);
		$this->db->where('id', $id);
		$kueri = $this->db->get($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($kueri->num_rows() == 1) {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array();
			} else {
				$res['code'] = 400;
				$res['message'] = 'Data duplicated';
			}
			return $res;
		}
	}

	public function select_by($where, $column = null)
	{
		if($column) $this->db->select($column);
		$this->db->where($where);
		$kueri = $this->db->get($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 404;
				$res['message'] = 'Data not found!';
			} else {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array();
			}
			return $res;
		}
	}

	public function select_like($where, $column = null)
	{
		if($column) $this->db->select($column);
		$this->db->like($where);
		$kueri = $this->db->get($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 404;
				$res['message'] = 'Data not found!';
			} else {
				$res['code'] = 200;
				$res['data'] = $kueri->result_array();
			}
			return $res;
		}
	}

	public function insert($data)
	{
		$kueri = $this->db->insert($this->db_table, $data);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = "no data has been inserted";
			} else {
				$res['code'] = 200;
				$res['message'] = "new data has been inserted";
				$res['data'] = $data;
			}
			return $res;
		}
	}

	public function insert_batch($data)
	{
		$kueri = $this->db->insert_batch($this->db_table, $data);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = "no data has been inserted";
			} else {
				$res['code'] = 200;
				$res['message'] = "new data has been inserted";
				$res['data'] = $data;
			}
			return $res;
		}
	}

	public function update($data, $nip)
	{
		$this->db->where('nip', $nip);
		$kueri = $this->db->update($this->db_table, $data);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = "no data has been updated";
			} else {
				$res['code'] = 200;
				$res['message'] = "data has been updated";
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
			return $this->res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = "no data has been updated";
			} else {
				$res['code'] = 200;
				$res['message'] = "data has been updated";
				$res['data'] = $data;
			}
			return $res;
		}
	}

	public function delete($nip)
	{
		$this->db->where('nip', $nip);
		$kueri = $this->db->delete($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = "no data has been deleted";
			} else {
				$res['code'] = 200;
				$res['message'] = "data has been deleted";
			}
			return $res;
		}
	}

	public function delete_where($where)
	{
		$this->db->where($where);
		$kueri = $this->db->delete($this->db_table);
		if(!$kueri) {
			$err = $this->db->error();
			return $this->res_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = "no data has been deleted";
			} else {
				$res['code'] = 200;
				$res['message'] = "data has been deleted";
			}
			return $res;
		}
	}
}
?>
