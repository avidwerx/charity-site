<?php
$_SESSION['loginTime'] = time();
//if(//$_SESSION['loginTime'] < time()+20*366660){ wp_logout(); }
if(is_user_logged_in() == false) {
	//wp_redirect( home_url() ); 
}
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * twentyten_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Ovo' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.easing.1.3.js"></script>-->
<!--[if IE]><script lang="javascript" type="text/javascript" 
    src="<?php echo get_template_directory_uri();?>/js/excanvas.js"></script><![endif]-->


<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
	<div id="header" class="<?php if(!is_front_page()){echo 'smallheader';} ?>">
	<?php if(is_front_page()){ ?>
		<div class="header-swirl"></div>
		<div class="header-glow"></div> 
		<div class="continent-wrap">
			<div class="header-continents"></div>
		</div>
		<?php } ?>
		<?php if(!is_front_page()){ ?>		
		<div class="smallhead-glow"></div>
		<div class="continent-wrap">
			<div class="header-continents small"></div>
		</div>
		<?php } ?>
		<div id="header-container">
				<div id="header-logo">
			<h1>
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri();?>/images/logo.png"></a>
			</h1>			
			</div>
			<div id="access" role="navigation">
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>				
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php if ( !is_user_logged_in() ) { 
				 wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'visitor_left' ) ); 
				 wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'visitor_right' ) );} 
				 else {  wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'user_left' ) );
				 wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'user_right' ) );}
				 ?>
			</div><!-- #access -->
			 <?php if(is_page('features')) { echo'
				<div id="tagline">EXPLORE OUR FEATURES</div>';}?>
			</div><!--end #header-->

			<!--<div id="multi"></div>-->
			 <?php if(is_page('home')) { echo'
<div id="home_slider">
		<div id="slide1" class="slide">
			<div class="one_half">
				<img src="'.get_template_directory_uri().'/images/sliderimg1.png"> 
			</div>
			<div class="one_third last">
				<h3>Fundraising made simple</h3>
				<p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip. </p>
				<a href="#"><img src="'.get_template_directory_uri().'/images/learn-btn.png"></a>
				<a href="#"><img src="'.get_template_directory_uri().'/images/visit-btn.png"></a>
			</div>	
		</div>
		
		<div id="slide2" class="slide">
			<div class="one_half">
				<img src="'.get_template_directory_uri().'/images/sliderimg1.png"> 
			</div>
			<div class="one_third last">
				<h3>Fundraising made simple</h3>
				<p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip. </p>
				<a href="#"><img src="'.get_template_directory_uri().'/images/learn-btn.png"></a>
				<a href="#"><img src="'.get_template_directory_uri().'/images/visit-btn.png"></a>
			</div>	
		</div>
		
		<div id="slide3" class="slide">
			<div class="one_half">
				<img src="'.get_template_directory_uri().'/images/sliderimg1.png"> 
			</div>
			<div class="one_third last">
				<h3>Fundraising made simple</h3>
				<p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip. </p>
				<a href="#"><img src="'.get_template_directory_uri().'/images/learn-btn.png"></a>
				<a href="#"><img src="'.get_template_directory_uri().'/images/visit-btn.png"></a>
			</div>	
		</div>
		
		<div id="slide4" class="slide">
			<div class="one_half">
				<img src="'.get_template_directory_uri().'/images/sliderimg1.png"> 
			</div>
			<div class="one_third last">
				<h3>Fundraising made simple</h3>
				<p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip. </p>
				<a href="#"><img src="'.get_template_directory_uri().'/images/learn-btn.png"></a>
				<a href="#"><img src="'.get_template_directory_uri().'/images/visit-btn.png"></a>
			</div>	
		</div>
		
	  </div>';}?>		
		</div><!--end#header-container-->	
		<?php echo signup_form(); ?>