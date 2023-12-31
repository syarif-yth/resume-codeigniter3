<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_app extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function select2_nav()
	{
		$this->db->select('nama AS id, label AS text');
		$this->db->order_by('urutan', 'ASC');
		$kueri = $this->db->get('navigasi');
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			return db_response($kueri->result_array());
		}
	}

	public function select2_parent_class()
	{
		$this->db->select('nama AS id, label AS text');
		$this->db->where('is_child', '0');
		$kueri = $this->db->get('par_class');
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			return db_response($kueri->result_array());
		}
	}

	public function select2_method()
	{
		$this->db->select('nama AS id, label AS text');
		$kueri = $this->db->get('par_method');
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			return db_response($kueri->result_array());
		}
	}

	public function select2_aksi()
	{
		$this->db->select('nama AS id, label AS text');
		$kueri = $this->db->get('par_aksi');
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			return db_response($kueri->result_array());
		}
	}

	public function select2_child_func($parent)
	{
		$this->db->select('nama AS id, label AS text');
		$this->db->where('is_child', '1');
		$this->db->like('parent', $parent);
		$kueri = $this->db->get('par_class');
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			return db_response($kueri->result_array());
		}
	}

	public function select2_parent_class_without($nama)
	{
		$this->db->select('nama AS id, label AS text');
		$this->db->where('is_child', '0');
		$this->db->where_not_in('nama', $nama);
		$kueri = $this->db->get('par_class');
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			return db_response($kueri->result_array());
		}
	}

	public function select2_location()
	{
		$this->db->select('kode AS id, nama AS text');
		$this->db->order_by('kode', 'ASC');
		$kueri = $this->db->get('kabupaten');
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			return db_response($kueri->result_array());
		}
	}

	public function select2_rule()
	{
		$this->db->select('nama AS id, label AS text');
		$this->db->order_by('nama', 'ASC');
		$kueri = $this->db->get('rules');
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			return db_response($kueri->result_array());
		}
	}
}

?>
