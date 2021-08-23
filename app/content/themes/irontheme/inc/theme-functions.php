<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Constants
 */
define( 'THEME_URL', get_template_directory_uri() );
define( 'TEXTDOMAIN', 'ith' );

if ( ! function_exists( 'ith_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ith_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ith, use a find and replace
		 * to change 'ith' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( TEXTDOMAIN, get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', TEXTDOMAIN ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_image_size( 'text_block', 550, 750, true );
		add_image_size( '50x50', 700, 530, true );
		add_image_size( 'upcoming_event', 750, 400, true );
		add_image_size( 'news', 460, 595, true );
		add_image_size( 'page_hero', 1920, 780, true );
		add_image_size( 'text_with_image', 483, 725, true );
		add_image_size( 'widget_upcoming_events', 323, 215, true );
		add_image_size( 'age_of_children', 310, 460, true );
		add_image_size( 'opening_time', 460, 690, true );
		add_image_size( 'staff', 460, 942, true );
	}
endif;
add_action( 'after_setup_theme', 'ith_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ith_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ith_content_width', 1920 );
}

add_action( 'after_setup_theme', 'ith_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ith_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', TEXTDOMAIN ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', TEXTDOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', TEXTDOMAIN ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', TEXTDOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', TEXTDOMAIN ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', TEXTDOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', TEXTDOMAIN ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', TEXTDOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 5', TEXTDOMAIN ),
		'id'            => 'footer-5',
		'description'   => esc_html__( 'Add widgets here.', TEXTDOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'ith_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ith_scripts() {
	wp_enqueue_style( 'ith-style', get_stylesheet_uri() );

	wp_enqueue_script( 'ith-main', get_template_directory_uri() . '/js/common.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'ith_scripts' );

/**
 * Remove tag p in CF7
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

function js_variables() {
	$variables = array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	);
	echo '<script type="text/javascript">window.wp_data = ' . json_encode( $variables ) . ';</script>';
}

add_action( 'wp_head', 'js_variables' );

add_filter( 'wp_terms_checklist_args', 'set_checked_ontop_default', 10 );
function set_checked_ontop_default( $args ) {
	if ( ! isset( $args['checked_ontop'] ) ) {
		$args['checked_ontop'] = false;
	}

	return $args;
}

/**
 * Get any posts
 */
function get_any_post( $post_type, $count = null, $tax_name = null, $tax_id = null, $orderby = 'ID' ) {
	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$args  = array(
		'post_type'      => $post_type,
		'post_status'    => 'publish',
		'posts_per_page' => $count ? $count : get_option( 'posts_per_page' ),
		'paged'          => $paged,
		'order'          => 'ASC',
		'orderby'        => $orderby
	);

	if ( $tax_id && $tax_name ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => $tax_name,
				'field'    => 'term_id',
				'terms'    => $tax_id
			)
		);
	}

	$query = new WP_Query( $args );

	return $query;
}

/**
 * Remove WordPress Image Compression
 */
add_filter( 'jpeg_quality', function ( $arg ) {
	return 100;
} );

function add_rewrite_rules( $wp_rewrite )
{
	$new_rules = array(
		'news/(.+?)/?$' => 'index.php?post_type=post&name='. $wp_rewrite->preg_index(1),
	);

	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'add_rewrite_rules');

function change_blog_links($post_link, $id=0){

	$post = get_post($id);

	if( is_object($post) && $post->post_type == 'post'){
		return home_url('/news/'. $post->post_name.'/');
	}

	return $post_link;
}
add_filter('post_link', 'change_blog_links', 1, 3);

add_filter('excerpt_more', function($more) {
	return '...';
});

add_filter( 'excerpt_length', function(){
	return 40;
} );