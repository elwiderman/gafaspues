<?php
/*
Plugin Name: YITH WooCommerce Multi Vendor Remove "Sold By" from everywhere
Plugin URI: http://yithemes.com/themes/plugins/yith-woocommerce-product-vendors/
Description: Remove sold by information from everywhere. Required: YITH WooCommerce Multi Vendor Premium
Author: YITHEMES
Version: 1.0.0
Author URI: http://yithemes.com/
*/
/*
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly 

add_action( 'init', 'yith_wcmv_remove_show_sold_by_action', 30 );

if( ! function_exists( 'yith_wcmv_remove_show_sold_by_action' ) ){
    function yith_wcmv_remove_show_sold_by_action(){
        if( function_exists( 'YITH_Vendors' ) ){
            /**
             * Disable plugin options
             */
            $options = array(
                'yith_wpv_vendor_name_in_loop',
                'yith_wpv_vendor_name_in_single',
                'yith_wpv_vendor_name_in_categories',
                'yith_wpv_vendor_name_in_store'
            );

            foreach( $options as $option ){
                add_filter( "pre_option_{$option}", '__return_false', 99 );
            }

            $frontend = YITH_Vendors()->frontend;

            if( ! empty( $frontend ) ){
                remove_action( 'woocommerce_after_shop_loop_item', array( $frontend, 'woocommerce_template_vendor_name' ), 6  );
                remove_action( 'woocommerce_single_product_summary', array( $frontend, 'woocommerce_template_vendor_name' ), 5 );
                remove_filter( 'wp_enqueue_scripts', array( $frontend, 'vendor_name_style' ), 20 );
                remove_filter( 'woocommerce_cart_item_name', array( $frontend, 'add_sold_by_vendor' ), 10, 3 );
                remove_filter( 'woocommerce_order_item_name', array( $frontend, 'add_sold_by_vendor' ), 10, 3 );

                // the following hides the sold by info
                remove_filter( 'woocommerce_get_item_data', array( $frontend, 'add_sold_by_vendor_to_item_data' ), 10, 3 );
            }
        }
    }
}