<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('set_column')) {
	function set_column($array = null)
	{
		$value = '';
		if(is_null($array)) {
			$value = '* ';
		} else {
			$last = count($array);
			foreach($array as $key => $val) {
				if(($key+1) === $last) {
					$value .= $val;
				} else {
					$value .= $val.", ";
				}
			}
		}
		return $value;
	}
}

if(!function_exists('res_data')) {
	function res_data($data)
	{
		$res = array();
		foreach($data as $key => $val) {
			$exp = explode('.', $key);
			$last = count($exp)-1;
			if(count($exp) > 1) {
				$res[$exp[$last]] = $val;
			} else {
				$res[$key] = $val;
			}
		}
		return $res;
	}
}

if(!function_exists('res_error')) {
	function res_error($err)
	{
		$res['code'] = 500;
		$res['message'] = $err['message'];
		return $res;
	}
}

?>

