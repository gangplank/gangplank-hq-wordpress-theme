<?php
/**
 * Template Name: Jobs
 *
 * @package WordPress
 * @subpackage Gangplank3
 * @since Twenty Ten 1.0
 */
?>

<?php get_header(); ?>
<div id="container">
	<div id="content" role="main">

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-content">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post();
					the_content();
				endwhile; wp_reset_query(); ?>
				<?php
				// lets show job CPT but drop after 30 days - chuck
				function filter_where($where = '') {
				    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
				    return $where;
				}
				add_filter('posts_where','filter_where');
				
				query_posts('post_type=job');
				while (have_posts()): the_post(); ?>
				<div class="job_single">
					<p><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr('Permalink to %s'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a> - <?php the_date('n/j'); ?><br />
					<?php the_excerpt(); ?></p>
				</div>
				<?php endwhile; wp_reset_query(); ?>
			</div><!-- .entry-content -->

		</div><!-- #post-## -->


	</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>