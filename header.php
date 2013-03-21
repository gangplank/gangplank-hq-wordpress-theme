<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Gangplank3
 * @since Gangplank 3.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head();
?>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2'></script>
<script type='text/javascript' src='<?php bloginfo( 'stylesheet_directory' ); ?>/gp.js'></script>
</head>

<body <?php body_class(); ?>>
<div class="bgwrapper">
<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="access" role="navigation">
			<div class="skip-link screen-reader-text"><a href="#content" title="Skip to content">Skip to content</a></div>
			<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary-menu' ) ); ?>

			<div class="searchform">
			<form role="search" method="get" id="searchform" action="/" >
				<label class="screen-reader-text" for="s">Search for:</label>
				<input type="text" value="Find It" name="s" id="s" />
				<input type="submit" id="searchsubmit" value="Search" />
			</form>			
			</div>
			
			<div class="social">
				<a href="http://twitter.com/gangplank" target="_blank" rel="me"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/twitter.gif" alt="@gangplank" /></a>
				<a href="http://www.facebook.com/Gangplank" target="_blank" rel="me"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/facebook.gif" alt="@gangplank" /></a>
			</div>
		</div><!-- #access -->
	
	</div><!-- #header -->

	<div id="main">
