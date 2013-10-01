<?php
require_once('library.php');

add_filter('show_admin_bar', '__return_false');

/*$separateur     = str_replace('index.php', '', $_SERVER['PHP_SELF']);
$path           = str_replace($separateur, '', $_SERVER['REQUEST_URI']);
$slugs          = explode('/', $path);*/

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
	if(empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['message'])){
		$_SESSION['ff_error'] = "Vérifiez les champs.";
		header('location:./contact');
        exit();
	}else{
		if($_SESSION['captcha'] != $_POST['captcha']){
			$_SESSION['ff_error'] = "Code antispam invalide.";
			header('location:./contact');
            	exit();
		}else{
			if(!VerifierAdresseMail($_POST['email'])){
				$_SESSION['ff_error'] = "Veillez saisir un email valide!";
				header('location:./contact');
            	exit();
			}else{
				$message = 'Email : '.$_POST['email']."\n";
				$message .= nl2br($_POST['message']);
				wp_mail( 'aymenlabidi88@gmail.com', 'Message de la part de '.$_POST['nom'], $message );
				$_SESSION['ff_message'] = "Votre message est bien envoyé.";
				header('location:./contact');
            	exit();
			}
		}
	}
}


if(isset($_POST['send-contribution']) && is_user_logged_in()){
    if(count($_FILES)>0 && isset($_FILES['img']) && !empty($_FILES['img']['name']) && !empty($_POST['titre']) && !empty($_POST['description'])){
        include_once ABSPATH . 'wp-admin/includes/media.php';
        include_once ABSPATH . 'wp-admin/includes/file.php';
        include_once ABSPATH . 'wp-admin/includes/image.php';
        $upload_overrides = array( 'test_form' => false );
        $movefile = media_handle_upload( 'img', NULL, array(), $upload_overrides );
        if ( $movefile ) {
            $user_ID = get_current_user_id();
            $my_post = array(
              'post_title'    => $_POST['titre'],
              'post_content'  => $_POST['description'],
              'post_status'   => 'pending',
              'post_category' => array(2),
              'post_author'   => $user_ID
            );
            $post_id = wp_insert_post( $my_post );
            set_post_thumbnail( $post_id, $movefile );
            $_SESSION['ff_message'] = "Votre création est ajoutée avec succès.";
            header('location:./ffcommunity');
            exit();
        } else {
            $_SESSION['ff_error'] = "Erreur d'upload de votre création.";
            header('location:./ffcommunity');
            exit();
        }
	}else{
		$_SESSION['ff_error'] = "Vérifiez les champs.";
		header('location:./ffcommunity');
        exit();
	}
}



