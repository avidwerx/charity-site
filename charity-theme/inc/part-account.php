<div id="accountinfo"  class="tab_content">			
			<?php //print_r(get_option("fb_user_data")); ?>
			<?php $fbstatus = get_option("fb_user_data"); $twstatus = get_option("tw_user_data"); print_r($_SESSION['access_token']);?>
			
			<!--<p><?php echo do_shortcode('[wpuf_editprofile]'); ?></p>-->
				<?php //print_r($current_user); ?>
			<form action="" class="form">
            <fieldset>
                <div class="widget">
                    <div class="title"><img src="<?php echo get_template_directory_uri();?>/css/images/icons/settingsicon.png" alt="" class="titleIcon"><h6>Account Settings</h6></div>  
					<div class="formRow">
					<div class="one_half">
					
					 <!--first sub item -->
					   <div class="subrow">
                        <label>Username:</label>
                        <div class="formRight "><input class="disabledinput" type="text" value="<?php echo $current_user->user_login; ?>" disabled="disabled"><span class="formNote">This can not be changed!</span>
						</div>
					  </div>	
					  
					 <!-- second sub item -->	
					  <div class="subrow">		
						<label>Full Name:</label>
                        <div class="formRight"><input type="text" placeholder="Enter your Full Name" value="<?php echo $current_user->display_name; ?>"><span class="formNote">Optional</span></div>                       
					  </div>
					  
					  <!--third sub item -->
					  <div class="subrow">
                        <label>Email:</label>
                        <div class="formRight"><input type="text" placeholder="Enter your email" value="<?php echo $current_user->user_email; ?>"><span class="formNote">Optional</span></div>                        
                    </div>  	
					
					 <!--fourth sub item -->
					 <div class="subrow">
                        <label for="labelFor">Phone:</label>
                        <div class="formRight"><input type="text" class="maskPhone" value=""><span class="formNote">(999) 999-9999</span></div>
                        <div class="clear"></div>
                    </div>					
					
					  
					 </div> 
					 
					 <!--second formrow column -->
					
						<div class="one_half last">
							 <!--first sub item -->
							   <div class="subrow">
								<label>Facebook Login:</label>
								<div class="formRight">
								 
									<a href="#" class="<?php if($fbstatus['id']) : echo 'facebooklogout'; else: echo 'facebooklogin'; endif; ?> "></a>
									<?php if($fbstatus['link']) : ?>
									<span class="formNote"><?php echo $fbstatus['link']; ?></span>
									<?php endif;?>
								</div>
							  </div>	
							  
							  <!--second sub item -->
							  <div class="subrow">
								<label>Twitter Login:</label>
								<div class="formRight">
								 
									<a href="#" class="<?php if($twstatus['link']) : echo 'twitterlogout'; else: echo 'twitterlogin'; endif; ?> "></a>
									<?php if($twstatus['link']) : ?>
									<span class="formNote"><?php echo $twstatus['link']; ?></span>
									<?php endif;?>
								</div>
							  </div>	
							  
							 <!--third sub item -->
							   <div class="subrow upload-profileimg margin_top_30">
								<label>Change Profile Image:</label>
								<div class="formRight" style="width:59%;">
									<a href="#" class="profile-img-change"></a>
								</div>                   
							</div>

							<!--fourth sub item -->
							 <div class="subrow margin_top_30">
								<label>Delete Your Account:</label>
								<div class="formRight" style="width:54.7%;"><a href="#" class="delete_account">Please delete my account</a></div>                       
							</div> 	
							
							<!--fifth sub item -->
							 <div class="subrow">
								<label>Password:</label>
								<div class="formRight"><a href="#" class="passchange">Change Password</a></div>                       
							</div> 	
					
						</div>
					
					   <div class="clear"></div>
					</div>
					<!-- end first formRow -->
					<!--begin second formRow -->
					
				<div class="formRow">
					<div class="one_half">
					
					 <!--first sub item -->
					   <div class="subrow">
                        <label>Location:</label>
                        <div class="formRight "><input class="" type="text" value="" >
						</div>
					  </div>	
					  
					  <!--second sub item -->
					  <div class="subrow">
                        <label>Website URL</label>
                        <div class="formRight"><input type="text" placeholder="Add a website url" value="<?php echo $current_user->user_url; ?>"><span class="formNote">Optional</span></div>                        
                    </div>    
					
					</div>
					<!--second column -->					 
					 	<div class="one_half last">
						
						<!--first sub item-->
							<div class="subrow">
								<label>Select dropdown:</label>
								<div class="formRight" style="margin-right:0;">
									<div class="selector" id="uniform-undefined"><span>Select Timezone</span><select name="select2" style="opacity: 0; ">
									<?php echo print_timezones(); ?>
									</select></div>           
									</div>  
							</div>
						   
						<!--second sub item-->
							 <div class="subrow">
							<label>Custom URL</label>
							<div class="formRight" style="width:284px;"><input type="text" placeholder="Add a custom url" value=""></div>                        
                    </div>   
						
						</div>
					<div class="clear"></div>					
				</div>
                  <h6 class="friendhead"> Invite/Find Friends </h6>
				  
				  <div class="formRow">
					<div class="one_half">
						<div class="subrow">
							<div style="margin-bottom:10px;">From: <span style="margin-left:78px;"><?php echo $current_user->user_email; ?></span></div>
							<label class="customlabel">To:<span> (Use commas to seperate emails)</span></label>
							<div class="formRight"><textarea rows="5" cols="" name="textarea"></textarea></div>
							
						</div>
					</div>
					<div class="one_half last">
							<div class="subrow margin_top_30">							
							<label class="customlabel">Message:<br/><span>(optional)</span></label>
							<div class="formRight"><textarea rows="5" cols="" name="textarea"></textarea></div>
							
						</div>
					</div>
						<div class="buttoncenter"><a href="#"class="sendfriends"></a> <a href="#"class="cancelfriends"></a></div>
					<div class="clear"></div>
				  </div>	
                   
				   
				   <div class="formRow">
					<div class="one_half">
					<h6 class="noteshead">Send email notifications when:</h6>
						<div class="subrow">
							 <div class="checker" id="uniform-check2"><span><input type="checkbox" name="check2" id="check2" style="opacity: 0; "></span></div><label for="check2">When a donation is received</label>
						
						</div>
						<div class="subrow">
							 <div class="checker" id="uniform-check3"><span><input type="checkbox" name="check2" id="check2" style="opacity: 0;"></span></div><label for="check3">When a personal message is received</label>
						
						</div>
						
						<div class="subrow">
							 <div class="checker" id="uniform-check2"><span><input type="checkbox" name="check2" id="check2" style="opacity: 0; "></span></div><label for="check2">When a comment is received about my cause</label>
						
						</div>
						
						<div class="subrow">
							 <div class="checker" id="uniform-check2"><span><input type="checkbox" name="check2" id="check2" style="opacity: 0; "></span></div><label for="check2">When a donation is received</label>
						
						</div>
						
						<h6 class="noteshead">Auto Approve:</h6>	
					
						<div class="subrow">
							 <div class="checker" id="uniform-check2"><span><input type="checkbox" name="check2" id="check2" style="opacity: 0; "></span></div><label for="check2">Comments about my cause</label>
						
						</div>
						
						<div class="subrow">
							 <div class="checker" id="uniform-check2"><span><input type="checkbox" name="check2" id="check2" style="opacity: 0; "></span></div><label for="check2">Friends Requests</label>
						
						</div>
					</div>
					
					
			
					<div class="one_half last">
					<h6 class="noteshead">Allow comments from:</h6>
						<div class="subrow">
						<div class="radio" id="uniform-radio2"><span><input type="radio" name="radio1" id="radio2" style="opacity: 0; "></span></div><label for="radio2">Guests & Registered Users</label>
						</div>
						
						<div class="subrow">
						<div class="radio" id="uniform-radio2"><span><input type="radio" name="radio1" id="radio2" style="opacity: 0; "></span></div><label for="radio2">Only Registered Users</label>
						</div>
						
						<div class="subrow">
						<div class="radio" id="uniform-radio2"><span><input type="radio" name="radio1" id="radio2" style="opacity: 0; "></span></div><label for="radio2">Only donors</label>
						</div>
						
						<div class="subrow">
						<div class="radio" id="uniform-radio2"><span><input type="radio" name="radio1" id="radio2" style="opacity: 0; "></span></div><label for="radio2">No comments allowed</label>
						</div>
						
					<h6 class="noteshead">Community Newsletter:</h6>	
					
					<div class="subrow">
							 <div class="checker" id="uniform-check2"><span><input type="checkbox" name="check2" id="check2" style="opacity: 0; "></span></div><label for="check2">I would like to receive the community newsletter</label>
						
						</div>
					</div>
								<div class="buttoncenter"><a href="#"class="savechanges"></a> <a href="#"class="cancelchanges"></a></div>
						<div class="clear"></div>
					  </div>
				  
                    
                </div>
            </fieldset>          
                          
            
        </form>
		
		 
               <div id="dialog-message" class="passdiv" title="Update your password">
                   <p><img src="<?php echo get_template_directory_uri();?>/css/images/icons/color/tick.png" alt="" class="icon" />Update your password.</p>                                
                    <div class="uiForm">
                    <form action="" class="dialog">
                      <div class="formRow">
							<div class="subrow">		
							<label>Enter your Password:</label>
							<div class="formRight"><input id="passwordchange" type="password" placeholder="Enter your new password" value=""></div>                       
							</div>
							
							<div class="subrow">		
							<label>Confirm your Password:</label>
							<div class="formRight"><input id="passwordagain" type="password" placeholder="Repeat your new password" value=""></div>                       
						   </div>
					  
					  
					  </div>
					</form>
                    </div>
                </div>
				
				<!-----logout of facebook dialog -------->
				<div id="fb-logout-message" class="fb-logout-message" title="Log out of facebook?">
                   <p><img src="<?php echo get_template_directory_uri();?>/css/images/icons/color/tick.png" alt="" class="icon" />You are about to disconnect your Charity account from your facebook account.</p>                      
                   
                </div>
				<input class="hidden-url" type="hidden" name="hidden-url" value="<?php echo get_template_directory_uri();?>/twitter/twitter_login.php?auth=1" />
            </div>	