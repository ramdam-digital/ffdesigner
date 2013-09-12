<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/Editing_wp-config.php Modifier
 * wp-config.php} (en anglais). C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'ffdesigner');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'mysql');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '3FC[5dERCFj@^7_y4Mqrm*^L%OJxwG6)][Kz#&.V*=L$rl,J.mYmb+/WJ/ui|-/&');
define('SECURE_AUTH_KEY',  'S84$4^9z}qE(0O!j_z=O`p)0A6J--X:,MxI DS6Yr|?JZxE7Ck h9<I63gOwLp`J');
define('LOGGED_IN_KEY',    'LVo+j=lJSVCA:mfEZP#u1~z!W5c%4v-KZkF0GYn6%s%^l: ^LV5 BO/nr4i%+2y2');
define('NONCE_KEY',        'X]iux-u?HbPGiGN$Jj*l)k_pZzbNhpgVhr3$9NW=,9!NlZhaOUsEWKC8I>X9<m#(');
define('AUTH_SALT',        'Y?H2Z$gGAuBr+2}ww>L~R LW,FGOk|k)v=`v.9c]&Wt@a]H<T,OdG=kNu}rp6auQ');
define('SECURE_AUTH_SALT', 't!c8+-qEusKD|me6P`^0uOF=#^KN*!9aQcGQQ]|}_GH(Yg;i8,QaE0u.D*dla4$q');
define('LOGGED_IN_SALT',   '`jn*Xy%+Jci:m90wS|@O-%a$p7^zHt_OpVXZfv:rsI*3OO0@aoT5sT`s-6BgS7Th');
define('NONCE_SALT',       'k7NDIEzlc`-WEgXw!D2lH,9GQ-RW:jz-Y<:]0~ZrW)50XYt4,WqP~-I=5OH0]2IC');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
define('WPLANG', 'fr_FR');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');