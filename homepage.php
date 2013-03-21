<?php
/**
 * Template Name: HomePage
 */

get_header(); ?>

		<div id="container" class="homepage">
			<img src="<?php bloginfo('stylesheet_directory')?>/images/gp-logo-home.png" alt="Gangplank Logo" />
			<div id="content" role="main">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

						<?php the_content(); ?>
						<?php endwhile; 
						wp_reset_query(); ?>
						
						<?php
							$sticky = get_option( 'sticky_posts' );
							rsort( $sticky );
							$sticky = array_slice( $sticky, 0, 1 );
							query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1 ) );
						?>
						<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<?php // enable the more line in loop
							global $more;
							$more = 0;
						?>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php the_content('Continue Reading'); ?>
						<?php endwhile; 
						wp_reset_query(); ?>
						
						<div id="picstrip"/>
							<div id="dapics">
									<!-- Start of Flickr Badge -->
									<div id="flickr_badge_uber_wrapper">
										<div id="flickr_badge_wrapper">
										<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?show_name=1&count=8&display=latest&size=s&layout=x&source=all_tag&tag=gangplankphx"></script>
										<?php // &user=65902450%40N00 ?>
										</div>
									</div>
							</div>
							<div class="flickrlink">	
								<span id="flickr_badge_source_txt">Got Pics? Tag them <a href="http://www.flickr.com/photos/tags/gangplankphx/"><strong>gangplankphx</strong></a> on flickr.com</span>
							</div>
						</div>

					</div><!-- .entry-content -->

					<?php if ( is_active_sidebar( 'home-rss' ) ) : ?>
					<div id="homerss">
						<ul><?php dynamic_sidebar( 'home-rss' ); ?>
						<?php //This was causing the home page to halt to a crawl on every load: gcal_parse_feed()?></ul>
					</div>
					<?php endif; ?>
				</div><!-- #post-## -->
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>