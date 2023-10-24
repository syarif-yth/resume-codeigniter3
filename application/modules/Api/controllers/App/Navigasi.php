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
		$this->db->where_in('nama', $nama);
		$kueri = $this->db->get('navigasi');
		return $kueri->result_array();
	}

	private function get_data()
	{
		$per = $this->access->navigasi($this->rule);
		$grouping = [];
		$get = $this->get_child($per);
		foreach($get as $val) {
			$grouping[] = $val['group'];
		}
		
		$uni = array_unique($grouping);
		$data = array();
		foreach($uni as $gr) {
			foreach($get as $key => $val) {
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
