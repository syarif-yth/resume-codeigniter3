<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dtable extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function format_parameter()
	{
		$param = array(
			'table' => 'users',
			'post_start' => $_POST['start'],
			'post_length' => $_POST['length'],
			'default_order' => array('id' => 'ASC'),
			'col_order' => array(null, 'id','username'),
			'post_order' => $_POST['order'],
			'col_search' => array('id','username'),
			'post_search' => $_POST['search']['value'],
		);
	}

	public function query($param)
	{
		$this->db->from($param['table']);
		$i = 0;
		foreach($param['col_search'] as $item) {
			if($param['post_search']) {
				if($i===0) {
					$this->db->group_start();
					$this->db->like($item, $param['post_search']);
				} else {
					$this->db->or_like($item, $param['post_search']);
				}
				if(count($param['col_search'])-1 == $i) $this->db->group_end();
			}
			$i++;
		}

		if(isset($param['post_order'])) {
			$order = $param['post_order']['0'];
			$this->db->order_by($param['col_order'][$order['column']], $order['dir']);
		} else {
			$this->db->order_by(key($param['default_order']), $default_order[key($param['default_order'])]);
		}
	}

	public function get_data($param)
	{
		$this->query($param);
		if($param['post_length'] != -1) {
			$this->db->limit($param['post_length'], $param['post_start']);
			$kueri = $this->db->get();
			if(!$kueri) {
				$err = $this->db->error();
				return db_error($err);
			} else {
				return $kueri->result();
			}
		}
	}

	public function count_all($param)
	{
		$this->db->from($param['table']);
		return $this->db->count_all_results();
	}

	public function count_filtered($param)
	{
		$this->query($param);
		$kueri = $this->db->get();
		return $kueri->num_rows();
	}
}
?>
