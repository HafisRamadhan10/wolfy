<?php

# =============================================================================================
# =                                          ACF Blocks                                      =
# = https://www.advancedcustomfields.com/blog/acf-5-8-introducing-acf-blocks-for-gutenberg/  =
# = https://www.advancedcustomfields.com/resources/acf_register_block/                       =
# =============================================================================================

//Block Jumbo Header
add_action('acf/init', 'my_acf_init');
function my_acf_init() {
    if( function_exists('acf_register_block') ) {
        acf_register_block(array(
            'name'              => 'banners',
            'title'             => __('Banners'),
            'description'       => __('Banners'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'formatting',
            'icon' => array(
                'background' => '#ededed',
                'foreground' => '#5e5e5e',
                'src' => 'format-image',
            ),
            'keywords' => array( 'banner' ),
            'mode' => 'edit',
            'align' => 'full',
            'supports' => array(
                //'align' => array('full'),
                'align' => [ 'center', 'full' ],
                'mode' => 'edit',
            ),
        ));

        acf_register_block(array(
            'name'              => 'accordions',
            'title'             => __('Accordions'),
            'description'       => __('Accordions'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'formatting',
            'icon' => array(
                'background' => '#ededed',
                'foreground' => '#5e5e5e',
                'src' => 'admin-links',
            ),
            'keywords' => array( 'accordion', 'faq' ),
            'mode' => 'preview',
            'align' => 'full',
            'supports' => array(
                'align' => false,
                'mode' => 'edit',
            ),
        ));

        acf_register_block(array(
            'name'              => 'quoteCarousel',
            'title'             => __('Quote Carousel'),
            'description'       => __('Quote Carousel'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'formatting',
            'icon' => array(
                'foreground' => '#5e5e5e',
                'src' => 'admin-settings',
            ),
            'keywords' => array( 'quote', 'carousel' ),
            'mode' => 'preview',
            'align' => 'full',
            'supports' => array(
                'align' => false,
                'mode' => 'edit',
            ),
        ));

        acf_register_block(array(
            'name'              => 'callToAction',
            'title'             => __('Call to Action'),
            'description'       => __('Call to Action'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'formatting',
             'icon' => array(
                'background' => '#ededed',
                'foreground' => '#5e5e5e',
                'src' => 'megaphone',
            ),
            'keywords' => array( 'cta', 'call to action' ),
            'mode' => 'preview',
            'align' => 'full',
            'supports' => array(
                'align' => false,
                'mode' => 'edit',
            ),
        ));

        acf_register_block(array(
            'name'              => 'upcomingEvent',
            'title'             => __('Upcoming Event'),
            'description'       => __('Upcoming Event'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'formatting',
            'icon' => array(
                'foreground' => '#5e5e5e',
                'src' => 'admin-settings',
            ),
            'keywords' => array( 'events', 'upcoming' ),
            'mode' => 'preview',
            'align' => 'full',
            'supports' => array(
                'align' => false,
                'mode' => 'edit',
            ),
        ));

        acf_register_block(array(
            'name'              => 'socialmedia',
            'title'             => __('Social Media'),
            'description'       => __('Social Media'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'formatting',
            'icon' => array(
                'foreground' => '#5e5e5e',
                'src' => 'admin-settings',
            ),
            'keywords' => array( 'social', 'media' ),
            'mode' => 'preview',
            'align' => 'full',
            'supports' => array(
                'mode' => 'preview',
            ),
        ));

        acf_register_block(array(
            'name'              => 'latestpost',
            'title'             => __('Latest Post'),
            'description'       => __('Latest Post'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'formatting',
            'icon' => array(
                'foreground' => '#5e5e5e',
                'src' => 'admin-settings',
            ),
            'keywords' => array( 'latest', 'post', 'featured' ),
            'mode' => 'preview',
            'align' => 'full',
            'supports' => array(
                'mode' => 'preview',
            ),
        ));

        acf_register_block(array(
            'name'              => 'experience',
            'title'             => __('Experience'),
            'description'       => __('Experience'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'formatting',
            'icon' => array(
                'background' => '#ededed',
                'foreground' => '#5e5e5e',
                'src' => 'format-image',
            ),
            'keywords' => array( 'experience' ),
            'mode' => 'edit',
            'align' => 'full',
            'supports' => array(
                'mode' => 'edit',
            ),
        ));

        acf_register_block(array(
            'name'              => 'surroundingtabs',
            'title'             => __('Surrounding Tabs'),
            'description'       => __('Surrounding Tabs'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'formatting',
            'icon' => array(
                'background' => '#ededed',
                'foreground' => '#5e5e5e',
                'src' => 'format-image',
            ),
            'keywords' => array( 'surroundingtabs' ),
            'mode' => 'edit',
            'align' => 'full',
            'supports' => array(
                'mode' => 'edit',
            ),
        ));

        acf_register_block(array(
            'name'              => 'location',
            'title'             => __('Location'),
            'description'       => __('Location'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'formatting',
            'icon' => array(
                'background' => '#ededed',
                'foreground' => '#5e5e5e',
                'src' => 'format-image',
            ),
            'keywords' => array( 'location' ),
            'mode' => 'edit',
            'align' => 'full',
            'supports' => array(
                'mode' => 'edit',
            ),
        ));
    }
}

/*----------  Render Blocks  ----------*/

function my_acf_block_render_callback( $block ) {

    // convert name ("acf/blockName") into path friendly slug ("blockName")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "template-parts/block" folder
    if( file_exists(STYLESHEETPATH . "/views/partials/block/content-{$slug}.php") ) {
        include( STYLESHEETPATH . "/views/partials/block/content-{$slug}.php" );
    }
}
