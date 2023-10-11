<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ----------------------------------------------------------------------------
 *
 * Class        MY_Form_validation
 *
 * @project     StarterKIT
 * @author      Syarif YTH
 * @link        http://syarif-yth.github.io
 * ----------------------------------------------------------------------------
 */

/**
 * Class MY_Form_validation
 *
 * place into ./application/libraries
 * 
 * use like this
 * if ($this->form_validation->run($this) == FALSE)
 * {
 *
 * }
 * else
 * {
 *
 * }
 */
class MY_form_validation extends CI_Form_validation
{

  /**
   * Class properties - public, private, protected and static.
   * ------------------------------------------------------------------------
   */


  // ------------------------------------------------------------------------

  /**
   * run ()
   * ---------------------------------------------------------------------------
   *
   * @param   string $module
   * @param   string $group
   * @return  bool
   */

  public function run($module = '', $group = '')
  {
    (is_object($module)) AND $this->CI = &$module;
    return parent::run($group);
  }

	

	/*
	custom validation, name function "{controller}_{field}"
	extra validation, name function "valid_{field}"
	database validation, name function "db_{field}_{model function name} 
	*/

	private function loader()
	{
		$ci =& get_instance();
		$ci->load->helper('input');
		$ci->load->model('validation');
		return $ci;
	}

	public function valid_username($str)
	{
		$ci = $this->loader();
		$preg = preg_user($str);
		if(!$preg) {
			$ci->form_validation->set_message('valid_username', 'The {field} field may only contain alpha-numeric characters, underscores, and dashes.');
			return false;
		} else {
			return true;
		}
	}

	public function valid_password($str)
	{
		$ci = $this->loader();
		$preg = preg_pass($str);
		if(!$preg) {
			$ci->form_validation->set_message('valid_password', 'The {field} field must contain uppercase letters, lowercase letters, numbers and special characters.');
			return false;
		} else {
			return true;
		}
	}

	public function db_email_is_unique($str)
	{
		$ci = $this->loader();
		$where = array('email' => $str);
		$is_unique = $ci->validation->is_unique($where);
		if($is_unique['code'] != 200) {
			if($is_unique['code'] == 400) {
				$ci->form_validation->set_message('db_email_is_unique', 'The {field} field must contain a unique value.');
			} else {
				$ci->form_validation->set_message('db_email_is_unique', $is_unique['message']);
			}
			return false;
		} else {
			return true;
		}
	}

	public function db_username_is_unique($str)
	{
		$ci = $this->loader();
		$where = array('username' => $str);
		$is_unique = $ci->validation->is_unique($where);
		if($is_unique['code'] != 200) {
			if($is_unique['code'] == 400) {
				$ci->form_validation->set_message('db_username_is_unique', 'The {field} field must contain a unique value.');
			} else {
				$ci->form_validation->set_message('db_username_is_unique', $is_unique['message']);
			}
			return false;
		} else {
			return true;
		}
	}

	public function db_email_is_exist($str)
	{
		$ci = $this->loader();
		$where = array('email' => $str);
		$is_exist = $ci->validation->is_exist($where);
		if($is_exist['code'] != 200) {
			if($is_exist['code'] == 400) {
				$ci->form_validation->set_message('db_email_is_exist', 'Email not registed.');
			} else {
				$ci->form_validation->set_message('db_email_is_exist', $is_exist['message']);
			}
			return false;
		} else {
			return true;
		}
	}

	public function db_username_is_exist($str)
	{
		$ci = $this->loader();
		$where = array('username' => $str);
		$is_exist = $ci->validation->is_exist($where);
		if($is_exist['code'] != 200) {
			if($is_exist['code'] == 400) {
				$ci->form_validation->set_message('db_username_is_exist', 'Username not registed.');
			} else {
				$ci->form_validation->set_message('db_username_is_exist', $is_unique['message']);
			}
			return false;
		} else {
			return true;
		}
	}

	public function recovery_email($str)
	{
		$ci = $this->loader();
		$where = array('email' => $str);
		$is_exist = $ci->validation->is_exist($where);
		if($is_exist['code'] != 200) {
			if($is_exist['code'] == 400) {
				$ci->form_validation->set_message('recovery_email', 'The Email or username not registed.');
			} else {
				$ci->form_validation->set_message('recovery_email', $is_unique['message']);
			}
			return false;
		} else {
			return true;
		}
	}

	public function recovery_username($str)
	{
		$ci = $this->loader();
		$where = array('username' => $str);
		$is_exist = $ci->validation->is_exist($where);
		if($is_exist['code'] != 200) {
			if($is_exist['code'] == 400) {
				$ci->form_validation->set_message('recovery_username', 'The Email or username not registed.');
			} else {
				$ci->form_validation->set_message('recovery_username', $is_unique['message']);
			}
			return false;
		} else {
			return true;
		}
	}

	




    // ------------------------------------------------------------------------

}   // End of MY_Form_validation Class.

/**
 * ----------------------------------------------------------------------------
 * Filename: MY_Form_validation.php
 * Location: ./application/libraries/MY_Form_validation.php
 * ----------------------------------------------------------------------------
 */ 
