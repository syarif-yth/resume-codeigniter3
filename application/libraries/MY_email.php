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

	public function send_key($email, $key)
	{
		$ci =& get_instance();
		$ci->load->config('email');
		
		$message = '<center>
			<h1>Confirm Your Account</h1>
			<h4>Thank you for signing up</h4>
			<p>before you can used application, we need to verify your account. To complete the varification process, please use the code below to log in, this code is valid for 10 minutes.</p>
			<br>
			<center style="color: #333333; font-size: 27px; font-weight: 700; line-height: 27px;">'.$key.'</center>
			<br>
			<p>If you received this email by mistake, <br>please, ignore it or inform us at<br>'.$ci->config->item('smtp_user').'</p>
		</div>';

		$ci->email->from($ci->config->item('smtp_user'), 'Localhost');
		$ci->email->to($email);
		$ci->email->subject('Confirm Your Account');
		$ci->email->message($message);

		if($ci->config->item('active')) {
			if(!$ci->email->send()) {
				$res['code'] = 500;
				$res['message'] = $ci->email->get_debugger();
				return $res;
			} else {
				$res['code'] = 200;
				$res['message'] = 'code activate send';
				return $res;
			}
		} else {
			$res['code'] = 200;
			$res['message'] = 'Config activation not actived';
			return $res;
		}
	}

	public function send_link($email, $link)
	{
		$ci =& get_instance();
		$ci->load->config('email');
		
		$message = '<center>
			<h1>Reset Password</h1>
			<h4></h4>
			<p>before you can used application, we need to verify your account. To complete the varification process, please copy this url or klik button to reset, this url is valid for 1 hours.</p>
			<br>
			<a href="'.$link.'" target="_blank">Reset Password</a>
			<br>
			'.$link.'
			<br>
			<p>If you received this email by mistake, <br>please, ignore it or inform us at<br>'.$ci->config->item('smtp_user').'</p>
		</div>';

		$ci->email->from($ci->config->item('smtp_user'), 'Localhost');
		$ci->email->to($email);
		$ci->email->subject('Reset Password');
		$ci->email->message($message);

		if($ci->config->item('active')) {
			if(!$ci->email->send()) {
				$res['code'] = 500;
				$res['message'] = $ci->email->get_debugger();
				return $res;
			} else {
				$res['code'] = 200;
				$res['message'] = 'code activate send';
				return $res;
			}
		} else {
			$res['code'] = 200;
			$res['message'] = 'Config activation not actived';
			return $res;
		}
	}
}
?>
