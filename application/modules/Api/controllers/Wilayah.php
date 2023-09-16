<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Wilayah extends RestController
{
	private $column;
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->column = array('kode', 'nama');
	}

	public function kab_get($kode)
	{
		$kab = $this->getdb_kab($kode)[0];
		$kec['kecamatan'] = $this->getdb_kec($kode);

		$res['status'] = true;
		$res['data'] = array_merge($kab, $kec);
		$this->response($res);
	}

	public function kec_get($kode)
	{
		$kec = $this->getdb_kec($kode);
		$loop = array();
		foreach($kec as $key => $val) {
			$desa['desa'] = $this->getdb_desa($val['kode']);
			$loop[] = array_merge($val, $desa);
		}
		$res['status'] = true;
		$res['data'] = $loop;
		$this->response($res);
	}

	public function input_post()
	{
		$string = "
		
		
		";

		$generate = $this->array_generate($string);
		// $data = $this->setdata_forkec($generate);
		$data = $this->setdata_fordesa($generate);

		$submit = $this->submit('desa', $data);
		$res['error'] = $submit;
		$this->response($res);

		// KABUPATEN ACEH SELATAN
	}

	public function label_get()
	{
		$kueri = $this->db->get('kabupaten');
		$data_kab = $kueri->result_array();

		// foreach($data_kab as $key => $val) {
		// 	$this->db->where('kode', $val['kode']);
		// 	$exp = explode(" ", $val['nama']);
		// 	$set = array('label' => $exp[0]);
		// 	$this->db->update('kabupaten', $set);
		// }

		$res['status'] = true;
		$res['data'] = $data_kab;
		$this->response($res);
	}

	private function getdb_kab($kode)
	{
		$this->db->select($this->column);
		$this->db->where('kode', $kode);
		$kueri = $this->db->get('kabupaten');
		if(!$kueri) {
			$err = $this->db->error();
			return $err['message'];
		} else {
			return $kueri->result_array();
		}
	}

	private function getdb_kec($kode)
	{
		$this->db->select($this->column);
		$this->db->where('kabupaten', $kode);
		$kueri = $this->db->get('kecamatan');
		if(!$kueri) {
			$err = $this->db->error();
			return $err['message'];
		} else {
			return $kueri->result_array();
		}
	}

	private function getdb_desa($kode)
	{
		$this->db->select($this->column);
		$this->db->where('kecamatan', $kode);
		$kueri = $this->db->get('desa');
		if(!$kueri) {
			$err = $this->db->error();
			return $err['message'];
		} else {
			return $kueri->result_array();
		}
	}

	private function submit($table, $data)
	{
		$this->load->database();
		$kueri = $this->db->insert_batch($table, $data);
		$err = $this->db->error();
		return $err;
	}
	private function array_generate($string)
	{
		$replace = str_replace("\n","", $string);
		$explode = explode("\t", $replace);
		foreach($explode as $key => $val) {
			if($val != '') {
				$first[] = $val;
			}
		}
		$nama = array();
		$kode = array();
		foreach($first as $key => $val) {
			if($key%2 == 0) {
				$kode[] = $val;
			} else {
				$nama[] = $val;
			}
		}

		foreach($kode as $key => $val) {
			$final[$val] = $nama[$key];
		}
		return $final;
	}

	private function setdata_forkec($data)
	{
		foreach($data as $key => $val) {
			$exp = explode('.', $key);
			$kode = $exp[0].'.'.$exp[1];
			$return[] = array('kode'=>$key,
				'nama'=>$val,
				'kabupaten'=>$kode);
		}
		return $return;
	}

	private function setdata_fordesa($data)
	{
		foreach($data as $key => $val) {
			$exp = explode('.', $key);
			$exval = explode(' ', $val);
			$kode = $exp[0].'.'.$exp[1].'.'.$exp[2];
			$label = $exval[0];
			$nama = '';
			$count = count($exval);
			foreach($exval as $ex => $ev) {
				if($ex != 0) {
					if($count == ($ex+1)) {
						$nama .= $ev;
					} else {
						$nama .= $ev.' ';
					}
				}
			}
			$return[] = array('kode'=>$key,
				'nama'=>$nama,
				'kecamatan'=>$kode,
				'label'=>$label);
		}
		return $return;
	}

}
?>
