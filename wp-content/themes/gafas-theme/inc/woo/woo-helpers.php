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



//  add_filter('woocommerce_hidden_order_itemmeta', function($meta) {
//     // $meta[] = 'op_item_details';
//     echo '<pre>';
//     var_dump($meta);
//     echo '</pre>';

//     return $meta;
//  },101,1);





// register custom product type Lentes - this is similar to variable product

// #1 Add New Product Type to Select Dropdown
// add_filter( 'product_type_selector', 'bbloomer_add_custom_product_type' );
// function bbloomer_add_custom_product_type( $types ){
//     $types['lente'] = 'Lente';
//     return $types;
// }


// // #2 Add New Product Type Class
// add_action( 'init', 'bbloomer_create_custom_product_type' );
// function bbloomer_create_custom_product_type(){
//     class WC_Product_Lente extends WC_Product_Variable {
//         public function get_type() {
//             return 'lente';
//         }
//     }

//     // class WC_Product_Lente extends WC_Product_Variable {
//     //     public function __construct($product) {
//     //         parent::__construct($product);
//     //         $this->product_type = 'lente';
//     //     }
//     // }
// }

// // #3 Load New Product Type Class
// add_filter( 'woocommerce_product_class', 'bbloomer_woocommerce_product_class', 10, 2 );
// function bbloomer_woocommerce_product_class( $classname, $product_type ) {
//     if ( $product_type == 'lente' ) {
//         $classname = 'WC_Product_Lente';
//     }
//     return $classname;
// }

// add_filter('woocommerce_product_data_tabs', 'enable_variation_tab_for_custom_variable');
// function enable_variation_tab_for_custom_variable($tabs) {
//     if (isset($tabs['variations'])) {
//         $tabs['variations']['class'][] = 'show_if_lente';
//     }
//     if (isset($tabs['inventory'])) {
//         $tabs['inventory']['class'][] = 'show_if_lente';
//     }
//     return $tabs;
// }

// function producttype_custom_js() {

// if ( 'product' != get_post_type() ) :
//     return;
// endif;

// } 

// add_action( 'admin_footer', 'producttype_custom_js' );



// // #5 Show Add to Cart Button
 
// add_action( "woocommerce_lente_add_to_cart", function() {
//     // do_action( 'woocommerce_lente_add_to_cart' );
// });

// // add_action('wp_enqueue_scripts', 'enqueue_lens_product_scripts');
// function enqueue_lens_product_scripts() {
//     if (is_product()) {
//         wp_enqueue_script('wc-add-to-cart-variation');
//     }
// }




add_action('init', 'register_lente_product_type');
function register_lente_product_type() {
    // class WC_Product_Lente extends WC_Product_Variable {
    //     public function __construct($product) {
    //         parent::__construct($product);
    //         $this->product_type = 'lente';
    //     }
    // }

    class WC_Product_Lente extends WC_Product_Variable {
        public function get_type() {
            return 'lente';
        }
    }
}

add_filter('product_type_selector', 'add_lente_product_type');
function add_lente_product_type($types) {
    $types['lente'] = __('Lente', 'woocommerce');
    return $types;
}

add_filter('woocommerce_product_class', 'set_lente_product_class', 10, 2);
function set_lente_product_class($classname, $product_type) {
    if ($product_type === 'lente') {
        return 'WC_Product_Lente';
    }
    return $classname;
}

add_filter('woocommerce_product_data_tabs', 'enable_variation_tab_for_custom_variable');
function enable_variation_tab_for_custom_variable($tabs) {
    // if (isset($tabs['variations'])) {
    //     $tabs['variations']['class'][] = 'show_if_variable show_if_lente';
    // }
    // if (isset($tabs['inventory'])) {
    //     $tabs['inventory']['class'][] = 'show_if_variable show_if_lente';
    // }

    array_push($tabs['attribute']['class'], 'show_if_variable show_if_lente');
    array_push($tabs['variations']['class'], 'show_if_lente');
    array_push($tabs['inventory']['class'], 'show_if_lente');
    return $tabs;
}

add_action( 'admin_footer', 'producttype_custom_js' );
function producttype_custom_js() {
    if ( 'product' != get_post_type() ) :
        return;
    endif;

    ?>
    
    <?php
    
    global $product_object;
    if ($product_object && $product_object->get_type() === 'lente') {
        wc_enqueue_js("
            $('body').on('woocommerce_added_attribute', function(event) {
                console.log(event);
                $('.woocommerce_attribute_data .enable_variation').addClass('show_if_lente').show();
            });

            $('.enable_variation').addClass('show_if_lente').show();
            $('#inventory_product_data ._manage_stock_field').addClass('show_if_lente').show();
            $('#inventory_product_data ._stock_status_field').addClass('hide_if_lente').hide();
            $('#inventory_product_data ._sold_individually_field').parent().addClass('show_if_lente').show();
            $('#inventory_product_data ._sold_individually_field').addClass('show_if_lente').show();
        ");
    }
} 


// add_action('wp_enqueue_scripts', 'enqueue_lente_variation_scripts');
function enqueue_lente_variation_scripts() {
    if (is_product()) {
        wp_enqueue_script('wc-add-to-cart-variation');
    }
}


add_action('woocommerce_lente_add_to_cart',  'lente_add_to_cart');
function lente_add_to_cart() {
    // wc_get_template('single-product/add-to-cart/lente.php', [], '', get_stylesheet_directory() . '/woocommerce/');
    // wc_get_template

    global $product;

    // Enqueue variation scripts.
    wp_enqueue_script( 'wc-add-to-cart-variation' );

    // Get Available variations?
    $get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

    echo '<pre>';
    var_dump($product);
    echo '</pre>';

    // Load the template.
    wc_get_template(
        'single-product/add-to-cart/lente.php',
        array(
            'available_variations' => $get_variations ? $product->get_available_variations() : false,
            'attributes'           => $product->get_variation_attributes(),
            'selected_attributes'  => $product->get_default_attributes(),
        )
    );
}

// add_action( "woocommerce_lente_add_to_cart", function() {
//     do_action( 'woocommerce_variable_add_to_cart' );
// });