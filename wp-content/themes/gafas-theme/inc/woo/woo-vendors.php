<?php

function gafas_vendor_can_add_prods($user_id) {
    $user_meta			= get_user_meta($user_id);
    $user_data			= get_userdata($user_id);

    $limit_group        = get_field('prod_limit_group', 'option');

    $result             = [
        'flag'      => true,
        'plan'      => '',
        'limit'     => 0,
        'roles'     => $user_data->roles
    ];

    if (in_array('yith_vendor', $user_data->roles)) :
        $vendor			= yith_wcmv_get_vendor($user_meta['yith_product_vendor'][0]);
        
        $plan           = get_term_meta( $vendor->term_id, 'cm_plan_type', true);
        
        // to count the number of products by the vendor
        $query			= new WP_Query([
            'post_type'		=> 'product',
            'posts_per_page'=> -1,
            'post_status'	=> 'any',
            'tax_query'		=> [
                [
                    'taxonomy'      => 'yith_shop_vendor',
                    'field'         => 'slug',
                    'terms'         => [$vendor->slug],
                    'operator'      => 'IN'
                ]
            ]
        ]);

        $found_posts    = $query->found_posts;
        $result['plan'] = $plan;

        if ($plan === 'premium') :
            $result['flag']     = true;
        else :
            $limit              = $plan === 'basic' ? $limit_group['basic_num'] : $limit_group['adv_num'];
            $result['limit']    = $limit;
            $result['flag']     = $found_posts >= $limit ? false : true;
            return $result;
        endif;
    else :
        return $result;
    endif;
}


// show admin notice to vendors when they reach the limit of products
add_action('admin_notices', 'gafas_show_admin_notice_to_vendors');
function gafas_show_admin_notice_to_vendors() {
    $check_can_add = gafas_vendor_can_add_prods(get_current_user_id());



    if ($check_can_add['flag'] == false) :
        $limit  = $check_can_add['limit'];

        echo "<div class='notice notice-error'><p>Has alcanzado el límite máximo de {$limit} productos. No se pueden agregar más productos en tu plan. Por favor contáctenos para actualizar su plan.</p></div>";
    endif;
}

// hides the add new product in the menu
add_action('admin_menu', 'gafas_hide_add_product_from_menu');
function gafas_hide_add_product_from_menu() {
    $check_can_add = gafas_vendor_can_add_prods(get_current_user_id());

    if ($check_can_add['flag'] == false) :
        remove_submenu_page('edit.php?post_type=product', 'post-new.php?post_type=product');
    endif;
}

// prevents access to the add new product page
add_action('load-post-new.php', 'gafas_prevent_access_to_add_prod_screen');
function gafas_prevent_access_to_add_prod_screen() {
    $check_can_add = gafas_vendor_can_add_prods(get_current_user_id());

    if ($check_can_add['flag'] == false && isset($_GET['post_type']) && $_GET['post_type'] === 'product') :
        wp_die("Has alcanzado el límite máximo de {$check_can_add['limit']} productos. No se pueden agregar más productos en tu plan. Por favor contáctenos para actualizar su plan.");
    endif;
}

// hide the add product button for vendors
add_action('admin_head', 'gafas_hide_add_prod_btn_css');
function gafas_hide_add_prod_btn_css() {
    $check_can_add = gafas_vendor_can_add_prods(get_current_user_id());

    if ($check_can_add['flag'] == false && get_current_screen()->post_type === 'product') :
        echo '<style>
            .page-title-action { display: none !important; }
        </style>';
    endif;
}