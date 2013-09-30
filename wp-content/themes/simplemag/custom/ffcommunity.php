<?php



if(count($_FILES)>0 && isset($_FILES['img']) && !empty($_FILES['img']['name'])){
        include_once ABSPATH . 'wp-admin/includes/media.php';
        include_once ABSPATH . 'wp-admin/includes/file.php';
        include_once ABSPATH . 'wp-admin/includes/image.php';
        $upload_overrides = array( 'test_form' => false );
        $movefile = media_handle_upload( 'img', NULL, array(), $upload_overrides );
        if ( $movefile ) {
            echo "File is valid, and was successfully uploaded.\n";
                // Create post object
            $user_ID = get_current_user_id();
            $my_post = array(
              'post_title'    => 'My post',
              'post_content'  => 'This is my post.',
              'post_status'   => 'pending',
              'post_category' => array(2),
              'post_author'   => $user_ID
            );

            // Insert the post into the database
            $post_id = wp_insert_post( $my_post );
            set_post_thumbnail( $post_id, $movefile );
        } else {
            echo "Possible file upload attack!\n";
        }
}

    include $template_root.'/header.php';
    ?>

    <section id="content" role="main" class="clearfix animated">
    
        <div class="wrapper">

        <h1>FFCommunity</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <p><label>Titre</label><br><input type="text" name="title"></p>
            <p><label>Description</label><br><textarea name="description"></textarea></p>
            <p><label>Image</label><br><input type="file" name="img"></p>
            
            <input type="submit" value="Envoyer"><input type="reset" value="Annuler">
        </form>
        </div><!-- #content -->
    </section><!-- #container -->

    <?php
    include $template_root.'/footer.php';
    die();