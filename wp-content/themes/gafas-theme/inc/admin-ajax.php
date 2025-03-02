<?php
// fetch the orders for the current vendor
add_action('wp_ajax_gafas_vendor_orders_dt', 'gafas_vendor_orders_dt');
function gafas_vendor_orders_dt() {
    $user_meta  = get_user_meta(get_current_user_id());
    $vendor_id  = $user_meta['yith_product_vendor'][0];

    $limit = $_REQUEST['length'];
    $offset = $_REQUEST['start'];

    // check if ordering is active and create the order query depending on the front end
    if ($_REQUEST['order'][0]['column'] && $_REQUEST['order'][0]['dir']) {
        if ($_REQUEST['order'][0]['column'] == 0) {
            $order = array(
                'orderby'   => 'ID',
                'order'     => strtoupper($_REQUEST['order'][0]['dir'])
            );
        } elseif ($_REQUEST['order'][0]['column'] == 5) {
            $order = array(
                'orderby'   => 'date',
                'order'     => strtoupper($_REQUEST['order'][0]['dir'])
            );
        } elseif ($_REQUEST['order'][0]['column'] == 6) {
            $order = array(
                'orderby'   => 'post_status',
                'order'     => strtoupper($_REQUEST['order'][0]['dir'])
            );
        } else {
            $order = array(
                'order'     => strtoupper($_REQUEST['order'][0]['dir']),
                'orderby'   => 'meta_value'
            );
            switch ($_REQUEST['order'][0]['column']) {
                case 3: // total
                    $order = array_merge($order, array(
                        'meta_key'  => '_order_total',
                    ));
                    break;
            }
        }
    } else {
        $order = [
            'orderby'   => 'date',
            'order'     => 'DESC'
        ];
    }

    $total_records_query = wc_get_orders([
        'type'           => 'shop_order',
        'return'         => 'ids',
        'limit'          => -1,
        'parent_exclude' => [0],
        'vendor_id'      => $vendor_id,
        'meta_query'     => [
            [
                'key'   => 'vendor_id',
                'value' => $vendor_id,
            ]
        ],
    ]);
    $recordsTotal = sizeof($total_records_query);


    $main_query_args = [
        'type'           => 'shop_order',
        'return'         => 'ids',
        'limit'          => $limit,
        'offset'         => $offset,
        'parent_exclude' => [0],
        'vendor_id'      => $vendor_id,
        'meta_query'     => [
            [
                'key'   => 'vendor_id',
                'value' => $vendor_id,
            ]
        ],
    ];

    $query_args = array_merge($main_query_args, $order);

    $order_query = wc_get_orders($query_args);

    $recordsFiltered = sizeof($order_query);


    $response = new stdClass();

    $response->draw = (int)$_REQUEST['draw'];
    $response->recordsTotal = $recordsTotal;
    $response->recordsFiltered = $recordsFiltered;


    $order_data = [];

    if ($recordsFiltered > 0) :
        foreach ($order_query as $order_id) :
            $obj            = new stdClass();
            $order          = wc_get_order($order_id);
            $obj->id        = $order_id;
            $obj->name      = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
            $obj->parent    = $order->get_parent_id();
            $obj->date      = $order->get_date_created()->date_i18n('M j, Y g:ia');
            $obj->status    = sprintf(
                                '<mark class="order-status status-%s"><span>%s</span></mark>', 
                                esc_attr($order->get_status()), 
                                esc_html(wc_get_order_status_name($order->get_status()))
                            );
            $obj->total     = $order->get_formatted_order_total();
            
            $commissions    = YITH_Commissions()->get_commissions(['order_id' => $order_id]);
            $total_commission = 0;
            if (!empty($commissions)) :
                foreach ($commissions as $commission_id) :
                    $commission = new YITH_Commission($commission_id);
                    $total_commission += $commission->get_amount();
                endforeach;
            endif;
            $obj->commission = wc_price($total_commission);

            $action         = '';
            // $link           = admin_url('page=gafas-pedido');
            $link           = add_query_arg([
                                'page'      => 'gafas-pedido',
                                'action'    => 'view',
                                'id'        => $order_id
            ], admin_url('admin.php'));

            $action         = "<a href='{$link}' class='btn btn-outline-primary'><span class='dashicons dashicons-visibility'></span></a>";

            $obj->action    = $action;

            array_push($order_data, $obj);
        endforeach;
    endif;

    $response->data = $order_data;

    header('Content-Type: application/json');
    
    wp_send_json($response);
}



// vendor to update the status from processing to ready to ship
add_action('wp_ajax_gafas_vendor_update_order_status', 'gafas_vendor_update_order_status');
add_action('wp_ajax_no_priv_gafas_vendor_update_order_status', 'gafas_vendor_update_order_status');
function gafas_vendor_update_order_status() {
    if (!isset($_POST['gafas_nonce_check']) || !wp_verify_nonce($_POST['gafas_nonce_check'], 'gafas_vendor_update_status')) :
        print 'Sorry, your nonce did not verify.';
    die;
    else :
        // Get order ID and new status
        $order_id = isset($_POST['order_id']) ? absint($_POST['order_id']) : 0;
        $new_status = isset($_POST['status']) ? sanitize_text_field($_POST['status']) : '';

        // Validate order ID and status
        if (!$order_id || !$new_status) {
            wp_send_json_error(['message' => 'Datos de pedido no válidos.']);
            return;
        }

        $order = wc_get_order($order_id);
        
        if (!$order) {
            wp_send_json_error(['message' => 'Pedido no encontrado.']);
            return;
        }

        // check if the old order status is 
        if ($order->get_status() === 'processing') {
            $old_status = $order->get_status();
            
            // Update the order status
            $order->update_status($new_status, 'El estado del pedido cambió a través de AJAX.', true);
    
            // Trigger custom email
            WC()->mailer()->emails['WC_Order_Ready_To_Ship_Email']->trigger($order_id, $old_status, $new_status, $order);
    
            wp_send_json_success(['message' => 'Estado del pedido actualizado y el administrador ha sido notificado exitosamente.']);

            exit;
        }

    endif; 
}
