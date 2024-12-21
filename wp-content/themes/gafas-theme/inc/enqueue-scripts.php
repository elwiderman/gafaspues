<?php
function adhq_framework_scripts() {

    $path = get_template_directory_uri();

    // Load site libs js files in footer
    wp_deregister_script('bootstrap'); // to prevent clash with plugins calling bootstrap 3 or 4

    wp_enqueue_script('site-scripts', $path . adhq_get_hashed_assets('js/app.js'), '', '', false);

    // the stylesheets
    global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    // Register main stylesheet
    wp_enqueue_style('site-css', $path . adhq_get_hashed_assets('scss/app.scss'), array(), '', 'all');
}

add_action('wp_enqueue_scripts', 'adhq_framework_scripts', 1000);





/**
 * ref - https://danielshaw.co.nz/wordpress-cache-busting-json-hash-map/
 * Serve theme styles via a hashed filename instead of WordPress' default style.css.
 *
 * Checks for a hashed filename as a value in a JSON object.
 * If it exists: the hashed filename is enqueued in place of style.css.
 * Fallback: the default style.css will be passed through.
 *
 * @param string $css is WordPress’ required, known location for CSS: style.css
 */

function adhq_get_hashed_assets($real_file) {
    $map = get_template_directory() . '/dist/parcel-manifest.json';
    static $hash = null;

    if ( null === $hash ) {
        $hash = file_exists( $map ) ? json_decode( file_get_contents( $map ), true ) : [];
    }

    if ( array_key_exists( $real_file, $hash ) ) {
        return '/dist' . $hash[ $real_file ];
    }

    return false;
}