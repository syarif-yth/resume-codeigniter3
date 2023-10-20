<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Tester extends RestController 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('auth_token');

		$this->column_order = array(null, 'kode','nama');
		$this->column_search = array('kode','nama');
		$this->order = array('kode' => 'ASC');
	}

	public function index_get()
	{
		$user_id = '5156165549';
		$exe = $this->auth_token->create($user_id);
		$this->response($exe);
	}

	public function index_post()
	{
		$user_id = '5156165549';
		$exe = $this->auth_token->validate($user_id);
		$this->response($exe);
	}

	public function index_delete()
	{
		$user_id = '5156165549';
		$exe = $this->auth_token->destroy();
		$this->response($exe);
	}

	

	
	private function _get_datatables_query()
	{
		$this->load->database();
		$this->db->from('kabupaten');
		$i = 0;
		foreach($this->column_search as $item) 
		{
			if($_POST['search']['value']) {
				if($i===0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				
				if(count($this->column_search) - 1 == $i) $this->db->group_end();
			}
			$i++;
		}
		
		if(isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order)) {
			$order = array('kode' => 'asc');
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->load->database();
		$this->_get_datatables_query();
		if($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}
	}
	
	function count_filtered()
	{
		$this->load->database();
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function count_all()
	{
		$this->load->database();
		$this->db->from('kabupaten');
		return $this->db->count_all_results();
	}

	public function datatable_post()
	{
		$this->load->database();
		$list = $this->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
						$no++;
						$row = array();
						$row[] = $no;
						$row[] = $field->kode;
						$row[] = $field->label.' '.$field->nama;
						$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->count_all(),
						"recordsFiltered" => $this->count_filtered(),
						"data" => $data,
		);
		//output dalam format JSON
		$this->response($output);
	}


	public function data_akses_get()
	{
		$this->load->database();
		$this->db->select('nama');
		$this->db->where('is_child', '0');
		$kueri = $this->db->get('par_func');
		$parent = $kueri->result_array();
		$child = [];
		foreach($parent as $par) {
			$get = $this->get_child($par['nama']);
			$val = [];
			foreach($get as $g) {
				$val[$g['nama']] = ['get','post'];
			}

			$child[$par['nama']] = array('child' => $val);
		}
		$this->response($child);
	}

	private function get_child($parent)
	{
		$this->load->database();
		$this->db->select('nama');
		$this->db->where('is_child', '1');
		$this->db->like('parent', $parent);
		$kueri = $this->db->get('par_func');
		$child = $kueri->result_array();
		return $child;
	}
}
?>
