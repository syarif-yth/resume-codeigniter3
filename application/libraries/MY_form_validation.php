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
	custom validate, name "{controller}_{field}"
	extra validate, name "valid_{field}"
	database validate, name "db_{field}_{model function name} 
	special validate, 
	*/

	private function loader()
	{
		$ci =& get_instance();
		$ci->load->helper('input');
		$ci->load->model('validation');
		$ci->mess_unique = 'The {field} field must contain a unique value.';
		return $ci;
	}

	public function valid_username($str)
	{
		$ci = $this->loader();
		$preg = preg_user($str);
		if(!$preg) {
			$ci->form_validation->set_message('valid_username', 'The {field} field may only contain alpha-numeric characters, underscores, and dashes.');
			return false;
		} else { return true; }
	}

	public function valid_password($str)
	{
		$ci = $this->loader();
		$preg = preg_pass($str);
		if(!$preg) {
			$ci->form_validation->set_message('valid_password', 'The {field} field must contain uppercase letters, lowercase letters, numbers and special characters.');
			return false;
		} else { return true; }
	}

	public function db_email_is_unique($str)
	{
		$ci = $this->loader();
		$where = array('email' => $str);
		$is_unique = $ci->validation->is_unique('users', $where);
		if($is_unique['code'] != 200) {
			if($is_unique['code'] == 400) {
				$ci->form_validation->set_message('db_email_is_unique', $ci->mess_unique);
			} else {
				$ci->form_validation->set_message('db_email_is_unique', $is_unique['message']);
			}
			return false;
		} else { return true; }
	}

	public function db_username_is_unique($str)
	{
		$ci = $this->loader();
		$where = array('username' => $str);
		$is_unique = $ci->validation->is_unique('users', $where);
		if($is_unique['code'] != 200) {
			if($is_unique['code'] == 400) {
				$ci->form_validation->set_message('db_username_is_unique', $ci->mess_unique);
			} else {
				$ci->form_validation->set_message('db_username_is_unique', $is_unique['message']);
			}
			return false;
		} else { return true; }
	}

	public function db_email_is_exist($str)
	{
		$ci = $this->loader();
		$where = array('email' => $str);
		$is_exist = $ci->validation->is_exist('users', $where);
		if($is_exist['code'] != 200) {
			if($is_exist['code'] == 400) {
				$ci->form_validation->set_message('db_email_is_exist', 'Email not registed.');
			} else {
				$ci->form_validation->set_message('db_email_is_exist', $is_exist['message']);
			}
			return false;
		} else { return true; }
	}

	public function db_username_is_exist($str)
	{
		$ci = $this->loader();
		$where = array('username' => $str);
		$is_exist = $ci->validation->is_exist('users', $where);
		if($is_exist['code'] != 200) {
			if($is_exist['code'] == 400) {
				$ci->form_validation->set_message('db_username_is_exist', 'Username not registed.');
			} else {
				$ci->form_validation->set_message('db_username_is_exist', $is_unique['message']);
			}
			return false;
		} else { return true; }
	}

	public function recovery_email($str)
	{
		$ci = $this->loader();
		$where = array('email' => $str);
		$is_exist = $ci->validation->is_exist('users', $where);
		if($is_exist['code'] != 200) {
			if($is_exist['code'] == 400) {
				$ci->form_validation->set_message('recovery_email', 'The Email or username not registed.');
			} else {
				$ci->form_validation->set_message('recovery_email', $is_unique['message']);
			}
			return false;
		} else { return true; }
	}

	public function recovery_username($str)
	{
		$ci = $this->loader();
		$where = array('username' => $str);
		$is_exist = $ci->validation->is_exist('users', $where);
		if($is_exist['code'] != 200) {
			if($is_exist['code'] == 400) {
				$ci->form_validation->set_message('recovery_username', 'The Email or username not registed.');
			} else {
				$ci->form_validation->set_message('recovery_username', $is_unique['message']);
			}
			return false;
		} else { return true; }
	}

	public function db_rulename_is_unique($str)
	{
		$ci = $this->loader();
		$where = array('nama' => $str);
		$is_unique = $ci->validation->is_unique('rules', $where);
		if($is_unique['code'] != 200) {
			if($is_unique['code'] == 400) {
				$ci->form_validation->set_message('db_rulename_is_unique', $ci->mess_unique);
			} else {
				$ci->form_validation->set_message('db_rulename_is_unique', $is_unique['message']);
			}
			return false;
		} else { return true; }
	}

	public function db_navname_is_unique($str)
	{
		$ci = $this->loader();
		$where = array('nama' => $str);
		$is_unique = $ci->validation->is_unique('navigasi', $where);
		if($is_unique['code'] != 200) {
			if($is_unique['code'] == 400) {
				$ci->form_validation->set_message('db_navname_is_unique', $ci->mess_unique);
			} else {
				$ci->form_validation->set_message('db_navname_is_unique', $is_unique['message']);
			}
			return false;
		} else { return true; }
	}

	public function db_urutan_is_unique($str)
	{
		$ci = $this->loader();
		$where = array('urutan' => $str);
		$is_unique = $ci->validation->is_unique('navigasi', $where);
		if($is_unique['code'] != 200) {
			if($is_unique['code'] == 400) {
				$ci->form_validation->set_message('db_urutan_is_unique', $ci->mess_unique);
			} else {
				$ci->form_validation->set_message('db_urutan_is_unique', $is_unique['message']);
			}
			return false;
		} else { return true; }
	}

	

	public function valid_navnama($str, $match)
	{
		$ci = $this->loader();
		$data = $ci->form_validation->validation_data;
		if($str !== $data[$match]) {
			$where = array('nama' => $str);
			$is_unique = $ci->validation->is_unique('navigasi', $where);
			if($is_unique['code'] != 200) {
				if($is_unique['code'] == 400) {
					$ci->form_validation->set_message('valid_navnama', $ci->mess_unique);
				} else {
					$ci->form_validation->set_message('valid_navnama', $is_unique['message']);
				}
				return false;
			} else { return true; }
		} else { return true; }
	}

	public function valid_urutan($str, $match)
	{
		$ci = $this->loader();
		$data = $ci->form_validation->validation_data;
		if($str !== $data[$match]) {
			$where = array('urutan' => $str);
			$is_unique = $ci->validation->is_unique('navigasi', $where);
			if($is_unique['code'] != 200) {
				if($is_unique['code'] == 400) {
					$ci->form_validation->set_message('valid_urutan', $ci->mess_unique);
				} else {
					$ci->form_validation->set_message('valid_urutan', $is_unique['message']);
				}
				return false;
			} else { return true; }
		} else { return true; }
	}

	public function db_classnama_is_unique($str)
	{
		$ci = $this->loader();
		$where = array('nama' => $str);
		$is_unique = $ci->validation->is_unique('par_class', $where);
		if($is_unique['code'] != 200) {
			if($is_unique['code'] == 400) {
				$ci->form_validation->set_message('db_classnama_is_unique', $ci->mess_unique);
			} else {
				$ci->form_validation->set_message('db_classnama_is_unique', $is_unique['message']);
			}
			return false;
		} else { return true; }
	}

	public function valid_classnama($str, $match)
	{
		$ci = $this->loader();
		$data = $ci->form_validation->validation_data;
		if($str !== $data[$match]) {
			$where = array('nama' => $str);
			$is_unique = $ci->validation->is_unique('par_class', $where);
			if($is_unique['code'] != 200) {
				if($is_unique['code'] == 400) {
					$ci->form_validation->set_message('valid_classnama', $ci->mess_unique);
				} else {
					$ci->form_validation->set_message('valid_classnama', $is_unique['message']);
				}
				return false;
			} else { return true; }
		} else { return true; }
	}

	public function no_space($str)
	{
		$ci = $this->loader();
		// if(strpos($str, " ") !== true) {
		// 	$ci->form_validation->set_message('no_space', 'The {field} field cannot contain spaces');
		// 	return false;
		// } else {
			return true;
		// }
	}




    // ------------------------------------------------------------------------

}   // End of MY_Form_validation Class.

/**
 * ----------------------------------------------------------------------------
 * Filename: MY_Form_validation.php
 * Location: ./application/libraries/MY_Form_validation.php
 * ----------------------------------------------------------------------------
 */ 
