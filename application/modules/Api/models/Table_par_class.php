<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_par_class extends CI_Model
{
	private $db_table;
	function __construct()
	{
		parent::__construct();
		$this->db_table = $this->db->protect_identifiers('par_class', TRUE);
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
				$res['message'] = "No data has been updated";
			} else {
				$res['message'] = "Data has been updated";
				$res['data'] = $data;
			}
			return $res;
		}
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
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
}
?>
