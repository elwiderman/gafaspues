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


// customize woocommerce form fields for the vendor regn page
add_filter('woocommerce_form_field', 'gafas_custom_woocommerce_form_field', 10, 4);
function gafas_custom_woocommerce_form_field($field, $key, $args, $value) {
    // segregating the classes needed for the display of the form
    $form_group_class   = [];
    $form_control_class = [];
    foreach ($args['class'] as $cls) {
        switch ($cls) {
            case 'form-row-wide':
                array_push($form_group_class, 'col-12');
                break;

            case 'form-row-first':
                array_push($form_group_class, 'col-12 col-md-6');
                break;

            case 'form-row-last':
                array_push($form_group_class, 'col-12 col-md-6');
                break;

            case 'validate-required':
                array_push($form_control_class, 'validate-required');
                break;
        }
    }

    $required = ($args['required']) ? '<span class="required">*</span>' : '';

    // Start custom field wrapper
    $custom_field = '<div class="form-group ' . implode(' ', $form_group_class) . ' ' . esc_attr($args['type']) . ' ' . esc_attr($key) . '">';

    // Add custom label
    if (!empty($args['label'])) {
        $custom_field .= '<label class="form-label" for="' . esc_attr($key) . '">' . esc_html($args['label']) . $required . '</label>';
    }

    // Add input field
    switch ($args['type']) {
        case 'text':
        case 'email':
        case 'password':
        case 'tel':
        case 'number':
            $custom_field .= '<input type="' . esc_attr($args['type']) . '" 
                name="' . esc_attr($key) . '" 
                id="' . esc_attr($key) . '" 
                class="form-control ' . implode(' ', $form_control_class) . '" 
                placeholder="' . esc_attr($args['placeholder']) . '" 
                value="' . esc_attr($value) . '" />';
            break;

        case 'textarea':
            $custom_field .= '<textarea name="' . esc_attr($key) . '" 
                id="' . esc_attr($key) . '" 
                class="form-control ' . implode(' ', $form_control_class) . '" 
                placeholder="' . esc_attr($args['placeholder']) . '">' . esc_textarea($value) . '</textarea>';
            break;

        case 'select':
            $custom_field .= '<select name="' . esc_attr($key) . '" id="' . esc_attr($key) . '" class="form-select ' . implode(' ', $form_control_class) . '">';
            foreach ($args['options'] as $option_key => $option_value) {
                $selected = ($value == $option_key) ? 'selected="selected"' : '';
                $custom_field .= '<option value="' . esc_attr($option_key) . '" ' . $selected . '>' . esc_html($option_value) . '</option>';
            }
            $custom_field .= '</select>';
            break;

        case 'checkbox':
            $checked = checked($value, 1, false);
            $custom_field .= '
            <div class="form-check">
                <input type="checkbox" name="'.esc_attr($key).'" id="'.esc_attr($key).'" class="form-check-input" value="1" ' . $checked . ' />
                <label class="form-check-label" for="'.esc_attr($key).'">'.$args['label'].'</label>
            </div>';
            break;

        case 'radio':
            if (!empty($args['options'])) {
                $i = 0;
                foreach ($args['options'] as $option_key => $option_value) {
                    $custom_field .= "<div class='form-check form-check-inline'>";
                    $i++;
                    $id            = $args['name'] . "-{$i}";
                    $checked       = checked($value, $option_key, false);
                    $custom_field .= 
                    '
                    <input class="form-check-input" type="radio" name="' . esc_attr($key) . '" id="'.$id.'" value="'.esc_attr($option_key).'" '.$checked.'>
                    <label class="form-check-label" for="'.$id.'">'.esc_html($option_value).'</label>';
                    $custom_field .= "</div>";
                }
            }
            break;
    }

    // Add description (if any)
    if (!empty($args['description'])) {
        $custom_field .= '<p class="custom-description">' . $args['description'] . '</p>';
    }

    // End custom field wrapper
    $custom_field .= '</div>';

    return $custom_field;
}



// hide specific items from the product meta 
add_filter('woocommerce_get_item_data', 'gafas_hide_specific_cart_meta', 10, 2);
function gafas_hide_specific_cart_meta($item_data, $cart_item) {
    $meta_keys_to_hide = ['Esferico', 'Cilindro', 'Adicional']; // Add meta keys to hide

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