<?php
/**
 * mirall functions and definitions
 *
 * @package mirall
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
    $content_width = 640; /* pixels */
}

if (!function_exists('mirall_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function mirall_setup()
    {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on mirall, use a find and replace
         * to change 'mirall' to the name of your theme in all the template files
         */
        load_theme_textdomain('mirall', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        add_image_size('large-thumb', 1060, 650, true);
        add_image_size('index-thumb', 200, 150, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'mirall')
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('mirall_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
    }
endif; // mirall_setup
add_action('after_setup_theme', 'mirall_setup');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function mirall_widgets_init()
{
    register_sidebar(array(
        'name' => __('Home Top', 'mirall'),
        'id' => 'home-top',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));

    register_sidebar(array(
        'name' => __('Home Top Right', 'mirall'),
        'id' => 'home-top-right',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));

    register_sidebar(array(
        'name' => __('Left Column', 'mirall'),
        'id' => 'left-column',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));

    register_sidebar(array(
        'name' => __('Center Column', 'mirall'),
        'id' => 'center-column',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));

    register_sidebar(array(
        'name' => __('Right Column', 'mirall'),
        'id' => 'right-column',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));

    register_sidebar(array(
        'name' => __('Sidebar', 'mirall'),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
}

add_action('widgets_init', 'mirall_widgets_init');

/**
 * Enqueue scripts and styles.
 *
 **/
function mirall_scripts()
{
    wp_enqueue_style('mirall-style', get_stylesheet_uri());

    wp_enqueue_style('mirall-style-google-fonts', 'http://fonts.googleapis.com/css?family=Roboto:900,400italic');

    wp_enqueue_script('mirall-script-jquery', 'http://code.jquery.com/jquery-2.1.4.js ', array(), '2.1.4', true);

    wp_enqueue_style('mirall-style-bootstrap', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css');

    wp_enqueue_script('mirall-script-bootstrap', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array(), '3.3.4', true);

    wp_enqueue_style('mirall-style-font-awesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

    wp_enqueue_style('mirall-content-sidebar', get_template_directory_uri() . '/layouts/content-sidebar.css');

    wp_enqueue_script('mirall-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true);

    wp_enqueue_script('mirall-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count . ' Views';
}

function setPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/** THE EXCERPT */

function custom_excerpt_length()
{
    return 20;
}

function new_excerpt_more()
{
    return ' <a class="read-more" href="' . get_permalink(get_the_ID()) . '">' . __('...', 'your-text-domain') . '</a>';
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);
add_filter('excerpt_more', 'new_excerpt_more');

/** END FILTERS FOR EXCERPT */

add_action('wp_enqueue_scripts', 'mirall_scripts');

add_role('blogger', 'Blogger', array(
    'read' => true, // True allows that capability
    'edit_posts' => true,
    'delete_posts' => false, // Use false to explicitly deny
));

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load theme widgets.
 */
$files = glob(get_template_directory() . '/widgets/*.php');
foreach ($files as $file) {
    require($file);
}