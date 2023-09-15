<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('array_unset')) {
	// UNSET WITHOUT REMOVE
	function array_unset($array, $unset)
	{
		$data = array();
		$d = array();
		foreach($array as $key => $val) {		
			if(is_array($unset)) {
				$d = array();
				foreach($unset as $k => $v) {
					if($key == $v) {
						$d[] = false;
					} 
				}

				if(!in_array(false, $d)) {
					$data[$key] = $val;
				} 
			} else {
				if($key != $unset) {
					$data[$key] = $val;
				}
			}
		}
		return $data;
	}
}
