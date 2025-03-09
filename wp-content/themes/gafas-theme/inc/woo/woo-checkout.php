<?php
// the checkout page 

// cedula field
// add_filter('woocommerce_billing_fields', 'gafas_custom_woocommerce_billing_fields');
function gafas_custom_woocommerce_billing_fields($fields) {
    $fields['billing_document_number'] = array(
        'type'        => 'text', // Field type (text, select, checkbox, etc.)
        'label'       => __('Número de Documento', 'gafas'),
        'placeholder' => __('Ingrese su número de Cédula', 'gafas'),
        'required'    => true, // Set to false if not required
        'class'       => ['form-row-first'],
        'clear'       => true,
        'priority'    => 25, // Adjust position in checkout form
    );
    $fields['billing_document_type'] = array(
        'type'        => 'select', // Field type (text, select, checkbox, etc.)
        'label'       => __('Tipo de Documento', 'gafas'),
        'placeholder' => __('Selecciona tu tipo de documento', 'gafas'),
        'required'    => true, // Set to false if not required
        'class'       => ['form-row-first'],
        'clear'       => true,
        'priority'    => 24, // Adjust position in checkout form,
        'options'     => [
            ''                      => 'Selecciona tu tipo de documento',
            'Cedula'                => 'Cedula',
            'Tarjeta de Identidad'  => 'Tarjeta de Identidad',
            'Cedula de extranjería' => 'Cedula de extranjería',
            'Otro'                  => 'Otro'
        ]
    );

    return $fields;
}

// safe custom checkout field
// add_action('woocommerce_checkout_update_order_meta', 'gafas_save_custom_checkout_field');
function gafas_save_custom_checkout_field($order_id) {
    if (!empty($_POST['billing_document_number'])) {
        update_post_meta($order_id, '_billing_document_number', sanitize_text_field($_POST['billing_document_number']));
    }
}


// show the custom field in the admin for orders
// add_action('woocommerce_admin_order_data_after_billing_address', 'gafas_display_custom_field_in_admin', 10, 1);
function gafas_display_custom_field_in_admin($order) {
    $custom_field = get_post_meta($order->get_id(), '_billing_document_number', true);
    if ($custom_field) {
        echo '<p><strong>' . __('Cédula', 'woocommerce') . ':</strong> ' . esc_html($custom_field) . '</p>';
    }
}


// show the custom field in emails
// add_filter('woocommerce_email_order_meta_fields', 'gafas_add_custom_field_to_emails', 10, 3);
function gafas_add_custom_field_to_emails($fields, $sent_to_admin, $order) {
    $custom_field = get_post_meta($order->get_id(), '_billing_document_number', true);
    if ($custom_field) {
        $fields['billing_document_number'] = array(
            'label' => __('Cédula', 'woocommerce'),
            'value' => $custom_field,
        );
    }
    return $fields;
}


// removes the login form from top of the page
// remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );


// remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
// add_action( 'woocommerce_review_order_after_cart_contents', 'woocommerce_checkout_coupon_form_custom' );
function woocommerce_checkout_coupon_form_custom() {
    echo '<tr class="coupon-form"><td colspan="2">';
    
    wc_get_template(
        'checkout/form-coupon.php',
        array(
            'checkout' => WC()->checkout(),
        )
    );
    echo '</tr></td>';
}

// make sure the priority value is correct, running after the default priority.
// remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
// add_action( 'woocommerce_after_order_notes', 'woocommerce_checkout_payment', 20 );




