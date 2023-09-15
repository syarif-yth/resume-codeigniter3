<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_email extends CI_Email
{
  public function clear_debugger() 
	{
    $this->_debug_msg = array();
  }

  public function get_debugger()
  {
    return $this->_debug_msg;
  }
}
?>
