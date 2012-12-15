<?php /*
Template Name: Dashboard Page */

get_header();
global $member, $account_url,$current_user,$bp; // Set up Globals

$blog = get_current_blog_id();
switch_to_blog($blog);
 get_currentuserinfo();
 $user_id = $current_user->ID;
 $post_author = $current_user->display_name;
 $fb_img = get_user_meta($user_id, 'facebook_avatar_full', true);
  $default_img =  get_avatar( $user_id, '66' );  
  $default_img_lg =  get_avatar( $user_id, '82' );
 $donation_avatar =  get_avatar( $user_id, '66' ); 
$status = get_option('user_status');  
	if(!$nomember) $user_id = $bp->displayed_user->id;
	else $user_id = $bp->loggedin_user->id;
	$pagename = get_query_var('pagename');


	
?>

<div class="outermain">
<div id="main-wrap" class="dashboard center960">		
 <div class="tabs-contenor">
       <div class="center960">
       <div class="profile">       
		 <div class="author_details">
			 <?php if($fb_img !== '') {echo '<img src="'.$fb_img.'" width="82" >';} else {echo $default_img_lg;} ?>	</div>
		 <div class="author_stats">		
			 <h2><?php echo $post_author; ?></h2>    
			<a href="#" class="fbicon"></a>	
			<a href="#" class="twittericon"></a>	
			<a href="#" class="rssicon"></a>	
			 <h4><a href="<?php echo wp_logout_url( home_url() );?>">Logout <img src="<?php echo get_template_directory_uri(); ?>/images/icons/login.jpg" alt="login" /></a></h4>
		 </div>
		 <div class="author_notes">
			<span><?php// echo my_bp_adminbar_notifications_menu(); ?> Updates</span>
			<input type="text" name="userstatus" value="<?php echo $status; ?>" id="userstatus" placeholder="Update your status here...">
		 </div>         
       </div>     
       
       
       <div class="tabs_links">
           <ul>               
			   <li><a href="#donations">Donations</a></li>              
               <li><a href="#project">Causes</a></li> 
			   <li><a href="#comments">Comments</a></li>	
			   <li><a href="#media">Media</a></li>			   
              
              
			   <li><a href="#accountinfo">Settings</a></li>
           </ul>
       </div>
      </div> 
     </div>
	
	<div id="content" class="dashboard-content">
	<?php// include 'inc/part-dashboard.php'; ?>	
	<?php include 'inc/part-donations.php'; ?>
	<?php include 'inc/part-project.php'; ?>
	<?php include 'inc/part-comments.php';?>
	<?php include 'inc/part-media.php'; ?>
	<?php include 'inc/part-account.php';?>

		
	</div>
	
	
	<div style="display:none;">
		<div id="dialog-form" title="Account Settings">
	

	 <ul>
                <li><a href="#ctabs-1">Tab One</a></li>
                <li><a href="#ctabs-2">Tab Two</a></li>                
                <button id="closer" style="float: right;"><span class="ui-icon ui-icon-closethick" style="margin-right: .3em;"></span></button>
            </ul>
            <div id="ctabs-1">
				<div id="vert-tabs">
				<ul id="subtabs">
					<li id="archive"><a href="#subtabs-1">Tab One</a></li>
					<li id="mail"><a href="#subtabs-2">Tab Two</a></li>    
				</ul>
				
                <div id="subtabs-1">TEST ONE</div>
				
				<div id="subtabs-2">TEST TWO</div>
				
			</div>		
            </div>
            <div id="ctabs-2">
                <form>
                    <fieldset class="ui-helper-reset">
                        <label for="tab_title">Title</label>
                        <input type="text" name="tab_title" id="tab_title" value="" class="ui-widget-content ui-corner-all" />
                        <label for="tab_content">Content</label>
                        <textarea name="tab_content" id="tab_content" class="ui-widget-content ui-corner-all"></textarea>
                    </fieldset>
                </form>
            </div>
	</div>
	
	<!-- user messages form-->
	<div id="message-form" title="Messages">
	<p> test </p>
	
	<p> </p>
	</div>
	</div>
	
<?php restore_current_blog();?>
<?php get_footer(); ?>