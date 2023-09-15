<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('romawi')) {
	function romawi($number)
	{
		$rule = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
		
		$romawi = '';
		while($number > 0) {
			foreach($rule as $roman => $int) {
				if($number >= $int) {
					$number -= $int;
					$romawi .= $roman;
					break;
				}
			}
		}
		return $romawi;
	} 
}



?>
