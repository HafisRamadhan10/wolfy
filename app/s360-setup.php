<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

use App\s360Filters;

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'important_navigation' => __('Important Navigation', 'sage'),
        'top_navigation' => __('Top Navigation', 'sage'),
        'footer_links_left' => __('Footer Links', 'sage'),
        'footer_links_right' => __('Footer Navigation Right', 'sage')
    ]);

}, 20);

/*----------  ACF theme options  ----------*/

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page('Theme Settings');
}

/**
 * Enable features from Soil when plugin is activated
 * @link https://roots.io/plugins/soil/
 */
add_theme_support('soil-clean-up');
add_theme_support('soil-disable-asset-versioning');
add_theme_support('soil-disable-trackbacks');
add_theme_support('soil-google-analytics', 'UA-XXXXX-Y');
add_theme_support('soil-jquery-cdn');
add_theme_support('soil-js-to-footer');
add_theme_support('soil-nav-walker');
add_theme_support('soil-nice-search');
add_theme_support('soil-relative-urls');
add_theme_support( 'align-wide' );

/**
 * Update uploaded image media size.
 * http://codex.wordpress.org/Post_Thumbnails
 * http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
 * http://codex.wordpress.org/Function_Reference/add_image_size
 */

add_theme_support('post-thumbnails');
add_image_size( 'large-cropped', 1600, 900, true ); // hard crop mode
add_image_size( 'small-thumb', 140, 140, true ); // hard crop mode

//Resize post thumbnails to 300x300.
update_option( 'thumbnail_size_w', 300 );
update_option( 'thumbnail_size_h', 300 );
update_option( 'thumbnail_crop', 1 );


add_action('wp_dashboard_setup', function () {
    global $wp_meta_boxes;
    // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);    // Right Now Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        // Activity Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Comments Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  // Incoming Links Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);         // Plugins Widget
    // unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);    // Quick Press Widget
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);     // Recent Drafts Widget
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);           //
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);         //
    // remove plugin dashboard boxes
    unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);           // Yoast's SEO Plugin Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);        // Gravity Forms Plugin Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);   // bbPress Plugin Widget
    /*
    have more plugin widgets you'd like to remove?
    share them with us so we can get a list of
    the most commonly used. :D
    https://github.com/eddiemachado/bones/issues
    */
});

/**
 * Remove comments links from admin bar
 **/
add_action('init', function () {

    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }

    /**
     * Remove emoji settings
     **/
    // all actions related to emojis
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );



});

/**
 * Disable support for comments and trackbacks in post types
 **/
add_action('admin_init', function () {

    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }

    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url('/')); exit;
    }

    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }

});

/**
 * Remove comments page in menu
 **/
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

/**
 * Remove comments links from admin bar
 **/
add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
});

/**
 * Remove comments page in menu
 **/
add_action('admin_head', function () {
    $icon = get_field('favicon', 'option');
    if($icon) {
        echo '<link rel="icon" href="'.$icon['url'].'" type="image/x-icon" />';
    }
});

/**
 *  Change login logo, please adjust the background image path and the CSS.
 */
add_action('login_enqueue_scripts', function ( ) { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png);
            height:65px;
            width:320px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
            background-size: contain;
        }
    </style>
    <?php
});


/* ADD GTM TO HEAD AND BELOW OPENING BODY */
add_action('get_header', function () {

    if(get_field('google_tag_manager_id', 'options')) :
    $gtm_ID = get_field('google_tag_manager_id', 'options');
    ?>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $gtm_ID; ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

<?php endif; });

/**
 * Add Header/Footer Scripts
 **/
add_action('wp_head', function () {
    echo get_field('header_scripts', 'options');

    if(get_field('google_tag_manager_id', 'options')) :
        $gtm_ID = get_field('google_tag_manager_id', 'options');?>

         <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer',<?php echo $gtm_ID ?>);</script>
        <!-- End Google Tag Manager -->

    <?php endif;
});

add_action('wp_footer', function () {
   echo get_field('footer_scripts', 'options');
});
