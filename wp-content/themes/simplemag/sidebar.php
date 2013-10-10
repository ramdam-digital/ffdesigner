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
    		<?php
                $category = get_the_category();
                $category_id = $category[0]->cat_ID;
                $banner = get_banners("side", $category_id);
            ?>
    	</div>
    </div>

    
    </aside><!-- .sidebar -->
