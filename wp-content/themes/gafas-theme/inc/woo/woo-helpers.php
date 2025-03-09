<?php
/* helper functions for woo only */


// check if the product is in the monturas category
function gafas_is_prod_in_monturas($product_id) {
    $flag           = false;
    $prod_cats      = get_the_terms($product_id, 'product_cat');
    if ($prod_cats) {
        $slugs      = wp_list_pluck($prod_cats, 'slug');

        if (in_array('monturas', $slugs)) {
            $flag   = true;
        }
    }

    return $flag;
}

// generating select options for the formula
function generateSelectOptions($min, $max, $step, $decimal_places) {
    $options = '';
    for ($value = $min; $value <= $max; $value += $step) {
        $formatted_value = $value;
        $sign = '';
        // format the value to the decimal places if present the in the fuction call
        if ($decimal_places > 0) {
            $formatted_value = number_format($value, $decimal_places);
            $sign = ($value > 0) ? '+' : ''; // Add "+" sign for positive values
        }

        $selected = ($value == 0) ? 'selected' : '';

        $options .= "<option value='{$formatted_value}' {$selected}>{$sign}{$formatted_value}</option>";
    }
    return $options;
}


// add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );

add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );
add_filter( 'woocommerce_is_attribute_in_product_name', '__return_false' );


/**
 * @snippet       Hide ALL shipping rates in ALL zones when Free Shipping is available
 * @how-to        businessbloomer.com/woocommerce-customization
 * @author        Rodolfo Melogli, Business Bloomer
 * @compatible    WooCommerce 6
 * @community     https://businessbloomer.com/club/
 */
  
add_filter( 'woocommerce_package_rates', 'gafas_unset_shipping_when_free_is_available_all_zones', 9999, 2 );
function gafas_unset_shipping_when_free_is_available_all_zones( $rates, $package ) {
    $all_free_rates = array();
    foreach ( $rates as $rate_id => $rate ) {
        if ( 'free_shipping' === $rate->method_id ) {
            $all_free_rates[ $rate_id ] = $rate;
            break;
        }
    }
    if ( empty( $all_free_rates )) {
        return $rates;
    } else {
        return $all_free_rates;
    } 
}

// hide lens product_cat from the archives
add_action('pre_get_posts', 'gafashide_category_products_from_shop');
function gafashide_category_products_from_shop($query) {
    // Check if it's the main query on the shop page
    if (!is_admin() && 
        (
            ($query->is_main_query() && is_shop()) || is_tax()
        )) :
        // Categories to exclude
        $excluded_categories = ['lentes']; // Replace with your category slugs

        // Get the IDs of the categories to exclude
        $excluded_category_ids = [];
        foreach ($excluded_categories as $slug) {
            $term = get_term_by('slug', $slug, 'product_cat');
            if ($term) {
                $excluded_category_ids[] = $term->term_id;
            }
        }

        // Exclude products from these categories
        $tax_query = $query->get('tax_query');
        if (!is_array($tax_query)) {
            $tax_query = [];
        }
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => $excluded_category_ids,
            'operator' => 'NOT IN',
        ];
        $query->set('tax_query', $tax_query);
    endif;
}


// allow only one product to be added to the cart at once 
add_filter('woocommerce_is_sold_individually', 'gafas_remove_all_quantity_fields', 10, 2 );
function gafas_remove_all_quantity_fields($return, $product) {
    return true;
}



// hide virtual and downloadable products 
add_filter('product_type_options', 'gafas_hide_virtual_downloadable_checkboxes');
function gafas_hide_virtual_downloadable_checkboxes($options) {
    // remove "Virtual" checkbox
    if( isset( $options[ 'virtual' ] ) ) {
        unset( $options[ 'virtual' ] );
    }
    // remove "Downloadable" checkbox
    if( isset( $options[ 'downloadable' ] ) ) {
        unset( $options[ 'downloadable' ] );
    }
    return $options;
}


