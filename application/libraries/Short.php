<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Short
{
	public function __construct()
	{
		$this->ci =& get_instance();
	}

	public function message($field, $message)
	{
		$this->ci->form_validation->set_message($field, $message);
	}
}
?>
