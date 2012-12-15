<div id="donations"  class="tab_content">	
		<div id="donations_stats">
			<div class="stats-shadow-wrap">
			<div class="stats-shadow"></div>
			</div>
			<div class="centering">
				<div class="two_third">
						<h2 class="green_under">Statistics</h2>						
						<?php $cause = get_option("active_cause"); ?>
						<?php $causeAmount = str_replace("$","",get_post_meta($cause, '_cause_amount',true));?>
						<?php $donationAmount = get_post_meta($cause, '_donation_amount',true);?>
						<?php $causeHigh = explode("-",$causeAmount); $causeVal = str_replace("$","",$causeHigh);  ?>
						<input type="hidden" value="<?php echo GetPercentage(); ?>" name="percentofgoal" id="percentofgoal">
						<input type="hidden" value="<?php echo GoalCompletion();?>" name="activecause" id="activecause">
						<input type="hidden" value="<?php echo $causeAmount;?>" name="causeAmount" id="causeAmount">
						<input type="hidden" value="<?php echo round(calculate_donations($cause),0);?>" name="donationAmount" id="donationAmount">

						<div  id="graphwrap">
						<div id="graph">
						<div id="jqChart1" style="width: 680px; height: 263px;"></div> 
						</div>	
						
					</div>	
				</div>
				
				<div class="one_third last">
					<div class="countdown">
						<h3>Time Remaing For Cause</h3>
						<ul id="countdown">
						<li>
							<span class="days">00</span>
							<p class="timeRefDays">days</p>
						</li>
						<li>
							<span class="hours">00</span>
							<p class="timeRefHours">hours</p>
						</li>
						<li>
							<span class="minutes">00</span>
							<p class="timeRefMinutes">minutes</p>
						</li>
						<li>
							<span class="seconds">00</span>
							<p class="timeRefSeconds">seconds</p>
						</li>
					</ul>
					</div>
					 <div style="float: left;" id="gaugeContainer">	
					 <h2>$<?php echo round(calculate_donations($cause),0);?></h2>
					    <div>
						
						<div class="fullguage"></div>	</div>				 
						<div class="pointer"><div class="guagefill"></div></div>
						
					 </div>
				
				</div>
		  </div>
		</div>
		<div class="centering">		
			<div class="donation_left_column">
			  <div class="widget">
		    <div class="title"><img src="<?php echo get_template_directory_uri();?>/images/dollar-icon.png" alt="" class="titleIcon" /><h6>Recent Donations </h6></div>
			<div class="dataTables_length">
			<label>
				<span class="itemsPerPage">Filter by date:</span>
				<div class="selector" id="uniform-tableFilter">
				<span>All</span>
				<select name="tableFilter" id="tableFilter" style="opacity:0;">
				
				<option value="all">Show All</option>
					<?php
				$args_one=array(
				  'post_type' => 'donations',
				  'post_status' => 'publish',
				  'posts_per_page' => -1,
				  
				);
				
				$my_query = new WP_Query($args_one);
				if( $my_query->have_posts() ) {
				while ($my_query->have_posts()) : $my_query->the_post();				
					//$date =  
				?>	
					
					<option value="<?php the_time('F j');?>"><?php the_time('F j');?></option>
				<?php  endwhile; }  wp_reset_query(); ?>
				</select>
				</div>
			</label>
			</div>
		
         
			
			<!--<div class="recent_donation-list">-->
			
				
				<?php
				
				 wp_reset_query();
				$paged = get_query_var('paged') ? get_query_var('paged') : 0;				 
				$args_three = array(
				  'post_type' => 'donations',
				  'post_status' => 'publish',
				  'posts_per_page' => 5,
				  'paged' => $paged
				  
				);
				
				$new_query = new WP_Query($args_three);
				if( $new_query->have_posts() ) {  ?>								 
				
				  <?php
				  while ($new_query->have_posts()) : $new_query->the_post();
				  
				  global $post;		
						  
					$donation =  get_post_meta($post->ID, '_donation_amount', true);
					$email =  get_post_meta($post->ID, '_donation_email', true);
					$phone =  get_post_meta($post->ID, '_donation_phone', true);
					$name =  get_post_meta($post->ID, '_donation_name', true);
					$author = get_the_author();
					$content = get_the_content();
					$postid = $post->ID;
					$meta = array();
					$count =  get_usernumposts(get_the_author_meta('ID'));
					$custom_fields = get_post_custom();
					$img0 = get_post_meta($post->ID, 'image_0', true);
					$img1 = get_post_meta($post->ID, 'image_1', true);
					$img2 = get_post_meta($post->ID, 'image_2', true);
					$img3 = get_post_meta($post->ID, 'image_3', true);
									

					
					?>
					<div class="wUserInfo">
					<div class="donation-div" data-id="<?php the_time('F j');?>">
						<!--<h2><?php the_date('F j');?> </h2>-->	
					<div class="donation_wrap" data-id="<?php the_time('F j');?>">	
						<ul class="donation_left leftList">
							<li class="activity-avatar wUserPic">								
								<?php echo $donation_avatar; ?>
		
							</li>
						</ul>
						<ul class="rightList">
					<li class="left_side leftList">						
						<?php echo $author; ?>
						<span><?php echo $author;?> has donated to <?php echo $count; ?> other causes</span>
					</li>

					<li class="rightList">
						$ <?php echo $donation; ?>
					</li>		
						
					</ul>	
					  <div class="clear"></div>
					</div>
				</div>	
				</div>
				 <div class="cLine"></div>
						<?php endwhile; ?>
						
						<!--<div id="donation_pagination">
						<?php if (  $new_query->max_num_pages > 1 ) : ?>
						<nav id="nav-below">
							<div class="next"><?php previous_posts_link( __( '<span></span> Previous ', 'themename' ) ); ?></div>
							<div class="prev"><?php next_posts_link( __( 'Next <span></span>', 'themename' ) ); ?></div>
						</nav>
					<?php endif; ?>
							<?php if(function_exists('wp_pagenavi')) {  wp_pagenavi(); } ?>
						
						</div>-->
				  
				<?php }
				wp_reset_postdata();

				?>
			
			<!--</div>-->
			</div>	

				<!--new widget -->
				<div class="widget">
                    <div class="title"><img src="<?php echo get_template_directory_uri();?>/css/images/icons/dark/refresh4.png" alt="" class="titleIcon"><h6>Latest updates</h6></div>
                    
                    <div class="updates">
                    	<div class="newUpdate">
                            <div class="uDone">
                                <a href="#" title=""><strong>A new server is on the board!</strong></a>
                                <span>We've just set up a new server. Our gurus ...</span>
                            </div>
                            <div class="uDate"><span class="uDay">08</span>feb</div>
                            <div class="clear"></div>
                        </div>
                        
                    	<div class="newUpdate">
                            <span class="uAlert">
                                <a href="#" title=""><strong>[ URGENT ] ex.ua was closed by government</strong></a>
                                <span>But already everything was solved. It will ...</span>
                            </span>
                            <span class="uDate"><span class="uDay">08</span>feb</span>
                            <div class="clear"></div>
                        </div>
                        
                    	<div class="newUpdate">
                            <span class="uDone">
                                <a href="#" title=""><strong>The goal was reached!</strong></a>
                                <span>We just passed 1000 sales! Congrats to all</span>
                            </span>
                            <span class="uDate"><span class="uDay">07</span>feb</span>
                            <div class="clear"></div>
                        </div>
                        
                    	<div class="newUpdate">
                            <span class="uNotice">
                                <a href="#" title=""><strong>Meat a new team member - Don Corleone</strong></a>
                                <span>Very dyplomatic and flexible sales manager</span>
                            </span>
                            <span class="uDate"><span class="uDay">06</span>feb</span>
                            <div class="clear"></div>
                        </div>
                        
                    </div>
                </div>
		</div>
		
		<div class="donation_right_column">
		  <div class="widget">
		    <div class="title"><img src="<?php echo get_template_directory_uri();?>/images/comments-icon.png" alt="" class="titleIcon" /><h6>Recent Comments</h6></div>				
			<?php wp_reset_query();
				global $post, $wp_query; ?>
				<?php $args = array(
					//'post_id'   => $active_cause,
					
					'status' => 'approve',
					'order'   => 'ASC',
					'count'	 => true	
				);?>
				<?php $wp_query->comments = get_comments( $args ); ?>
						
				<?php wp_reset_query();?>
			<?php $active_cause = get_option('active_cause'); 
				$args = array(
					//'post_id'   => $active_cause,
					'post_id' => '',
					'status' => 'approve',
					'order'   => 'ASC'
				);
				$wp_query->comments = get_comments( $args );
				wp_list_comments(array('style' => 'div','avatar_size' => 45,'max_depth' => 3,'callback'=>'donations_comment'));
				
			?>
			
		</div>
		
			  <div class="widget">
                    <div class="title"><img src="<?php echo get_stylesheet_directory_uri();?>/css/images/icons/dark/timer.png" alt="" class="titleIcon" /><h6>My Causes</h6></div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable taskWidget">
                        <thead>
                            <tr>
                                <td>Cause Name</td>
                                <td width="100">Cause Status</td>
                                <td width="60">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
						
							<?php
								$args_cause=array(
								  'post_type' => 'projects',
								  'post_status' => 'publish,draft',
								  'posts_per_page' => 5,
								  
								);
								
								$my_query_cause = new WP_Query($args_cause);
								if( $my_query->have_posts() ) {  ?>								 
								
								  <?php
								  while ($my_query_cause->have_posts()) : $my_query_cause->the_post();
								  global $post; ?>								  
                            <tr>
                                <td class="<?php if($post->post_status == 'publish'): echo 'taskPr'; else: echo 'taskD'; endif; ?>"><a href="#" title=""><?php echo ucfirst(get_the_title());?></a></td>
                                <td><span class="green f11"><?php echo ucfirst($post->post_status); ?></span></td>
                                <td class="actBtns"><a href="#" title="Update" class="tipS"><img src="<?php echo get_stylesheet_directory_uri();?>/css/images/icons/edit.png" alt="" /></a><a href="#" title="Remove" class="tipS"><img src="<?php echo get_stylesheet_directory_uri();?>/css/images/icons/remove.png" alt="" /></a></td>
                            </tr>
							
						<?php endwhile; ?>
				  
						<?php }
						wp_reset_query(); ?>
                            
                        </tbody>
                    </table>            
                </div>
				</div>
		</div><!--end centering-->
	</div>	