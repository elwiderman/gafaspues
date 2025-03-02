<?php
// all hooks and helpers for the vendors


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
        $vendor_id      = $user_meta['yith_product_vendor'][0];
        
        if ($vendor_id) :
            $vendor     = get_term_by('id', $vendor_id, 'yith_shop_vendor');
            $plan       = get_term_meta($vendor_id, 'cm_plan_type', true);

            // to count the number of products by the vendor
            $query      = new WP_Query([
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
        endif;

        return $result;
    else :
        return $result;
    endif;
}


// show admin notice to vendors when they reach the limit of products
add_action('admin_notices', 'gafas_show_admin_notice_to_vendors');
function gafas_show_admin_notice_to_vendors() {
    $check_can_add = gafas_vendor_can_add_prods(get_current_user_id());

    // echo '<pre>';
    // var_dump($check_can_add);
    // echo '</pre>';

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


// add custom menu page for vendors only
add_action('admin_menu', 'gafas_add_menu_to_admin_panel', 999);
function gafas_add_menu_to_admin_panel() {
    add_menu_page( 
        __('Pedidos', 'gafas'),
        __('Pedidos', 'gafas'),
        'view_custom_gafas_wc_orders', // this is the custom capability for the yith_vendor user role
        'gafas-pedidos', 
        'gafas_vendor_admin_orders_list',
        'dashicons-cart',
        56
    );

    add_submenu_page( 
        '',
        __('Pedido', 'gafas'),
        '',
        'view_custom_gafas_wc_orders', // this is the custom capability for the yith_vendor user role
        'gafas-pedido', 
        'gafas_vendor_admin_order_view'
    );

    if (current_user_can('view_custom_gafas_wc_orders')) {
        remove_menu_page('edit.php?post_type=shop_order');
    }

    return false;
}

function gafas_vendor_admin_orders_list() {
    get_template_part('parts/admin/vendor-orders');
}

function gafas_vendor_admin_order_view() {
    get_template_part('parts/admin/vendor-order-single');
}

// this invokes the custom admin menu for the yith vendors
if (!function_exists('yith_wcmv_allow_custom_admin_menu')) {
	add_filter('yith_wcmv_admin_vendor_menu_items', 'yith_wcmv_allow_custom_admin_menu', 99);
	function yith_wcmv_allow_custom_admin_menu($items) {
        
        $items[] = 'gafas-pedidos';

        foreach ($items as $key => $value) {
            // remove the original wc-orders page
            if ($value == 'edit.php?post_type=shop_order') {
                // unset($items[$key]);
            }
        }

		return $items;
	}
}