// hide specific items from the product meta 
add_filter('woocommerce_get_item_data', 'gafas_hide_specific_cart_meta', 10, 2);
function gafas_hide_specific_cart_meta($item_data, $cart_item) {
    $meta_keys_to_hide = ['Esferico', 'Cilindro', 'Adicional', 'Lentes - Esferico', 'Lentes - Cilindro', 'Lentes - Adicion']; // Add meta keys to hide

    foreach ($item_data as $key => $meta) {
        if (in_array($meta['key'], $meta_keys_to_hide)) {
            unset($item_data[$key]);
        }
    }

    // take out wpced_date from the $item_data and append it to the end
    $wpced_date = $item_data['wpced_date'];
    unset($item_data['wpced_date']);
    $item_data['wpced_date'] = $wpced_date;

    return $item_data;
}

// hide specific items from the product meta in emails
add_filter('woocommerce_order_item_get_formatted_meta_data', 'gafas_hide_specific_prod_meta_emails', 10, 2);
function gafas_hide_specific_prod_meta_emails($formatted_meta, $item) {
    $hidden_meta_keys = ['Esferico', 'Cilindro', 'Adicional', 'Lentes - Esferico', 'Lentes - Cilindro', 'Lentes - Adicion']; // Add meta keys to hide

    foreach ($formatted_meta as $key => $meta) {
        if (in_array($meta->key, $hidden_meta_keys)) {
            unset($formatted_meta[$key]); // Remove the unwanted meta
        }
    }

    return $formatted_meta;
}


// adding custom order status for managing the doc uploads to the orders
add_filter( 'woocommerce_register_shop_order_post_statuses', 'gafas_register_custom_order_status' );
function gafas_register_custom_order_status( $order_statuses ) {
    // Status must start with "wc-"!
    $order_statuses['wc-readyforshipping'] = array(
        'label'                     => __('Listo para el envío', 'gafas'),
        'public'                    => false,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop('Listo para el envío <span class="count">(%s)</span>', 'Listo para el envío <span class="count">(%s)</span>', 'shady'),
    );
    $order_statuses['wc-ordershipped'] = array(
        'label'                     => __('El pedido se envía', 'gafas'),
        'public'                    => false,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop('El pedido se envía <span class="count">(%s)</span>', 'El pedido se envía <span class="count">(%s)</span>', 'shady'),
    );
   return $order_statuses;
}
// add the statuses to the dropdown
add_filter( 'wc_order_statuses', 'gafas_show_custom_order_status_single_order_dropdown' );
function gafas_show_custom_order_status_single_order_dropdown( $order_statuses ) {
    $order_statuses['wc-readyforshipping']  = __('Listo para el envío', 'gafas');
    $order_statuses['wc-ordershipped']      = __('El pedido se envía', 'gafas');
    return $order_statuses;
}
// add color the custom statuses 
add_action('admin_head', 'gafas_add_custom_wc_status_colors');
function gafas_add_custom_wc_status_colors() {
    echo '<style>
        .status-readyforshipping { background: #d3b3d4 !important; color: #6c306e !important; }
        .status-ordershipped { background: #1E90FF !important; color: #ffffff !important; }
    </style>';
}



// add custom capability to the yith_vendor
add_action('init', function() {
    $role = get_role('yith_vendor');

    if ($role && !$role->has_cap('view_custom_gafas_wc_orders')) {
        $role->add_cap('view_custom_gafas_wc_orders');
    }
});



/* 
    custom email template for sending custom emails
*/
add_filter( 'woocommerce_email_classes', 'gafas_register_wc_custom_email_class' );
function gafas_register_wc_custom_email_class( $email_classes ) {
    // Include the email class file
    include_once 'class-wc-readyforshipping-email.php';
    include_once 'class-wc-ordershipped-email.php';

    // Register the email class
    $email_classes['WC_Order_Ready_To_Ship_Email'] = new WC_Order_Ready_To_Ship_Email();
    $email_classes['WC_Order_Shipped_Email'] = new WC_Order_Shipped_Email();

    return $email_classes;
}
// register this custom email so that WooCommerce recognizes it.
add_filter( 'woocommerce_email_actions', 'gafas_add_wc_custom_email_action' );
function gafas_add_wc_custom_email_action( $email_actions ) {
    $email_actions[] = 'woocommerce_order_status_changed';
    return $email_actions;
}