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
    if (!is_admin() && $query->is_main_query() && is_shop()) {
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
    }
}


// allow only one product to be added to the cart at once 
add_filter('woocommerce_is_sold_individually', 'gafas_remove_all_quantity_fields', 10, 2 );
function gafas_remove_all_quantity_fields($return, $product) {
    return true;
}




// creating custom product type
// #1 Add New Product Type to Select Dropdown
add_filter( 'product_type_selector', 'bbloomer_add_custom_product_type' );
function bbloomer_add_custom_product_type( $types ){
    $types['montura'] = 'Montura';
    return $types;
}

// #2 Add New Product Type Class
add_action( 'init', 'bbloomer_create_custom_product_type' );
function bbloomer_create_custom_product_type(){
    class WC_Product_Montura extends WC_Product {
        public function get_type() {
            return 'montura';
        }
    }
}

// #3 Load New Product Type Class
add_filter( 'woocommerce_product_class', 'bbloomer_woocommerce_product_class', 10, 2 );
function bbloomer_woocommerce_product_class( $classname, $product_type ) {
    if ( $product_type == 'montura' ) {
        $classname = 'WC_Product_Montura';
    }
    return $classname;
}

// #4 Show Product Data General Tab Prices
// Hide Other Product Data Tabs and add the custom connected lens tab
add_filter( 'woocommerce_product_data_tabs', 'gafas_modify_custom_admin_product_tabs', 9999 );
function gafas_modify_custom_admin_product_tabs($tabs) {

    $tabs['inventory']['class'][] = 'show_if_montura';
    // $tabs['attribute']['class'][] = 'show_if_montura';

    // custom tab
    $tabs['connected-lens'] = array(
        'label'     => __('Monturas Info', 'gafas'),
        'target'    => 'lens_product_data',
        'class'     => ['show_if_montura', 'hide_if_variable', 'hide_if_grouped'],
        'priority'  => 21
    );

    return $tabs;
}

add_action( 'woocommerce_product_data_panels', 'bbloomer_custom_product_type_show_price' );
function bbloomer_custom_product_type_show_price() {
    wc_enqueue_js("
        $(document.body).on('woocommerce-product-type-change', function(event,type) {
            if (type=='montura') {
                console.log('montura selected');
                $('.general_tab').show().trigger('click');
                $('.pricing').show();
                $('#inventory_product_data ._manage_stock_field').addClass('show_if_montura').show();
                $('#inventory_product_data .inventory_sold_individually').addClass('show_if_montura').show().find('._sold_individually_field').addClass('show_if_montura').show();
            }
        });
    ");
    global $product_object;
    if ($product_object && 'montura' === $product_object->get_type()) {
        wc_enqueue_js("
            console.log('montura');
            $('.general_tab').show().trigger('click');
            $('.pricing').show();
            $('#inventory_product_data ._manage_stock_field').addClass('show_if_montura').show();
            $('#inventory_product_data .inventory_sold_individually').addClass('show_if_montura').show().find('._sold_individually_field').addClass('show_if_montura').show();
        ");


        

    }
    // add the custom html for the montura product type
    echo '<div id="lens_product_data" class="panel woocommerce_options_panel">
    <div class="options_group lens-content show_if_montura"></div></div>
    <style>
        #lens_product_data label {
            float: unset;
            width: unset;
        }
        #woocommerce-product-data ul.wc-tabs li.connected-lens_options a::before {
            content: "\f177";
        } 
    </style>
    ';
}

add_action('admin_footer', 'custom_admin_product_tab_content_js');
function custom_admin_product_tab_content_js() {
    global $typenow, $pagenow;

    if( in_array($pagenow, ['post.php', 'post-new.php']) && 'product' === $typenow ) : 
    
    $field_group_key = 'group_677b2ffae2d5b'; // <== HERE define the ACF field group key
    ?>
    <script>
    jQuery(function($){
        const fieldGroup = '<?php echo $field_group_key; ?>', 
              fieldGroupID = '#acf-'+fieldGroup,
              fieldGroupHtml = $(fieldGroupID+' .acf-fields').html();
        $(fieldGroupID).remove();

        $('#lens_product_data > .lens-content').css('padding', '0 20px').html(fieldGroupHtml);
    });
    </script>
    <?php endif;
}


// #5 Show Add to Cart Button 
add_action('woocommerce_montura_add_to_cart' , function() {
    do_action('woocommerce_simple_add_to_cart');
});