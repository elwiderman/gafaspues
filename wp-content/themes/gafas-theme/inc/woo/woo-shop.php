<?php
// the functions to override the archive pages 

// post per page for shop
add_filter('loop_shop_per_page', 'gafas_redefine_products_per_page', 9999);
function gafas_redefine_products_per_page($per_page) {
    $per_page = 16;
    return $per_page;
}

// add wrapper to the notices, result count and ordering
add_action('woocommerce_before_shop_loop', 'gafas_open_wrapper_before_shop_loop', 9);
function gafas_open_wrapper_before_shop_loop() {
    echo "<div class='shop-before-loop'>";
}
add_action('woocommerce_before_shop_loop', 'gafas_close_wrapper_before_shop_loop', 31);
function gafas_close_wrapper_before_shop_loop() {
    echo "</div>";
}


// move the breadcrumb in the shop header section before title
add_action('wp', 'gafas_move_breadcrumb_in_shop_header');
function gafas_move_breadcrumb_in_shop_header() {
    if (is_shop() || is_product_category() || is_product_tag()) {
        // Remove the default breadcrumb
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

        // Add breadcrumb before the title
        add_action('woocommerce_archive_description', 'woocommerce_breadcrumb', 5);
    }
    if (is_tax('yith_shop_vendor')) {
        // Remove the default breadcrumb
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    }
}




function gafas_xoo_el_nav_footer_links( $form, $args ){

	?>

	<?php if( $form === 'login' && in_array( 'register' , $args['tabs'] ) && isset( $args['navstyle'] ) && $args['navstyle'] === 'links' ): ?>
		<span class="xoo-el-reg-tgr xoo-el-nav-ft"><?php _e( "Don't have an account? Signup now !!!!!", 'easy-login-woocommerce' ) ?></span>
	<?php endif; ?>

	<?php if( $form === 'register' && in_array( 'login' , $args['tabs'] ) && isset( $args['navstyle'] ) && $args['navstyle'] === 'links' ): ?>
		<span class="xoo-el-login-tgr xoo-el-nav-ft"><?php _e( "Already a member? Login", 'easy-login-woocommerce' ) ?></span>
	<?php endif; ?>


	<?php if( $form === 'lostpw' && isset( $args['navstyle'] ) && $args['navstyle'] === 'links' ): ?>
		<span class="xoo-el-login-tgr xoo-el-nav-ft"><i class="xoo-el-icon-arrow-left2"></i></span>
	<?php endif; ?>

	<?php

}
add_action( 'xoo_el_after_form', 'gafas_xoo_el_nav_footer_links',10, 2 );
remove_action('xoo_el_after_form', 'xoo_el_nav_footer_links');





// function move_order_review_section() {
    // Remove from the default position
    remove_action('woocommerce_checkout_after_order_review', 'woocommerce_checkout_payment');
    // remove_action('woocommerce_checkout_after_order_review');
    
    // Add it after customer details
    // add_action('woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment');
// }
// add_action('wp', 'move_order_review_section');
