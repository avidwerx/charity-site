<?php
/**
 * TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyten_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
 
 if(!session_id())
session_start();

function kill_the_session() {
	session_destroy();
}
add_action('wp_logout', 'kill_the_session'); 

//==========setup requires====================//
define("FACEBOOK",TEMPLATEPATH."/facebook/" );
define("TWITTER",TEMPLATEPATH."/twitter/" );
require_once (FACEBOOK.'facebook.php');
require_once (TWITTER.'tmhOAuth.php');
require_once (TWITTER.'tmhUtilities.php');
//===============end setup requires===============//

if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'user_left' => __( 'logged in user Navigation left', 'twentyten' ),
		'user_right' => __( 'logged in user Navigation right', 'twentyten' ),
		'visitor_left' => __( 'Vistor Navigation left', 'twentyten' ),
		'visitor_right' => __( 'Vistor Navigation right', 'twentyten' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 940 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 198 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyten_admin_header_style(), below.
	add_custom_image_header( '', 'twentyten_admin_header_style' );
	
	add_filter('widget_text', 'do_shortcode');

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/starkers.png',
			'thumbnail_url' => '%s/images/headers/starkers-thumbnail.png',
			/* translators: header image description */
			'description' => __( 'Starkers', 'twentyten' )
		)
	) );
}
endif;

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Twenty Ten 1.0
 */
function twentyten_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since Twenty Ten 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function twentyten_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'twentyten' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'twentyten_filter_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
 
 add_filter('logout_url', 'projectivemotion_logout_home', 10, 2);
 
function projectivemotion_logout_home($logouturl, $redir)
{
$redir = get_option('siteurl');
return $logouturl . '&amp;redirect_to=' . urlencode($redir);
}

function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function twentyten_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="wUserInfo">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata "><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'twentyten'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'twentyten' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'twentyten' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'twentyten' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'twentyten' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'twentyten' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


