<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."libraries/format.php";
require APPPATH."libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Recovery extends RestController 
{
	function __construct()
	{
		parent::__construct();
	}

	public function index_post()
	{
		$is_valid = $this->valid_input();
		$res['status'] = true;
		$res['message'] = $is_valid;
		$this->response($res);
	}

	private function valid_input()
	{
		$this->form_validation->set_data($this->post());
    $data = array(
			array('field' => 'email',
				'rules' => 'trim|required|min_length[5]|valid_email'),
      array('field' => 'username',
        'rules' => 'trim|required|min_length[5]|max_length[20]')
    );
    $this->form_validation->set_rules($data);
		if($this->form_validation->run($this) == false) {
			return $this->form_validation->error_array();
		} else {
			return true;
		}
	}
}
?>
