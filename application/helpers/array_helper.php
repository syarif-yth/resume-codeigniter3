<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('array_remove')) {
	// removing array by key without delete like array_unset
	function array_remove($array, $remove = null)
	{
		if($array && $remove) {
			return array_diff_key($array, array_flip((array) $remove));
		} else {
			return $array;
		}
	}
}

if(!function_exists('set_null')) {
	// set null value if zero with array_map
	// used 'array_map("set_null", $val);'
	function set_null($val)
	{
		return ($val=='') ? NULL : $val;
	}
}
