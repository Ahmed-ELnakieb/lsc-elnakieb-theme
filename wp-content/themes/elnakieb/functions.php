<?php
/**
 * elnakieb functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package elnakieb
 */

define('ELNAKIEB_THEME_DRI', get_template_directory());
define('ELNAKIEB_INC_DRI', get_template_directory() . '/inc/');
define('ELNAKIEB_THEME_URI', get_template_directory_uri());
define('ELNAKIEB_CSS_PATH', ELNAKIEB_THEME_URI . '/assets/css');
define('ELNAKIEB_JS_PATH', ELNAKIEB_THEME_URI . '/assets/js');
define('ELNAKIEB_IMG_PATH', ELNAKIEB_THEME_URI . '/assets/images');
define('Elnakieb_Admin_DRI', ELNAKIEB_THEME_DRI . '/admin');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function elnakieb_setup(){
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on elnakieb, use a find and replace
	 * to change 'elnakieb' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('elnakieb', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');
	add_image_size('elnakieb-img-size-1', 435, 323, true);
	add_image_size('elnakieb-img-size-2', 733, 465, true);
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');
	remove_theme_support('widgets-block-editor');
	add_filter( 'big_image_size_threshold', '__return_false' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	//Woocommerc
	add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'elnakieb'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	add_theme_support('post-formats', [
		'standard', 'image', 'video', 'gallery'
	]);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'elnakieb_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'elnakieb_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function elnakieb_content_width(){
	$GLOBALS['content_width'] = apply_filters('elnakieb_content_width', 640);
}
add_action('after_setup_theme', 'elnakieb_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function elnakieb_widgets_init(){
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'elnakieb'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'elnakieb'),
			'before_widget' => '<div id="%1$s" class="%2$s sidebar-box wow fadeInUp">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="sidebar-box-title egx-heading-1">',
			'after_title' => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__('Shop Siderbar', 'elnakieb'),
			'id' => 'shop-sidebar-1',
			'description' => esc_html__('Add widgets here.', 'elnakieb'),
			'before_widget' => '<div id="%1$s" class="widget mt-30 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget__title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'elnakieb_widgets_init');



/**
 *Google Font Load 
 */
if (!function_exists('elnakieb_fonts_url')):

	function elnakieb_fonts_url(){
		$fonts_url = '';
		$font_families = array();
		$subsets = 'latin';

		if ('off' !== _x('on', 'Inter: on or off', 'elnakieb')) {
			$font_families[] = 'Inter:100,100i,300,300i,400,400i,500,500i,700,700i,800,800i,900,900i';
		}
		if ('off' !== _x('on', 'Urbanist: on or off', 'elnakieb')) {
			$font_families[] = 'Urbanist:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
		}
		
		if ($font_families) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode(implode('|', $font_families)),
					'subset' => urlencode($subsets),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return esc_url_raw($fonts_url);
	}
endif;


/**
 * Enqueue scripts and styles.
 */
function elnakieb_scripts(){

	wp_enqueue_style('elnakieb-google-fonts', elnakieb_fonts_url(), array(), null);

	wp_enqueue_style('bootstrap', ELNAKIEB_CSS_PATH . '/bootstrap.min.css');
	wp_enqueue_style('all-min', ELNAKIEB_CSS_PATH . '/fontawesome.min.css');
	wp_enqueue_style('e-animations', ELNAKIEB_CSS_PATH . '/animate.css');
	wp_enqueue_style('image-reveal', ELNAKIEB_CSS_PATH . '/image-reveal.css');
	wp_enqueue_style('magnific-popup', ELNAKIEB_CSS_PATH . '/magnific-popup.css');
	wp_enqueue_style('swiper-elnakieb', ELNAKIEB_CSS_PATH . '/swiper.min.css');
	wp_enqueue_style('nice-select', ELNAKIEB_CSS_PATH . '/nice-select.css');
	wp_enqueue_style('elnakieb-main', ELNAKIEB_CSS_PATH . '/main.css');

	if (class_exists('WooCommerce')) {
		wp_enqueue_style('woocommerce-style', get_template_directory_uri() . '/woocommerce/woocommerce.css');
	}

	$your_curnt_lang = apply_filters('wpml_current_language', NULL);
	if (is_rtl() && $your_curnt_lang != 'en') {
		wp_enqueue_style('elnakieb-rtl', ELNAKIEB_CSS_PATH . '/rtl.css');
	}

	wp_enqueue_style('elnakieb-style', get_stylesheet_uri(), array());

	wp_enqueue_script( 'jquery-masonry', array( 'jquery' ), false, true );
	wp_enqueue_script( 'imagesloaded', ['jquery'], false, true );
	wp_enqueue_script('bootstrap-bundle', ELNAKIEB_JS_PATH . '/bootstrap.bundle.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('swiper-bundle', ELNAKIEB_JS_PATH . '/swiper-bundle.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('appear', ELNAKIEB_JS_PATH . '/appear.js', array('jquery'), '1.0', true);
	wp_enqueue_script('wow', ELNAKIEB_JS_PATH . '/wow.js', array('jquery'), '1.0', true);
	wp_enqueue_script('magnific-popup', ELNAKIEB_JS_PATH . '/magnific-popup.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('SplitText', ELNAKIEB_JS_PATH . '/SplitText.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('isotope', ELNAKIEB_JS_PATH . '/isotope.pkgd.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('nice-select', ELNAKIEB_JS_PATH . '/nice-select.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('gsap', ELNAKIEB_JS_PATH . '/gsap.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('counterup', ELNAKIEB_JS_PATH . '/counterup.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('marquee', ELNAKIEB_JS_PATH . '/marquee.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('waypoints', ELNAKIEB_JS_PATH . '/waypoints.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('lenis', ELNAKIEB_JS_PATH . '/lenis.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('ScrollTrigger', ELNAKIEB_JS_PATH . '/ScrollTrigger.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('reveal', ELNAKIEB_JS_PATH . '/reveal.js', array('jquery'), '1.0', true);
	
	wp_enqueue_script('elnakieb-main', ELNAKIEB_JS_PATH . '/main.js', array('jquery'), '1.0', true);

	$your_curnt_lang = apply_filters('wpml_current_language', NULL);
	if (is_rtl() && $your_curnt_lang != 'en') {
		wp_enqueue_script('elnakieb-rtl', ELNAKIEB_JS_PATH . '/rtl.js', array('jquery'), '1.0', true);
	}


	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'elnakieb_scripts');

/**
 * Implement the Custom Header feature.
 */
require ELNAKIEB_THEME_DRI . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require ELNAKIEB_THEME_DRI . '/inc/template-tags.php';

/**
 * Custom template tags for this theme.
 */
require ELNAKIEB_THEME_DRI . '/inc/class-wp-eergx-navwalker.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require ELNAKIEB_THEME_DRI . '/inc/template-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require ELNAKIEB_THEME_DRI . '/inc/eergx-functions.php';

/**
 * Cs Fremwork Config
 */
require ELNAKIEB_THEME_DRI . '/inc/cs-framework-functions.php';

/**
 * Dynamic Style
 */
require ELNAKIEB_THEME_DRI . '/inc/dynamic-style.php';

/**
 * elnakieb Core Functions
 */
require ELNAKIEB_THEME_DRI . '/inc/eergx-helper-class.php';

/**
 * elnakieb Core Functions
 */
require ELNAKIEB_THEME_DRI . '/inc/admin/class-admin-dashboard.php';

/**
 * elnakieb Core Functions
 */
require ELNAKIEB_THEME_DRI . '/inc/admin/demo-import/functions.php';

/**
 * Customizer additions.
 */
require ELNAKIEB_THEME_DRI . '/inc/customizer.php';


/**
 * Initial Breadcrumb
 */
require ELNAKIEB_THEME_DRI . '/inc/breadcrumb-init.php';



/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require ELNAKIEB_THEME_DRI . '/inc/jetpack.php';
}

