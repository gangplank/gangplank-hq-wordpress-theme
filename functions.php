<?php

// main theme setup - typical shit
add_action('after_setup_theme','gphq_theme_setup');
function gphq_theme_setup() {
	add_theme_support('post-thumbnails');
	add_theme_support('menus');
	add_theme_support('automatic-feed-links');	
}

// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
	'primary-menu' => __('Primary Menu'),
	'secondary-menu' => __('Secondary Menu')
) );

// new jobs cpt - chuck aug2011
add_action('init','gphq_cpt_job');
function gphq_cpt_job() {
    $labels = array( 
        'name' => _x('Jobs','job'),
        'singular_name' => _x('job','job'),
        'add_new' => _x('Add New','job'),
        'add_new_item' => _x('Add New job','job'),
        'edit_item' => _x('Edit job','job'),
        'new_item' => _x('New job','job'),
        'view_item' => _x('View job','job'),
        'search_items' => _x('Search Jobs','job'),
        'not_found' => _x('No jobs found','job'),
        'not_found_in_trash' => _x('No jobs found in Trash','job'),
        'parent_item_colon' => _x('Parent job:','job'),
        'menu_name' => _x('Jobs / Leads','job'),
    );
    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'supports' => array('title','editor'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
		'menu_icon' => get_template_directory_uri() . '/images/linkedin_icon.png',
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 
            'slug' => 'job', 
            'with_front' => false,
            'feeds' => true,
            'pages' => false
        ),
        'capability_type' => 'post'
    );
    register_post_type('job', $args );
}

// add stuff into header
function gphq_build_header() {
?>
<!-- GeoTag metadata -->
<meta name="geo.country" content="US" />
<meta name="geo.region" content="US-AZ" />
<meta name="geo.placename" content="Chandler, AZ 85225, USA" />
<meta name="geo.position" content="33.299671, -111.841882" />
<!-- GeoURL metadata -->
<meta name="ICBM" content="33.299671, -111.841882" />
<meta name="DC.title" content="Gangplank - A Collaborative coworking and event space" />
<!-- End GeoData -->
<?php }
add_action('wp_head','gphq_build_header','1');



