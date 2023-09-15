<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends MX_Controller
{
	function __construct()
  {
    parent::__construct();
    $this->load->library('migration');
		$this->load->helper('tree_helper');
  }

	private function check_db()
	{
		$this->load->database();
		$this->load->dbutil();
		$db_name = $this->db->database;
		if(!$this->dbutil->database_exists($db_name)) {
			$res['status'] = false;
			$res['message'] = 'Not connected database, or database not exists';
		} else {
			$res['status'] = true;
			$res['message'] = 'Connected to '.$db_name;
		}
		return $res;
	}

	public function index()
	{
		$this->load->database();
		$db_name = $this->db->database;
		$view = array('dbName' => $db_name);
		$this->load->view('migrate', $view);
	}

	public function process()
	{		
		$migrate = $this->migration();
		$view = array('response' => $migrate);
		$this->load->view('response', $view);
	}

	private function migration()
	{
		$version = 4;
		$migrate = array();
		for($v=1; $v<=$version; $v++) {
			if(!$this->migration->version($v)) {
				$error = show_error($this->migration->error_string());
				$migrate[$v] = array(
					'status' => false,
					'message' => 'Migration table '.$this->string_version($v).' ERROR.<br>'.$error);
			} else {
				$migrate[$v] = array(
					'status' => true,
					'message' => 'Migration table '.$this->string_version($v).' SUCCESS.');
			}
		}
		return $migrate;
	}

	private function string_version($v)
	{
		$count = strlen($v);
		switch($count) {
			case '3': return $v;
				break;
			case '2': return '0'.$v;
				break;
			case '1': return '00'.$v;
				break;
			default: return $v;
				break;
		}
	}
}
