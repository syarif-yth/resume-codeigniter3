<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Navigasi extends RestController 
{
	private $rule;
	function __construct()
	{
		parent::__construct();
		$auth = $this->auth_token->is_valid();
		if($auth['code'] !== 200) {
			$this->response($auth['body'], $auth['code']);
			die();
		}
		$this->rule = $auth['body']['user']['rule'];
		$this->load->library('access');
	}

	public function index_get()
	{
		$res['status'] = true;
		$res['data'] = $this->get_data();
		$this->response($res);
	}

	private function get_child($nama)
	{
		$this->load->database();
		$this->db->select('group, nama, label, url, icon');
		$this->db->order_by('urutan', 'ASC');
		$this->db->where('nama', $nama);
		$kueri = $this->db->get('navigasi');
		return $kueri->result_array()[0];
	}

	private function get_data()
	{
		$per = $this->access->navigasi($this->rule);
		$dt_child = [];
		$grouping = [];
		foreach($per as $val) {
			$get = $this->get_child($val);
			$dt_child[] = $get;
			$grouping[] = $get['group'];
		}

		$uni = array_unique($grouping);
		foreach($uni as $gr) {
			foreach($dt_child as $key => $val) {
				if($val['group'] == $gr) {
					unset($val['group']);
					$data[$gr][] = $val;
				}
			}
		}
		return $data;
	}
}
?>