// add_filter('woocommerce_checkout_fields', 'gafas_reorder_checkout_fields', 9999);
function gafas_reorder_checkout_fields( $fields ) {
 
    // default priorities:
    // 'first_name' - 10
    // 'last_name' - 20
    // 'company' - 30
    // 'country' - 40
    // 'address_1' - 50
    // 'address_2' - 60
    // 'city' - 70
    // 'state' - 80
    // 'postcode' - 90
    
    // e.g. move 'company' above 'first_name':
    // just assign priority less than 10
    // $fields['billing']['billing_country']['priority']       = 8;
    // $fields['billing']['billing_email']['priority']         = 9;
    // $fields['billing']['billing_email'] = 10;


    $fields['billing']['billing_email']['label'] = __('Correo Electrónico', 'gafas');
    $fields['billing']['billing_address_1']['label'] = __('Dirección', 'gafas');
    $fields['billing']['billing_state']['class'] = ['form-row-first', 'address-field'];
    $fields['billing']['billing_city']['class'] = ['form-row-last', 'address-field'];
    $fields['billing']['billing_city']['label'] = __('Ciudad', 'gafas');
    $fields['billing']['billing_postcode']['class'] = ['form-row-first', 'address-field'];
    $fields['billing']['billing_postcode']['label'] = __('Código postal (opcional)', 'gafas');
    $fields['billing']['billing_phone']['class'] = ['form-row-last'];
    $fields['billing']['billing_phone']['required'] = true;

    $fields['shipping']['shipping_address_1']['label'] = __('Dirección', 'gafas');
    $fields['shipping']['shipping_state']['class'] = ['form-row-first', 'address-field'];
    $fields['shipping']['shipping_city']['class'] = ['form-row-last', 'address-field'];
    $fields['shipping']['shipping_city']['label'] = __('Ciudad', 'gafas');
    $fields['shipping']['shipping_postcode']['class'] = ['form-row-first', 'address-field'];
    $fields['shipping']['shipping_postcode']['label'] = __('Código postal (opcional)', 'gafas');
    $fields['shipping']['shipping_phone']['class'] = ['form-row-last'];
    $fields['shipping']['shipping_phone']['required'] = true;
    $fields['shipping']['shipping_phone']['label'] = 'Teléfono';


    // create an array to set the order of the fields
    $order_billing = [
        'billing_email',
        'billing_country',
        'billing_first_name',
        'billing_last_name',
        'billing_document_type',
        'billing_document_number',
        'billing_address_1',
        'billing_address_2',
        'billing_state',
        'billing_city',
        'billing_postcode',
        'billing_phone',
    ];
    $order_shipping = [
        'shipping_country',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_address_1',
        'shipping_address_2',
        'shipping_state',
        'shipping_city',
        'shipping_postcode',
        'shipping_phone',
    ];
    $i = 0;
    foreach ($order_billing as $item) :
        $i++;
        $fields['billing'][$item]['priority'] = $i * 2;
        // $fields['shipping'][$item]['priority'] = $i * 2;
    endforeach;

    // echo '<pre>';
    // var_dump($fields['billing']['billing_address_1']);
    // echo '</pre>';
    
    return $fields;
}




// customize woocommerce form fields
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

            case 'address-field':
                array_push($form_group_class, 'address-field');
                break;

            case 'validate-state':
                array_push($form_group_class, 'validate-state');
                break;

            case 'update_totals_on_change':
                array_push($form_group_class, 'update_totals_on_change');
                break;

            case 'update_totals_on_change':
                array_push($form_group_class, 'update_totals_on_change');
                break;

            case 'validate-required':
                array_push($form_control_class, 'validate-required');
                array_push($form_group_class, 'validate-required');
                break;
        }
    }

    $required = ($args['required']) ? '<span class="required">*</span>' : '';

    // Start custom field wrapper
    $custom_field = '<div class="form-group ' . implode(' ', $form_group_class) . ' ' . esc_attr($args['type']) . ' ' . esc_attr($key) . '">';  

    if (!in_array($args['type'], ['checkbox', 'radio'])) :
        $custom_field .= '<div class="form-floating">';
    else :
        // Add custom label
        if (!empty($args['label'])) :
            $custom_field .= '<label class="form-label" for="' . esc_attr($key) . '">' . esc_html($args['label']) . $required . '</label>';
        endif;
    endif;

    // Add input field
    switch ($args['type']) :
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
        case 'country':
            $countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

            if (1 === count($countries)) :
                $custom_field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys( $countries ) ) . '" class="country_to_state" readonly="readonly" />';
                $custom_field .= '<input type="text" name="dummy_country" id="' . esc_attr( $args['id'] ) . '-dummy" value="' . current( $countries) . '" class="form-control" readonly="readonly" disabled>';

            else :
                $data_label = ! empty( $args['label'] ) ? 'data-label="' . esc_attr( $args['label'] ) . '"' : '';

                $custom_field = '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="form-select country_to_state country_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" data-placeholder="' . esc_attr( $args['placeholder'] ? $args['placeholder'] : esc_attr__( 'Select a country / region&hellip;', 'woocommerce' ) ) . '" ' . $data_label . '><option value="">' . esc_html__( 'Select a country / region&hellip;', 'woocommerce' ) . '</option>';

                foreach ( $countries as $ckey => $cvalue ) {
                    $custom_field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
                }

                $custom_field .= '</select>';

                $custom_field .= '<noscript><button type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country / region', 'woocommerce' ) . '">' . esc_html__( 'Update country / region', 'woocommerce' ) . '</button></noscript>';

                echo '<pre>';
                var_dump($custom_field);
                echo '</pre>';

            endif;
            break;
        case 'state':
            $custom_field .= '<select name="' . esc_attr($key) . '" id="' . esc_attr($key) . '" class="form-select state_select' . implode(' ', $form_control_class) . '">';
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
    endswitch;

    // Add description (if any)
    if (!empty($args['description'])) {
        $custom_field .= '<p class="custom-description">' . $args['description'] . '</p>';
    }

    
    if (!in_array($args['type'], ['checkbox', 'radio'])) :
        // Add custom label
        if (!empty($args['label'])) :
            $custom_field .= '<label class="form-label" for="' . esc_attr($key) . '">' . esc_html($args['label']) . $required . '</label>';
        endif;
        $custom_field .= '</div>';
    endif;

    // End custom field wrapper
    $custom_field .= '</div>';

    if ($key == 'billing_email') :
        $custom_field .= wc_get_template_part('checkout/form-login');
    endif;

    return $custom_field;
}