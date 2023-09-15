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
		$this->load->config('migration');
		$version = $this->config->item('migration_version');
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
