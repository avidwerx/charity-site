<div id="project"  class="tab_content">		
			<div class="centering project-items-div">
			<div class="recent_project-list">
				<h3>Recent Projects</h3>
				<ul id="example">	
				<?php
				$args=array(
				  'post_type' => 'projects',
				  'post_status' => 'publish',
				  'posts_per_page' => -1,
				  
				);
				
				$my_query = new WP_Query($args);
				if( $my_query->have_posts() ) {  ?>								 
				
				  <?php
				  while ($my_query->have_posts()) : $my_query->the_post();
				  global $post;
					$project = get_post_meta($post->ID, 'custom_project_type', true);
					$featuredimg = get_post_meta($post->ID, 'image_0_0', true);
					$firstname =  get_post_meta($post->ID, 'custom_customer_firstname', true);
					$lastname =  get_post_meta($post->ID, 'custom_customer_lastname', true);
					$company =  get_post_meta($post->ID, 'custom_customer_company', true);
					$email =  get_post_meta($post->ID, 'custom_customer_email', true);
					$phone =  get_post_meta($post->ID, 'custom_customer_phone', true);
					$street =  get_post_meta($post->ID, 'custom_customer_street', true);
					$city =  get_post_meta($post->ID, 'custom_customer_city', true);
					$zip =  get_post_meta($post->ID, 'custom_customer_zip', true);
					$hidecustomer =  get_post_meta($post->ID, 'custom_customer_hidecustomer', true);
					$goal =  get_post_meta($post->ID, '_cause_amount', true);
					$content = get_the_content();
					$postid = $post->ID;
					$meta = array();
					$custom_fields = get_post_custom();
					$active_cause = get_option('active_cause');
					//$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'project-thumb' );
					?>
					<li class="donation_project <?php if($post->ID == $active_cause){echo 'current_project';}else{echo 'previous_project';} ?> ">
						<div class="projectwrap <?php if($post->ID == $active_cause){echo 'current_project';}else{echo 'previous_project';} ?> ">
						<?php the_post_thumbnail('project-thumb'); ?>
						<h1><?php the_title();?></h1>
						<div class="cause_state <?php if($post->ID == $active_cause){echo 'current_project';}else{echo 'previous_project';} ?>  "><?php if($post->ID == $active_cause){echo 'CURRENT CAUSE';}else{echo 'PREVIOUS CAUSE';} ?></div>
						<div class="clearboth"></div>
						<p><?php echo wp_trim_words( get_the_content(), 20 ); ?></p>
						<div class="project-details">
							<span><?php if($post->ID == $active_cause){echo get_current_donations_amount();} else {echo '$40,000';} ?></span>
							<a href="<?php the_permalink();?>">View This Cause</a>
						</div>
						</div>
					
					</li>
					
						<?php endwhile; ?>
				  
				<?php }
				wp_reset_query();
				?>
				<li class="new_project">
					<a href="#">Start a new cause<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/new_cause.png"></a>
				</li>
			</ul>
		 </div>
		</div> 
	<div id="wizard" class="cause-form swMain">
		<div class="centering">
		<ul class="cause_top-bar anchor">		
  				<li><a href="#step-1" class="selected" isdone="1" rel="1">
                <label class="stepNumber">1</label>
                <span class="stepDesc">
                  Basics
                   <small>Primary Info</small>
                </span>
            </a></li>
  				<li><a href="#step-2" class="disabled" isdone="0" rel="2">
                <label class="stepNumber">2</label>
                <span class="stepDesc">
                   Rewards
                   <small>Reward your donors</small>
                </span>
            </a></li>
  				<li><a href="#step-3" class="disabled" isdone="0" rel="3">
                <label class="stepNumber">3</label>
                <span class="stepDesc">
                   Narrative
                   <small>Tell your story</small>
                </span>                   
             </a></li>
  				<li><a href="#step-4" class="disabled" isdone="0" rel="4">
                <label class="stepNumber">4</label>
                <span class="stepDesc">
                   Proceeds
                   <small>Payment info</small>
                </span>                   
            </a></li>
			<li><a href="#step-5" class="disabled" isdone="0" rel="5">
                <label class="stepNumber">5</label>
                <span class="stepDesc">
                   Review
                   <small>The final product</small>
                </span>                   
            </a></li>
		
		</ul>
		</div>
		 <form name="projectform" id="projectform" action="/">
		<div id="step-1">
		<h1 class="green_under">Create a new cause</h1>			 
				  <div class="form-row" id="project_title">
                    <samp>Cause Title</samp> <input type="text" id="cause-title" name="cause-title" value="" class="input-text large" placeholder="max 20 words here" />
					</div>
				  
				  
				   <div class="clear"></div>                   
                    <div class="form-row" id="project_desc">
					 <samp>Cause Featured</samp>
					<textarea class="wysiwyg_new" id="textarea" name="cause_featured_text" cols="79" rows="15" placeholder="Enter featured text of your cause here"></textarea>
                    </div>
                    <br />
					
					
					<div class="clear"></div>                   
                    <div class="form-row" id="cause_cat">
					 <samp>Cause Category</samp>
					  <div class="select-wrap">
					<select name="cause-category" id="cause-category" value="">
						<option value="" >Select a Category</option>
						<option value="Animals">Animals</option>
						<option value="Arts, Culture, Humanities">Arts, Culture, Humanities</option>
						<option value="Education">Education</option>
						<option value="Environment">Environment</option>
						<option value="Health">Health</option>
						<option value="Human Services">Human Services</option>
						<option value="International">International</option>
						<option value="Public Benefit">Public Benefit</option>
						<option value="Religion">Religion</option>
						<option value="Family">Family</option>
					</select>
					</div>
                    </div>
                    <br />
					
					<div class="clear"></div>                   
                    <div class="form-row" id="cause_loc">
					 <samp>Cause Location</samp>
					 <input id="cause-location"  name="cause-location" type="text" size="50" placeholder="Enter a location" autocomplete="off"></div>
					<!-- <div class="select-wrap">
					<select name="cause-location" id="cause-location" value="">
						<option>Enter City, State or Zipcode</option>
						<option value="mo">Saint Louis, MO</option>
						<option>Category 3</option>
					</select>
					</div>
                    </div>-->
                    <br />
					
					<div class="clear" ></div>  
					<div class="form-row" id="project_goal">
                    <samp>Cause Goal Amount</samp> <input type="text" class="input-text large" maxlength="20" placeholder="max 20 characters here" />
					<input type="hidden" value="" name="project-goal-amount">
					<div id="slider-range"></div>
                  </div>
				   
				   <div class="form-row" id="project_start">
                    <samp>Funding Duration</samp>
                    <label> <input type="radio" name="date-type" value="range" /> Number of Days</label><input type="text" class="input-text small a" id="funding-duration" placeholder="1 - 60 Days, 30 days is recommended " />
					<div id="project_end">	
					<label><input type="radio" name="date-type" value="specific" id="datepicker_2" />End on specific date and time</label></div>
                    </div>
                    <br />					
					 <?php adddiv(); ?>
					 <div class="form-row">
					<div class="thumb_div"></div>
					<div>
					<div class="form-row right">				
					<a href="#" class="prev-btn "> </a>
					<a href="#" class="next-btn"> </a>
					</div>
					</div>
					</div>
			
				</div><!--end step1 -->			
			
			<div id="step-2">
				<h1 class="green_under">Donor Rewards</h1>
				<div id="step2_wrap">
				<div class="block-1">
					<div class="reward_left">
					<p class="reward-count-1">Reward #1</p>
					</div>
					<div class="reward_right">
					  <div class="form-row" id="reward_title">
					  <samp>Donation Amount</samp> <input type="text" id="reward-amount" class="input-text large" maxlength="20" placeholder="max 20 characters here" name="reward[0][reward_amount]" />
					  <a href="#" class="delete-reward">Delete Reward</a>
					  </div>
					
					  <div class="form-row" id="reward_description">
					  <samp>Description</samp> <textarea id="reward_description_box" class="input-text large"  placeholder="max 20 characters here"  row="5" name="reward[0][reward_description]"/></textarea>
					  </div>
					  
					  <div class="form-row" id="project_start">
					  <samp>Est. Reward Date</samp>
					  <div class="select-wrap">
						<select name="reward[0][reward-start]" id="reward-start" value="">
							<option>Select Month</option>
							<option value="January">January</option>
							<option value="February">February</option>
							<option value="March">March</option>
							<option value="April">April</option>
							<option value="May">May</option>
							<option value="June">June</option>
							<option value="July">July</option>
							<option value="August">August</option>
							<option value="September">September</option>
							<option value="October">October</option>
							<option value="November">November</option>
							<option value="December">December</option>
						</select>
					</div>	

						
					 <div class="select-wrap last">
						<select name="reward[0][reward-end]" id="reward-end" value="">
							<option>Select Year</option>
							<option>2012</option>
							<option>2013</option>
							<option>2014</option>
							<option>2015</option>
						</select>
					</div>	
					</div>
					
					  <div class="form-row" id="limit_rewards">
						<samp><label><input type="checkbox" name="limit-rewards"  id="limit_reward1" />Limit # Available</label></samp>
						<input type="text" name="reward[0][reward_avail]" value=""  class="input-text large" maxlength="20"/>
						<a href="#" class="reward_add">Add another reward</a>
					  </div>
					  
					   </div> 
				   </div>
				</div>
				
			</div><!--end step2 -->	
			<div id="step-3"></div><!--end step3 -->
			<div id="step-4"></div><!--end step4 -->	
			<div id="step-5"></div><!--end step5 -->	
			</form>				
		</div>
			
</div>