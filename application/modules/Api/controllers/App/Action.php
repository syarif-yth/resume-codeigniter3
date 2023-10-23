<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Action extends RestController 
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
	}

	public function index_get()
	{
		$uri = $this->get('uri');
		$res['status'] = true;
		$res['data'] = $this->get_data($uri);
		$this->response($res);
	}

	private function get_data($uri)
	{
		$act = $this->access->action($this->rule, $uri);
		return $act;
	}
}
?>
