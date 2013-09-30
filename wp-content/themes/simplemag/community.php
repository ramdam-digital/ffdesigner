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
                    pagination: "#pager2",
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
                            
                            <div class="list_carousel">
                                <ul id="foo2">
                                    <?php for($i=1; $i<20; $i++):?>
                                    <li>
                                        <table>
                                            <tr><td><?php the_post_thumbnail( 'ffd-size', array('style'=>'max-width: 210px') ); ?></td></tr>
                                            <tr><td><?php the_post_thumbnail( 'ffd-size', array('style'=>'max-width: 210px') ); ?></td></tr>
                                        </table>
                                    </li>
                                    <?php endfor; ?>
                                </ul>
                                <div class="clearfix"></div>
                                <a id="prev2" class="prev" href="#">&lt;</a>
                                <a id="next2" class="next" href="#">&gt;</a>
                                <div id="pager2" class="pager"></div>
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
