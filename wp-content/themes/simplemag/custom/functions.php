<?php

function ramdam_summary( $str, $n = 500, $end_char = '&#8230;' ){

	$str = strip_tags($str);

	if (strlen($str) < $n)
	{
	    echo $str;
	    return;
	}

	$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

	if (strlen($str) <= $n)
	{
	    echo $str;
	    return;
	}

	$out = "";
	foreach (explode(' ', trim($str)) as $val)
	{
	    $out .= $val.' ';

	    if (strlen($out) >= $n)
	    {
	        $out = trim($out);
	        echo (strlen($out) == strlen($str)) ? $out : $out.$end_char;
	        return;
	    }
	}

	echo $str;
	return;
}


$separateur     = str_replace('index.php', '', $_SERVER['PHP_SELF']);
$path           = str_replace($separateur, '', $_SERVER['REQUEST_URI']);
$slugs          = explode('/', $path);



if(count($slugs) == 1 && $slugs['0']=='ffcommunity'){
    require_once 'ffcommunity.php';
}



