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

function VerifierAdresseMail($adresse)  
{  
   $Syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';  
   if(preg_match($Syntaxe,$adresse))  
      return true;  
   else  
     return false;  
}