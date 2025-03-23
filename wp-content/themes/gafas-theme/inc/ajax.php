<?php

add_action('wp_ajax_gafas_render_lens_variations', 'gafas_render_lens_variations');
add_action('wp_ajax_nopriv_gafas_render_lens_variations', 'gafas_render_lens_variations');

function gafas_render_lens_variations() {
    // wp_send_json_success($_POST);
    $frame_id       = $_POST['frame_id'];

    $lens_type      = $_POST['lens_type'];
    $lens_tint      = $_POST['lens_tint'];
    $category_args  = [
        'relation' => 'AND',
        [
            'taxonomy'      => 'product_cat',
            'field'         => 'slug',
            'terms'         => 'lentes',
            'include_children'  => false,
            'operator'      => 'IN'
        ]
    ];

    // get the vendor tax from the product id to fetch the proper lens configs
    $vendor         = get_the_terms($frame_id, 'yith_shop_vendor')[0];
    if ($vendor) :
        array_push($category_args, [
            'taxonomy'      => 'yith_shop_vendor',
            'field'         => 'slug',
            'terms'         => [$vendor->slug],
            'operator'      => 'IN'
        ]);
    endif;

    if ($lens_type) {
        array_push($category_args, [
            'taxonomy'      => 'lente',
            'field'         => 'slug',
            'terms'         => $lens_type,
            'operator'      => 'IN'
        ]);
    }
    if ($lens_tint) {
        array_push($category_args, [
            'taxonomy'      => 'filtro',
            'field'         => 'slug',
            'terms'         => $lens_tint,
            'operator'      => 'IN'
        ]);
    }

    // get the lens connected 
    // $connected_lens = get_field('prod_lens_relation', $frame_id);
    
    // get all the lens with the selected lens type and tint
    $all_lenses_with_cats = new WC_Product_Query([
        'type'      => 'variable',
        'limit'     => -1,
        'return'    => 'ids',
        'tax_query' => $category_args
    ]);

    // the common between the connected lens and all lenses within the current cats will be visible
    // $active_products = array_intersect($connected_lens, $all_lenses_with_cats->get_products());

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

    if ((float)$left_add >= 0.75 || (float)$right_add >= 0.75) {
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
    if (in_array($lens_type, ['monofocal', 'solo-para-descanso'])) {
        unset($attributes['attribute_pa_adicion']);
    }

    // add the lens color to the get matching variations
    if ($lens_type !== 'claros') {
        $attributes['attribute_pa_lens-color'] = $_POST['lens_color'];
    }

    $variations = [];

    $prods = [];

    $lens_options = "";

    if ($all_lenses_with_cats->get_products()) {
        foreach ($all_lenses_with_cats->get_products() as $prod) {
            $product        = wc_get_product($prod);
            $prod_title     = $product->get_name();
            $prod_desc      = $product->get_description();
            
            $variation_id   = (new WC_Product_Data_Store_CPT())->find_matching_product_variation(new WC_Product($prod), $attributes);
            
            if ($variation_id) {
                $var_prod   = wc_get_product($variation_id);

                $price      = $var_prod->get_price();
                $price_html = $var_prod->get_price_html();

                // get the colors added to the lens
                $colors     = [];
                $has_colors = false;
                if (get_the_terms($prod, 'pa_lentes-color')) {
                    $has_colors = true;
                    foreach (get_the_terms($prod, 'pa_lentes-color') as $color) {
                        array_push($colors, [
                            'term_id'   => $color->term_id,
                            'name'      => $color->name,
                            'slug'      => $color->slug,
                            'color'     => get_term_meta($color->term_id, 'lens_color', true)
                        ]);
                    }
                }
    
                array_push($variations, [
                    'lens_id'       => $prod,
                    'lens_name'     => $prod_title,
                    'lens_desc'     => $prod_desc,
                    'lens_children' => $product->get_available_variations(),
                    'variation'     => $variation_id,
                    'price'         => $price,
                    'price_html'    => $price_html,
                    'colors'        => $colors
                ]);
            }

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
        'dp'            => $_POST['dp'],
        'lens_color'    => $_POST['lens_color']
    ];

    wp_send_json([
        'results'   => $variations,
        'formula'   => $formula
    ]);
}

add_action('wp_ajax_gafas_get_lens_colors', 'gafas_render_lens_colors');
add_action('wp_ajax_nopriv_gafas_get_lens_colors', 'gafas_render_lens_colors');
function gafas_render_lens_colors() {
    $lens_id = $_POST['lens_id'];

    $colors = [];
    if (get_the_terms($lens_id, 'pa_lentes-color')) {
        foreach (get_the_terms($lens_id, 'pa_lentes-color') as $color) {
            array_push($colors, [
                'name'      => $color->name,
                'slug'      => $color->slug,
                'color'     => get_term_meta($color->term_id, 'lens_color', true)
            ]);
        }
        wp_send_json($colors);
    } else {
        wp_send_json(false);
    }
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
                'left_esf'      => $_POST['left_esf'],
                'right_esf'     => $_POST['right_esf'],
                'left_cil'      => $_POST['left_cil'],
                'right_cil'     => $_POST['right_cil'],
                'left_eje'      => $_POST['left_eje'],
                'right_eje'     => $_POST['right_eje'],
                'left_add'      => $_POST['left_add'],
                'right_add'     => $_POST['right_add'],
                'dp'            => $_POST['dp'],
                'lens_color'    => $_POST['lens_color']
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

    if (isset($cart_item['lens_color'])) {
        $item_data[] = [
            'name'  => __('Color de Lente', 'gafas'),
            'value' => wc_clean($cart_item['lens_color']),
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
    if (isset($values['right_esf'])) {
        $item->add_meta_data(__('Ojo Der. ESF.', 'gafas'), $values['right_esf']);
    }
    if (isset($values['left_esf'])) {
        $item->add_meta_data(__('Ojo Izq. ESF.', 'gafas'), $values['left_esf']);
    }
    
    if (isset($values['right_cil'])) {
        $item->add_meta_data(__('Ojo Der. CIL.', 'gafas'), $values['right_cil']);
    }
    if (isset($values['left_cil'])) {
        $item->add_meta_data(__('Ojo Izq. CIL.', 'gafas'), $values['left_cil']);
    }

    if (isset($values['right_eje'])) {
        $item->add_meta_data(__('Ojo Der. EJE.', 'gafas'), $values['right_eje']);
    }
    if (isset($values['left_eje'])) {
        $item->add_meta_data(__('Ojo Izq. EJE.', 'gafas'), $values['left_eje']);
    }
    
    if (isset($values['right_add'])) {
        $item->add_meta_data(__('Ojo Der. ADD.', 'gafas'), $values['right_add']);
    }
    if (isset($values['left_add'])) {
        $item->add_meta_data(__('Ojo Izq. ADD.', 'gafas'), $values['left_add']);
    }

    if (isset($values['dp'])) {
        $item->add_meta_data(__('Distancia Pupilar', 'gafas'), $values['dp']);
    }

    if (isset($values['lens_color'])) {
        $item->add_meta_data(__('Color de Lente', 'gafas'), $values['lens_color']);
    }
}