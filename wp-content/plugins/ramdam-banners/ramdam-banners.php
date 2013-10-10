<?php
/*
Plugin Name: Ramdam banners
Plugin URI: http://www.ramdam.in/
Description: Gestion de bannières par Ramdam
Version: 1.0
Author: Aymen Labidi
Author URI: http://aboutme.geekick.net/
*/

if( !defined( 'ABSPATH' ) )
	exit;



/**
 * Ajouter le nouveau type de cotenu surnommé Bannières
 */
add_action( 'init', 'ramdam_banner_init' );
function ramdam_banner_init() {
	$labels = array(
		'name' => 'Bannière',
		'singular_name' => 'Bannière',
		'add_new' => 'Ajouter',
		'add_new_item' => 'Ajouter une bannière',
		'edit_item' => 'Modifier',
		'new_item' => 'Nouvelle bannière',
		'all_items' => 'Les bannières',
		'view_item' => 'Voir bannière',
		'search_items' => 'Trouver une bannière',
		'not_found' =>  'Aucune bannière trouvée',
		'not_found_in_trash' => 'Aucune bannière dans la corbeille', 
		'parent_item_colon' => '',
		'menu_name' => 'Bannières'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'bannieres' ),
		'capability_type' => 'post',
		'has_archive' => false, 
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array( 'title', 'thumbnail', 'editor'),
		'register_meta_box_cb' => 'add_banners_metaboxes'
	); 

	register_post_type( 'bannieres', $args );
	//register_taxonomy( 'categories', 'bannieres');  
	flush_rewrite_rules();
}


/**
 * Affecter les champs meta à notre type de contenu
 */
add_action( 'add_meta_boxes', 'add_banners_metaboxes' );
function add_banners_metaboxes() {
    add_meta_box('ramdam_banner_link', 'Lien du bannière', 'ramdam_banner_form', 'bannieres', 'normal', 'default');
    add_meta_box('ramdam_banner_zone', 'Zone du bannière', 'ramdam_banner_form_zone', 'bannieres', 'normal', 'default');
    add_meta_box('ramdam_banner_type', 'Type du bannière', 'ramdam_banner_form_type', 'bannieres', 'normal', 'default');
    add_meta_box('ramdam_banner_cats', 'Catégories du bannière', 'ramdam_banner_form_cats', 'bannieres', 'normal', 'default');
}

/**
 * Ajouter le champs à notre formulaire
 */
function ramdam_banner_form($post, $metabox){
	$value = get_post_meta($post->ID,'_ramdam_banner_link',true); // outputs value of custom field
	echo '<input type="text" id="ramdam_banner_link" name="ramdam_banner_link" value="'.esc_attr( $value ).'" size="64" />';
	$nonce = wp_create_nonce( 'ramdam-banner' );
	echo '<input type="hidden" name="ramdam_action" value="submitted" />';
	echo '<input type="hidden" name="nonce" value="'.$nonce.'" />';
}

function ramdam_banner_form_zone($post, $metabox){
	$position = get_post_meta($post->ID,'_ramdam_banner_zone',true); // outputs value of custom field
	?>
	<select name="ramdam_banner_zone">
		<option value="top" <?php if($position == "top") echo 'selected';?>>Bannière header</option>
		<option value="side"<?php if($position == "side") echo 'selected';?>>Bannière sidebar</option>
	</select>
	<?php
}

function ramdam_banner_form_type($post, $metabox){
	$type = get_post_meta($post->ID,'_ramdam_banner_type',true); // outputs value of custom field
	?>
	<select name="ramdam_banner_type">
		<option value="image" <?php if($type == "image") echo 'selected';?>>Image</option>
		<option value="flash"<?php if($type == "flash") echo 'selected';?>>Flash</option>
		<option value="script"<?php if($type == "script") echo 'selected';?>>Script</option>
	</select>
	<?php
}

