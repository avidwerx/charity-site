<?php global $post;?>
<?php $post_id = $post->ID;
if ( isset( $_POST['html-upload'] ) && !empty( $_FILES ) ) {
    //require_once(ABSPATH . 'wp-admin/includes/admin.php');
    $id = media_handle_upload('async-upload', $post_id); //post id of Client Files page
    unset($_FILES);
    if ( is_wp_error($id) ) {
        $errors['upload_error'] = $id;
        $id = false;
    }

    if ($errors) {
        echo "<p>There was an error uploading your file.</p>";
    } else {
        echo "<p>Your file has been uploaded.</p>";
    }
}

?>
<div id="media"  class="tab_content">	
		<div  id="user_media">
			<h2>Media Gallery</h2>
			<p><a class="addmedia newmedia" href="#basic-modal-content"><img src="<?php echo get_template_directory_uri(); ?>/images/addmedia-btn.png">Add New Media</a></p>
			
			<p><a class="addmedia existing" href="#basic-modal-content"><img src="<?php echo get_template_directory_uri(); ?>/images/addmedia-btn.png">Add Media to existing gallery</a></p>
			<div id="mediaholder">
			<?php query_posts('post_type=media'); 
			while (have_posts()) : the_post();
			?>
			<div class="gallerywrap">
			<li class="album-grid primary"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('album-grid'); ?></a></li>

				<?php if ( $post->post_type == 'media' && $post->post_status == 'publish' ) {
						$attachments = get_posts( array(
							'post_type' => 'attachment',
							'posts_per_page' => -1,
							'post_parent' => $post->ID,
							'exclude'     => get_post_thumbnail_id()
						) );

						if ( $attachments ) {
							foreach ( $attachments as $attachment ) {
								$class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
								$title = wp_get_attachment_link( $attachment->ID, 'album-grid', true );
								echo '<li class="' . $class . ' album-grid">' . $title . '</li>';
							}
							
						}
					}?> </div> <?php
				endwhile;	wp_reset_query();
				?>
		</div>
		</div>
		<div class="shelf"></div>
		<div id="basic-modal-content" style="display:none;" enctype="multipart/form-data" action="">
					<form id="file-form" enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">

				<p id="async-upload-wrap"><label for="async-upload">Upload image</label>
				<input type="file" id="async-upload" name="async-upload"> <input type="submit" value="Upload" name="html-upload"></p>
				
				<p class="gallerylabel"><label for="">Gallery Name</label>
				<input type="text" id="galleryname" name="galleryname" placeholder="add gallery name..."> </p>
				
				<p><input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id ?>" />
				<?php wp_nonce_field('client-file-upload'); ?>
				<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" /></p>

				<p><input type="submit" value="Save all changes" name="save" style="display: none;"></p>
				</form>
				
				
				  <div class="progress">
        <div class="bar"></div >
        <div class="percent">0%</div >
    </div>
    
    <div id="status"></div>
		</div>
		
		<div id="basic-modal-content-existing" style="display:none;" enctype="multipart/form-data" action="">
					<form id="file-form-existing" enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">

				<p id="async-upload-wrap"><label for="async-upload">Upload image</label>
				<input type="file" id="async-upload" name="async-upload"> <input type="submit" value="Upload" name="html-upload"></p>
				
				<p class="gallerylabel"><label for="">Select Gallery</label>
				<select id="galleryselect" name="galleryselect">
					<?php
						query_posts('post_type=media'); 
						while (have_posts()) : the_post();
						
						echo "<option value='".$post->ID."'>";
						the_title();
						echo " </option>";
					
						endwhile;
					?>
				</select>
				</p>

				<p><input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id ?>" />
				<?php wp_nonce_field('client-file-upload'); ?>
				<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" /></p>

				<p><input type="submit" value="Save all changes" name="save" style="display: none;"></p>
				</form>
				
				
				  <div class="progress">
        <div class="bar"></div >
        <div class="percent">0%</div >
    </div>
    
    <div id="status"></div>
		</div>
	</div>	