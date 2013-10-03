<?php
/**
 * The template for displaying the footer.
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/ 
?>

    <!--<footer id="footer" role="contentinfo" class="animated">
    
        <?php get_sidebar( 'footer' ); // Output the footer sidebars ?>
        
        <div class="copyright">
            <div class="wrapper">
            	<div class="grids">
                    <div class="grid-10">
                        <?php global $ti_option; echo $ti_option['copyright_text']; ?>
                    </div>
                    <div class="grid-2">
                        <a href="#" class="back-top"><?php _e( 'Back to top', 'themetext' ); ?> <i class="icon-chevron-up"></i></a>
                    </div>
                </div>
            </div>
        </div>
            
    </footer>-->
    <!-- #footer -->

    <footer id="ffd-footer" role="contentinfo" class="animated">
        <div class="totop back-top" ></div>
        <!--<ul class="footer-menu">
            <li><a href="#">Contact</a></li>
            <li><a href="#">Archives</a></li>
            <li><a href="#">Partenaires</a></li>
            <li><a href="#">Mentions légales</a></li>
        </ul>-->
        <?php
            if ( has_nav_menu( 'secondary_menu' ) ) {
                wp_nav_menu( array (
                    'theme_location' => 'secondary_menu',
                    'container' => '',
                    'container_class' => '',
                    'menu_class' => 'footer-menu',
                    'depth' => 1,
                    'fallback_cb' => false,
                    'walker' => new TI_Menu()
                 ));
             }
            ?>
        <div class="copy">Copyright FFDesigner&copy;2013. All Rights Reserved.</div>


        <ul class="icon-menu">
            <li><a href="<?= get_option('facebook', '#');?>"><img src="<?php echo get_template_directory_uri() . '/custom/icone_facebook.png';?>"></a></li>
                    <li><a href="<?= get_option('twitter', '#');?>"><img src="<?php echo get_template_directory_uri() . '/custom/icone_twitter.png';?>"></a></li>
                    <li><a href="<?= get_option('pinterest', '#');?>"><img src="<?php echo get_template_directory_uri() . '/custom/icone_pinterest.png';?>"></a></li>
                    <li><a href="<?= get_option('instagram', '#');?>"><img src="<?php echo get_template_directory_uri() . '/custom/icone_instagram.png';?>"></a></li>
                    <li><a href="<?= get_option('youtube', '#');?>"><img src="<?php echo get_template_directory_uri() . '/custom/icone_youtube.png';?>"></a></li>
        </ul>
    </footer>
    
    </div><!-- #inner-wrap -->
</div><!-- #outer-wrap -->
    
<?php wp_footer(); ?>

</body>
</html>