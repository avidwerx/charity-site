<?php
/**
 * Template Name: Charity Homepage
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<div id="main-wrap">

<div id="content" class="home">
	  
		<div id="content-nav">
			<ul id="navigation">
				<li><a id="home-link-home" href="#slide1">Home</a></li>
				<li><a id="home-link-portfolio" href="#slide2">Portfolio</a></li>
				<li><a id="home-link-about" href="#slide3">About Me</a></li>
				<li><a id="home-link-contact" href="#slide4">Contact</a></li>
			</ul>
		
		</div>
		<div id="large-tagline">
			<p class="two_third">Welcome to Goodwerx! There has never been an easier way to reach 
			donors and supportors of your cause. Explore what goodwerx has to offer...			
			</p>
			<a class="one_fourth last" href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/learn-btn.png"></a>
		</div>

		<div id="home_columns">
			<div class="one_third first">
				<h3>LOWER COST</h3>
				<p>ullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. nisi erat porttitor ligula, eget lacinia odio sem nec elit. </p>
			
			</div>
			
			<div class="one_third second">
				<h3>SIMPLE TO USE</h3>
				<p>ullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. nisi erat porttitor ligula, eget lacinia odio sem nec elit. </p>
			</div>
			
			<div class="one_third last third">
				<h3>COMPLETE SOLUTION</h3>
				<p>ullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. nisi erat porttitor ligula, eget lacinia odio sem nec elit. </p>
			</div>
		</div>		
	<div class="clearboth"></div>
	
	<div id="signup_wrap">	
		<h2><img src="<?php echo get_template_directory_uri(); ?>/images/tagline-text.png"/></h2>
		<div id="signup">	
			<input type="text" name="signup" value="" placeholder="enter your email....">
			<input type="submit" name="submit" value="submit">
		</div>
	</div>

</div><!--end #main-wrap-->
<?php get_footer(); ?>