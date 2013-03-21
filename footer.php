<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Gangplank3
 * @since Twenty Ten 1.0
 */
?>
	</div><!-- #main -->
</div><!-- #wrapper -->
</div><!-- bg wrapper -->
<div id="footer" role="contentinfo">
	<div id="footer_inner">
		<h4 class="join"><span>Join Us</span></h4>
		<div id="colophon">
			<div class="map">
			<p>Historic Downtown Chandler<br/>
			<a href="http://is.gd/dDYfh" title="Map and Directions to Gangplank" rel="nofollow" target="_blank">260 South Arizona Avenue<br/>
			Chandler, AZ 85225</a><br />
			info@gangplankhq.com - <a href="http://j.mp/parkgp" title="Where to Park" target="_blank" rel="nofollow">Parking</a></p>
			</div>
			<div class="maptextright">
				<ul>
				<?php if ( !dynamic_sidebar( 'first-footer-widget-area' ) )  {}?>
				</ul>
			</div>
		</div><!-- #colophon -->
		<p class="copyright">Copyright 2007-<?=date('Y')?> Gangplank, LLC</p>
		<?php wp_nav_menu( array( 'container_class' => 'menu-footer', 'theme_location' => 'secondary-menu' ) ); ?>
	</div>
</div><!-- #footer -->

<?php wp_footer(); ?>
</body>
</html>
