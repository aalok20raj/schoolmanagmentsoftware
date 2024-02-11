<?php
function get_safe_value($conn,$str){
	if ($str!='') {
		$str=trim($str);
		return mysqli_real_escape_string($conn,$str);
	}
}
function slug($text){
	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	$text = trim($text,'-');
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	$text = strtolower($text);
	$text = preg_replace('~[^-\w]+~', '', $text);
	if (empty($text)) {
		return 'n-a';
	}
	return $text;
}
?>