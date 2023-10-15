<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Navigasi extends RestController 
{
	// private $dt_user;
	function __construct()
	{
		parent::__construct();
		// $auth = $this->auth_token->is_valid();
		// if($auth['code'] === 200) {
		// 	$data = $auth['body']['data'];
		// 	$this->dt_user = $data->user;
		// } else {
		// 	$this->response($auth['body'], $auth['code']);
		// 	die();
		// }
	}

	public function index_get()
	{
		$res['status'] = true;
		$res['data'] = $this->get_data();
		$this->response($res);
	}

	private function get_group()
	{
		$this->load->database();
		$this->db->select('nama, label');
		$this->db->order_by('urutan', 'ASC');
		$kueri = $this->db->get('group_navigasi');
		return $kueri->result_array();
	}

	private function get_child($group)
	{
		$this->load->database();
		$this->db->select('nama, label, url, icon');
		$this->db->order_by('urutan', 'ASC');
		$this->db->where('group', $group);
		$kueri = $this->db->get('navigasi');
		return $kueri->result_array();
	}

	private function get_data()
	{
		$group = $this->get_group();
		$cek = [];
		foreach($group as $key => $val) {
			$child['child'] = $this->get_child($val['nama']);
			$cek[] = array_merge($val, $child);
		}
		return $cek;
	}
}
?>
