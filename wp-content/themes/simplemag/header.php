<?php
/**
 * The Header for the theme
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
global $ti_option; // Fetch options stored in $ti_option;
?><!DOCTYPE html>
<!--[if lt IE 9]><html <?php language_attributes(); ?> class="oldie"><![endif]-->
<!--[if !(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php
	if( ! is_home() ):
	  wp_title( '|', true, 'right' );
	endif;
	bloginfo( 'name' );
  ?></title>

<!-- Meta Viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
// Get the favicon

$site_favicon = get_template_directory_uri() . '/images/favicon.ico';

?>
<link rel="shortcut icon" href="<?php echo $site_favicon; ?>" />
<link rel='stylesheet' href="<?php echo get_template_directory_uri().'/custom/reset.css';?>" type='text/css' media='all' />

<?php wp_head(); ?>
<link rel='stylesheet' href="<?php echo get_template_directory_uri().'/custom/tooltips/css/tooltipster.css';?>" type='text/css' media='all' />
<link rel='stylesheet' href="<?php echo get_template_directory_uri().'/custom/style.css';?>" type='text/css' media='all' />
</head>

<body <?php body_class(); ?>>

<div id="outer-wrap">
    <div id="inner-wrap">

    <div id="pageslide">
        <a id="close-pageslide" href="#top"><i class="icon-remove-sign"></i></a>
    </div><!-- Sidebar in Mobile View -->

    <header id="masthead" role="banner" class="clearfix">
            
        <div class="top-strip">
            <div class="wrapper clearfix">
                <div class="left">
                <a href="<?php echo home_url( '/' ); ?>" class="logo"><img src="<?php echo get_template_directory_uri() . '/custom/logo.png';?>"></a>

                <ul class="icon-menu">
                    <li><a href="#"><img src="<?php echo get_template_directory_uri() . '/custom/icone_facebook.png';?>"></a></li>
                    <li><a href="#"><img src="<?php echo get_template_directory_uri() . '/custom/icone_twitter.png';?>"></a></li>
                    <li><a href="#"><img src="<?php echo get_template_directory_uri() . '/custom/icone_pinterest.png';?>"></a></li>
                    <li><a href="#"><img src="<?php echo get_template_directory_uri() . '/custom/icone_instagram.png';?>"></a></li>
                    <li><a href="#"><img src="<?php echo get_template_directory_uri() . '/custom/icone_youtube.png';?>"></a></li>
                </ul>

                <a href="#" class="contact_link">Contact</a>

                <div class="search-form">
                    <input type="text" class="search-input" placeholder="Recherche">
                    <input type="submit" class="submit" value="">
                </div>

                </div>
                <div class="right">
                    <ul class="menu-right">
                        <li class="connexion">
                            <a href="#">Connexion</a>
                            <div class="box">
                                <form>
                                    <!--<p>Vous n'avez pas de compte? <a href="#">Inscrivez-vous</a>.</p>-->
                                    <p>
                                        <label class="mini">Nom d'utilisateur</label>
                                        <input type="text" name="username" class="input">
                                    </p>
                                    <p>
                                        <label>Mot de passe</label>
                                        <input type="password" name="password" class="input">
                                    </p>
                                    <p style="">
                                        <input type="submit" class="btn" value="Se connecter">
                                        
                                    </p>
                                    <p>
                                        <a href="#" style="margin-top:5px;">Mot de passe oublié?</a>
                                    </p>
                                </form>
                            </div>
                        </li>
                        <li class="sep"></li>
                        <li><a href="#">Inscription</a></li>
                    </ul>
                </div>

            </div><!-- .wrapper -->

            <div class="newsletter">
                <span>Abonnez-vous</span>
                <div class="cover">
                    <img src="<?php echo get_template_directory_uri() . '/custom/cover.png';?>">
                </div>
            </div>

        </div><!-- .top-strip -->
            
        <div class="wrapper">

            
        
            <div id="branding" class="animated">
                <!-- Logo -->
				<?php 
                // Get the logo
                if ( $ti_option['site_logo'] != '' ) { 
                    $site_logo = $ti_option['site_logo'];
                } else { 
                    $site_logo = get_template_directory_uri() . '/images/logo.png';
                }
                ?>
                
                <!--<a class="logo" href="<?php echo home_url( '/' ); ?>">
                    <img src="<?php echo $site_logo; ?>" alt="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>" title="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>" />
                </a>-->
                <!-- End Logo -->

                <!--<?php 
                // Show or Hide site tagline under the logo based on Theme Options
                if( $ti_option['site_tagline'] == 1 ) {
                ?>
                <span class="tagline">
                    <?php bloginfo( 'description' ); ?>
                </span>
                <?php } ?>-->

            <div class="top-banner" style="height: 90px;width: 720px; border: 1px solid #000; display: block;">
                
            </div>
                
                
            </div>
            
            <?php
            // Main Menu
			if ( has_nav_menu( 'main_menu' ) ) :
				wp_nav_menu( array (
					'theme_location' => 'main_menu',
					'container' => 'nav',
					'container_class' => 'animated main-menu',
					'menu_id' => 'main-nav',
					'depth' => 2,
					'fallback_cb' => false,
					'walker' => new TI_Menu()
				 ));
			 else:
			 	echo '<div class="message warning"><i class="icon-warning-sign"></i>' . __( 'Define your site main menu', 'themetext' ) . '</div>';
			 endif;
            ?>
    
        </div><!-- .wrapper -->     
    </header><!-- #masthead -->