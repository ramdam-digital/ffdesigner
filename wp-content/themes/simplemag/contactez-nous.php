<?php
/*
Template Name: Contactez-nous
*/

wp_enqueue_script('gmap', 'http://maps.google.com/maps/api/js?sensor=false', array(), null, true );
// Footer custom JS
function custom_scripts(){ ?>
        <script type="text/javascript">

        var map;
        function initialize(x, y) {
          var mapOptions = {
            zoom: 14,
            center: new google.maps.LatLng(x, y),
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          map = new google.maps.Map(document.getElementById('map-canvas'),
              mapOptions);

        var myMarker = new google.maps.Marker({
            position: new google.maps.LatLng(x, y),
            icon: '<?php echo get_template_directory_uri()."/custom/marker.png";?>',
            map: map
        });
          
        }

        initialize(<?= get_option('latitude', 36);?>, <?= get_option('longitude', 10);?>);

        </script>

        <?php
}
add_action( 'wp_footer', 'custom_scripts', 101 );



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
                                <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post">
                                <div class="form-contact">
                                    <table>
                                        <tr>
                                            <td><label>Nom</label></td>
                                            <td><input type="text" name="nom"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Email</label></td>
                                            <td><input type="text" name="email"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Message</label></td>
                                            <td>
                                                <div class="area">
                                                    <textarea name="message"></textarea>
                                                    <input type="submit" name="send-contact" value="Envoyer" class="button">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>
                                                <?php 
                                                $x = rand(0,9);
                                                $y = rand(0,9);
                                                $_SESSION['captcha'] = $x+$y;
                                                echo $x.' + '.$y.' ?';
                                                ?>
                                                </label></td>
                                            <td><input type="text" name="captcha"></td>
                                        </tr>
                                    </table>
                                </div>
                                </form>

                                <div class="map-contact">
                                    <p class="address">
                                        <?= get_option('address', '');?>
                                    </p>
                                    <div id="map-canvas"></div>
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
