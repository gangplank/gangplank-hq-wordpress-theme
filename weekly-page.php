<?php
/**
 * Template Name: Weekly
 *
 * SUPER static hacked by chuck just for this to work on the display TV up front
 *
 * @package WordPress
 * @subpackage Gangplank3
 * @since Twenty Ten 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<meta name="description" content="Roundup of events updated weekly" /> 
<link rel="canonical" href="http://gangplankhq.com/this-week/" /> 
<meta name="robots" content="noindex,nofollow,noodp,noydir,nosnippet" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
</head>
<body <?php body_class(); ?>>
<div id="content" role="main">

<?php
$weekly_query = new WP_Query( array(
		'category__in' => '598',
		'posts_per_page' => 1,
		'order' => 'DESC' )
		);
while ( $weekly_query->have_posts() ) : $weekly_query->the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->
<?php endwhile; ?>

</div><!-- #content -->
</body>
</html>