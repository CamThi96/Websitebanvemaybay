<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
		
function ngay(){
	$current = getdate();
    return $current['year'].'-'.$current['mon'].'-'.$current['mday'];
}

function rand5str(){
	return '-'.substr(md5(time().rand()),0,5);
}

function gio(){
	$ngaythang=getdate();
	$giay=date('s');
	$gio=date('g');
	$phut=date('i');
	return $gio.':'.$phut.':'.$giay;
}
		
		
function khongdau($str) {
 $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
			'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '-'=>' |\'|"|_|&',
        );
        
		$str = preg_replace('~\s+~', ' ', trim($str));
       foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
       }
			$str = str_replace('"', '-', $str);
			$str = str_replace('”', '-', $str);
			$str = str_replace('“', '-', $str);
			$str = str_replace(',', '-', $str);
			$str = str_replace('/', '-', $str);
			$str = str_replace('*', '-', $str);
			$str = str_replace('(', '-', $str);
			$str = str_replace(')', '-', $str);
			$str = str_replace(':', '-', $str);
			$str = str_replace(';', '-', $str);
			$str = str_replace(',', '-', $str);
			$str = str_replace('+', '-', $str);
			$str = str_replace('<', '-', $str);
			$str = str_replace('>', '-', $str);
			$str = str_replace('?', '-', $str);
			$str = str_replace('!', '-', $str);
			$str = str_replace('@', '-', $str);
			$str = str_replace('#', '-', $str);
			$str = str_replace('$', '-', $str);
			$str = str_replace('%', '-', $str);
			$str = str_replace('^', '-', $str);
			$str = str_replace('=', '-', $str);
			$str = str_replace('|', '-', $str);
			$str = str_replace('~', '-', $str);
			$str = str_replace('`', '-', $str);

			$str = str_replace('--', '-', $str);
			$str = str_replace('--', '-', $str);
			$str = str_replace('--', '-', $str);
		if(substr($str, strlen($str)-1,1)=='-'){
			$str=substr($str,0,strlen($str)-1);
		}
		return strtolower($str);
}
?>