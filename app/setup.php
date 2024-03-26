<?php

namespace App;

use App\Controllers\App;
use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */

add_action('wp_enqueue_scripts', function () {
    $primary_font = get_field('primary_font','option');

    if ($primary_font == 'ssp') {
        $primary_font = 'Source+Sans+Pro';
    } elseif ($primary_font == 'ns') {
        $primary_font = 'Noto+Serif';
    } elseif ($primary_font == 'rbt') {
        $primary_font = 'Roboto';
    } elseif ($primary_font == 'zilla') {
        $primary_font = 'Zilla+Slab';
    } elseif ($primary_font == 'pd') {
        $primary_font = 'Playfair+Display';
    } elseif ($primary_font == 'mt') {
        $primary_font = 'Montserrat';
    } else {
        $primary_font = 'Quicksand';
    }

    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family='.$primary_font.':300,400,400i,700', null, null);
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_style('sage/fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css', null, true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('sage/modernizr.js', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js', null, true);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
    wp_enqueue_script('youtubeAPI', 'https://www.youtube.com/player_api', null, true);
    wp_enqueue_style('sage/aoscss', 'https://unpkg.com/aos@2.3.1/dist/aos.css', false, null);
    wp_enqueue_script('sage/slideup', 'https://unpkg.com/aos@2.3.1/dist/aos.js', [], null, true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

//This is used to enqueue block scripts and styles in both the admin editor and frontend of the site.
add_action('enqueue_block_assets', function () {
    $primary_font = get_field('primary_font','option');

    if ($primary_font == 'ssp') {
        $primary_font = 'Source+Sans+Pro';
    } elseif ($primary_font == 'ns') {
        $primary_font = 'Noto+Serif';
    } elseif ($primary_font == 'rbt') {
        $primary_font = 'Roboto';
    } elseif ($primary_font == 'zilla') {
        $primary_font = 'Zilla+Slab';
    } elseif ($primary_font == 'pd') {
        $primary_font = 'Playfair+Display';
    } elseif ($primary_font == 'mt') {
        $primary_font = 'Montserrat';
    } else {
        $primary_font = 'Quicksand';
    }

    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family='.$primary_font.':300,400,400i,700', null, null);
    //wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
});


//This can be used to enqueue block scripts and styles in the admin editor only.
add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_style('sage/gutenberg.css', asset_path('styles/gutenberg.css'), false, null);
});

/**
 * Theme setup
 */

add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    $primary_color = get_field('primary_color','option');

    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => __( 'Primary Color', 'cmt' ),
            'slug'  => 'color-primary',
            'color' => get_field( 'primary_color', 'options' ),
        ),
        array(
            'name'  => __( 'Thin Primary Color', 'cmt' ),
            'slug'  => 'thin-color-primary',
            'color' => hex2rgba($primary_color, 0.1),
        ),
        array(
            'name'  => __( 'Secondary Color', 'cmt' ),
            'slug'  => 'color-secondary',
            'color' => get_field( 'secondary_color', 'options' ),
        ),
        array(
            'name'  => __( 'Charcoal', 'cmt' ),
            'slug'  => 'color-charcoal',
            'color' => '#404042',
        ),
        array(
            'name'  => __( 'White', 'cmt' ),
            'slug'  => 'color-white',
            'color' => '#ffffff',
        ),
    ) );


    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_links_left' => __('Footer Links', 'sage'),
        'footer_links_right' => __('Footer Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Adds support for editor font sizes.
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support( 'editor-font-sizes', array(
        array(
            'name' => __( 'Small', 'campaignmaster' ),
            'size' => 12,
            'slug' => 'small'
        ),
        array(
            'name' => __( 'Normal', 'campaignmaster' ),
            'size' => 16,
            'slug' => 'normal'
        ),
        array(
            'name' => __( 'Large', 'campaignmaster' ),
            'size' => 30,
            'slug' => 'large'
        ),
        array(
            'name'      => __( 'Huge', 'campaignmaster' ),
            'size'      => 40,
            'slug'      => 'huge'
        )
    ) );

}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});