/*--------------------------------------------
/    Add needed image sizes
/*--------------------------------------------*/
add_image_size( 'album-grid', 225, 150, true );
add_image_size('cause-featured', 669,317,true);
add_image_size('cause-thumb',160,97,true);
add_image_size('project-thumb',246,136,true);
/*--------------------------------------------
/ Truncate the_content()
/*--------------------------------------------*/
add_filter("the_content", "break_text");
function break_text($text){
 if(!is_page_template('page-cause-project.php')){
    $length = 120;
    if(strlen($text)<$length+10) return $text;//don't cut if too short

    $break_pos = strpos($text, ' ', $length);//find next space after desired length
    $visible = substr($text, 0, $break_pos);
    return balanceTags($visible) . "";
	}else {
		return $text;
	}
} 
/*-------------------------------------------
/WORDPRESS Scripts
/*------------------------------------------*/
add_action("init", "add_scripts");
function add_scripts() {
global $pagename,$post,$wp_query;

	$currentPage = get_screen_name();
	//echo $currentPage;
	//echo $pagename;
	//echo $currentPage;

	wp_register_style( 'jqueryui','http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/sunny/jquery-ui.css');
	wp_register_style( 'datatable',get_bloginfo('template_url') . '/css/data-table.css');
	wp_register_style( 'jqxstyle',get_bloginfo('template_url') . '/js/jqwidgets/styles/jqx.darkblue.css');
	wp_register_style( 'donation',get_bloginfo('template_url') . '/css/udb.css');
	wp_register_style( 'smartwizard',get_bloginfo('template_url') . '/css/smart_wizard.css');
	wp_register_style( 'uicustom',get_bloginfo('template_url') . '/css/ui_custom.css');
	wp_register_style( 'social',get_bloginfo('template_url') . '/css/dpSocialFeedr.css');
	wp_register_style( 'bootstrap',get_bloginfo('template_url') . '/css/bootstrap.min.css');	
	wp_register_script( 'jquery','https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
	wp_register_script( 'jqueryui','https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js');	
	wp_register_script( 'scripts',get_bloginfo('template_url') . '/js/scripts.js', array('jquery'), '',true);
	wp_register_script( 'colorbox',get_bloginfo('template_url') . '/js/jquery.colorbox-min.js', array('jquery'), '',true);
	wp_register_script( 'cycle',get_bloginfo('template_url') . '/js/jquery.cycle.all.js', array('jquery'), '',true);
	wp_register_script( 'progress',get_bloginfo('template_url') . '/js/progress.js', array('jquery'), '',true);
	wp_register_script( 'chart',get_bloginfo('template_url') . '/js/jquery.jqChart.min.js', array('jquery'), '',true);
	wp_register_script( 'scroll',get_bloginfo('template_url') . '/js/jquery.mCustomScrollbar.js', array('jquery'), '',true);
	wp_register_script( 'mousewheel',get_bloginfo('template_url') . '/js/jquery.mousewheel.js', array('jquery'), '',true);
	wp_register_script( 'formstyle',get_bloginfo('template_url') . '/js/forms-style.js', array('jquery'), '',true);
	wp_register_script( 'maskedinput',get_bloginfo('template_url') . '/js/maskedinput.js', array('jquery'), '',true);
	wp_register_script( 'wysiwyg',get_bloginfo('template_url') . '/js/jquery.wysiwyg.js', array('jquery'), '',true);
	wp_register_script( 'formwizard',get_bloginfo('template_url') . '/js/formwizard.js', array('jquery'), '',true);
	wp_register_script( 'datepickercore',get_bloginfo('template_url') . '/js/datepicker/jquery.ui.core.js', array('jquery'), '',true);	
	wp_register_script( 'datepicker',get_bloginfo('template_url') . '/js/datepicker/jquery.ui.datepicker.js', array('jquery'), '',true);
	wp_register_script( 'fullcalendar',get_bloginfo('template_url') . '/js/fullcalendar.min.js', array('jquery'), '',true);
	wp_register_script( 'tipsy',get_bloginfo('template_url') . '/js/jquery.tipsy.js', array('jquery'), '',true);
	wp_register_script( 'datatable',get_bloginfo('template_url') . '/js/jquery.dataTables.js', array('jquery'), '',true);
	wp_register_script( 'jeditable',get_bloginfo('template_url') . '/js/jquery.jeditable.mini.js', array('jquery'), '',true);
	wp_register_script( 'form',get_bloginfo('template_url') . '/js/jquery.form.js', array('jquery'), '',true);
	wp_register_script( 'form-count',get_bloginfo('template_url') . '/js/jquery.counter-2.2.min.js', array('jquery'), '',true);
	wp_register_script( 'smartwizard',get_bloginfo('template_url') . '/js/jquery.smartWizard-2.0.min.js', array('jquery'), '',true);
	wp_register_script( 'slimscroll',get_bloginfo('template_url') . '/js/slimScroll.min.js', array('jquery'), '',true);
	wp_register_script( 'flot',get_bloginfo('template_url') . '/js/jquery.flot.js', array('jquery'), '',true);
	wp_register_script( 'jqueryflotpie',get_bloginfo('template_url') . '/js/jquery.flot.pie.js', array('jquery'), '',true);
	wp_register_script( 'socialstream',get_bloginfo('template_url') . '/js/jquery.dpSocialFeedr.js', array('jquery'), '',true);
	wp_register_script( 'transit',get_bloginfo('template_url') . '/js/jquery.transit.min.js', array('jquery'), '',true);
	wp_register_script( 'bxslider',get_bloginfo('template_url') . '/js/jquery.bxSlider.min.js', array('jquery'), '',true);
	wp_register_script( 'countdown',get_bloginfo('template_url') . '/js/countdown.js', array('jquery'), '',true);
	wp_register_script( 'adipoli',get_bloginfo('template_url') . '/js/jquery.adipoli.min.js', array('jquery'), '',true);
	wp_register_script( 'donationbox',get_bloginfo('template_url') . '/js/udb-jsonp.js', array('jquery'), '',true);
	wp_register_script( 'googleplaces', "https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places");
	 wp_register_style( 'mainstyle',get_bloginfo('template_url') . '/css/main.css');
	 wp_register_script( 'uniform',get_bloginfo('template_url') . '/js/forms/uniform.js', array('jquery'), '',true);
	wp_register_script( 'chosen',get_bloginfo('template_url') . '/js/forms/chosen.jquery.min.js', array('jquery'), '',true);
	wp_register_script( 'duallist',get_bloginfo('template_url') . '/js/forms/jquery.dualListBox.js', array('jquery'), '',true);
	
	
	//wp_enqueue_style('jqueryui');
	wp_enqueue_style('datatable');
	wp_enqueue_style('jqxstyle');
	wp_enqueue_style('social');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jqueryui');
	if($currentPage != '23'){
		wp_enqueue_script('cycle');
	}	
	 if ( $currentPage == '23') {wp_enqueue_script( 'comment-reply' );}
	wp_enqueue_script('colorbox');	
	//wp_enqueue_script('mousewheel');		
	wp_enqueue_script('formstyle');
	wp_enqueue_script('form');
	if(!is_front_page() && !is_admin() && !is_page("causes") ) {
	wp_enqueue_style('smartwizard');
	wp_enqueue_style('mainstyle');
	wp_enqueue_style('uicustom');
	wp_enqueue_script('maskedinput');
	wp_enqueue_script('wysiwyg');
	wp_enqueue_script('progress');
	wp_enqueue_script('chart');	
	wp_enqueue_script('datatable');
	wp_enqueue_script('jeditable');
	wp_enqueue_script('form-count');
	wp_enqueue_script('smartwizard');
	wp_enqueue_script('slimscroll');
	wp_enqueue_script('flot');
	wp_enqueue_script('transit');
	wp_enqueue_script('jqueryflotpie');	
	wp_enqueue_script('datepickercore');
	wp_enqueue_script('datepicker');
	wp_enqueue_script('adipoli');
	wp_enqueue_script('fullcalendar');
	wp_enqueue_script('socialstream');
	wp_enqueue_script('bxslider');
	wp_enqueue_script('countdown');
	wp_enqueue_script('plupload-all');
	wp_enqueue_script('googleplaces');
	wp_enqueue_script('uniform');
	wp_enqueue_script('tipsy');	
	wp_enqueue_script('chosen');	
	wp_enqueue_script('duallist');	
	
	}
	
	 if(is_page("causes") || $currentPage == "58" || is_page_template("single-projects.php") || $currentPage != '23'){
	  //wp_enqueue_style('bootstrap');
	  wp_enqueue_script('bxslider');
	  wp_enqueue_script('colorbox');
	 
	  wp_register_script( 'uicarousel',get_bloginfo('template_url') . '/js/jquery.ui.rcarousel.min.js', array('jquery'), '',true);
	  //wp_enqueue_style('donation');
	  wp_enqueue_script('uicarousel');
	  wp_enqueue_script('donationbox');
	 
	  wp_register_script( 'frontend-causes-scripts',get_bloginfo('template_url') . '/js/frontend-causes-page-scripts.js', array('jquery'), '',true);
	  wp_enqueue_script('frontend-causes-scripts');  
	 }

	//wp_enqueue_script('tipsy');
	 if(!is_admin()){	 
	 wp_enqueue_script('scripts');}
	 
	
	 
	 $directories = get_template_directory_uri();   

	wp_localize_script( 'scripts', 'directory', $directories );
	wp_localize_script( 'socialstream', 'directory', $directories );
	
}

//*--------------------------------------------*//
//				PLUPLOAD
//*--------------------------------------------*//
function adddiv() { ?>

 <div id="plupload-upload-ui" class="hide-if-no-js form-row">
					 <samp>Add Image/Video</samp>
					 <div id="drag-drop-area">
					<div class="drag-drop-inside">
						<a id="upload_image" href="#" class="upload_image_div drag-drop-buttons" ></a>
					</div>				
					</div>
					</div>	
	<?php				
$plupload_init = apply_filters('plupload_init', $plupload_init);

$plupload_init = array(
    'runtimes'            => 'html5,silverlight,flash,html4',
    'browse_button'       => 'plupload-browse-button',
    'container'           => 'plupload-upload-ui',
    'drop_element'        => 'drag-drop-area',
    'file_data_name'      => 'async-upload',            
    'multiple_queues'     => true,
    'max_file_size'       => '4'.'mb',
    'url'                 => admin_url('admin-ajax.php?'),
    'flash_swf_url'       => includes_url('js/plupload/plupload.flash.swf'),
    'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
    'filters'             => array(array('title' => __('Allowed Files'), 'extensions' => '*')),
    'multipart'           => true,
    'urlstream_upload'    => true,
 
    // additional post data to send to our ajax hook
    'multipart_params'    => array(
      '_ajax_nonce' => wp_create_nonce('photo-upload'),
      'action'      => 'photo_gallery_upload',            // the ajax action name
    ),
  );
  
  ?>
  <script type="text/javascript">
  jQuery(document).ready(function($) {
 // create the uploader and pass the config from above
      var uploader = new plupload.Uploader(<?php echo json_encode($plupload_init); ?>);
 
      // checks if browser supports drag and drop upload, makes some css adjustments if necessary
      uploader.bind('Init', function(up){
        var uploaddiv = jQuery('#plupload-upload-ui');
 
        if(up.features.dragdrop){
          uploaddiv.addClass('drag-drop');
            jQuery('#drag-drop-area')
              .bind('dragover.wp-uploader', function(){ uploaddiv.addClass('drag-over'); })
              .bind('dragleave.wp-uploader, drop.wp-uploader', function(){ uploaddiv.removeClass('drag-over'); });
 
        }else{
          uploaddiv.removeClass('drag-drop');
          jQuery('#drag-drop-area').unbind('.wp-uploader');
        }
      });
 
      uploader.init();
 
      // a file was added in the queue
      uploader.bind('FilesAdded', function(up, files){
        var hundredmb = 100 * 1024 * 1024, max = parseInt(up.settings.max_file_size, 10);
 
        plupload.each(files, function(file){
          if (max > hundredmb && file.size > hundredmb && up.runtime != 'html5'){
            // file size error?
 
          }else{
 
            // a file was added, you may want to update your DOM here...
            console.log(file);
			
          }
        });
 
        up.refresh();
        up.start();
      });
 
      // a file was uploaded
      uploader.bind('FileUploaded', function(up, file, response) {
 
        // this is your ajax response, update the DOM with it or something...
        console.log(response);		
		var image = response['response'];		
		var build = $("<div class='thumb'><img src='"+image+"'></div>");
			$(".thumb_div").append(build);
			
		
      });
	  function addhovers() {
	  $('.thumb_div .thumb img').adipoli({
                'startEffect' : 'grayscale',
                'hoverEffect' : 'normal'
            });
			}
	  });
	  
	 </script>
<?php }	 
  // handle uploaded file here
add_action('wp_ajax_photo_gallery_upload', 'testme');
function testme(){
 
  check_ajax_referer('photo-upload');
  $cause = get_option("active_cause");
 
  // you can use WP's wp_handle_upload() function:
  $status = wp_handle_upload($_FILES['async-upload'], array('test_form'=>true, 'action' => 'photo_gallery_upload'));
  $attachment = array(
			 'guid' => $status['file'], 
			 'post_mime_type' => $status['type'],
			 'post_title' => preg_replace('/\.[^.]+$/', '',  basename($status['file'])),
			 'post_content' => '',
			 'post_status' => 'inherit'
			);
  $attach_id = wp_insert_attachment( $attachment, $status['file'],$cause );
			 // for the function wp_generate_attachment_metadata() to work
			  require_once(ABSPATH . 'wp-admin/includes/image.php');
			  $attach_data = wp_generate_attachment_metadata( $attach_id, $status['file'] );
			  wp_update_attachment_metadata( $attach_id, $attach_data );
 
  // and output the results or something...
  echo $status['url'];
  die;
  exit;
}
/*---------------------------------------------------/
/	WORDPRESS SET FEATURED IMAGE AUTO				/
/*-------------------------------------------------*/
function autoset_featured() {
			  global $post;
          $already_has_thumb = has_post_thumbnail($post->ID);
              if (!$already_has_thumb)  {
              $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
                          if ($attached_image) {
                                foreach ($attached_image as $attachment_id => $attachment) {
                                set_post_thumbnail($post->ID, $attachment_id);
                                }
                           }
                        }
	}		
add_action('the_post', 'autoset_featured');
add_action('save_post', 'autoset_featured');
add_action('draft_to_publish', 'autoset_featured');
add_action('new_to_publish', 'autoset_featured');
add_action('pending_to_publish', 'autoset_featured');
add_action('future_to_publish', 'autoset_featured');
			
//*--------------------------------------------*/
//*----------------get post id based on url-----*//
function get_screen_name() {
	$url = explode('?', 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
$ID = url_to_postid($url[0]);
return $ID;
}
add_action("init","get_screen_name");
//*---------------------------------------------
// SETUP CUSTOM POST TYPES 1st Projects CPT
//*---------------------------------------------*/
add_action("init", "register_project_post_init");
function register_project_post_init() {
	register_post_type( 'projects',
		array(
			'labels' => array(
				'name' => __( 'Projects' ),
				'singular_name' => __( 'Project' ),
				'add_new' => __( 'Add Project' ),
				'add_new_item' => __( 'Add New Project' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Project' ),
				'new_item' => __( 'New Project' ),
				'view' => __( 'View Project' ),
				'view_item' => __( 'View Project' ),
				'search_items' => __( 'Search Project' ),
				'not_found' => __( 'No Project' ),
				'not_found_in_trash' => __( 'No Projects found in Trash' ),
				'parent' => __( 'Parent Project' )
			),
			'public' => true,
			'rewrite' => array('with_front' => false,'slug' => 'project'),
			'supports' => array( 'editor', 'thumbnail', 'title','custom-fields','comments' ),
			'taxonomies' => array ( 'category' ),
			'register_meta_box_cb' => 'add_project_metaboxes')
	);
}
// Add the Events Meta Boxes
function add_project_metaboxes() {
    add_meta_box('cpt_project_meta', 'Projects', 'cpt_project', 'projects', 'normal', 'high');
}

// The Event Location Metabox
function cpt_project() {
    global $post;
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="contractormeta_noncename" id="dealmeta_noncename" value="' .
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    // Get the location data if its already been entered
    $project_name = get_the_title();
	$project_goal_amount = get_post_meta($post->ID, '_cause_amount', true);
	$project_start = get_post_meta($post->ID, '_cause_start', true);	
	$project_end = get_post_meta($post->ID, '_cause_end', true);
	$reward_0 = get_post_meta($post->ID, '_reward', true);	
	$reward_1 = get_post_meta($post->ID, '_reward_1', true);	
	
	
    // Echo out the field
    echo '<div><label>Project Name</label><input type="text" name="_project_name" value="' . $project_name  . '" class="widefat" /></div>';	
	echo '<div><label>Project Amount</label><input type="text" name="_cause_amount" value="' . $project_goal_amount  . '" class="widefat" /></div>';	
	echo '<div><label>Project Start</label><input type="text" name="_cause_start" value="' . $project_start  . '" class="widefat" /></div>';
	echo '<div><label>Project End</label><input type="text" name="_cause_end" value="' . $project_end  . '" class="widefat" /></div>';	
	echo '<div><label>Reward 0</label><textarea rows="4" name="_reward" value="' . $reward_0  . '" class="widefat" />' . $reward_0  . '</textarea></div>';	
	
}

// Save the Metabox Data
function wpt_save_project_meta($post_id, $post) {
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['projectmeta_noncename'], plugin_basename(__FILE__) )) {
    return $post->ID;
    }
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;
    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.
    $project_meta['_project_name'] = $_POST['_project_name'];
	$project_meta['_cause_amount'] = $_POST['_cause_amount'];
	$project_meta['_cause_start'] = $_POST['_cause_start'];
	$project_meta['_cause_end'] = $_POST['_cause_end'];
	
	
    // Add values of $events_meta as custom fields
    foreach ($project_meta as $key => $value) { // Cycle through the $events_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }
}
add_action('save_post', 'wpt_save_project_meta', 1, 2); // save the custom fields

//*---------------------------------------------
// SETUP MEDIA CPT
//*---------------------------------------------*/
add_action( 'init', 'register_cpt_media' );

function register_cpt_media() {

    $labels = array( 
        'name' => _x( 'Media', 'media' ),
        'singular_name' => _x( 'Media', 'media' ),
        'add_new' => _x( 'Add New', 'media' ),
        'add_new_item' => _x( 'Add New Media', 'media' ),
        'edit_item' => _x( 'Edit Media', 'media' ),
        'new_item' => _x( 'New Media', 'media' ),
        'view_item' => _x( 'View Media', 'media' ),
        'search_items' => _x( 'Search Media', 'media' ),
        'not_found' => _x( 'No media found', 'media' ),
        'not_found_in_trash' => _x( 'No media found in Trash', 'media' ),
        'parent_item_colon' => _x( 'Parent Media:', 'media' ),
        'menu_name' => _x( 'Media', 'media' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'User media ',
        'supports' => array( 'title', 'excerpt', 'author', 'thumbnail', 'custom-fields','editor' ),
        'taxonomies' => array( 'post_tag', 'video', 'images' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'media', $args );
}

//*---------------------------------------------
// SETUP CUSTOM POST TYPES 1st Donations CPT
//*---------------------------------------------*/
//add_action("init", "register_donation_post_init");
function register_donation_post_init() {
	register_post_type( 'donations',
		array(
			'labels' => array(
				'name' => __( 'Donations' ),
				'singular_name' => __( 'Donation' ),
				'add_new' => __( 'Add Donation' ),
				'add_new_item' => __( 'Add New Donation' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Donation' ),
				'new_item' => __( 'New Donation' ),
				'view' => __( 'View Donation' ),
				'view_item' => __( 'View Donation' ),
				'search_items' => __( 'Search Donation' ),
				'not_found' => __( 'No Donation' ),
				'not_found_in_trash' => __( 'No Donations found in Trash' ),
				'parent' => __( 'Parent Donation' )
			),
			'public' => true,
			'rewrite' => array('with_front' => false,'slug' => 'donations'),
			'supports' => array( 'editor', 'thumbnail', 'title','custom-fields','comments' ),
			'taxonomies' => array ( 'category' ))
	);
}
/*-------------------------------------------
/NOTIFICATIONS COUNT
/*-------------------------------------------*/
/*function my_bp_adminbar_notifications_menu() {
        global $bp;
 
        if ( !is_user_logged_in() )
                return false;
 
       /* echo '<li id="bp-adminbar-notifications-menu"><a href="' . $bp->loggedin_user->domain . '">';
        _e( 'Notifications', 'buddypress' );*/
 
      /*  if ( $notifications = bp_core_get_notifications_for_user( $bp->loggedin_user->id ) ) { 
                $counted = count($notifications); 
				
    
        }
		if($notifications) {
			echo $counted;
		} else{
			echo '0';
		}
 
       // echo '</a>';
       // echo '<ul>';
 
        /*if ( $notifications ) { ?>
                <?php $counter = 0; ?>
                <?php for ( $i = 0; $i < count($notifications); $i++ ) { ?>
                        <?php $alt = ( 0 == $counter % 2 ) ? ' class="alt"' : ''; ?>
                        <li<?php echo $alt ?>><?php echo $notifications[$i] ?></li>
                        <?php $counter++; ?>
                <?php } ?>
        <?php } else { ?>
                <li><a href="<?php echo $bp->loggedin_user->domain ?>"><?php _e( 'No new notifications.', 'buddypress' ); ?></a></li>
        <?php
        }
 
        echo '</ul>';
        echo '</li>';*/
//}

/*function my_bp_adminbar_notifications_menu_list() {
        global $bp;
 
        if ( !is_user_logged_in() )
                return false;				
           
       echo '<div class="widget">';
	    echo '<div class="whead">';
       echo '<li id="bp-adminbar-notifications-menu"><a href="' . $bp->loggedin_user->domain . '">';
        _e( 'Notifications', 'buddypress' );
 
        if ( $notifications = bp_core_get_notifications_for_user( $bp->loggedin_user->id ) ) { ?>
                <?php echo count($notifications) ?>
        <?php
        }
 
       echo '</a>';
       echo '<ul>';
 
        if ( $notifications ) { ?>
                <?php $counter = 0; ?>
                <?php for ( $i = 0; $i < count($notifications); $i++ ) { ?>
                        <?php $alt = ( 0 == $counter % 2 ) ? ' class="alt"' : ''; ?>
                        <li<?php echo $alt ?>><?php echo $notifications[$i] ?></li>
                        <?php $counter++; ?>
                <?php } ?>
        <?php } else { ?>
                <li><a href="<?php echo $bp->loggedin_user->domain ?>"><?php _e( 'No new notifications.', 'buddypress' ); ?></a></li>
        <?php
        }
 
        echo '</ul>';
        echo '</li>';
		echo '</div>';
		echo '</div>';
}

function profile_loop() {
 global $bp;
 ?>
	<?php if ( bp_has_profile() ) : ?>    
  <?php while ( bp_profile_groups() ) : bp_the_profile_group(); ?>
 
    <ul id="profile-groups">
    <?php if ( bp_profile_group_has_fields() ) : ?>
 
      <li>
        <?php bp_the_profile_group_name() ?>
 
        <ul id="profile-group-fields">
        <?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>
   
          <?php if ( bp_field_has_data() ) : ?>
          <li>
            <?php bp_the_profile_field_name() ?>
            <?php bp_the_profile_field_value() ?>
          </li>
          <?php endif; ?>
 
        <?php endwhile; ?>    
        </ul>
      <li>
 
    <?php endif; ?>   
    </ul>
 
  <?php endwhile; ?>
 
<?php else: ?>
 
  <div id="message" class="info">
    <p>This user does not have a profile.</p>
  </div>
 
<?php endif;
}
// uploads //
function insert_attachment($file_handler,$post_id,$setthumb='false') {
	// check to make sure its a successful upload
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id = media_handle_upload( $file_handler, $post_id );

	if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);
	return $attach_id;
}*/
/*-------------------------------------------
/WORDPRESS REGISTRATION FORM
/*------------------------------------------*/
//add_action('register_form','signup_form');

function signup_form() {?>
 <div style="display:none;">	
	<div id="register_form_div">
		<h1><img class="points" src="<?php echo get_template_directory_uri();?>/images/header-register.png"></h1>
		<div id="register-form-left">
			<form id="register-form" class="modal" action="" method="POST">
				<div class="input_block">
					<label>Your Name</label>
					<input type="text" name="user_name" value="">
					<span>Use your own name, not your organization.</span>		
				</div>	

				<div class="input_block">
					<label>Email Address</label>
					<input type="text" name="user_email" value="">
					<span style="margin-right:99px;"><b>Must</b> be primary email.</span>		
				</div>	

				<div class="input_block">
					<label>Re-Enter Email</label>
					<input type="text" name="user_email" value="">					
				</div>

				<div class="input_block">
					<label>Choose Password</label>
					<input type="password" name="user_pass" value="">						
				</div>		

				<div class="input_block checkbox">					
					<input type="checkbox" name="user_terms" value="">
					<span>I agree to GoodWerx’s terms & conditions and understand 
							that a feeof 5% will be automatically deducted from each 
							donation I receive.
					</span>		
				</div>			
				
				
				<div class="input_block">			
					
					<input class="" type="submit" name="submit" value="submit">						
				</div>	
			</form>
		</div>	
		
		<div id="register-form-right">
			<img class="points" src="<?php echo get_template_directory_uri();?>/images/register-right-checks.png">
			<span class="fbLoginButton">    
				<fb:login-button scope="email" v="2" size="small" onlogin="jfb_js_login_callback();">Login with Facebook</fb:login-button> 
			</span>	
			
		</div>
		
		<div id="signupbar">
			<div id="step-one" class="step active">
				<p class="one_fourth">1</p>
				<p class="three_fourth last">This is step one.</p>
			</div>
			
			<div id="step-two" class="step">
				<p class="one_fourth">2</p>
				<p class="three_fourth last">This is step two.</p>
			</div>
			
			<div id="step-three" class="step">
				<p class="one_fourth">3</p>
				<p class="three_fourth last">This is step three.</p>
			</div>
		</div>
	</div>
</div>	
<?php }


/*-------------------------------------------
/ REMOVE WORDPRESS ADMIN BAR
/*-------------------------------------------*/
show_admin_bar( false );
/*-------------------------------------------
/WORDPRESS Redirect user on login
/*------------------------------------------*/

// REDIRECT FOR THE TOOLBOX
if ( is_user_logged_in() && is_admin() ) {
    global $current_user;
    get_currentuserinfo();
    $user_info = get_userdata($current_user->ID);
	if ( $user_info->wp_user_level != 10 )
	{
		$redirect = network_site_url('/account/');
		header( 'Location: '.$redirect );
	}
}

function wc_login_redirect() {
	$redirect = network_site_url('/account/');
	return $redirect;
}


add_filter('login_redirect', 'wc_login_redirect');

add_action('wp_ajax_login_form', 'charity_login');
add_action( 'wp_ajax_nopriv_login_form', 'charity_login' );  


function charity_login() { ?>
<?php if (!(current_user_can('level_0'))){ ?>
<div class="login_wrap" id="login_form_div" style="">
<h2>Login</h2>
<form action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
<p>
<input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" placeholder="username" /><label for="name"></label></p>
<p><input type="password" name="pwd" id="pwd" size="20"  placeholder="Password" /></p>
<div class="submitwrap">
    <p>
		<input type="submit" name="submit" value="Send" class="button" />
       <label style="margin-left:0;" for="rememberme">Remember Me <input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /></label>
       <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
	   <a style="margin-left:0;" href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword">Recover password</a>
    </p>
</div>	
</form>

<?php } else { ?>
<h2>Logout</h2>
<a href="<?php echo wp_logout_url(urlencode($_SERVER['REQUEST_URI'])); ?>">logout</a><br />
<a href="http://XXX/wp-admin/">admin</a>
</div>
<?php }?>



<?php die; }

/*-------------------------------------------
/WORDPRESS Dashboard insert post
/*------------------------------------------*/
add_action('wp_ajax_activity_post', 'activity_post');
add_action( 'wp_ajax_nopriv_activity_post', 'activity_post' );  

function activity_post() { 
global $member, $account_url,$current_user; // Set up Globals

 get_currentuserinfo();
 $user_id = $current_user->ID;
 $post_author = $current_user->display_name;


 global $wpdb;
	//set up customer post variables
	
	$id = wp_insert_term('activityfeed', 'category');
    $post_category = $id;    
	$userid = $_GET['userid'];
    $post_content =  $_GET['activityomment'];	
	$post_title = $_GET['activityomment'];
	
	
  //create customer record	
	
    $new_post = array(
          'ID' => '',
          'post_author' => $userid, 
          'post_category' => '',
          'post_content' => $post_content, 
          'post_title' => $post_title,
		  'post_type' => 'post',
          'post_status' => 'publish'
        );
    //add the customer record and return the post id 
    $post_id = wp_insert_post($new_post);
	
	//update post with additional meta data
	//wp_set_object_terms($post_id, 'customer', 'category',false);
		echo $post_id;

die;

}

/*-------------------------------------------
/WORDPRESS Dashboard insert post
/*------------------------------------------*/
add_action('wp_ajax_get_activity', 'get_activity');
add_action( 'wp_ajax_nopriv_get_activity', 'get_activity' );  

function get_activity() { 
	global $post,$posts;
	
	$postid = $_GET['postid'];
	
	$thepost = get_post( $postid );
	
	echo $thepost->post_content;
}

/*-------------------------------------------
/UPDATE STATUS
/*------------------------------------------*/
add_action('wp_ajax_update_status', 'update_status');
add_action( 'wp_ajax_nopriv_update_status', 'update_status' );  

function update_status() { 
	global $wp;
	
	$status = $_GET['status'];
	$option_name = 'user_status';
	update_option( 'user_status', $status );	
	$newstatus = get_option('user_status');
	echo $newstatus;
	die;
}
/*----------------------------------------------------
/ calculate amount of donations for each cause
/*------------------------------------------------------*/
function get_current_donations_amount() {
global $post;
$project = get_option("active_cause");
$amounts = array();
$my_query = new WP_Query(array(
                                'post_type'=> 'donations',
                                'post_status' => 'publish',
                                'meta_key' => 'donation_cause',
                                'meta_value' => $project,
                              ));

if($my_query->have_posts()):

    while($my_query->have_posts()):$my_query->the_post();
        //All the post stuff here.
		$amount = get_post_meta($post->ID, "_donation_amount", true);
		array_push($amounts,$amount);
    endwhile;
endif;
//foreach ($amounts as $key => $value){
//	$
//}
$result = array_sum($amounts);
 return $result;
 //print_r($amounts);
}

/*---------------------------------------------
/ get the percent
/*---------------------------------------------*/
/*function GetPercentage() {
global $post;
	$project = get_option("active_cause");
	$yesterday_donations = get_option('yesterday_donations');
	$amounts = array();
	date_default_timezone_set('America/Chicago');
	$today = getdate();
	$my_query = new WP_Query( 'year=' . $today["year"] . '&monthnum=' . $today["mon"] . '&day=' . $today["mday"] . '&post_type=donations&post_status=publish&meta_key=donation_cause&meta_value='. $project );
	
	if($my_query->have_posts()):

		while($my_query->have_posts()):$my_query->the_post();
			//All the post stuff here.
			$amount = get_post_meta($post->ID, "_donation_amount", true);
			array_push($amounts,$amount);
		endwhile;
	endif;

$result = array_sum($amounts);
	$today_donations = $result;
   $count1  = $today_donations - $yesterday_donations; 
   $count2 = $count1 / $yesterday_donations;
   $count3 = $count2 * 100;
   $count4 = number_format($count3, 2);
   echo $count4;
}*/
function GetPercentage() {
	global $post;
	 $cause = get_option("active_cause");
	 $donationTotal = calculate_donations($cause);
	 $donationTotal = round($donationTotal,0);
	 $causeAmount = get_post_meta($cause, '_cause_amount',true);
	  $causeAmount = str_replace("$","",$causeAmount);
	 $percent = ($donationTotal / $causeAmount)*100;
	 return $percent;
}

function GoalCompletion() {
	global $post;
		 //$donationTotal = get_current_donations_amount();		
		 $cause = get_option("active_cause");
		 $donationTotal = calculate_donations($cause);
		 $donationTotal = round($donationTotal,0);
		 $causeAmount = get_post_meta($cause, '_cause_amount',true);
		 $causeAmount = str_replace("$","",$causeAmount);
		 $causeHigh = explode("-",$causeAmount); $causeVal = str_replace("$","",$causeHigh); 
		 //$percent = ($donationTotal / $causeVal[1])*100;
		 $percent = ($donationTotal / $causeAmount)*100;
		// echo $percent;
		// echo $donationTotal;
		// echo $causeAmount;
}
/*----------------------------------------------
/Schedule update of current tally of donations
/*----------------------------------------------*/
add_action('init', 'donation_update_activation');
function donation_update_activation() {
    if ( !wp_next_scheduled( 'daily_donation_tally' ) ) {
        wp_schedule_event( current_time( 'timestamp' ), 'daily', 'daily_donation_tally');
		
		
   }
}

add_action('daily_donation_tally', 'daily_donation_update_callback');
function daily_donation_update_callback() {
    // here you get a list of posts to update the hotness for and you just 
    // call update_hotness for each one ex:
		   global $post;
		$project = get_option("active_cause");
		$amounts = array();
		$my_query = new WP_Query(array(
										'post_type'=> 'donations',
										'post_status' => 'publish',
										'meta_key' => 'donation_cause',
										'meta_value' => $project,
									  ));

		if($my_query->have_posts()):

			while($my_query->have_posts()):$my_query->the_post();
				//All the post stuff here.
				$amount = get_post_meta($post->ID, "_donation_amount", true);
				array_push($amounts,$amount);
			endwhile;
		endif;
		//foreach ($amounts as $key => $value){
		//	$
		//}
		$result = array_sum($amounts);
		update_option( 'yesterday_donations', $result );
}

/*-------------------------------------------
/ Add cause when button is clicked
/*--------------------------------------------*/
add_action('wp_ajax_create_new_cause', 'create_new_cause');
add_action( 'wp_ajax_nopriv_create_new_cause', 'create_new_cause' ); 
function create_new_cause() { 
global $member, $account_url,$current_user,$wpdb,$post; // Set up Globals

 get_currentuserinfo();
 $user_id = $current_user->ID;
 $post_author = $current_user->display_name;
	
  //create cause record	
 if(get_page_by_title('Draft Cause',"",'projects')) :
	$page_id = get_page_by_title('Draft Cause',"",'projects');
	$page_id = $page_id->ID;
 else :
	$page_id = '';
 endif;
    $new_post = array(
          'ID' => $page_id,
          'post_author' => $userid, 
          'post_category' => '',
          'post_content' => '', 
          'post_title' => 'Draft Cause',
		  'post_type' => 'projects',
          'post_status' => 'draft'
        );
    //add the customer record and return the post id 
    $post_id = wp_insert_post($new_post);	
	update_option('active_cause',$post_id);
		echo $post_id;

die;
}
/*-------------------------------------------
/UPDATE CAUSE/PROJECT
/*------------------------------------------*/
add_action('wp_ajax_update_cause', 'update_cause');
add_action( 'wp_ajax_nopriv_update_cause', 'update_cause' );  

function update_cause() { 
global $member, $account_url,$current_user; // Set up Globals
global $wpdb,$post;

	 get_currentuserinfo();
	 $user_id = $current_user->ID;
	 $post_author = $current_user->display_name;
	 $cause_id = get_option("active_cause");
	
	 parse_str($_POST['serialize'], $formvars);	

	//set up customer post variables   
	
    $post_content =  $_POST['cause_featured_text'];	
	$post_title = $_POST['cause-title'];
	$goal_amount = $_POST['project-goal-amount'];	
	$goal_end = $_POST['date-type'];		
	$rewards =  $_POST['reward'];	
	$cause_location =  $_POST['cause-location'];
	$category =  $_POST['cause-category'];		
	$i = 0;
	 
	
  //create customer record	
	
    $new_post = array(
          'ID' => $cause_id,
          'post_author' => $userid, 
          'post_category' => '',
          'post_content' => $post_content, 
          'post_title' => $post_title,
		  'post_type' => 'projects',
          'post_status' => 'publish'
        );
    //add the customer record and return the post id 
    $post_id = wp_insert_post($new_post);
	
	$termid = wp_insert_term( $category, "category");
	$term_id = term_exists($category, 'category');
	wp_set_post_terms( $post_id, $term_id, 'category');
	//foreach($rewards as $reward => $key){
		update_post_meta($post_id, "_reward", maybe_serialize($rewards));
	//	$i++;
	//} 
	
	update_post_meta($post_id, "_cause_end", $goal_end);
	update_post_meta($post_id, "_cause_amount", $goal_amount);
	
	//update post with additional meta data
	//wp_set_object_terms($post_id, 'customer', 'category',false);
		print_r($rewards);

die;
}

/*-------------------------------------------
/UPDATE CAUSE/PROJECT with rewards
/*------------------------------------------*/
add_action('wp_ajax_update_cause_rewards', 'update_cause_rewards');
add_action( 'wp_ajax_nopriv_update_cause_rewards', 'update_cause_rewards' );  

function update_cause_rewards() { 
global $member, $account_url,$current_user; // Set up Globals
global $wpdb,$post;

 get_currentuserinfo();
 $user_id = $current_user->ID;
 $post_author = $current_user->display_name;
 	
	
    $rewards =  $_GET['reward'];		
	$cause_id = get_option("active_cause");
	$i = 0;
	foreach($rewards as $reward){
		update_post_meta($cause_id, "_reward_{$i}", $reward);
		$i++;
	}  

	die;
}

/*-------------------------------------------
/ Handle donation frontend
/*------------------------------------------*/
add_action('wp_ajax_send_donation', 'send_donation');
add_action( 'wp_ajax_nopriv_send_donation', 'send_donation' );  

function send_donation() { 
global $member, $account_url,$current_user,$post; // Set up Globals

	//set up customer post variables
	
	$id = wp_insert_term('donation', 'category');
    $post_category = $id;    
	$cause_id = $_GET['postid'];   
	$post_title = $_GET['name'];
	$donation_email = $_GET['email'];
	$donation_amount = $_GET['amount'];
	$donation_phone = $_GET['phone'];
	$donation_comment = $_GET['comment'];
	$author_id = $_GET['author_id'];
	$author_email = $_GET['author_email'];
	$author_name = $_GET['author_name'];
	
	
  //create customer record	
	
    $new_post = array(
          'ID' => '',
          'post_author' => '', 
          'post_category' => '',
          'post_content' => $donation_email, 
          'post_title' => $post_title,
		  'post_type' => 'donations',
          'post_status' => 'publish'
        );
    //add the customer record and return the post id 
    $post_id = wp_insert_post($new_post);
	
	update_post_meta($post_id, "_donation_amount", $donation_amount);
	update_post_meta($post_id, "_donation_email", $donation_email);
	update_post_meta($post_id, "_donation_phone", $donation_phone);
	update_post_meta($post_id, "_donation_name", $post_title);
	update_post_meta($post_id, "donation_cause", $cause_id);
	
	
	//insert comments//
	$data = array(
	'comment_post_ID' => $cause_id,
	'comment_author' => $author_name,
	'comment_author_email' => $author_email,
	'comment_author_url' => '',
	'comment_content' => $donation_comment,
	'comment_author_IP' => '127.0.0.1',
	'comment_agent' => 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; fr; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3',
	'comment_date' => date('Y-m-d H:i:s'),
	'comment_date_gmt' => date('Y-m-d H:i:s'),
	'comment_approved' => 1,
	'user_id' => $author_id,
);

$comment_id = wp_insert_comment($data);
	//update post with additional meta data
	//wp_set_object_terms($post_id, 'customer', 'category',false);
		echo $post_id;

die;
}
/*--------------------------------------------
/*		comments callback function			 */
/*-------------------------------------------*/
function my_custom_comments(){ ?>
	<div class="reply">
     <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
</div>
<?php }
/*-------------------------------------------
/ Handle new media
/*------------------------------------------*/
add_action('wp_ajax_get_donations_week', 'get_donations_week');
add_action( 'wp_ajax_nopriv_get_donations_week', 'get_donations_week' );  

function get_donations_week() { 
global $post; // Set up Globals

	$amounts = array();
	$args = array( 'numberposts' => '7','post_type' => 'donations','post_status' => 'publish' );
	$recent_posts = wp_get_recent_posts( $args );
	foreach( $recent_posts as $recent ){
		$amount = get_post_meta($recent["ID"], "_donation_amount", true);
		array_push($amounts,$amount);
	}
 $result =	json_encode($amounts);
	echo $result;
	
	die;
}


function get_media_images() {
	global $post;
	
	 query_posts('post_type=media&posts_per_page=5'); 
                    while (have_posts()) : the_post();                       
                        $args = array(
                            'order'          => 'ASC',
                            'post_type'      => 'attachment',
                            'post_parent'    => $post->ID,
                            'post_mime_type' => 'image',
                            'post_status'    => null,
                            'numberposts'    => 2,
                        );
                        $attachments = get_posts($args);
                        if ($attachments) {
                            foreach ($attachments as $attachment) {
                                //echo apply_filters('post_title', $attachment->post_title);
                                echo "<li><a href='";
                                echo the_permalink();
                                echo "' title='";
                                echo the_title();
                                echo "'>";					
								echo "<div class='imgwrap'>"; 
                                 echo wp_get_attachment_image($attachment->ID, 'album-grid', false, false);
								echo "</div>";
                                echo "</a></li>";
                            }
                        }
                        
                    endwhile;

}
/*-------------------------------------------
/ Handle new media
/*------------------------------------------*/
add_action('wp_ajax_new_media', 'new_media');
add_action( 'wp_ajax_nopriv_new_media', 'new_media' );  

function new_media() { 
global $member, $current_user,$post; // Set up Globals
	$title = $_GET['title'];
	//set up customer post variables
	
	$id = wp_insert_term('media', 'category');	
	
	
  //create customer record	
	
    $new_post = array(
          'ID' => '',
          'post_author' => '', 
          'post_category' => '',
          'post_content' => '', 
          'post_title' => $title,
		  'post_type' => 'media',
          'post_status' => 'publish'
        );
    //add the customer record and return the post id 
    $post_id = wp_insert_post($new_post);
	
	if ($_FILES) {
	foreach ($_FILES as $file => $array) {
	$newupload = insert_attachment($file,$post_id);
	// $newupload returns the attachment id of the file that
	// was just uploaded. Do whatever you want with that now.
	}
}
	
	
		echo $post_id;

die;
}

/*-------------------------------------------
/ Handle new media
/*------------------------------------------*/
add_action('wp_ajax_existing_media', 'existing_media');
add_action( 'wp_ajax_nopriv_existing_media', 'existing_media' );  

function existing_media() { 
global $member, $current_user,$post; // Set up Globals

	//set up customer post variables	
	$post_id = $_GET['post_id'];
  //create customer record	
	if ($_FILES) {
	foreach ($_FILES as $file => $array) {
	$newupload = media_handle_upload($file, $post_id);
	// $newupload returns the attachment id of the file that
	// was just uploaded. Do whatever you want with that now.
	}
	}   
	
		echo $post_id;

die;

}
/*-----------------------------------------------
/ show friends
/*----------------------------------------------*/
function total_friend_count( $user_id = false ) {
		global $wpdb, $bp;
		if ( !$user_id )
			$user_id = ( $bp->displayed_user->id ) ? $bp->displayed_user->id : $bp->loggedin_user->id;
		/* This is stored in 'total_friend_count' usermeta.
		   This function will recalculate, update and return. */
		$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(id) FROM {$bp->friends->table_name} WHERE (initiator_user_id = %d OR friend_user_id = %d) AND is_confirmed = 1", $user_id, $user_id ) );
		if ( !$count )
			return 0;
		update_usermeta( $user_id, 'total_friend_count', $count );
		return $count;
	}
	
	/*------------------------------------------------------------------------------------
/ ADD DELETE LINK FOR CUSTOMER RECORD 
/*------------------------------------------------------------------------------------*/

function wp_delete_post_link($link = 'Delete This', $before = '', $after = '', $title="Move this item to the Trash", $cssClass="delete-post") {
    global $post;
    if ( $post->post_type == 'page' ) {
        if ( !current_user_can( 'edit_page' ) )
            return;
    } else {
        if ( !current_user_can( 'edit_post' ) )
            return;
    }
    $delLink = wp_nonce_url( site_url() . "/wp-admin/post.php?action=trash&post=" . $post->ID, 'trash-' . $post->post_type . '_' . $post->ID);
    $link = '<a class="' . $cssClass . '" href="' . $delLink . '" onclick="javascript:if(!confirm(\'Are you sure you want to move this item to trash?\')) return false;" title="'.$title.'" />'.$link."</a>";
    return $before . $link . $after;
}

//*----------------------------------------------------------------------------
// Create Blog for each user
//*---------------------------------------------------------------------------*/
function create_user_blogs() {
global $current_site;
$blogusers = get_users();
foreach($blogusers as $user) {
 wpmu_create_blog( $current_site->domain, $current_site->path . $user->ID, 'Charity Site', $user->ID, $user->ID  );
	
	}

}
//create_user_blogs();
//*---------------------------------------------------------------------------
// Recent Donations Loop
//*---------------------------------------------------------------------------*/
function recent_donations_loop() { ?>
<table summary="" cellpadding="0" cellspacing="0" border="0" class="display" id="example1">	
				<?php
				$args=array(
				  'post_type' => 'donations',
				  'post_status' => 'publish',
				  'posts_per_page' => 5,
				  
				);
				
				$my_query = new WP_Query($args);
				if( $my_query->have_posts() ) {  ?>
								 
				 <thead>  <tr><th width="25%">Date</th><th width="30%">Name</th><th width="30%">Contact</th><th width="15%">Donation</th></tr></thead>
				  <?php
				  while ($my_query->have_posts()) : $my_query->the_post();
				  global $post;					
					$donation =  get_post_meta($post->ID, '_donation_amount', true);
					$email =  get_post_meta($post->ID, '_donation_email', true);
					$phone =  get_post_meta($post->ID, '_donation_phone', true);
					$name =  get_post_meta($post->ID, '_donation_name', true);
					$content = get_the_content();
					$postid = $post->ID;
					$meta = array();
					$custom_fields = get_post_custom();
					$img0 = get_post_meta($post->ID, 'image_0', true);
					$img1 = get_post_meta($post->ID, 'image_1', true);
					$img2 = get_post_meta($post->ID, 'image_2', true);
					$img3 = get_post_meta($post->ID, 'image_3', true);
									

					
					?>
					<tr><td><p><?php echo get_the_date(); ?></p></td>
					<td><p><?php if(get_the_title() !=='') {echo the_title();} else {echo $firstname . ' ' . $lastname; }?>
					<div class="row-actions">
						
						<span class="view">
							<a href="#" class="view" title="View this item inline">View</a> 							
						</span>
						<span class="trash">
						<?php// echo wp_delete_post_link('Delete'); ?>
						</span>
						</div></p></td><td><p><?php echo $email; ?><br><?php echo $phone; ?></p></td><td><p class="imgcell">$ <?php echo $donation; ?></p></td>			
						
						</tr>
						<?php endwhile; ?>
				  
				<?php }
				wp_reset_query();
				?>
			</table>
<?php } 


//*---------------------------------------------------------------------------
// Function to create users programatically
//*---------------------------------------------------------------------------*/
			function add_user_signup($user_data) {
			
			$domain = 'http://avidwerx.com/charity';
			$path = $userdata['path'];
			$title = $userdata['title'];
			$user = $userdata['firstname'];
			$user_email = $userdata['email'];
			
			/*$user_data = array(
                'ID' => '',
                'user_pass' => wp_generate_password(),
                'user_login' => $loginName,
                'display_name' => $loginName,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'role' => get_option('default_role') // Use default role or another role, e.g. 'editor'
            );*/
            $user_id = wpmu_signup_blog( $domain, $path, $title, $user, $user_email  );
         
			}

//*---------------------------------------------------------------------------
// FUCTION FOR FRONT END UPLOADS
//*---------------------------------------------------------------------------*/			
	add_action('wp_print_scripts','include_jquery_form_plugin');
function include_jquery_form_plugin(){
    if (is_page('23')){ // only add this on the page that allows the upload
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-form',array('jquery'),false,true ); 
    }
}		
//hook the Ajax call
//for logged-in users
add_action('wp_ajax_my_upload_action', 'my_ajax_upload');
//for non logged-in users
add_action('wp_ajax_nopriv_my_upload_action', 'my_ajax_upload');

function my_ajax_upload(){
//simple Security check
    check_ajax_referer('upload_thumb');

//get POST data
    $post_id = $_POST['post_id'];

//require the needed files
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
//then loop over the files that were sent and store them using  media_handle_upload();
    if ($_FILES) {
        foreach ($_FILES as $file => $array) {
            if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                echo "upload error : " . $_FILES[$file]['error'];
                die();
            }
            $attach_id = media_handle_upload( $file, $post_id );
        }   
		$attach_file = wp_insert_attachment( $attachment, $attach_id['file'] );
			 // for the function wp_generate_attachment_metadata() to work
			  require_once(ABSPATH . 'wp-admin/includes/image.php');
			  $attach_data = wp_generate_attachment_metadata( $attach_file, $attach_id['file'] );
			  wp_update_attachment_metadata( $attach_file, $attach_data );
    }
//and if you want to set that image as Post  then use:
  update_post_meta($post_id,'_thumbnail_id',$attach_id);
  echo "uploaded the new Thumbnail";
  die();
} 
//*---------------------------------------------------------------------------
// Function to create custom comment display
//*---------------------------------------------------------------------------*/
function donations_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent'); ?> id="comment-<?php comment_ID() ?>" >
		<div class="wUserInfo">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body wUserInfo">
		<?php endif; ?>
		<div class="comment-author vcard">
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
		</div>
<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
		<br />
<?php endif; ?>
        <div class="commentdatawrap">
			<?php comment_text() ?>
			
		</div>
		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a>
			<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => 2, 'max_depth' => 3))) ?>
			</div>
		</div>

		

	
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
			
		<?php endif; ?>
		</div>
		<div class="clear"></div>
			 <div class="cLine"></div>
<?php
        }		
		
