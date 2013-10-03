<?php
/*
Template Name: Abonnez Vous
*/

wp_enqueue_script('fancybox', get_template_directory_uri() . '/custom/jquery.fancybox.js', array(), null, true  );
wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/custom/jquery.fancybox.css' );

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

            $('.fancybox').fancybox();

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

            $('#3mois').mouseover(function(){
                $(this).attr('src', "<?php echo get_template_directory_uri() . '/custom/3mois_hover.png';?>");
                $('#prix_3mois').fadeIn('fast');
            }).mouseout(function(){
                $(this).attr('src', "<?php echo get_template_directory_uri() . '/custom/3mois.png';?>");
                $('#prix_3mois').fadeOut('fast');
            }).click(function(){
                $('#data_abn .forms .right .prix').html($('#prix_3mois').html());
                $('#hidden_prix').val('3 mois');
                $('#data_abn .forms .right img').attr('src', "<?php echo get_template_directory_uri() . '/custom/3mois.png';?>")
            });

            $('#6mois').mouseover(function(){
                $(this).attr('src', "<?php echo get_template_directory_uri() . '/custom/6mois_hover.png';?>");
                $('#prix_6mois').fadeIn('fast');
            }).mouseout(function(){
                $(this).attr('src', "<?php echo get_template_directory_uri() . '/custom/6mois.png';?>");
                $('#prix_6mois').fadeOut('fast');
            }).click(function(){
                $('#data_abn .forms .right .prix').html($('#prix_6mois').html());
                $('#hidden_prix').val('6 mois');
                $('#data_abn .forms .right img').attr('src', "<?php echo get_template_directory_uri() . '/custom/6mois.png';?>")
            });

            $('#12mois').mouseover(function(){
                $(this).attr('src', "<?php echo get_template_directory_uri() . '/custom/12mois_hover.png';?>");
                $('#prix_12mois').fadeIn('fast');
            }).mouseout(function(){
                $(this).attr('src', "<?php echo get_template_directory_uri() . '/custom/12mois.png';?>");
                $('#prix_12mois').fadeOut('fast');
            }).click(function(){
                $('#data_abn .forms .right .prix').html($('#prix_12mois').html());
                $('#hidden_prix').val('12 mois');
                $('#data_abn .forms .right img').attr('src', "<?php echo get_template_directory_uri() . '/custom/12mois.png';?>")
            });


            $('#sabonner').click(function(e){
                e.preventDefault();
                var newsletter, nom, prenom, email, tel;
                if($('#newsletter').is(":checked")){
                    newsletter = 1;
                }else{
                    newsletter = 0;
                }

                nom         = $('#nom').val();
                prenom      = $('#prenom').val();
                email       = $('#email').val();
                tel         = $('#tel').val();
                abonnement  = $('#hidden_prix').val();
                $("#imgLoading").show();
                $("#msg").empty();
                $.ajax({
                    type: "GET",
                    url: "<?php echo esc_url( home_url( '/ajax_data' ) ); ?>",
                    data: {nom: nom, prenom: prenom, tel: tel, email: email, newsletter: newsletter, abonnement: abonnement}
                }).done(function( result ) {
                    $("#imgLoading").hide();
                    if(result == 'done'){
                        var text = '<div class="headb"></div><div class="msgbg"><h3>Merci!</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, sunt, a, corporis quam excepturi ab perferendis vero assumenda officia rem adipisci dolore hic dolor ullam consequatur voluptate temporibus aspernatur reiciendis!</p></div>';
                        $("#data_abn").html(text);
                    }else{
                        $("#msg").html( result );
                    }
                });
            });
            

        });
    </script>

    <?php
}
add_action( 'wp_footer', 'custom_scripts', 101 );



?>

<?php 
$args = array(
        'category'         => 14,
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
                                    <?php echo get_the_post_thumbnail( $posts_array[0]->ID, 'ffd-cover' ); ?>
                                </td>
                                <td class="ctn top_text">
                                    <h3><?php echo $posts_array[0]->post_title;?></h3>
                                    <?php echo $posts_array[0]->post_content;?>
                                </td>
                            </tr>
                        </table>
                        
        
                        <div class="page-content">

                            <div id="form-area">
                                    
                                    <h3>Abonnez Vous</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, sunt, a, corporis quam excepturi ab perferendis vero assumenda officia rem adipisci dolore hic dolor ullam consequatur voluptate temporibus aspernatur reiciendis!</p>
                                    <div class="abonnements">
                                        <div class="abn"><span id="prix_3mois"><?= get_option('3mois', '');?></span><a href="#data_abn" class="fancybox"><img class="img_abn" id="3mois" src="<?php echo get_template_directory_uri() . '/custom/3mois.png';?>"/></a></div>
                                        <div class="abn"><span id="prix_6mois"><?= get_option('6mois', '');?></span><a href="#data_abn" class="fancybox"><img class="img_abn" id="6mois" src="<?php echo get_template_directory_uri() . '/custom/6mois.png';?>"/></a></div>
                                        <div class="abn"><span id="prix_12mois"><?= get_option('12mois', '');?></span><a href="#data_abn" class="fancybox"><img class="img_abn" id="12mois" src="<?php echo get_template_directory_uri() . '/custom/12mois.png';?>"/></a></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="data_abn">
                                        <div class="head"></div>
                                        <div class="forms">
                                            <form action="" method="post">
                                                
                                                <input type="hidden" value="" id="hidden_prix" name="prix">
                                                <div class="left">
                                                    <h3>Je M'abonne</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, commodi odio id repudiandae ipsam hic repellendus aliquam quisquam inventore asperiores!</p>
                                                </div>
                                                <div class="right">
                                                    <img class="img_abn"/>
                                                    <p class="prix"></p>
                                                </div>
                                                
                                                <div class="clearfix"></div>
                                                <div id="msg"></div>
                                                <img src="<?php echo get_template_directory_uri() . '/custom/loading.gif';?>" id="imgLoading" />
                                                <table width="100%">
                                                    <tr>
                                                        <td><input type="text" placeholder="Nom" name="nom" id="nom"></td>
                                                        <td class="mrg"><input type="text" placeholder="Prénom" name="prenom" id="prenom"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" placeholder="Email" name="email" id="email"></td>
                                                        <td class="mrg"><input type="text" placeholder="Téléphone" name="tel" id="tel"></td>
                                                    </tr>
                                                </table>

                                                <div>
                                                    <div class="check"><input type="checkbox" name="newsletter" value="1" id="newsletter" checked> <label for="newsletter">Je veux recevoir la newsletter FFDesigner</label></div>
                                                    <div class="btn"><input type="submit" value="Envoyer" name="sabonner" id="sabonner"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                            

                            
                            <h4 class="ffd">Découvrez les anciennes parutions FFDesigner</h4>



                            <div class="list_carousel">
                                <ul id="foo2">
                                    <?php for($i=0; $i<count($posts_array); $i = $i+2):?>
                                    <li <?php if(($i>0 && $i==6) || ($i>8 && ($i-6)%8==0)) echo 'class="nomargin"';?>>
                                        <table>
                                            <tr><td><?php echo get_the_post_thumbnail( $posts_array[$i]->ID, 'ffd-cover' ); ?></td></tr>
                                            <tr><td><?php if(isset($posts_array[$i+1])) echo get_the_post_thumbnail( $posts_array[$i+1]->ID, 'ffd-cover' ); ?></td></tr>
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
