<?php 
/**
 * The Template for displaying all single blog posts
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
global $ti_option;
?>

<?php get_header(); ?>
		
    <section id="content" role="main" class="clearfix animated">

	<?php 
    if ( have_posts() ) :
      while ( have_posts() ) : the_post(); 
    ?>
           
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      
        <header class="entry-header wrapper">
            
            
            
            <h1 class="entry-title single-title">
                <span><?php the_title(); ?></span>
            </h1>

            <div class="entry-meta entry-center">
               <span class="entry-category"><?php the_category(', '); ?></span> |
               <span class="entry-date"><?php the_date('j F Y'); ?></span> |
               par <span class="entry-author"><?php the_author(); ?></span> 
            </div>
            
        </header>

        <div class="entry-media">
            <?php 
            /**
             * Filter posts by selected post format
             * Output media from every post ( gallery, video, audio )
            **/
            if( !get_post_format() ){
                get_template_part( 'formats/format', 'standard' ); // Show standard post
            } else{
                get_template_part( 'formats/format', get_post_format() ); // Show selected post format
            }
            ?>
        </div>
        
        <div class="wrapper">
        
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : // If sidebar has widgets ?>
        <div class="grids">
            <div class="grid-8">
        <?php endif; ?>
                
                
			   <?php
               // Post Rating - Defined by post author in admin post edit page
			   if ( get_field('enable_rating') == '1' ) { ?>
					
					<?php
						// Loop through the scores 
						// get the scores summ
						// devide the summ of all scores by scores count
						$score_rows = get_field( 'rating_module' );
						$score = array();
						
						if ( $score_rows ){
							foreach( $score_rows as $key => $row ){
								$score[$key] = $row['score_number'];
							}
						}
						
						$score_items = count( $score ); 
						$score_sum = array_sum( $score );
						$score_total = $score_sum / $score_items;
					?>
					
					<div class="entry-rating">
						<div class="inner">
							<?php 
							// Title
							echo '<h3 class="entry-title">' . $ti_option['single_rating_title'] . '</h3>';
							
							// Output rating note
							$rating_note = get_field('rating_note');
							if ( $rating_note ){
								echo '<p class="entry-meta">' . $rating_note . '</p>';
							}
							
							// Output rating score
							echo '<div class="score-' . number_format( $score_total, 0, '.', '' ) . '">
									<input class="knob" data-width="74" data-height="74" data-displayInput="true" data-readonly="true" data-fgColor="' . $ti_option['main_site_color'] . '" data-bgColor="#ffffff" data-thickness=".20" value="' . number_format( $score_total, 1, '.', '' ) . '" />
								 </div>';
							?>
						</div>
					</div>
				<?php } ?>
            
            
                <div class="single-box clearfix entry-content">
                	<?php the_content(); ?>
                    <?php
						$args = array(
							'before' => '<div class="link-pages">' . __( 'Pages:', 'themetext' ),
							'after' => '</div>',
							'link_before' => '<span>',
							'link_after' => '</span>'
						);
						wp_link_pages( $args ); 
					?>
                </div>
                
                
                <?php 
				// Rating and Scores Breakdown
				if ( get_field('enable_rating') == '1' ) { ?>
                    <div class="single-box clearfix entry-breakdown inview">
                    
                        <h3 class="entry-title">
							<?php echo $ti_option['single_breakdown_title']; ?>
                        </h3>
                        
                        <?php
                        $score_output = get_field( 'rating_module' );
                        if( $score_output ){
                            foreach( $score_output as $row ){?>
                                <div class="score-<?php echo $row['score_number']; ?> item clearfix">
                                	<h4 class="entry-meta">
                                    	<span class="total"><?php echo $row['score_number']; ?></span>
                                    	<?php echo $row['score_label']; ?>
                                    </h4>
                                    <div class="score-outer">
                                    	<div class="score-line" style="width:<?php echo $row['score_number']; ?>0%;"></div>
                                    </div>
                                </div>
                        <?php 
                            }
                        } ?>
                        
                        <div class="total-score clearfix">
                            <h4 class="entry-meta">
                                <span class="total"><?php echo number_format( $score_total, 1, '.', '' ); ?></span>
                                <?php echo __( 'Total Score', 'themetext' ); ?>
                            </h4>
                            <div class="score-outer">
                                <div class="score-line" style="width:<?php echo number_format( $score_total, 1, '', '' ); ?>%;"><span></span></div>
                            </div>
                        </div>
                        
                    </div>
                <?php } ?>
                
                                
                <?php the_tags('<div class="single-box clearfix"><div id="tags-box"><i class="icon-tag"></i>', '', '</div></div>'); ?>
                
                
                <?php 
                // Show/Hide share links
                if ( $ti_option['single_social'] == 1 ) { ?>
                <div id="social-box" class="single-box clearfix">
                    <ul>
                        <li>
                            <span><?php _e( 'Share on:', 'themetext' ); ?></span>
                        </li>
                        <li>
                            <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="blank"><?php _e( 'Facebook', 'themetext' ); ?></a>
                        </li>
                        <li>
                            <a href="http://twitter.com/home?status=<?php the_permalink() ?>" target="_blank"><?php _e( 'Twitter', 'themetext' ); ?></a>
                        </li>
                        <li>
                            <?php $pinimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); ?>
                            <a href="//pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo $pinimage[0]; ?>&amp;description=<?php the_title(); ?>" target="_blank"><?php _e( 'Pinterest', 'themetext' ); ?></a>
                        </li>
                        <li>
                            <a href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink() ?>" target="_blank"><?php _e( 'Google +', 'themetext' ); ?></a>
                        </li>
                    </ul>
                </div><!-- social-box -->
                <?php } ?>
                
                <?php 
                // Show/Hide author box
                if ( $ti_option['single_author'] == 1 ) {
                    get_template_part( 'inc/author', 'box' );
                }
                ?>
                
                <hr class="hr-nav">
				<nav class="single-box clearfix nav-single">
                    <?php
                    $prev_post = get_previous_post();
					$next_post = get_next_post();
                    
                    if ( !empty( $prev_post ) ){ 
                        $post_format = get_post_format( $prev_post->ID );
                        if($post_format=='video'){
                            $video_path = get_post_meta( $prev_post->ID, "add_video_url", true );
                            $video_key = explode('?v=', $video_path);
                            $video_key = substr($video_key[1], 0, 11);
                            $prev_thumb = "http://img.youtube.com/vi/$video_key/default.jpg";
                        }else{
                            $thumb      = wp_get_attachment_image_src( get_post_thumbnail_id($prev_post->ID), 'thumbnail' );
                            $prev_thumb = $thumb['0'];
                        }
                    ?>
                    <div class="nav-previous">
                        <?php //previous_post_link( '%link', '<i class="icon-chevron-left"></i><span class="sub-title">Article précédent</span>' ); ?>
                        <a href="<?php echo get_permalink( $prev_post->ID ); ?>" rel="prev" class="tooltip" title="<img src='<?php echo $prev_thumb;?>' width='48' height='48' style='float:left; margin-right:5px;' /> <h3 style='margin:7px;'><?php echo $prev_post->post_title;?></h3>"><i class="icon-chevron-left"></i><span class="sub-title">Article précédent</span></a>
                    </div>
                    <?php } ?>
                    
                    <?php if ( !empty( $next_post ) && !empty( $prev_post ) ){ ?>
                    <span class="sep"></span>
                    <?php } ?> 
                    
                    <?php
                    if ( !empty( $next_post ) ){ 
                        $post_format = get_post_format( $next_post->ID );
                        if($post_format=='video'){
                            $video_path = get_post_meta( $next_post->ID, "add_video_url", true );
                            $video_key = explode('?v=', $video_path);
                            $video_key = substr($video_key[1], 0, 11);
                            $next_thumb = "http://img.youtube.com/vi/$video_key/default.jpg";
                        }else{
                            $thumb      = wp_get_attachment_image_src( get_post_thumbnail_id($next_post->ID), 'thumbnail' );
                            $next_thumb = $thumb['0'];
                        }
                    ?>
                    <div class="nav-next">
                        <?php //next_post_link( '%link', '<i class="icon-chevron-right"></i><span class="sub-title">Article suivant</span>' ); ?>
                        <a href="<?php echo get_permalink( $next_post->ID ); ?>" rel="prev" class="tooltip" title="<img src='<?php echo $next_thumb;?>' width='48' height='48' style='float:left; margin-right:5px;' /> <h3 style='margin:7px;'><?php echo $next_post->post_title;?> bla bla bla</h3>"><i class="icon-chevron-right"></i><span class="sub-title">Article suivant</span></a>
                    </div>
                    <?php } ?>
                </nav><!-- .nav-single -->

                <?php
                // Show/Hide related posts
                if ( $ti_option['single_related'] == 1 ) {
                	get_template_part( 'inc/related', 'posts' );
                }
                ?>
                
                <?php comments_template(); ?>
        
            <?php if ( is_active_sidebar( 'sidebar-1' ) ) : // If the sidebar has widgets ?>
                </div><!-- .grid-8 -->
            
                <div class="grid-4">
                    <?php get_sidebar(); ?>
                </div>
            </div><!-- .grids -->
            <?php endif; ?>
            
            </div><!-- .wrapper -->
        </article>
              
        <?php endwhile; endif; ?>

    </section><!-- #content -->
    
    <?php
	// Show/Hide random posts slide dock
	if ( $ti_option['single_slide_dock'] == 1 ) {
		get_template_part( 'inc/slide', 'dock' );
	}
	?>
    
<?php get_footer(); ?>