<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('now')) {
	function now($format = null)
	{
		$time = new DateTime();
		if(!$format) {
			$now = $time->format('Y-m-d H:i:s');
		} else {
			$now = $time->format($format);
		}
		return $now;
	} 
}

if(!function_exists('tgl_indo')) {
	function tgl_indo($date = null, $with_day = true)
	{
		// output default "hari, tgl bulan_text tahun"
		$hari = array(
			1 => 'Senin','Selasa', 'Rabu','Kamis','Jumat','Sabtu','Minggu');
		$bln = array(
			1 => 'Januari','Februari','Maret','April','Mei','Juni',
			'Juli','Agustus','September','Oktober','November','Desember');

		if($date) {
			$exp = explode('-', $date);
			if(count($exp) == 1) {
				$tgl = date('Y-m-d', $date);
				$str = explode('-', $tgl);
				$num_day = date('N', $date);
				$tgl_indo = $str[2].' '.$bln[(int)$str[1]].' '.$str[0];
			} else {
				$num_day = date('N', strtotime($date));
				$tgl_indo = $exp[2].' '.$bln[(int)$exp[1]].' '.$exp[0];
			}

			if(!$with_day) {
				return $tgl_indo;
			} else {
				return $hari[$num_day].', '.$tgl_indo;
			}
		} else {
			$get = getdate();
			$num_day = $get['wday'];
			$num_month = $get['mon'];
			$default = $hari[$num_day].', '.$get['mday'].' '.$bln[$num_month].' '.$get['year'];
			return $default;
		}
	}
}

?>
