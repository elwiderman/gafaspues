<?php
// enqueue scripts


add_action('wp_enqueue_scripts', 'gafas_theme_frontend_js_css', 1000);
function gafas_theme_frontend_js_css() {

    $path = get_template_directory_uri();

    // Load site libs js files in footer
    wp_deregister_script('bootstrap'); // to prevent clash with plugins calling bootstrap 3 or 4

    wp_enqueue_script('site-scripts', $path . gafas_get_hashed_assets('js/app.js'), '', '', false);

    if (is_front_page()) {
        wp_enqueue_script('home-scripts', $path . gafas_get_hashed_assets('js/home.js'), '', '', false);
        wp_enqueue_style('home-css', $path . gafas_get_hashed_assets('scss/home.scss'), array(), '', 'all');
    }

    if (is_product()) {
        wp_enqueue_script('woo-formula-scripts', $path . gafas_get_hashed_assets('js/wooFormula.js'), '', '', false);
        wp_enqueue_style('prod-single-css', $path . gafas_get_hashed_assets('scss/single-product.scss'), array(), '', 'all');

        wp_localize_script('woo-formula-scripts', 'WPURLS', array(
            'ajaxurl'       => admin_url('admin-ajax.php'),
            'cart_nonce'    => wp_create_nonce('update_cart_nonce'),
        ));
    }

    if (is_cart() || is_checkout()) {
        wp_enqueue_style('cart-checkout-css', $path . gafas_get_hashed_assets('scss/cart-checkout.scss'), array(), '', 'all');
    }

    if (is_shop() || is_tax(['product_cat', 'product_brand', 'yith_shop_vendor'])) {
        wp_enqueue_style('shop-css', $path . gafas_get_hashed_assets('scss/shop.scss'), array(), '', 'all');
    }

    if (is_account_page()) {
        wp_enqueue_style('myaccount-css', $path . gafas_get_hashed_assets('scss/woo-account.scss'), array(), '', 'all');
    }

    if (is_page_template('templates/page-helpers.php')) {
        wp_enqueue_style('helpers-css', $path . gafas_get_hashed_assets('scss/helpers.scss'), array(), '', 'all');
    }

    if (is_page_template('templates/page-become-vendor.php')) {
        wp_enqueue_style('vendor-css', $path . gafas_get_hashed_assets('scss/vendor.scss'), array(), '', 'all');
    }

    if (is_page_template('templates/page-contact.php')) {
        wp_enqueue_style('contact-css', $path . gafas_get_hashed_assets('scss/contact.scss'), array(), '', 'all');
    }


    // the stylesheets
    global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    // Register main stylesheet
    wp_enqueue_style('common-css', $path . gafas_get_hashed_assets('scss/common.scss'), array(), '', 'all');
    // wp_enqueue_style('site-css', $path . gafas_get_hashed_assets('scss/app.scss'), array(), '', 'all');
}


add_action('admin_enqueue_scripts', 'gafas_admin_admin_js_css');
function gafas_admin_admin_js_css($hook) {
    $path = get_template_directory_uri();
    // echo '<pre style="margin:100px 0 0 240px;">';
    // var_dump($hook);
    // echo '</pre>';

    $hook_array = array(
        'toplevel_page_gafas-pedidos',
        'admin_page_gafas-pedido'
    );
    
    $localized_scripts  = [
        'ajaxurl'           => admin_url('admin-ajax.php')
    ];
    
    if (in_array($hook, $hook_array)) {
        $localized_scripts['vendor_orders'] = admin_url('admin-ajax.php?action=gafas_vendor_orders_dt');

        wp_enqueue_script('admin-scripts', $path . gafas_get_hashed_assets('js/admin.js'), '', '', false);
        wp_localize_script('admin-scripts', 'wpurls', $localized_scripts);
        
        wp_enqueue_style('admin-css', $path . gafas_get_hashed_assets('scss/admin.scss'), array(), '', 'all');
    }
}


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

function gafas_get_hashed_assets($real_file) {
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