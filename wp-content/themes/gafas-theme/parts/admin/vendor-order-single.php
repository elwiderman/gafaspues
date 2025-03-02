    <?php
// order single page

if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] === 'view') :
    $order_id           = sanitize_text_field($_GET['id']);
    $order              = wc_get_order($order_id);
    $order_date         = $order->get_date_created()->date('F j, Y  g:ia');
    $modified_date      = $order->get_date_modified()->date('F j, Y  g:ia');
    $paid_date          = $order->get_date_paid() ? $order->get_date_paid()->date('F j, Y  g:ia') : '-';
    $commissions        = YITH_Commissions()->get_commissions(['order_id' => $order_id]);
    $total_commission   = 0;
    if (!empty($commissions)) :
        foreach ($commissions as $commission_id) :
            $commission = new YITH_Commission($commission_id);
            $total_commission += $commission->get_amount();
        endforeach;
    endif;
    $total_commission   = wc_price($total_commission);
    ?>

    <div class="gafas-admin">
        <div class="admin-wrap">
            <div class="title-section">
                <div class="container">
                    <h1 class="page-title">
                        <?php _e('Pedido', 'gafas');?>
                        <?php echo " - # {$order_id}";?>
                    </h1>
                </div>
            </div>

            <div class="content-block order-single">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-7 col-xl-8">
                            <div class="panel">
                                <h5><?php _e('Informacion', 'gafas');?></h5>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <ul class="info-list pl-0">
                                            <li>
                                                <span class="info-list__label"><?php _e('Fecha de Venta:', 'gafas');?></span>
                                                <span class="info-list__value"><?php echo $order_date;?></span>
                                            </li>
                                            <li>
                                                <span class="info-list__label"><?php _e('Fecha de Pago:', 'gafas');?></span>
                                                <span class="info-list__value"><?php echo $paid_date;?></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col">
                                        <ul class="info-list pl-0 text-md-end">
                                            <li>
                                                <span class="info-list__label"><?php _e('Venta Total:', 'gafas');?></span>
                                                <span class="info-list__value"><?php echo $order->get_formatted_order_total();?></span>
                                            </li>
                                            <li>
                                                <span class="info-list__label"><?php _e('Comision Total:', 'gafas');?></span>
                                                <span class="info-list__value"><?php echo $total_commission;?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel p-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col"><?php _e('Artículo', 'gafas');?></th>
                                                <th scope="col"><?php _e('Cantidad', 'gafas');?></th>
                                                <th scope="col"><?php _e('Subtotal', 'gafas');?></th>
                                                <th scope="col"><?php _e('IVA', 'gafas');?></th>
                                                <th scope="col"><?php _e('Comisión', 'gafas');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($order->get_items() as $item_id => $item) :
                                                $product        = $item->get_product();
                                                $item_name      = $item->get_name();
                                                $qty            = $item->get_quantity();
                                                $subtotal       = $item->get_subtotal();
                                                $total          = $item->get_total();
                                                $subtotal_tax   = wc_price($item->get_subtotal_tax());
                                                $unit_price     = wc_price($subtotal / $qty);
                                                $st_formatted   = wc_price($subtotal);
                                                $thumb          = $product->get_image('woocommerce_gallery_thumbnail', [
                                                    'class' => 'img-fluid',
                                                    'alt'   => $item_name
                                                ]);
                                                $comm_id        = $item->get_meta('_commission_id', true);
                                                $comm_amt       = new YITH_Commission($comm_id);
                                                $comm           = wc_price($comm_amt->get_amount());

                                                $meta               = "";
                                                if (has_term('lentes', 'product_cat', $item->get_product_id())) :
                                                    $meta           = "<ul class='product__info--meta'>";
                                                    $keys           = [
                                                        'Ojo Der. ESF.',
                                                        'Ojo Izq. ESF.',
                                                        'Ojo Der. CIL.',
                                                        'Ojo Izq. CIL.',
                                                        'Ojo Der. EJE.',
                                                        'Ojo Izq. EJE.',
                                                        'Ojo Der. ADD.',
                                                        'Ojo Izq. ADD.',
                                                        'Distancia Pupilar'
                                                    ];
                                                    foreach ($item->get_meta_data() as $value) :
                                                        if (in_array($value->key, $keys)) :
                                                            $val    = $value->value ? $value->value : '-';
                                                            $meta   .= "<li>
                                                                <span class='label'>{$value->key}:</span>
                                                                <span class='value'>{$val}</span>
                                                            </li>";
                                                        endif;
                                                    endforeach;
                                                    $meta           .= "</ul>";
                                                endif;

                                                echo "
                                                <tr>
                                                    <td class='product'>
                                                        <figure class='product__thumb'>
                                                            {$thumb}
                                                        </figure>
                                                        <div class='product__info'>
                                                            <p class='product__info--title'>{$item_name}</p>
                                                            {$meta}
                                                        </div>

                                                    </td>
                                                    <td class='qty'>
                                                        <p class='qty__count mb-0'>{$qty}</p>
                                                    </td>
                                                    <td class='subtotal'>
                                                        <p class='subtotal__value mb-0'>{$st_formatted}</p>
                                                    </td>
                                                    <td class='iva'>
                                                        <p class='iva__value mb-0'>{$subtotal_tax}</p>
                                                    </td>
                                                    <td class='commission'>
                                                        <p class='commission__value mb-0'>{$comm}</p>
                                                    </td>
                                                </tr>
                                                ";
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-5 col-xl-4">
                            <div class="panel">
                                <h5><?php _e('Estado', 'gafas');?></h5>
                                <hr>
                                <div class="status-form">
                                    <?php
                                    $status_html    = sprintf(
                                        '<mark class="order-status status-%s"><span>%s</span></mark>', 
                                        esc_attr($order->get_status()), 
                                        esc_html(wc_get_order_status_name($order->get_status()))
                                    );
                                    $updated_label  = __('Actualizado por última vez el', 'gafas');
                                    
                                    echo "
                                        {$status_html}
                                        <p class='modified-on'>{$updated_label} - {$modified_date}</p>
                                    ";

                                    // show the change of status 
                                    if ($order->get_status() === 'processing') : ?>
                                        <form id="vendorUpdateOrderStatus">
                                            <?php wp_nonce_field('gafas_vendor_update_status', 'gafas_nonce_check');?>
                                            <input type="hidden" name="action" value="gafas_vendor_update_order_status">
                                            <input type="hidden" name="status" value="readyforshipping">
                                            <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
                                            <button type="submit" class="btn btn-primary">
                                                <?php _e('El pedido es listo para enviar', 'gafas');?>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
endif;