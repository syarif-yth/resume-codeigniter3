<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_profile extends CI_Model
{
	private $tb_users;
	function __construct()
	{
		parent::__construct();
		$this->tb_users = $this->db->protect_identifiers('users', TRUE);
		$this->tb_exper = $this->db->protect_identifiers('pengalaman', TRUE);
	}

	public function get_info($id)
	{
		$column = array('cover', 'deskripsi', 'no_telp', 
			'domisili', 'tempat_lahir', 'tgl_lahir');
		$this->db->select($column);
		$this->db->where('nip', $id);
		$kueri = $this->db->get($this->tb_users);
		if(!$kueri) {
			$err = $this->db->error();
			return db_error($err);
		} else {
			if($kueri->num_rows() == 1) {
				return db_response($kueri->result_array()[0]);
			} else {
				return db_response('Data duplicated', 400);
			}
		}
	}
}
?>