// Eliminates jump to anchor on more links
function gphq_remove_more_jump_link($link) { 
	$offset = strpos($link,'#more-');
		if ($offset) {
			$end = strpos($link,'"',$offset);
		}
	if ($end) {
		$link = substr_replace($link,'', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link','gphq_remove_more_jump_link');


// Who loves widget areas?
function gphq_widgets_init() {	
	register_sidebar( array(
		'name' => 'Home Page Middle Sidebar',
		'id' => 'home-rss',
		'description' => 'Middle column of homepage above events',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Home Page Right Sidebar',
		'id' => 'homepage-widget-area',
		'description' => 'Main right column sidebar on homepage only',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Main Blog Sidebar',
		'id' => 'primary-widget-area',
		'description' => 'This widget area is for the sidebar on the blog only',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Footer Widget Area',
		'id' => 'first-footer-widget-area',
		'description' => 'Main footer area widget',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Secondary Widget Area',
		'id' => 'secondary-widget-area',
		'description' => 'The secondary widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action('widgets_init','gphq_widgets_init');



// Add custom fields to user profiles
function add_twitter_contactmethod( $contactmethods ) {
	// Add
	$contactmethods['twitter'] = 'Twitter';
	$contactmethods['facebook'] = 'Facebook';
	// Remove
	unset($contactmethods['yim']);
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	
	return $contactmethods;
}
add_filter('user_contactmethods','add_twitter_contactmethod',10,1);
/* add on front-end as <?php the_author_meta('twitter'); ?> */

// Fix auto excerpt links
function new_excerpt_more($more) {
       global $post;
	return ' <a href="'. get_permalink($post->ID) . '"><em>(Continue Reading...)</em></a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// remove excerpt auto p tag
remove_filter('the_excerpt','wpautop');


// clean up the header a bit
add_theme_support('automatic-feed-links');
remove_action('wp_head','start_post_rel_link');
remove_action('wp_head','index_rel_link');
remove_action('wp_head','adjacent_posts_rel_link');

// Remove Akismet Stats submenu
remove_action('admin_menu','akismet_config_page');
remove_action('admin_menu','akismet_stats_page');

// Remove some dashboard crap that nobody loves
add_action('admin_menu','gp_remove_dashboard_boxes');
function gp_remove_dashboard_boxes() {
	// remove_meta_box('dashboard_right_now','dashboard','core'); // Right Now Overview Box
	// remove_meta_box('dashboard_incoming_links','dashboard','core'); // Incoming Links Box
	remove_meta_box('dashboard_quick_press','dashboard','core'); // Quick Press Box
	remove_meta_box('dashboard_plugins','dashboard','core'); // Plugins Box
	remove_meta_box('dashboard_recent_drafts','dashboard','core'); // Recent Drafts Box
	remove_meta_box('dashboard_recent_comments','dashboard','core'); // Recent Comments
	remove_meta_box('dashboard_primary','dashboard','core'); // WordPress Development Blog
	remove_meta_box('dashboard_secondary','dashboard','core'); // Other WordPress News
	remove_meta_box('yoast_db_widget','dashboard','core'); // Yoast Dash box
	remove_meta_box('yoast_posts','dashboard','core'); // Yoast Dash posts box
	remove_meta_box('w3tc_pagespeed','dashboard','core'); // W3TC page speed box
	// Kill Blubrry dash shit forever and ever and ever
	remove_action('admin_head-index.php','powerpress_dashboard_head');
	remove_action('wp_dashboard_setup','powerpress_dashboard_setup');
}

// remove meta boxes from default posts screen
add_action('admin_menu','gp_remove_default_post_metaboxes');
function gp_remove_default_post_metaboxes() {
	remove_meta_box('postcustom','post','normal'); // Custom Fields metabox
	remove_meta_box('postexcerpt','post','normal'); // Excerpt metabox
	//remove_meta_box('commentstatusdiv','post','normal'); // Comments metabox
	remove_meta_box('trackbacksdiv','post','normal'); // Talkback metabox
	//remove_meta_box('slugdiv','post','normal'); // Slug metabox
	//remove_meta_box('authordiv','post','normal'); // Author metabox
	remove_meta_box('revisionsdiv','post','normal'); // Revisions metabox
	remove_meta_box('tagsdiv-post_tag','post','normal'); // Tags metabox
	//remove_meta_box('categorydiv','post','normal'); // Comments metabox
}
// remove meta boxes from default pages screen
add_action('admin_menu','gp_remove_default_page_metaboxes');
function gp_remove_default_page_metaboxes() {
	remove_meta_box('postcustom','page','normal'); // Custom Fields metabox
	remove_meta_box('commentstatusdiv','page','normal'); // Discussion metabox
	remove_meta_box('commentsdiv','page','normal'); // Comments metabox
	//remove_meta_box('slugdiv','page','normal'); // Slug metabox
	remove_meta_box('authordiv','page','normal'); // Author metabox
	remove_meta_box('revisionsdiv','page','normal'); // Revisions metabox
	remove_meta_box('postimagediv','page','side'); // Featured Image metabox
}


// Enable AutoEmbeds from Plain Text URLs in Text Widgets
// add_filter('widget_text', array( $wp_embed,'run_shortcode'), 8 );
// add_filter('widget_text', array( $wp_embed,'autoembed'), 8 );

// fix TinyMCE for iframes
add_filter('tiny_mce_before_init', create_function('$a',
'$a["extended_valid_elements"] = "iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]"; return $a;') );

// remove visual editor - katie needs to learn :)  (added back for hanna)
// add_filter('user_can_richedit',create_function('' ,'return false;'),50);


// END custom - everything under here was left from josh's initial scrape from twenty-ten

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
/*function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter('wp_page_menu_args','twentyten_page_menu_args');
*/
/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
/*function twentyten_excerpt_length( $length ) {
	return 40;
}
add_filter('excerpt_length','twentyten_excerpt_length');
*/
/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
/*function twentyten_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __('Continue reading <span class="meta-nav">&rarr;</span>','twentyten') . '</a>';
}
*/
/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
/*function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter('get_the_excerpt','twentyten_custom_excerpt_more');

*/
if ( ! function_exists('twentyten_comment') ) :
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
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __('%s <span class="says">says:</span>','twentyten'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0') : ?>
			<em><?php _e('Your comment is awaiting moderation.','twentyten'); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s','twentyten'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __('(Edit)','twentyten'),' ');
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array('depth' => $depth,'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e('Pingback:','twentyten'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)','twentyten'),' '); ?></p>
	<?php
			break;
	endswitch;
}
endif;



/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
/*function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action('wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],'recent_comments_style') );
}
add_action('widgets_init','twentyten_remove_recent_comments_style');
*/
if ( ! function_exists('twentyten_posted_on') ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __('<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s','twentyten'),
		'meta-prep meta-prep-author',
	// mod by chuck - remove link on date to same - look at future arhive based links 
	//	sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
	//		get_permalink(),
		sprintf('<span class="entry-date">%2$s</span>',
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_the_author_meta('twitter'), // mod to use new twitter field by Chuck. orig: get_author_posts_url( get_the_author_meta('ID') ),
			sprintf( esc_attr__('View all posts by %s'), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists('twentyten_posted_in') ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list('',',');
	if ( $tag_list ) {
		$posted_in = __('This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.','twentyten');
	} elseif ( is_object_in_taxonomy( get_post_type(),'category') ) {
		$posted_in = __('This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.','twentyten');
	} else {
		$posted_in = __('Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.','twentyten');
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list(','),
		$tag_list,
		get_permalink(),
		the_title_attribute('echo=0')
	);
}
endif;
