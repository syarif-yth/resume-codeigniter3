<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Access
{
	protected $class;
	protected $func;
	protected $method;
	protected $uri;

	public function __construct() 
	{
		$this->ci =& get_instance();
		$this->method = $this->ci->input->method();
		$this->func = $this->ci->router->fetch_method();
		$this->class = $this->ci->router->fetch_class();

	}

	public function navigasi($rule)
	{
		$get = $this->data_navigasi($rule);
		if($get['code'] == 200) {
			return json_decode($get['data'][0]);
		} else {
			return $get;
		}
	}

	public function class($rule)
	{
		$get = $this->data_class($rule);
		if($get['code'] == 200) {
			$decode = json_decode($get['data'][0]);
			$array = (array) $decode;

			// $dummy = $this->dataDummy();
			// $decode = json_decode($dummy);
			// $array = (array) $decode;

			if($this->func != 'index') {
				$child = (array) $array[$this->class]->child;
				$class = (empty($child[$this->func])) ? false : $child[$this->func];
			} else {
				if(!empty($array[$this->class])) {
					$class = $array[$this->class]->method;
				}
			}

			if(!empty($class)) {
				$body = 'Access forbidden!';
				$code = 403;
				foreach($class as $key => $val) {
					if($val == $this->method) {
						$body = 'Access accepted';
						$code = 200;
					}
				}
				return $this->res($body, $code);
			} else {
				return $this->res('Access forbidden!', 403);
			}
		} else { return $get; }
	}

	public function action_disabled($rule)
	{
		$get = $this->data_class($rule);
		if($get['code'] == 200) {
			$decode = json_decode($get['data'][0]);
			$array = (array) $decode;
			$aksi = $array[$this->class]->aksi;
			$act = $this->par_action($aksi);
			if($act['code'] == 200) {
				$disabled = array();
				foreach($act['data'] as $key => $val) {
					$disabled[] = $val['nama'];
				}
				return $disabled;
			} else { return $act; }
		} else { return $get; }
	}

	public function action_table($rule)
	{
		$get = $this->data_class($rule);
		if($get['code'] == 200) {
			$decode = json_decode($get['data'][0]);
			$array = (array) $decode;
			$data = $array[$this->class]->aksi;
			$act = array();
			foreach($data as $key => $val) {
				$act[$val] = true;
			}
			return $act;
		} else { return $get; }
	}

	private function data_navigasi($rule)
	{
		$this->ci->load->database();
		$this->ci->db->select('navigasi');
		$this->ci->db->where('nama', $rule);
		$kueri = $this->ci->db->get('rules');
		if(!$kueri) {
			$err = $this->ci->db->error();
			return db_error($err);
		} else {
			if($kueri->num_rows() == 1) {
				$res[] = $kueri->result_array()[0]['navigasi'];
				return db_response($res);
			} else {
				return db_response('Data duplicated', 500);
			}
		}
	}

	private function data_class($rule)
	{
		$this->ci->load->database();
		$this->ci->db->select('class');
		$this->ci->db->where('nama', $rule);
		$kueri = $this->ci->db->get('rules');
		if(!$kueri) {
			$err = $this->ci->db->error();
			return db_error($err);
		} else {
			if($kueri->num_rows() == 1) {
				$res[] = $kueri->result_array()[0]['class'];
				return db_response($res);
			} else {
				return db_response('Data duplicated', 500);
			}
		}
	}

	private function par_action($key=null) 
	{
		$this->ci->load->database();
		$this->ci->db->select('nama');
		if($key) {
			$this->ci->db->where_not_in('nama', $key);
		}
		$kueri = $this->ci->db->get('par_aksi');
		if(!$kueri) {
			$err = $this->ci->db->error();
			return db_error($err);
		} else {
			if($kueri->num_rows() > 0) {
				$res = $kueri->result_array();
				return db_response($res);
			} else {
				return db_response('Internal server error', 500);
			}
		}
	}

	/**
	 * HELPER
	 */
	private function res($data, $code = null)
	{
		if(!$code) {
			$status = array('status' => true);
			$code = 200;
		} else {
			$status = array('status' => ($code != 200) ? false : true);
		}

		$res['code'] = $code;
		if(is_array($data)) {
			$res['body'] = array_merge($status, $data);
		} else {
			$res['body'] = array_merge($status, 
				array('message' => $data));
		}
		return $res;
	}




	

	/** TRIAL */
	public function dataDummy()
	{
		$akses = array(
			"users" => array(
				"aksi" => array("add","edit","delete"),
				"method" => array("get","post","put"),
				"child" => array(
					"datatables" => array("post","get"),
					"chart" => array("post","get"),
					"pdf" => array("get","delete")
				) 
			),
			"permision" => array(
				"aksi" => array('add', 'edit'),
				"method" => array('get','post','delete', 'put'),
				"child" => array(
					"datatable" => array('post'),
					"nav" => array('put'),
					"class" => array('put'),
					"method" => array('put'),
					"detail" => array('post'),
				)
			)
		);
		return json_encode($akses);
	}

	public function dataDummys()
	{
		/*
		{
			"permision" : {
				"aksi": ["add","edit"],
				"method": ["get","post","put","delete"],
				"child": {
					"datatable": ["post"],
					"nav": ["put"],
					"class": ["put"],
					"method": ["put"],
					"detail": ["post"]
				}
			}
		}
		*/
	}

}
?>
