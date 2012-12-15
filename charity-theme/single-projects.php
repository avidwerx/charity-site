<?php 
/*
Template Name: Projects Frontend Page
*/
?>
<?php get_header();  global $post, $posts,$current_user,$slug,$pagename,$wp_scripts; ?>
<?php
	$project = get_option("active_cause");
    get_currentuserinfo();	
	//echo '<pre>';
	//print_R($post );
	//echo '</pre>';
?>
<div class="clear"></div>
<div class="outermain">
<div id="main-wrap" class="charity-cause">
<div id="content" class="cause-content">
	<div class="projects-header">
		<div class="project_holder">
		
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
		
			{ 
				 $start = get_post_meta($post->ID, '_cause_start', true); 
				 $end = get_post_meta($post->ID, '_cause_end', true); 
				 $amount = get_post_meta($post->ID, '_cause_amount', true);
				 $reward_0 = maybe_unserialize(get_post_meta($post->ID, '_reward', true));	
				  $campaign = get_post_meta($post->ID, '_campaignID', true);
				 ?>
				 <div class="left_project_holder">
				 <div class="bk-rubyslider ">
				 <div id="featureslide_left">
				 <ul id="featureslide">					
				<?php	$args = array(
						'post_type' => 'attachment',
						'numberposts' => null,
						'post_status' => null,
						'post_parent' => $post->ID
					);
					$attachments = get_posts($args);
					if ($attachments) {
					
						foreach ($attachments as $attachment) {
						$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'cause-featured' );
						 ?>
						<li>						
							 <img class="slide_img" src="<?php echo $image_attributes[0]; ?>" title="This is a sample caption" />
							 <div class="fpshadow"></div>
						</li>	
						<?php }  }?>				
						
					</ul>
					
					</div>
					<div class="thumbs">
						<a href="" class="uparrow"></a>
						<ul>							
					 <?php	$args2 = array(
							'post_type' => 'attachment',
							'numberposts' => null,
							'post_status' => null,
							'post_parent' => $post->ID
						);
					$attachments2 = get_posts($args2);
					if ($attachments2) {
					$i = 1;
						foreach ($attachments2 as $attachment2) {
							$image_attributes = wp_get_attachment_image_src( $attachment2->ID, 'cause-thumb' );
						?>
					<li> <a href="" data-id="<?php echo $i - 1; ?>">
						<img src="<?php echo $image_attributes[0]; ?>" />
						<span><?php echo 'image #'.$i; ?></span>
						</a>
					</li>
					<?php	$i++; }
					} ?>
					</ul>
						<a href="" class="downarrow"></a>
					</div>
				 <div class="clearboth"></div>
				 </div>				 
				
				  
				
			
				<h2 class="front_cause_title"><?php the_title(); ?></h2>
			
				<p style="display:none;">Fund Raising Begins: <?php echo $start;?></p>
				<p style="display:none;">Fund Raising Ends: <?php echo $end;?></p>
				<p style="display:none;">Goal: <?php echo $amount;?></p>
				<p><?php echo wp_trim_words( get_the_content(), 40 ); ?></p>
				</div>
				<form id="donation_form" name="donation_form" style="display:none;">
					<fieldset>
						<legend> Your Details</legend>
						<ol>
							<li>
							<label for="name">Name</label>
							<input id="name" name="name" type="text" placeholder="First and last name" required autofocus>
							</li>
							<li>
							<label for="email">Email</label>
							<input id="email" name="email" type="email" placeholder="example@domain.com" required>
							</li>
							<li>
							<label for="phone">Phone</label>
							<input id="phone" name="phone" type="tel" placeholder="Eg. 3149725515">
							</li>
							<li>
							<label for="donation amount">Donation Amount $USD:</label>
							<input id="donation_amount" name="donation_amount" type="number" placeholder="50" required>
							</li>
							<li>
							<label for="comment">Cause Comment</label>
							<textarea id="cause_comment" name="cause_comment" paceholder="Your comment" required></textarea>
							</li>
						</ol>
						</fieldset>
						<fieldset>
						<legend> Submit</legend><br>
						<input type="submit" name="donate" value="Donate" id="send_donation">
						<input type="hidden" name="cause_id" value="<?php echo $post->ID; ?>" id="cause_id">
						<input type="hidden" name="author_id" value="<?php echo $current_user->ID; ?>" id="author_id">
						<input type="hidden" name="author_email" value="<?php echo $current_user->user_email; ?>" id="author_email">
						<input type="hidden" name="author_name" value="<?php echo $current_user->display_name; ?>" id="author_name">
						</fieldset>
				  </form>
				  </div>
				  <div class="cause_description">
				   <div class="one_half">
					<h1 class="green_under">Our Story</h1>
							<p><?php echo wp_trim_words( get_the_content(), 240 ); ?></p>
						</div>
					<div class="one_half last">
					<h1 class="green_under">Donor Rewards</h1>
					<div class="rewardsholder">
					<ul id="rewardlist">						
					<?php 
						foreach($reward_0 as $reward => $key){
						$amount = $key['reward_amount'];
						$description = $key['reward_description'];
						$reward_start = $key['reward-start'];
						$reward_end = $key['reward-end'];
						$reward_avail = $key['reward_avail'];
						
						echo "<li>";
							echo "<div class='reward_top_left'>";
							
								echo "<h3>$".$amount." Reward</h3>";
								
								
							echo '</div>';
							
							echo "<div class='reward_top_right'>";
							
								echo "<a href='#donator_div' class='donate_btn'></a>";
								
							echo '</div>';
							
							echo "<div class='reward_bottom'>";
								
								echo "<p>".wp_trim_words($description,30)."</p>";
							echo "</div>";
						echo "</li>";
						}
					?>						
							
						</ul>
						<a class="donatebutton" href="#donator_div"></a>
					</div>	
							<div style="display:none;">
							<div id="donator_div">
								<?php echo do_shortcode('[donationcampaign id="'.$campaign.'"]'); ?>
								</div>
							</div>					
				  </div>
		<?php	} endwhile; 
		
				
		wp_reset_query(); ?>
	</div>
	
		
	
</div>
<?php get_footer(); ?>