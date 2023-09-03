<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('enum_helper'))
{
    function status($status){
		if ($status == '1') {
			$value = 'Aktif';
		} else if ($status == '0') {
			$value = 'Tidak Aktif';
		} else {
			$value = '';
		}
        return $value;
    }
	function aktif($status){
		if ($status == 1) {
			$value = 'Aktif';
		} elseif ($status == 0) {
			$value = 'Tidak Aktif';
		}
		return $value;
	}
}

?>
