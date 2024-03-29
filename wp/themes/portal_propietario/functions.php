<?php
/**
 * portal_propietario functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package portal_propietario
 */




if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.1' );
}

if ( ! function_exists( 'portal_propietario_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function portal_propietario_setup() {

		register_post_type('inmueble', array(
			'label' => 'Inmuebles', 
			'public' => true
		));


		register_post_type('cita', array(
			'label' => 'Citas', 
			'public' => true
		));


		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on portal_propietario, use a find and replace
		 * to change 'portal_propietario' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'portal_propietario', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		//add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		//add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		//add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		/*register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'portal_propietario' ),
			)
		);*/

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				//'search-form',
				//'comment-form',
				//'comment-list',
				//'gallery',
				//'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		/*add_theme_support(
			'custom-background',
			apply_filters(
				'portal_propietario_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);
		*/
		// Add theme support for selective refresh for widgets.
		//add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		/*add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);*/

	}
endif;
add_action( 'after_setup_theme', 'portal_propietario_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function portal_propietario_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'portal_propietario_content_width', 640 );
}
add_action( 'after_setup_theme', 'portal_propietario_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function portal_propietario_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'portal_propietario' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'portal_propietario' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'portal_propietario_widgets_init' );
define('ALLOW_UNFILTERED_UPLOADS', true);
/**
 * Enqueue scripts and styles.
 */
function portal_propietario_scripts() {
	wp_enqueue_style( 'portal_propietario-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'portal_propietario-style', 'rtl', 'replace' );

	wp_enqueue_script( 'portal_propietario-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'portal_propietario-imgauto', get_template_directory_uri() . '/assets/js/img-perfil.js', array(), _S_VERSION, true );

	wp_enqueue_style( 'portal_propietario-roboto-style', 'https://fonts.googleapis.com/css2?family=Roboto&display=swap', array(), _S_VERSION );

	wp_enqueue_script( 'portal_propietario-toast', 'https://cdn.jsdelivr.net/npm/toastify-js', array(), _S_VERSION, true);
	wp_enqueue_style( 'portal_propietario-toast-style', 'https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css', array(), _S_VERSION );

}
add_action( 'wp_enqueue_scripts', 'portal_propietario_scripts' );

function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');

function generate_random_string($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


/**
 * Create default pages.
 */
require get_template_directory() . '/self/installation.php';


/**
 * fontawesome helper.
 */
require get_template_directory() . '/self/fontawesome.php';

/**
 * permalinks activator.
 */
require get_template_directory() . '/self/permalinks.php';

