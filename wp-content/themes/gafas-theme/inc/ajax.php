<?php

add_action('wp_ajax_gafas_render_lens_variations', 'gafas_render_lens_variations');
add_action('wp_ajax_nopriv_gafas_render_lens_variations', 'gafas_render_lens_variations');

function gafas_render_lens_variations() {
    // wp_send_json_success($_POST);
    $frame_id   = $_POST['frame_id'];
    $lens_type  = $_POST['lens_type'];
    $lens_tint  = $_POST['lens_tint'];
    $category_args = [];

    if ($lens_type) {
        array_push($category_args, $lens_type);
    }
    if ($lens_tint) {
        array_push($category_args, $lens_tint);
    }

    // get the lens connected 
    $connected_lens = get_field('prod_lens_relation', $frame_id);
    
    // get all the lens with the selected lens type and tint
    $all_lenses_with_cats = new WC_Product_Query([
        'limit'     => -1,
        'return'    => 'ids',
        'category'  => $category_args
    ]);

    // the common between the connected lens and all lenses within the current cats will be visible
    $active_products = array_intersect($connected_lens, $all_lenses_with_cats->get_products());

    // get the values and just return the type of power added to determine the prices of the lens to create the variations
    // for esf
    $left_esf = preg_replace('/[+-]/', '', $_POST['left_esf']);
    $right_esf = preg_replace('/[+-]/', '', $_POST['right_esf']);

    if ((float)$left_esf > 4 || (float)$right_esf > 4) {
        $esf    = 'greater-4';
    } else {
        $esf    = 'standard';
    }

    // for cil
    $left_cil = preg_replace('/[+-]/', '', $_POST['left_cil']);
    $right_cil = preg_replace('/[+-]/', '', $_POST['right_cil']);

    if ((float)$left_cil > 2 || (float)$right_cil > 2) {
        $cil    = 'greater-2';
    } else {
        $cil    = 'standard';
    }

    // for add
    $left_add = preg_replace('/[+-]/', '', $_POST['left_add']);
    $right_add = preg_replace('/[+-]/', '', $_POST['right_add']);

    if ((float)$left_add > 0.75 || (float)$right_add > 0.75) {
        $add    = 'greater-075';
    } else {
        $add    = 'standard';
    }

    // create the attributes
    $attributes = [
        'attribute_pa_esferico'     => $esf,
        'attribute_pa_cilindro'     => $cil,
        'attribute_pa_adicion'      => $add
    ];

    // if lens_type is senllio or solo-para-descanso remove attribute for adicion
    if (in_array($lens_type, ['sensillo', 'solo-para-descanso'])) {
        unset($attributes['attribute_pa_adicion']);
    }

    $variations = [];

    if ($active_products) {
        foreach ($active_products as $prod) {
            $product        = wc_get_product($prod);
            $prod_title     = $product->get_name();
            $prod_desc      = $product->get_description();

            $variation_id   = $product->get_matching_variation($attributes);
            $var_prod       = wc_get_product($variation_id);
            $price          = $var_prod->get_price();
            $price_html     = $var_prod->get_price_html();

            array_push($variations, [
                'lens_id'       => $prod,
                'lens_name'     => $prod_title,
                'lens_desc'     => $prod_desc,
                'lens_children' => $product->get_available_variations(),
                'variation'     => $variation_id,
                'price'         => $price,
                'price_html'    => $price_html
            ]);
        }
    }

    $formula    = [
        'left_esf'      => $_POST['left_esf'],
        'right_esf'     => $_POST['right_esf'],
        'left_cil'      => $_POST['left_cil'],
        'right_cil'     => $_POST['right_cil'],
        'left_eje'      => $_POST['left_eje'],
        'right_eje'     => $_POST['right_eje'],
        'left_add'      => $_POST['left_add'],
        'right_add'     => $_POST['right_add'],
        'dp'            => $_POST['dp']
    ];

    wp_send_json([
        'results'   => $variations,
        'formula'   => $formula
    ]);
}



add_action('wp_ajax_gafas_add_lens_config_to_cart', 'gafas_add_lens_config_to_cart');
add_action('wp_ajax_nopriv_gafas_add_lens_config_to_cart', 'gafas_add_lens_config_to_cart');
function gafas_add_lens_config_to_cart() {
    // wp_send_json($_POST);
    
    global $woocommerce;
    $lens_item = '';
    // empty cart
    WC()->cart->empty_cart();

    if ($_POST['frame_id']) {
        WC()->cart->add_to_cart($_POST['frame_id'], 1);
    }
    if ($_POST['lens_id']) {
        $lens_item = WC()->cart->add_to_cart(
            $_POST['lens_id'],
            1,
            $_POST['variation_id'],
            null,
            [
                'left_esf'  => $_POST['left_esf'],
                'right_esf' => $_POST['right_esf'],
                'left_cil'  => $_POST['left_cil'],
                'right_cil' => $_POST['right_cil'],
                'left_eje'  => $_POST['left_eje'],
                'right_eje' => $_POST['right_eje'],
                'left_add'  => $_POST['left_add'],
                'right_add' => $_POST['right_add'],
                'dp'        => $_POST['dp'],
            ]
        );
    }

    // $meta = '';

    // foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
    //     $meta = wc_get_formatted_cart_item_data( $cart_item );

    //     if ($cart_item_key === $lens_item) {
    //         $cart_item['variation'] = '';
    //     }
    // }

    if (WC()->cart->get_cart_contents_count() > 0) {

        
        $cart_link = add_query_arg([
            'custom'    => true
        ], wc_get_cart_url());
        wp_send_json([
            'count' => WC()->cart->get_cart_contents_count(),
            'cart'  => $cart_link,
            // 'meta'  => $meta,
            'cartdata' => WC()->cart->get_cart(),
            'lensitme' => $lens_item
        ]);
    }
}


