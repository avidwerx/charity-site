<?php
  $project = get_option("active_cause"); 
  
	//$my_query = new WP_Query( 'year=' . $today["year"] . '&monthnum=' . $today["mon"] . '&day=' . $today["mday"] .
  print_r($today);
 ?> 

<?php	$args = array(
			'post_type' => 'projects',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'p' => $project
		);
		
		  query_posts($args);  		  
		  
			while ( have_posts() ) : the_post(); { 
				 $start = get_post_meta($post->ID, '_cause_start', true); 
				 $end = get_post_meta($post->ID, '_cause_end', true); 
				 $amount = get_post_meta($post->ID, '_cause_amount', true); } endwhile; ?>
		
<div class="tab_content" id="dashboard">
	<div  id="user-stats">
			<div class="two_third">
				<h2>Funds Raised <span>$</span><span id="counter"><?php echo get_current_donations_amount();?></span></h2>
			</div>
			<div id="goal-percent" class="one_third last">
				<h2 class="one_half"><b id="percent">1</b>%</h2>
				<span class="change one_half last" style=""><?php echo GetPercentage(); ?></span>		
			</div>
			<div id="progress_bar" class="ui-progress-bar ui-container">			
					<div class="ui-progress" style="width: 79%;display:none;">
						<span class="ui-label" style="display:none;">Total Donations to date <b class="value">79%</b></span>
					</div><!-- .ui-progress -->
					
				</div><!-- #progress_bar -->  
				<div class="goal-amount">
					<p>Overall Goal: <span><?php echo $amount; ?></span></p>
				</div>
	</div>		
	

		<div id="user-menus">
			<div class="one_half left">
				<div class="visitor"><a href="#"></a></div>
				<div class="returning-visitor"><a href="#"></a></div>
			</div>
			
			<div class="one_half right last">
			<ul id="chart-toggle">
				<li class="plot"><a href="#"></a></li>
				<li class="bar"><a href="#"></a></li>
				<li class="pie"><a href="#"></a></li>
			</ul>
			</div>
		</div>
	
		<div  id="graphwrap">
			<div id="graph">
			<div id="jqChart" style="width: 800px; height: 300px;"></div> 
			</div>	
			<div class="graphshadow"></div>
		</div>	
		<!-- add recent donations table-->
		<div id="recent_donations">
				<h2 class="green_under">Recent Donations</h2>
				<div id="tablewrapper">
				<?php recent_donations_loop(); ?>
				<div class="donation_shadow"><img src="<?php echo get_template_directory_uri();?>/images/donation-shadow.png"></div>
				</div>
			</div>
		<!--activity stream-->
		<div id="snapshot_activitystream" >
		<h2 class="green_under">Activity Feed</h2>			
		<div id="activity-stream">
			<div class="activity-left">								
				<div class="comment-div blackgradient">
					<div class="user-icon"><?php if($fb_img !== '') {echo '<img src="'.$fb_img.'" width="66" >';} else {echo $default_img;} ?></div>
					<div class="commentbox">						
						<input type="text" name="activitycomment" value="">
						<div class="commentbox-filters">
							<label style='width: 56px;'>Post to</label>
							<label><input type="checkbox" name="facebookpost" value="facebookpost">Facebook</label>
							<label><input type="checkbox" name="twitterpost" value="twitterpost">Twitter</label>
							<input type="submit" name="comment-submit-btn" value="submit" class="comment-submit-btn">
						</div>		
							
					</div>
				</div>
				
	<div id="mcs_container">
		<div class="customScrollBox">
			<div class="container">
				<div class="content">
					<div class="activity-holder">
					<?php if ( bp_has_activities( 'max=5&user_id='.$user_id ) ) : ?>
						<?php while ( bp_activities() ) : bp_the_activity(); ?>
					 
							<?php locate_template( array( 'activity/entry.php' ), true, false ); ?>
					 
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		  </div>
		</div>
	</div> 		
				 <div class="dragger_container">
					<div class="dragger"></div>
				</div>
	</div>			
				 <!-- scroll buttons -->
		<a class="scrollUpBtn" href="#"></a> <a class="scrollDownBtn" href="#"></a>
			
				</div>
			 <a class="viewmore" href="#activity">View More</a>
		</div> <!--end activity stream-->
		
		<!--right sidebar-->
		<div class="right_sidebar">
			<div id="event_widget" class="widget_wrap">
				<h2 class="green_under">Events</h2>
			<?php	if (class_exists('EM_Events')) {
					echo EM_Events::output( array('limit'=>3,'orderby'=>'event_start_date') );
				} ?>
			</div>
			
			<!--media gallery-->
			<div id="media_widget" class="widget_wrap">
			 <h2 class="green_under">Media Gallery</h2>
				<!-- relevant for the tutorial - start -->
				<div class="grid_6 prefix_1 suffix_1" id="gallery">
				  <div id="pictures">
					<?php echo get_media_images(); ?>
				  </div>
				  <div class="grid_3 alpha" id="prev">
					<a href="#previous"><< Previous Picture</a>
				  </div>
				  <div class="grid_3 omega" id="next">
					<a href="#next">Next Picture >></a>
				  </div>
				   <a class="viewmore" href="#media">View More</a>
				</div>
				
			<!-- relevant for the tutorial - end -->
			
			</div>
			
			<!--news widget -->
			<div id="news_widget" class="widget_wrap">
			 <h2 class="green_under">Latest News</h2>
			 <p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lacinia vestibulum nisi, et ornare justo aliquam id. Cras tempor aliquet venenatis. Morbi tempus viverra eros nec imperdiet. Duis suscipit lectus quis tellus lacinia sollicitudin. Aliquam neque odio, vulputate sed molestie ut, mollis quis ipsum. Donec nec magna mi, eget scelerisque arcu. Nunc pharetra iaculis metus eget pellentesque.                                       
			 </p>
			  <a class="viewmore" href="#">View More</a>
			 </div>
		</div>
	</div>