<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
?>

    <aside class="sidebar" role="complementary">
	<?php
		if ( is_page() && !is_page_template( 'page-composer.php' )) { // Output sidebar for pages besides homepage
			dynamic_sidebar( 'Pages' );
		} else { // Output sidebar for categories and posts
			dynamic_sidebar( 'Magazine' );
		}

    ?>
    <div id="banner" class="widget">
		<div class="side-banner">
    		<img src="<?php echo get_template_directory_uri() . '/custom/banner250x250.png';?>">
    	</div>
    </div>
    
    </aside><!-- .sidebar -->
