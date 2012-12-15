<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>
<div id="footer">
<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
	
?>		
</div> <!--end #wrapper-->
	<div id="copyright">
		<div class="copy-left">
			<p> Copyright 2012 GOODWERX. All Rights Reserved.</p>
		</div>
		
		<div class="copy-right">
			<p> Designed by <b>AVIDWERX</b> </p>
		</div>

	</div>
	
</div>
</div>
</div>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>