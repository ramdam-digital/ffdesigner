<?php
require_once('library.php');

add_filter('show_admin_bar', '__return_false');
add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));

$separateur     = str_replace('index.php', '', $_SERVER['PHP_SELF']);
$path           = str_replace($separateur, '', $_SERVER['REQUEST_URI']);
$slugs          = explode('/', $path);

$myUrl 			= explode('?', $slugs[0]);

if ($myUrl[0]=='inscription' && is_user_logged_in() ){
    header('location:./');
    exit();
}

if($myUrl[0]=='ajax_data'){
	if(isset($_GET['nom']) && !empty($_GET['nom']) 
		&& isset($_GET['prenom']) && !empty($_GET['prenom']) 
		&& isset($_GET['email']) && !empty($_GET['email']) 
		&& isset($_GET['tel']) && !empty($_GET['tel']) ){
		if(VerifierAdresseMail($_GET['email'])){
			$message = '<p>Nom : '.$_GET['nom'].'</p>';
			$message .= '<p>Prenom : '.$_GET['prenom'].'</p>';
			$message .= '<p>Tel : '.$_GET['tel'].'</p>';
			$message .= '<p>Email : '.$_GET['email'].'</p>';
			$message .= '<p>Type Abonnement : '.$_GET['abonnement'].'</p>';
			if($_GET['newsletter']==1){
				$wpdb->insert( 'wp_newsletter', array(
														'email' 	=> $_GET['email'],
														'name' 		=> $_GET['prenom'],
														'surname' 	=> $_GET['nom'],
														'status' 	=> 'C',
														'created'	=> Date('Y-m-d H:i:s')
													) );
			}
			wp_mail( get_option('mail_contact', ''), "Demande d'abonnement de la part de ".$_GET['nom']." ".$_GET['prenom'], $message );
			die('done');
		}else{
			die('<p class="erreur">Adresse mail invalide!</p>');
		}
	}else{
		die('<p class="erreur">Vérifiez les champs!</p>');
	}

	exit();
}

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
				wp_mail( get_option('mail_contact', ''), 'Message de la part de '.$_POST['nom'], $message );
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


if(isset($_POST['send-inscription'])){
    if(empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['prenom']) || empty($_POST['password']) || empty($_POST['repassword']) || empty($_POST['username'])){
		$_SESSION['ff_error'] = "Vérifiez les champs.";
		header('location:./inscription');
        exit();
	}else{
		if($_SESSION['captcha'] != $_POST['captcha']){
			$_SESSION['ff_error'] = "Code antispam invalide.";
			header('location:./inscription');
            	exit();
		}else{
			if(!VerifierAdresseMail($_POST['email'])){
				$_SESSION['ff_error'] = "Veillez saisir un email valide!";
				header('location:./inscription');
            	exit();
			}else{
				if($_POST['password']!=$_POST['repassword']){
					$_SESSION['ff_error'] = "Les deux mots de passe sont différents!";
					header('location:./inscription');
	            	exit();
				}else{
					$userdata = array(
									'user_login' 		=> $_POST['username'],
									'user_pass' 		=> $_POST['password'],
									'user_email' 		=> $_POST['email'],
									'user_registered' 	=> Date('Y-m-d H:i:s'),
									'first_name' 		=> $_POST['prenom'],
									'last_name' 		=> $_POST['nom']
								);

					$user = wp_insert_user( $userdata );
					if(is_wp_error( $user )){
						$error = $user->get_error_message();
						$_SESSION['ff_error'] = $error;
						header('location:./inscription');
		            	exit();
					}else{
						$_SESSION['ff_message'] = "Votre compte est crée avec succès.";
			            header('location:./inscription');
			            exit();
					}
				}
			}
		}
	}
}
