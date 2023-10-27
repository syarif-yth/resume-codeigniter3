<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_users extends CI_Model
{
	private $db_table;
	function __construct()
	{
		parent::__construct();
		$this->db_table = $this->db->protect_identifiers('users', TRUE);
	}

	public function select_all($column = null)
	{
		if($column) $this->db->select($column);
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
				$result = result_filter($kueri->result_array(), 'password');
				$res['data'] = $result;
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
			return db_error($err);
		} else {
			if($kueri->num_rows() == 1) {
				$res['code'] = 200;
				$result = result_filter($kueri->result_array(), 'password');
				$res['data'] = $result;
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
			return db_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 404;
				$res['message'] = 'Data not found!';
			} else {
				$res['code'] = 200;
				$result = result_filter($kueri->result_array(), 'password');
				$res['data'] = $result;
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
			return db_error($err);
		} else {
			if($kueri->num_rows() == 0) {
				$res['code'] = 404;
				$res['message'] = 'Data not found!';
			} else {
				$res['code'] = 200;
				$result = result_filter($kueri->result_array(), 'password');
				$res['data'] = $result;
			}
			return $res;
		}
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
			return db_error($err);
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
			return db_error($err);
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
			return db_error($err);
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
			return db_error($err);
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
			return db_error($err);
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

	public function insert_attr($data)
	{
		$this->db->trans_begin();
		$user = array_remove($data, 'rule');
		$kueri = $this->db->insert($this->db_table, $user);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			if($this->db->affected_rows() == 0) {
				$res['code'] = 400;
				$res['message'] = "no data has been inserted";
			} else {
				$dt_attr = array('nip' => $data['nip'],
					'email' => $data['email'],
					'rule' => $data['rule']);
				$attr = $this->db->insert('users_attr', $dt_attr);
				if(!$attr) {
					$this->db->trans_rollback();
					$err = $this->db->error();
					return db_error($err);
				} else {
					$this->db->trans_commit();
					$res['code'] = 200;
					$res['message'] = "new data has been inserted";
					$res['data'] = $data;
				}
			}
			return $res;
		}
	}

	public function delete_attr($nip)
	{
		$this->db->trans_begin();
		$this->db->where('nip', $nip);
		$attr = $this->db->delete('users_attr');
		if(!$attr) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			$this->db->where('nip', $nip);
			$kueri = $this->db->delete($this->db_table);
			if(!$kueri) {
				$this->db->trans_rollback();
				$err = $this->db->error();
				return db_error($err);
			} else {
				$this->db->trans_commit();
				$res['code'] = 200;
				$res['message'] = "data has been deleted";
				return $res;
			}
		}
	}
}
?>
