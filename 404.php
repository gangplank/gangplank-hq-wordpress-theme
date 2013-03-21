<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Gangplank3
 * @since Twenty Ten 1.0
 */

get_header(); ?>

	<div id="container">
		<div id="content" role="main">

			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
				<div class="entry-content">
					<p>Sunova! So sorry, the link you followed is bad and the content has either moved or is no longer available. Please visit the <a href="http://gangplankhq.com">Gangplank homepage</a> or use the search box below to try and locate it.</p>
					
					<?php get_search_form(); ?>
					
					<h3>Blame Derek!</h3>
					<p><img src="http://gangplankhq.com/wp-content/uploads/derek-neighbors-404.jpg" width="444" height="375" alt="derek wtf" /></p>
				</div><!-- .entry-content -->
			</div>

		</div><!-- #content -->
	</div><!-- #container -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>
