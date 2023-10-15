<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Permision
{
	protected $class;
	protected $func;
	protected $method;

	public function __construct() 
	{
		$this->ci =& get_instance();
		$this->method = $this->ci->input->method();
		$this->func = $this->ci->router->fetch_method();
		$this->class = $this->ci->router->fetch_class();
	}

	public function navigasi($rule)
	{
		$get = $this->get_akses($rule);
		if($get['code'] == 200) {
			$data = json_decode($get['data'][0]);
			return $data->navigasi;
		} else {
			return $get;
		}
	}

	public function action($rule)
	{
		$get = $this->get_akses($rule);
		if($get['code'] == 200) {
			$decode = json_decode($get['data'][0]);
			$array = (array) $decode;
			return $array[$this->class]->aksi;
		} else {
			return $get;
		}
	}

	public function method($rule)
	{
		$get = $this->get_akses($rule);
		if($get['code'] == 200) {
			$decode = json_decode($get['data'][0]);
			$array = (array) $decode;

			if($this->func != 'index') {
				$child = (array) $array[$this->class]->child;
				$class = $child[$this->func];
			} else {
				$class = $array[$this->class]->method;
			}

			$body = 'Unknown method!';
			$code = 404;
			foreach($class as $key => $val) {
				if($val == $this->method) {
					$body = 'Access accepted';
					$code = 200;
				}
			}
			return $this->res($body, $code);
		} else {
			return $get;
		}
	}

	private function get_akses($rule)
	{
		$this->ci->load->database();
		$this->ci->db->select('akses');
		$this->ci->db->where('nama', $rule);
		$kueri = $this->ci->db->get('rules');
		if(!$kueri) {
			$err = $this->ci->db->error();
			return db_error($err);
		} else {
			if($kueri->num_rows() == 1) {
				$res[] = $kueri->result_array()[0]['akses'];
				return db_response($res);
			} else {
				return db_response('Data duplicated', 500);
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
			"navigasi" => array("profile","resume","users","permision")
		);
		return json_encode($akses);
	}

}
?>
