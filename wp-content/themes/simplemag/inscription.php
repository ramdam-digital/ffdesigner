<?php
/*
Template Name: Inscription
*/

?>


<?php get_header(); ?>
    
    <section id="content" role="main" class="clearfix animated">
        <div class="wrapper">
            
            <header class="entry-header">
                <h1 class="entry-title page-title">
                    <span><?php wp_title( "", true ); ?></span>
                </h1>
            </header>

            <?php
            // Enable/Disable sidebar based on the field selection
            if ( get_field( 'page_sidebar' ) == 'page_sidebar_on'  &&  is_active_sidebar( 'sidebar-2' )):
            ?>
            <div class="grids">
                <div class="grid-8">
            <?php endif; ?>
                
                <?php 
                if (have_posts()) :
                    while (have_posts()) : the_post(); 
                ?>
                
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        
                        <table cellspacing="0" border="0" class="contact-tab">
                            <tr>
                                <td>
                                    <?php if ( has_post_thumbnail() ) { ?>
                                        <?php the_post_thumbnail( 'img_big' ); ?>
                                    <?php } ?>
                                </td>
                                <td class="ctn">
                                    <?php the_content();?>
                                </td>
                            </tr>
                        </table>
                        
        
                        <div class="page-content">

                            <div id="form-area">
                                <form class="cform suscribe" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post">
                                    <?php
                                        if(isset($_SESSION['ff_message'])){
                                            echo '<p class="succes">'.$_SESSION['ff_message'].'</p>';
                                            unset($_SESSION['ff_message']);
                                        }
                                        if(isset($_SESSION['ff_error'])){
                                            echo '<p class="erreur">'.$_SESSION['ff_error'].'</p>';
                                            unset($_SESSION['ff_error']);
                                        } 
                                    ?>
                                    <h3>Inscrivez vous</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, sunt, a, corporis quam excepturi ab perferendis vero assumenda officia rem adipisci dolore hic dolor ullam consequatur voluptate temporibus aspernatur reiciendis!</p>
                                    
                                        <p><input type="text" name="nom" placeholder="Nom"></p>
                                        <p><input type="text" name="prenom" placeholder="Prénom"></p>
                                        <p><input type="text" name="email" placeholder="Email"></p>
                                        <p><input type="text" name="username" placeholder="Nom d'utilisateur"></p>
                                        <p><input type="password" name="password" placeholder="Mot de passe"></p>
                                        <p><input type="password" name="repassword" placeholder="Retapez mot de passe"></p>
                                        <?php 
                                        $x = rand(0,9);
                                        $y = rand(0,9);
                                        $_SESSION['captcha'] = $x+$y;
                                        ?>
                                        <p><input type="text" name="captcha" placeholder="<?php echo $x.' + '.$y.' ?';?>"></p>
                                        
                                        <p>
                                            <input type="submit" name="send-inscription" value="S'inscrire">
                                            <div class="clearfix"></div>
                                        </p>
                                </form>
                            </div>
                            

          
                        </div>
                        
                    </article>
                
                <?php endwhile; endif; ?>
        
                <?php
                // Enable/Disable sidebar based on the field selection
                if ( get_field( 'page_sidebar' ) == 'page_sidebar_on'  &&  is_active_sidebar( 'sidebar-2' )):
                ?>
                </div><!-- .grid-8 -->
            
                <div class="grid-4">
                    <?php get_sidebar(); ?>
                </div>
            </div><!-- .grids -->
            <?php endif; ?>
        
        </div>
    </section><!-- #content -->

<?php get_footer(); ?>
