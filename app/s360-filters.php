<?php

namespace App\s360Filters;

/**
 * Close comments on the front-end
 */
add_filter('comments_open', function () {

    return false;

},20,2);

/**
 * Close comments on the front-end
 */
add_filter('pings_open', function () {

    return false;

},20,2);

/**
 * Hide existing comments
 */
add_filter('pings_open', function ( $comments ) {

    $comments = array();
    return $comments;

},10,2);

/**
 * Change WP Admin Footer Text with S360 info
 */
add_filter('admin_footer_text', function ( $default ) {
    //return the new footer text
    return 'Developed by <a href="https://www.strategies360.com">Strategies 360</a>. Please email <a href="mailto:websupport@strategies360.com">websupport@strategies360.com</a> for support.';

});

/**
 * Filter the Gravity Forms button type
 */
add_filter('gform_submit_button', function ($button, $form) {
    return "<button class='button full' id='gform_submit_button_{$form['id']}'><span>Submit</span></button>";
},10,2);

/**
 * Filter Change URL WP Login
 */
add_filter('login_headerurl', function () {
    return home_url('/');
},10,2);

/**
 * Move SEO Framwork meta box to bottom
 */
add_filter( 'the_seo_framework_metabox_priority', function() {
    return 'low'; // Accepts 'high', 'default', 'low'
} );


