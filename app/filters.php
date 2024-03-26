<?php

namespace App;
use WP_User;
use WP_Query;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);

// changing the alt text on the logo to show your site name
add_filter('login_headertitle', __NAMESPACE__ . '\\my_login_title');
function my_login_title() {
    return get_option('blogname');
}

/**
 *  Change login logo, please adjust the background image path and the CSS.
 */
add_action( 'login_enqueue_scripts', __NAMESPACE__ . '\\changeLogoLogin' );
function changeLogoLogin() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png) !important;
            height:65px;
            width:320px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
            background-size: contain;
        }
    </style>
<?php }

//remove type script
add_filter('script_loader_tag', function($tag){
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}, 10, 2);
//remove type script


add_filter('excerpt_more', function($more) {
    global $post;
    return '...<a class="read-more" href="'. get_permalink($post->ID) . '">Read More</a>';
});

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif (is_archive()) {
        if(post_type_archive_title( '', false ) !== null) {
            $title = post_type_archive_title( '', false );
        }
    }

    return $title;
});

add_action('admin_head', function() {
    $primary_color = get_field('primary_color','option');
    $secondary_color = get_field('secondary_color','option');
    $primary_font = get_field('primary_font','option');

    if ($primary_font == 'ssp') {
        $primary_font = "'Source Sans Pro', sans-serif";
    } elseif ($primary_font == 'ns') {
        $primary_font = "'Noto Serif', serif";
    } elseif ($primary_font == 'rbt') {
        $primary_font = "'Roboto', sans-serif";
    } elseif ($primary_font == 'zilla') {
        $primary_font = "'Zilla Slab', serif";
    } elseif ($primary_font == 'pd') {
        $primary_font = "'Playfair Display', serif";
    } elseif ($primary_font == 'mt') {
        $primary_font = "'Montserrat', sans-serif";
    } else {
        $primary_font = "'Quicksand', sans-serif";
    }
    ?>

<style>
    :root {
        --colorPrimary: <?php echo $primary_color ?>;
        --colorSecondary: <?php echo $secondary_color ?>;
        --fontPrimary: <?php echo $primary_font ?>;
        --colorPrimary2: <?php echo hex2rgba($primary_color, 0.5); ?>;
        --colorPrimary3: <?php echo hex2rgba($primary_color, 0.1); ?>;
        --colorSecondary2: <?php echo hex2rgba($secondary_color, 0.8); ?>;
        --colorPrimaryDark: <?php echo color_luminance( $primary_color, -0.3 ); ?>;
        --colorSecondaryDark: <?php echo color_luminance( $secondary_color, -0.3 ); ?>;
    }
</style>
<?php
});

add_filter('sage/display_sidebar', function ($display) {
    static $display;

    isset($display) || $display = in_array(true, [
      // The sidebar will be displayed if any of the following return true
      is_home(),
    ]);

    return $display;
});

add_filter( 'excerpt_length', function($length) {
    return 35;
}, 999 );


add_action( 'template_redirect', function() {
    if ( is_search() || is_404()  )
    {
      wp_redirect(home_url());
      exit;
    }
} );

/* Gravity form filters */

add_filter( 'gform_ajax_spinner_url', function($src){
    return  'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
});

add_filter( 'gform_confirmation_anchor', '__return_false' );

/**
 * Block template for posts
 * @see https://www.billerickson.net/gutenberg-block-templates/
 *
 */
//add_action( 'init', function() {
//    if ( ! is_admin() ) {
//        // This is not the post/page we want to limit things to.
//        return false;
//    }
//
//    $page_id = $_GET['post'];
//    $page_template = get_page_template_slug($page_id);
//
//    $post_type_object = get_post_type_object( 'page' );
//    $post_type_object->template = array(
//        array( 'acf/banners', array(
//            'data' => [
//                'field_5c93860a36b91' => 'news-banner',
//                'field_5cc18560af45e' => 'center',
//            ],
//            'align' => 'full',
//            'mode' => 'edit'
//        ) ),
//        array('acf/latestpost', array(
//            'mode' => 'edit'
//        ) ),
//    );
//
//} );