function ramdam_banner_form_cats($post, $metabox){
	$args = array(
		'type'                     => 'post',
		'child_of'                 => 0,
		'parent'                   => '',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 0,
		'hierarchical'             => 1,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'category',
		'pad_counts'               => false 
	); 
	$allCats 	= get_categories( $args );

	$cats 		= get_post_meta($post->ID,'_ramdam_banner_cats',true);

	$bannerCats = json_decode($cats);
	if(is_null($bannerCats)) $bannerCats = array();

	foreach($allCats as $c):
	?>
	<p><input type="checkbox" id="<?php echo $c->slug;?>" name="cats[]" value="<?php echo $c->cat_ID;?>" <?php if(in_array($c->cat_ID, $bannerCats)) echo 'checked';?>><label for="<?php echo $c->slug;?>"><?php echo $c->name;?></label></p>
	<?php
	endforeach;
}

/**
 * Savegarder nos données
 */
add_action( 'save_post', 'ramdam_banner_save_postdata' );
function ramdam_banner_save_postdata( $post_id ) {
	if(isset($_POST['ramdam_action']) && $_POST['ramdam_action']=="submitted"){
		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'ramdam-banner' ) ) {
		     die( 'Security check' ); 
		}
		$post_ID = $_POST['post_ID'];
		$link = sanitize_text_field( $_POST['ramdam_banner_link'] );
		add_post_meta($post_ID, '_ramdam_banner_link', $link, true) 
		or update_post_meta($post_ID, '_ramdam_banner_link', $link);

		$position = sanitize_text_field( $_POST['ramdam_banner_zone'] );
		add_post_meta($post_ID, '_ramdam_banner_zone', $position, true) 
		or update_post_meta($post_ID, '_ramdam_banner_zone', $position);

		$type = sanitize_text_field( $_POST['ramdam_banner_type'] );
		add_post_meta($post_ID, '_ramdam_banner_type', $type, true) 
		or update_post_meta($post_ID, '_ramdam_banner_type', $type);

		$cats = array();
		foreach ($_POST['cats'] as $value) {
			$cats[] = $value;
		}
		$cats = json_encode($cats);
		$categories = sanitize_text_field( $cats );
		add_post_meta($post_ID, '_ramdam_banner_cats', $categories, true) 
		or update_post_meta($post_ID, '_ramdam_banner_cats', $categories);
	}
}



/**
 * Récupérer les bannières par zone
 */
function get_banners($zone, $category = null){
	$args = array( 
				'post_type' 	=> 'bannieres',
				'post_status'   => array('publish', 'future'),
				'meta_key' 		=> '_ramdam_banner_zone',
				'meta_value' 	=> $zone,
			);
	
	$loop = get_posts( $args );
	$data = array();
	foreach ($loop as $p) {
		if(strtotime($p->post_date) > time()){
			$data[] = $p;
		}
	}

	$filter = array();
	if(!is_null($category) && $category != 1){
		foreach($data as $d){
			$cats 		= get_post_meta($d->ID,'_ramdam_banner_cats',true);
			$bannerCats = json_decode($cats);
			if(!is_null($bannerCats) && count($bannerCats)>0){
				if(in_array($category, $bannerCats)){
					$filter[] = $d;
				}
			}
		}
	}
	
	if(count($filter)>0) $data = $filter;
	
	if(count($data)>0){
		$id = rand(0, (count($data)-1));
		render_banner($data[$id]);
	}
	
}


function render_banner($banner){
	$type = get_post_meta($banner->ID,'_ramdam_banner_type',true);
	
	if($type=="image"){
		$link = get_post_meta($banner->ID,'_ramdam_banner_link',true);
		echo '<a href="'.$link.'" target="_blank">'.get_the_post_thumbnail( $banner->ID ).'</a>';
		return;
	}

	if($type=="flash"){
		echo do_shortcode( $banner->post_content );
		return;
	}

	if($type=="script"){
		echo $banner->post_content;
		return;
	}

}

