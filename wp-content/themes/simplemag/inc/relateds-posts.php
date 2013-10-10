<?php 
/**
 * Featured Posts
 * Page Composer Section
 *
 * @package SimpleMag
 * @since   SimpleMag 1.0
**/
?>

<?php
global $ti_option; 

$categories = get_the_category( $post->ID );
$first_cat = $categories[0]->cat_ID;

$args = array(
  'category__in' => array( $first_cat ),
  'post__not_in' => array( $post->ID ),
  'posts_per_page' => 3
);

$related_posts = get_posts( $args );
if( $related_posts ):

?>

<section class="featured-posts no-border">
       <h3 class="entry-title related-posts-title">
            <?php echo $ti_option['single_related_title']; ?>
        </h3>
            
    <div class="grids entries">

    <?php foreach( $related_posts as $post ): setup_postdata( $post ); ?>
    
        <article <?php post_class("grid-4"); ?>>
            
            <figure class="entry-image">
                <a href="<?php the_permalink(); ?>">
    
                    <?php 
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'medium-size' );
                    } elseif('video' == get_post_format()){ 
                        $video_path = get_post_meta( $post->ID, "add_video_url", true );
                        $video_key = explode('?v=', $video_path);
                        $video_key = substr($video_key[1], 0, 11);
                    ?>

                    <img src="http://img.youtube.com/vi/<?php echo $video_key;?>/sddefault.jpg" style="height:330px; width:330px;" >
                    <?php }else { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/default-image.png" alt="<?php the_title(); ?>" />
                    <?php } ?>
                </a>
            </figure>
            
            <header class="entry-header">
                <div class="entry-meta">
                   <span class="entry-category"><?php the_category(', '); ?></span>
                   <!--<span class="entry-date"><?php the_time('F j, Y'); ?></span>-->
                </div>
                <h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
            </header>
            
            <div class="entry-summary">
            <?php the_excerpt(); ?>
            </div>
                
        </article>
        
      <?php endforeach; ?>
        

    </div>
    
    <?php wp_reset_query(); ?>

</section><!-- Featured Posts -->
<?php endif; ?>