add_filter('woocommerce_get_item_data', 'custom_display_cart_item_data', 10, 2);
function custom_display_cart_item_data($item_data, $cart_item) {
    // Check if the product has variations
    if (isset($cart_item['variation']) && is_array($cart_item['variation'])) {
        foreach ($item_data as $key => $data) {
            if (array_key_exists($data['key'], $cart_item['variation'])) {
                unset($item_data[$key]); // Remove the variation attribute from the displayed meta
            }
        }
    }

    if (isset($cart_item['right_esf'])) {
        $item_data[] = [
            'name'  => __('Ojo Der. ESF.', 'gafas'),
            'value' => wc_clean($cart_item['right_esf']),
        ];
    }
    if (isset($cart_item['left_esf'])) {
        $item_data[] = [
            'name'  => __('Ojo Izq. ESF.', 'gafas'),
            'value' => wc_clean($cart_item['left_esf']),
        ];
    }

    if (isset($cart_item['right_cil'])) {
        $item_data[] = [
            'name'  => __('Ojo Der. CIL.', 'gafas'),
            'value' => wc_clean($cart_item['right_cil']),
        ];
    }
    if (isset($cart_item['left_cil'])) {
        $item_data[] = [
            'name'  => __('Ojo Izq. CILL.', 'gafas'),
            'value' => wc_clean($cart_item['left_cil']),
        ];
    }

    if (isset($cart_item['right_eje'])) {
        $item_data[] = [
            'name'  => __('Ojo Der. EJE.', 'gafas'),
            'value' => wc_clean($cart_item['right_eje']),
        ];
    }
    if (isset($cart_item['left_eje'])) {
        $item_data[] = [
            'name'  => __('Ojo Izq. EJE.', 'gafas'),
            'value' => wc_clean($cart_item['left_eje']),
        ];
    }

    if (isset($cart_item['right_add'])) {
        $item_data[] = [
            'name'  => __('Ojo Der. ADD.', 'gafas'),
            'value' => wc_clean($cart_item['right_add']),
        ];
    }
    if (isset($cart_item['left_add'])) {
        $item_data[] = [
            'name'  => __('Ojo Izq. ADD.', 'gafas'),
            'value' => wc_clean($cart_item['left_add']),
        ];
    }

    if (isset($cart_item['dp'])) {
        $item_data[] = [
            'name'  => __('Distancia Pupilar', 'gafas'),
            'value' => wc_clean($cart_item['dp']),
        ];
    }    
    return $item_data;
}

add_filter('woocommerce_cart_item_rest_response', 'hide_variable_attributes_for_cart_block', 10, 2);
function hide_variable_attributes_for_cart_block($response, $cart_item) {
    // Remove variation attributes from the REST API response
    if (isset($response['variation']) && is_array($response['variation'])) {
        unset($response['variation']);
    }

    return $response;
}



add_action('woocommerce_checkout_create_order_line_item', 'custom_save_cart_meta_to_order', 10, 4);
function custom_save_cart_meta_to_order($item, $cart_item_key, $values, $order) {    
    if (isset($values['left_esf'])) {
        $item->add_meta_data(__('Oje Izq. ESF.', 'gafas'), $values['left_esf']);
    }
    if (isset($values['right_esf'])) {
        $item->add_meta_data(__('Oje Der. ESF.', 'gafas'), $values['right_esf']);
    }
    
    if (isset($values['left_cil'])) {
        $item->add_meta_data(__('Oje Izq. CIL.', 'gafas'), $values['left_cil']);
    }
    if (isset($values['right_cil'])) {
        $item->add_meta_data(__('Oje Der. CIL.', 'gafas'), $values['right_cil']);
    }

    if (isset($values['left_eje'])) {
        $item->add_meta_data(__('Oje Izq. EJE.', 'gafas'), $values['left_eje']);
    }
    if (isset($values['right_eje'])) {
        $item->add_meta_data(__('Oje Der. EJE.', 'gafas'), $values['right_eje']);
    }
    
    if (isset($values['left_add'])) {
        $item->add_meta_data(__('Oje Izq. ADD.', 'gafas'), $values['left_add']);
    }
    if (isset($values['right_add'])) {
        $item->add_meta_data(__('Oje Der. ADD.', 'gafas'), $values['right_add']);
    }

    if (isset($values['dp'])) {
        $item->add_meta_data(__('Distancia Pupilar', 'gafas'), $values['dp']);
    }
}