//*---------------------------------------------------------------------------
// FUNCTION TO HANDLE AJAX SUBMIT OF CAUSE TO DONATION PLUGIN DB TABLES
//*---------------------------------------------------------------------------*/
		add_action('wp_ajax_admin_request_handler_new', 'admin_request_handler_new');
		add_action( 'wp_ajax_nopriv_admin_request_handler_new', 'admin_request_handler_new' );  
		
function admin_request_handler_new() {
		global $wpdb,$post;
		if (!empty($_POST['ak_action'])) {
			switch($_POST['ak_action']) {
				case 'donationmanager_update_settings':
					$this->populate_settings();
					if (isset($_POST["donationmanager_enable_paypal"])) $this->options['enable_paypal'] = "on";
					else $this->options['enable_paypal'] = "off";
					if (isset($_POST["donationmanager_enable_payza"])) $this->options['enable_payza'] = "on";
					else $this->options['enable_payza'] = "off";
					if (isset($_POST["donationmanager_payza_sandbox"])) $this->options['payza_sandbox'] = "on";
					else $this->options['payza_sandbox'] = "off";
					if (isset($_POST["donationmanager_enable_skrill"])) $this->options['enable_skrill'] = "on";
					else $this->options['enable_skrill'] = "off";
					if (isset($_POST["donationmanager_enable_interkassa"])) $this->options['enable_interkassa'] = "on";
					else $this->options['enable_interkassa'] = "off";
					if (isset($_POST["donationmanager_paypal_sandbox"])) $this->options['paypal_sandbox'] = "on";
					else $this->options['paypal_sandbox'] = "off";
					if (isset($_POST["donationmanager_enable_authnet"])) $this->options['enable_authnet'] = "on";
					else $this->options['enable_authnet'] = "off";
					if (isset($_POST["donationmanager_authnet_sandbox"])) $this->options['authnet_sandbox'] = "on";
					else $this->options['authnet_sandbox'] = "off";
					if (isset($_POST["donationmanager_enable_2co"])) $this->options['enable_2co'] = "on";
					else $this->options['enable_2co'] = "off";
					if (isset($_POST["donationmanager_enable_egopay"])) $this->options['enable_egopay'] = "on";
					else $this->options['enable_egopay'] = "off";
					if (isset($_POST["donationmanager_enable_liberty"])) $this->options['enable_liberty'] = "on";
					else $this->options['enable_liberty'] = "off";
					if (isset($_POST["donationmanager_native_ajax"])) $this->options['native_ajax'] = "on";
					else $this->options['native_ajax'] = "off";
					$errors = $this->check_settings();
					if ($errors === true) {
						$this->update_settings();
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager&updated=true');
						die();
					} else {
						$this->update_settings();
						$message = "";
						if (is_array($errors)) $message = __('The following error(s) occured:', 'donationmanager').'<br />- '.implode('<br />- ', $errors);
						setcookie("donationmanager_error", $message, time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager');
						die();
					}
					break;

				case 'donationmanager_update_campaign':
					if (isset($_POST["donationmanager_id"]) && !empty($_POST["donationmanager_id"])) {
						$id = intval($_POST["donationmanager_id"]);
						$campaign_details = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."dm_campaigns WHERE id = '".$id."' AND deleted = '0'", ARRAY_A);
						if (intval($campaign_details["id"]) == 0) unset($id);
					}
					$title = trim(stripslashes($_POST["donationmanager_title"]));
					$descrption = trim(stripslashes($_POST["donationmanager_description"]));
					$top_limit = trim(stripslashes($_POST["donationmanager_top_limit"]));
					$top_limit = number_format(floatval($top_limit), 2, '.', '');
					$currency = trim(stripslashes($_POST["donationmanager_currency"]));
					if (isset($id)) {
						$tmp = $wpdb->get_row("SELECT COUNT(*) AS total FROM ".$wpdb->prefix."dm_donators WHERE status > 0 AND deleted = '0' AND campaign_id = '".$id."'", ARRAY_A);
						$total = $tmp["total"];
						if ($total > 0 && $currency != $campaign_details["currency"]) {
							setcookie("donationmanager_error", __('Changing currency not allowed, because donations already exists!', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-add'.(!empty($id) ? '&id='.$id : ''));
							exit;
						}
					}
					if (strlen($title) < 2) {
						setcookie("donationmanager_error", __('Campaign title is too short', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-add'.(!empty($id) ? '&id='.$id : ''));
						exit;
					}
					if (!empty($id)) {
						$sql = "UPDATE ".$wpdb->prefix."dm_campaigns SET 
							title = '".mysql_real_escape_string($title)."', 
							description = '".mysql_real_escape_string($descrption)."', 
							top_limit = '".$top_limit."',
							currency = '".$currency."'
							WHERE id = '".$id."'";
						if ($wpdb->query($sql) !== false) {
							setcookie("donationmanager_info", __('Campaign successfully updated', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-campaigns');
							exit;
						} else {
							setcookie("donationmanager_error", __('Service is not available', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-add'.(!empty($id) ? '&id='.$id : ''));
							exit;
						}
					} else {
						$sql = "INSERT INTO ".$wpdb->prefix."dm_campaigns (
							title, description, top_limit, currency, registered, deleted) VALUES (
							'".mysql_real_escape_string($title)."',
							'".mysql_real_escape_string($descrption)."',
							'".$top_limit."',
							'".$currency."',
							'".time()."',
							'0'
							)";
						if ($wpdb->query($sql) !== false) {
							setcookie("donationmanager_info", __('Campaign successfully added', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-campaigns');
							exit;
						} else {
							setcookie("donationmanager_error", __('Service is not available', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-add'.(!empty($id) ? '&id='.$id : ''));
							exit;
						}
					}
					break;
				case 'donationmanager_update_donator':
					if (isset($_POST["donationmanager_id"]) && !empty($_POST["donationmanager_id"])) {
						$id = intval($_POST["donationmanager_id"]);
						$donator_details = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."dm_donators WHERE id = '".$id."' AND deleted = '0'", ARRAY_A);
						if (intval($donator_details["id"]) == 0) unset($id);
					}
					$name = trim(stripslashes($_POST["donationmanager_name"]));
					$email = trim(stripslashes($_POST["donationmanager_email"]));
					$url = trim(stripslashes($_POST["donationmanager_url"]));
					$amount = trim(stripslashes($_POST["donationmanager_amount"]));
					$amount = number_format(floatval($amount), 2, '.', '');
					$campaign_id = intval(trim(stripslashes($_POST["donationmanager_campaign"])));
					$campaign_details = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."dm_campaigns WHERE id = '".$campaign_id."' AND deleted = '0'", ARRAY_A);
					if (intval($campaign_details["id"]) == 0) {
						setcookie("donationmanager_error", __('Invalid campaign', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-add-donator'.(!empty($id) ? '&id='.$id : ''));
						exit;
					}
					if (strlen($name) == 0) $name = __('Anonymous Donor', 'donationmanager');
					if (!empty($id)) {
						$sql = "UPDATE ".$wpdb->prefix."dm_donators SET 
							campaign_id = '".$campaign_details["id"]."',
							name = '".mysql_real_escape_string($name)."', 
							email = '".mysql_real_escape_string($email)."', 
							url = '".mysql_real_escape_string($url)."', 
							amount = '".$amount."',
							currency = '".$campaign_details['currency']."'
							WHERE id = '".$id."'";
						if ($wpdb->query($sql) !== false) {
							setcookie("donationmanager_info", __('Donor successfully updated', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-donators');
							exit;
						} else {
							setcookie("donationmanager_error", __('Service is not available', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-add-donator'.(!empty($id) ? '&id='.$id : ''));
							exit;
						}
					} else {
						$sql = "INSERT INTO ".$wpdb->prefix."dm_donators (
							campaign_id, name, email, url, amount, currency, status, created, deleted) VALUES (
							'".$campaign_details["id"]."', 
							'".mysql_real_escape_string($name)."',
							'".mysql_real_escape_string($email)."',
							'".mysql_real_escape_string($url)."',
							'".$amount."',
							'".$campaign_details['currency']."',
							'".DONATIONMANAGER_STATUS_ACTIVE_BYADMIN."',
							'".time()."',
							'0'
							)";
						if ($wpdb->query($sql) !== false) {
							setcookie("donationmanager_info", __('Donor successfully added', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-donators');
							exit;
						} else {
							//die(mysql_error());
							setcookie("donationmanager_error", __('Service is not available', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-add-donator'.(!empty($id) ? '&id='.$id : ''));
							exit;
						}
					}
					break;
				default:
					break;
			}
		}
		if (!empty($_GET['ak_action'])) {
			switch($_GET['ak_action']) {
			
			case 'donationmanager_update_campaign':
					if (isset($_GET["donationmanager_id"]) && !empty($_GET["donationmanager_id"])) {
						$id = intval($_GET["donationmanager_id"]);
						$campaign_details = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."dm_campaigns WHERE id = '".$id."' AND deleted = '0'", ARRAY_A);
						if (intval($campaign_details["id"]) == 0) unset($id);
					}
					$title = trim(stripslashes($_GET["donationmanager_title"]));
					$descrption = trim(stripslashes($_GET["donationmanager_description"]));
					$top_limit = trim(stripslashes($_GET["donationmanager_top_limit"]));
					$top_limit = number_format(floatval($top_limit), 2, '.', '');
					$currency = trim(stripslashes($_GET["donationmanager_currency"]));
					$postID = trim(stripslashes($_GET["postid"]));
					if (isset($id)) {
						$tmp = $wpdb->get_row("SELECT COUNT(*) AS total FROM ".$wpdb->prefix."dm_donators WHERE status > 0 AND deleted = '0' AND campaign_id = '".$id."'", ARRAY_A);
						$total = $tmp["total"];
						if ($total > 0 && $currency != $campaign_details["currency"]) {
							setcookie("donationmanager_error", __('Changing currency not allowed, because donations already exists!', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-add'.(!empty($id) ? '&id='.$id : ''));
							exit;
						}
					}
					if (strlen($title) < 2) {
						setcookie("donationmanager_error", __('Campaign title is too short', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-add'.(!empty($id) ? '&id='.$id : ''));
						exit;
					}
					if (!empty($id)) {
						$sql = "UPDATE ".$wpdb->prefix."dm_campaigns SET 
							title = '".mysql_real_escape_string($title)."', 
							description = '".mysql_real_escape_string($descrption)."', 
							top_limit = '".$top_limit."',
							currency = '".$currency."'
							WHERE id = '".$id."'";
						if ($wpdb->query($sql) !== false) {
							setcookie("donationmanager_info", __('Campaign successfully updated', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-campaigns');
							exit;
						} else {
							setcookie("donationmanager_error", __('Service is not available', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-add'.(!empty($id) ? '&id='.$id : ''));
							exit;
						}
					} else {
						$sql = "INSERT INTO ".$wpdb->prefix."dm_campaigns (
							title, description, top_limit, currency, registered, deleted) VALUES (
							'".mysql_real_escape_string($title)."',
							'".mysql_real_escape_string($descrption)."',
							'".$top_limit."',
							'".$currency."',
							'".time()."',
							'0'
							)";
						if ($wpdb->query($sql) !== false) {
							setcookie("donationmanager_info", __('Campaign successfully added', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-campaigns');
							update_post_meta($postID,'_campaignID',$wpdb->insert_id);
							return $wpdb->insert_id;
							exit;
						} else {
							setcookie("donationmanager_error", __('Service is not available', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
							header('Location: '.get_bloginfo("wpurl").'/wp-admin/admin.php?page=donation-manager-add'.(!empty($id) ? '&id='.$id : ''));
							exit;
						}
						
					}
					break;
				case 'donationmanager_delete':
					$id = intval($_GET["id"]);
					$campaign_details = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."dm_campaigns WHERE id = '".$id."' AND deleted = '0'", ARRAY_A);
					if (intval($campaign_details["id"]) == 0) {
						setcookie("donationmanager_error", __('Invalid service call', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager-campaigns');
						die();
					}

					$sql = "UPDATE ".$wpdb->prefix."dm_campaigns SET deleted = '1' WHERE id = '".$id."'";
					if ($wpdb->query($sql) !== false) {
						setcookie("donationmanager_info", __('Campaign successfully removed', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager-campaigns');
						die();
					} else {
						setcookie("donationmanager_error", __('Invalid service call', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager-campaigns');
						die();
					}
					break;
				case 'donationmanager_donator_delete':
					$id = intval($_GET["id"]);
					$donator_details = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."dm_donators WHERE id = '".$id."' AND deleted = '0'", ARRAY_A);
					if (intval($donator_details["id"]) == 0) {
						setcookie("donationmanager_error", __('Invalid service call', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager-donators');
						die();
					}

					$sql = "UPDATE ".$wpdb->prefix."dm_donators SET deleted = '1' WHERE id = '".$id."'";
					if ($wpdb->query($sql) !== false) {
						setcookie("donationmanager_info", __('Donor successfully removed', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager-donators');
						die();
					} else {
						setcookie("donationmanager_error", __('Invalid service call', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager-donators');
						die();
					}
					break;
				case 'donationmanager_donator_block':
					$id = intval($_GET["id"]);
					$donator_details = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix . "dm_donators WHERE id = '".$id."' AND deleted = '0'", ARRAY_A);
					if (intval($donator_details["id"]) == 0) {
						setcookie("donationmanager_error", __('Invalid service call', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager-donators');
						die();
					}
					if ($donator_details["status"] < DONATIONMANAGER_STATUS_PENDING) {
						$sql = "UPDATE ".$wpdb->prefix."dm_donators SET status = status+".DONATIONMANAGER_STATUS_PENDING." WHERE id = '".$id."'";
						$wpdb->query($sql);
						setcookie("donationmanager_info", __('Donor successfully blocked', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager-donators');
						die();
					} else {
						setcookie("donationmanager_error", __('You can not block this donor', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager-donators');
						die();
					}
					break;
				case 'donationmanager_donator_unblock':
					$id = intval($_GET["id"]);
					$donator_details = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix . "dm_donators WHERE id = '".$id."' AND deleted = '0'", ARRAY_A);
					if (intval($donator_details["id"]) == 0) {
						setcookie("donationmanager_error", __('Invalid service call', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager-donators');
						die();
					}
					if ($donator_details["status"] >= DONATIONMANAGER_STATUS_PENDING) {
						$sql = "UPDATE ".$wpdb->prefix."dm_donators SET status = status-".DONATIONMANAGER_STATUS_PENDING." WHERE id = '".$id."'";
						$wpdb->query($sql);
						setcookie("donationmanager_info", __('Donor successfully unblocked', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager-donators');
						die();
					} else {
						setcookie("donationmanager_error", __('You can not unblock this donor', 'donationmanager'), time()+30, "/", ".".str_replace("www.", "", $_SERVER["SERVER_NAME"]));
						header('Location: '.get_bloginfo('wpurl').'/wp-admin/admin.php?page=donation-manager-donators');
						die();
					}
					break;
				case 'donationmanager_transactiondetails':
					if (isset($_GET["id"]) && !empty($_GET["id"])) {
						$id = intval($_GET["id"]);
						$transaction_details = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."dm_transactions WHERE id = '".$id."' AND deleted = '0'", ARRAY_A);
						if (intval($transaction_details["id"]) != 0) {
							echo '
<html>
<head>
	<title>'.__('Transaction Details', 'donationmanager').'</title>
</head>
<body>
	<table style="width: 100%;">';
							$details = explode("&", $transaction_details["details"]);
							foreach ($details as $param) {
								$data = explode("=", $param, 2);
								echo '
		<tr>
			<td style="width: 170px; font-weight: bold;">'.esc_attr($data[0]).'</td>
			<td>'.esc_attr(urldecode($data[1])).'</td>
		</tr>';
							}
							echo '
	</table>						
</body>
</html>';
						} else echo __('No data found!', 'donationmanager');
					} else echo __('No data found!', 'donationmanager');
					die();
					break;
				default:
					break;
					
			}
		}
		echo $_GET['ak_action'];
		die();
	}

//*---------------------------------------------------------------------------
// Function to get the total amount of donations per cause
//*---------------------------------------------------------------------------*/
function calculate_donations($id) {
	global $wpdb,$post;
		$id = get_post_meta($id,'_campaignID',true);
		$sql = "SELECT SUM(amount) AS donated FROM ".$wpdb->prefix."dm_donators WHERE deleted='0' AND campaign_id = '".$id."' AND (status = '".DONATIONMANAGER_STATUS_ACTIVE_BYUSER."' OR status = '".DONATIONMANAGER_STATUS_ACTIVE_BYADMIN."')";
		$donated = $wpdb->get_row($sql, ARRAY_A);	
		$amount = number_format($donated["donated"], 2, ".", "");
		return $amount;
	}		

//*---------------------------------------------------------------------------
//  Timezones dropdown list
//*---------------------------------------------------------------------------*/
function print_timezones(){
	$zones = '
	<option timeZoneId="1" gmtAdjustment="GMT-12:00" useDaylightTime="0" value="-12">(GMT-12:00) International Date Line West</option>
	<option timeZoneId="2" gmtAdjustment="GMT-11:00" useDaylightTime="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
	<option timeZoneId="3" gmtAdjustment="GMT-10:00" useDaylightTime="0" value="-10">(GMT-10:00) Hawaii</option>
	<option timeZoneId="4" gmtAdjustment="GMT-09:00" useDaylightTime="1" value="-9">(GMT-09:00) Alaska</option>
	<option timeZoneId="5" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
	<option timeZoneId="6" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
	<option timeZoneId="7" gmtAdjustment="GMT-07:00" useDaylightTime="0" value="-7">(GMT-07:00) Arizona</option>
	<option timeZoneId="8" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
	<option timeZoneId="9" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
	<option timeZoneId="10" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="-6">(GMT-06:00) Central America</option>
	<option timeZoneId="11" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="-6">(GMT-06:00) Central Time (US & Canada)</option>
	<option timeZoneId="12" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
	<option timeZoneId="13" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="-6">(GMT-06:00) Saskatchewan</option>
	<option timeZoneId="14" gmtAdjustment="GMT-05:00" useDaylightTime="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
	<option timeZoneId="15" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
	<option timeZoneId="16" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="-5">(GMT-05:00) Indiana (East)</option>
	<option timeZoneId="17" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
	<option timeZoneId="18" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
	<option timeZoneId="19" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="-4">(GMT-04:00) Manaus</option>
	<option timeZoneId="20" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="-4">(GMT-04:00) Santiago</option>
	<option timeZoneId="21" gmtAdjustment="GMT-03:30" useDaylightTime="1" value="-3.5">(GMT-03:30) Newfoundland</option>
	<option timeZoneId="22" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Brasilia</option>
	<option timeZoneId="23" gmtAdjustment="GMT-03:00" useDaylightTime="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
	<option timeZoneId="24" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Greenland</option>
	<option timeZoneId="25" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Montevideo</option>
	<option timeZoneId="26" gmtAdjustment="GMT-02:00" useDaylightTime="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
	<option timeZoneId="27" gmtAdjustment="GMT-01:00" useDaylightTime="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
	<option timeZoneId="28" gmtAdjustment="GMT-01:00" useDaylightTime="1" value="-1">(GMT-01:00) Azores</option>
	<option timeZoneId="29" gmtAdjustment="GMT+00:00" useDaylightTime="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
	<option timeZoneId="30" gmtAdjustment="GMT+00:00" useDaylightTime="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
	<option timeZoneId="31" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
	<option timeZoneId="32" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
	<option timeZoneId="33" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
	<option timeZoneId="34" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
	<option timeZoneId="35" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) West Central Africa</option>
	<option timeZoneId="36" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Amman</option>
	<option timeZoneId="37" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
	<option timeZoneId="38" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Beirut</option>
	<option timeZoneId="39" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Cairo</option>
	<option timeZoneId="40" gmtAdjustment="GMT+02:00" useDaylightTime="0" value="2">(GMT+02:00) Harare, Pretoria</option>
	<option timeZoneId="41" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
	<option timeZoneId="42" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Jerusalem</option>
	<option timeZoneId="43" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Minsk</option>
	<option timeZoneId="44" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Windhoek</option>
	<option timeZoneId="45" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
	<option timeZoneId="46" gmtAdjustment="GMT+03:00" useDaylightTime="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
	<option timeZoneId="47" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Nairobi</option>
	<option timeZoneId="48" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Tbilisi</option>
	<option timeZoneId="49" gmtAdjustment="GMT+03:30" useDaylightTime="1" value="3.5">(GMT+03:30) Tehran</option>
	<option timeZoneId="50" gmtAdjustment="GMT+04:00" useDaylightTime="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
	<option timeZoneId="51" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="4">(GMT+04:00) Baku</option>
	<option timeZoneId="52" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="4">(GMT+04:00) Yerevan</option>
	<option timeZoneId="53" gmtAdjustment="GMT+04:30" useDaylightTime="0" value="4.5">(GMT+04:30) Kabul</option>
	<option timeZoneId="54" gmtAdjustment="GMT+05:00" useDaylightTime="1" value="5">(GMT+05:00) Yekaterinburg</option>
	<option timeZoneId="55" gmtAdjustment="GMT+05:00" useDaylightTime="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
	<option timeZoneId="56" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
	<option timeZoneId="57" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
	<option timeZoneId="58" gmtAdjustment="GMT+05:45" useDaylightTime="0" value="5.75">(GMT+05:45) Kathmandu</option>
	<option timeZoneId="59" gmtAdjustment="GMT+06:00" useDaylightTime="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
	<option timeZoneId="60" gmtAdjustment="GMT+06:00" useDaylightTime="0" value="6">(GMT+06:00) Astana, Dhaka</option>
	<option timeZoneId="61" gmtAdjustment="GMT+06:30" useDaylightTime="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
	<option timeZoneId="62" gmtAdjustment="GMT+07:00" useDaylightTime="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
	<option timeZoneId="63" gmtAdjustment="GMT+07:00" useDaylightTime="1" value="7">(GMT+07:00) Krasnoyarsk</option>
	<option timeZoneId="64" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
	<option timeZoneId="65" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
	<option timeZoneId="66" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
	<option timeZoneId="67" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Perth</option>
	<option timeZoneId="68" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Taipei</option>
	<option timeZoneId="69" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
	<option timeZoneId="70" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="9">(GMT+09:00) Seoul</option>
	<option timeZoneId="71" gmtAdjustment="GMT+09:00" useDaylightTime="1" value="9">(GMT+09:00) Yakutsk</option>
	<option timeZoneId="72" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="9.5">(GMT+09:30) Adelaide</option>
	<option timeZoneId="73" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="9.5">(GMT+09:30) Darwin</option>
	<option timeZoneId="74" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="10">(GMT+10:00) Brisbane</option>
	<option timeZoneId="75" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
	<option timeZoneId="76" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Hobart</option>
	<option timeZoneId="77" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
	<option timeZoneId="78" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Vladivostok</option>
	<option timeZoneId="79" gmtAdjustment="GMT+11:00" useDaylightTime="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
	<option timeZoneId="80" gmtAdjustment="GMT+12:00" useDaylightTime="1" value="12">(GMT+12:00) Auckland, Wellington</option>
	<option timeZoneId="81" gmtAdjustment="GMT+12:00" useDaylightTime="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
	<option timeZoneId="82" gmtAdjustment="GMT+13:00" useDaylightTime="0" value="13">(GMT+13:00) Nuku\'alofa</option>
';
return $zones;
}

/*-------------------------------------------------/
// Handle updating the user password
//*-----------------------------------------------*/

add_action('wp_ajax_update_user_pass', 'update_user_pass');
add_action('wp_ajax_nopriv_update_user_pass', 'update_user_pass');

function update_user_pass() {
	global $current_user, $wpdb;
	get_currentuserinfo();
	$password = $_GET['password'];
	//$userid = $_GET['userid'];
	$userid = $current_user->ID;
	wp_update_user(array('ID' => $userid, 'user_pass' => $password));
	
	echo $password.$userid;
	die;
	
}	

//================================================//
//			FB CONNECT FUNCTIONALITY			  //
//================================================//

add_action('wp_ajax_fb_connect_member', 'fb_connect_member');
add_action('fb_connect_member', 'fb_connect_member');

function fb_connect_member() {
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '376206965769982',
  'secret' => '5fac80006f907f4597a5f74cc1f145df',
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
if($user_profile):
		update_option("fb_user_data",$user_profile);
endif;
die();
}

//================================================//
//			FB DISCONNECT FUNCTIONALITY			  //
//================================================//

add_action('wp_ajax_fb_disconnect_member', 'fb_disconnect_member');
add_action('fb_disconnect_member', 'fb_disconnect_member');

function fb_disconnect_member() {

	delete_option("fb_user_data");
	die();

}


//===============================================//
//			wp custom user fields				//
//==============================================//
function wp_user_profile_fields( $user )
	{ ?>

		<h3><?php _e("Custom Profile Information"); ?></h3>

		<table class="form-table">
			<tr>
				<th><label for="fullname"><?php _e("Full Name"); ?></label></th>
				<td>
					<input type="text" name="fullname" id="fullname" value="<?php echo esc_attr( get_the_author_meta( 'fullname', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"><?php _e("Please enter your full name."); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="city"><?php _e("City"); ?></label></th>
				<td>
					<input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"><?php _e("Please enter your city."); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="province"><?php _e("Province"); ?></label></th>
				<td>
					<input type="text" name="province" id="province" value="<?php echo esc_attr( get_the_author_meta( 'province', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"><?php _e("Please enter your province."); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="postalcode"><?php _e("Postal Code"); ?></label></th>
				<td>
					<input type="text" name="postalcode" id="postalcode" value="<?php echo esc_attr( get_the_author_meta( 'postalcode', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"><?php _e("Please enter your postal code."); ?></span>
				</td>
			</tr>
		</table>
<?php }

add_action( 'show_user_profile', 'wp_custom_user_profile_fields' ); //Add Some Action
add_action( 'edit_user_profile', 'wp_custom_user_profile_fields' );

function wp_save_custom_user_profile_fields( $user_id )
	{
		if ( !current_user_can( 'edit_user', $user_id ) ) { return false; } //User Auth

		update_usermeta( $user_id, 'address', $_POST['address'] );
		update_usermeta( $user_id, 'city', $_POST['city'] );
		update_usermeta( $user_id, 'province', $_POST['province'] );
		update_usermeta( $user_id, 'postalcode', $_POST['postalcode'] );
	}

add_action( 'personal_options_update', 'wp_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'wp_save_custom_user_profile_fields' );


function insert_avatar($file_handler,$post_id,$setthumb='false') {

  // check to make sure its a successful upload
  if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  require_once(ABSPATH . "wp-admin" . '/includes/file.php');
  require_once(ABSPATH . "wp-admin" . '/includes/media.php');

  $attach_id = media_handle_upload( $file_handler, $post_id );

   update_usermeta($current_user->id,'_avatar_id',$attach_id);
  return $attach_id;
}
?>