<?php get_header(); ?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>	
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>				

					<div class="entry-content">
						<?php the_content(); ?>
						<?php if ( is_page('events') ) {
						    echo '<iframe src="http://www.google.com/calendar/embed?src=gangplankhq.com_0fgcnbe2jug0b1bi43m5qv86s8%40group.calendar.google.com&ctz=America/Phoenix" style="border: 0" width="680" height="600" frameborder="0" scrolling="no"></iframe>';
						} ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . 'Pages:', 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php// comments_template( '', true ); ?>

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
