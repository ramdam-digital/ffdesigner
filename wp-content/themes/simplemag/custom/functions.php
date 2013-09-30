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


$separateur     = str_replace('index.php', '', $_SERVER['PHP_SELF']);
$path           = str_replace($separateur, '', $_SERVER['REQUEST_URI']);
$slugs          = explode('/', $path);



if(isset($_POST['attempt']) && $_POST['attempt']==1){
	$creds = array();
	$creds['user_login'] = $_POST['username'];
	$creds['user_password'] = $_POST['password'];
	$creds['remember'] = true;
	$user = wp_signon( $creds, false );
	header('location:./');
	exit();
}


if(isset($_POST['send-contact'])){
	$contact_erreur = "";
	$contact_message = "";
	if(empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['message'])){
		$contact_erreur = "Vérifiez les champs!";
	}else{
		if(!VerifierAdresseMail($_POST['email'])){
			$contact_erreur = "Veillez saisir un email valide!";
		}else{
			$message = 'Email : '.$_POST['email']."\n";
			$message .= nl2br($_POST['message']);
			wp_mail( 'aymenlabidi88@gmail.com', 'Message de la part de '.$_POST['nom'], $message );
			$contact_message = "Votre message est bien envoyé.";
		}
	}
	
}


if(count($slugs) == 1 && $slugs['0']=='ffcommunity'){
    require_once 'ffcommunity.php';
}



