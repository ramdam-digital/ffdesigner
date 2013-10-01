<?php
/*
Template Name: FFD Community
*/

wp_enqueue_script('carousel', get_template_directory_uri() . '/custom/jquery.carouFredSel-6.2.1-packed.js', array(), null, true );

wp_enqueue_script('mousewheel', get_template_directory_uri() . '/custom/helper-plugins/jquery.mousewheel.min.js', array(), null, true );
wp_enqueue_script('touchswipe', get_template_directory_uri() . '/custom/helper-plugins/jquery.touchSwipe.min.js', array(), null, true );
wp_enqueue_script('transit', get_template_directory_uri() . '/custom/helper-plugins/jquery.transit.min.js', array(), null, true );
wp_enqueue_script('debounce', get_template_directory_uri() . '/custom/helper-plugins/jquery.ba-throttle-debounce.min.js', array(), null, true );
// Footer custom JS
function custom_scripts(){ 
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#foo2').carouFredSel({
                    auto: false,
                    prev: '#prev2',
                    next: '#next2',
                    mousewheel: true,
                    swipe: {
                        onMouse: true,
                        onTouch: true
                    }
                });
        });
    </script>

    <?php
}
add_action( 'wp_footer', 'custom_scripts', 101 );



?>

<?php 
$args = array(
        'category'         => 2,
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'post_type'        => 'post',
        'post_status'      => 'publish'
    ); 
$posts_array = get_posts( $args );
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
                                <form class="cform" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post" enctype="multipart/form-data">
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
                                    <h3>Poster ma création</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, sunt, a, corporis quam excepturi ab perferendis vero assumenda officia rem adipisci dolore hic dolor ullam consequatur voluptate temporibus aspernatur reiciendis!</p>
                                    <p><input type="text" name="titre" placeholder="Ajouter le titre ici"></p>
                                    <p><textarea name="description" placeholder="Ajouter la desciption ici" rows="6"></textarea></p>
                                    <p>
                                        <div class="upload"><input type="file" name="img"></div>
                                        <input type="submit" name="send-contribution" value="Envoyer">
                                        <div class="clearfix"></div>
                                    </p>
                                </form>
                            </div>
                            

                            
                            <h4 class="ffd">Découvrez la communauté FFDesigner</h4>



                            <div class="list_carousel">
                                <ul id="foo2">
                                    <?php for($i=0; $i<count($posts_array); $i = $i+2):?>
                                    <li <?php if(($i>0 && $i==6) || ($i>8 && ($i-6)%8==0)) echo 'class="nomargin"';?>>
                                        <table>
                                            <tr><td><?php echo get_the_post_thumbnail( $posts_array[$i]->ID, 'thumbnail' ); ?></td></tr>
                                            <tr><td><?php if(isset($posts_array[$i+1])) echo get_the_post_thumbnail( $posts_array[$i+1]->ID, 'thumbnail' ); ?></td></tr>
                                        </table>
                                    </li>
                                    <?php endfor; ?>
                                </ul>
                                <div class="clearfix"></div>
                                <div id="flip">
                                    <a id="prev2" class="prev" href="#"><img src="<?php echo get_template_directory_uri() . '/custom/carousel_prev.png';?>"></a>
                                    <a id="next2" class="next" href="#"><img src="<?php echo get_template_directory_uri() . '/custom/carousel_next.png';?>"></a>
                                </div>
                                <div class="clearfix"></div>
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
