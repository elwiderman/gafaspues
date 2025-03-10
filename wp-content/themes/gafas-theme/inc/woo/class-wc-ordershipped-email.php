<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WC_Order_Shipped_Email extends WC_Email {

    /**
     * Constructor.
     */
    public function __construct() {
        $this->id           = 'wc_order_shipped_email'; // Unique ID for the email
        $this->customer_email = true;
        $this->title        = 'Shipped Order';
        $this->description  = 'Este es un correo electrónico personalizado de WooCommerce que se envía cuando se envía un pedido..';
        
        $this->heading      = 'Su pedido ha sido Enviado';
        $this->subject      = 'Tu pedido #{order_number} de GafasPues ha sido ENVIADO';

        $this->template_base  = get_template_directory() . '/woocommerce/';
        $this->template_html  = 'emails/shipped-email-template.php';
        $this->template_plain = 'emails/plain/shipped-email-template.php';

        // Call parent constructor to load default settings and user options
        parent::__construct();

        // Set default recipient if not defined
        // $this->recipient = $this->get_option( 'recipient', get_option( 'admin_email' ) );

        // Triggers for this email
        add_action( 'woocommerce_order_status_changed', array( $this, 'trigger' ), 10, 4 );
    }

    /**
     * Trigger this email.
     */
    public function trigger( $order_id, $old_status, $new_status, $order ) {
        if ( ! $order_id ) return;

        
        // send the email only for the parent order and not for the sub orders
        if ($order->get_parent_id() === 0) :
            $this->object = wc_get_order( $order_id );
    
            $this->placeholders = array(
                '{order_date}'   => date_i18n( wc_date_format(), strtotime( $this->object->get_date_created() ) ),
                '{order_number}' => $this->object->get_order_number(),
            );
    
            $this->recipient = $this->object->get_billing_email(); // Set recipient to the customer
    
            // Send email only for specific statuses (optional)
            if ( $new_status === 'ordershipped' ) {
                if ( $this->is_enabled() && $this->get_recipient() ) {
                    $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
                }
            }
        endif;
    }

    /**
     * Get the HTML for the email.
     */
    public function get_content_html() {
        ob_start();
        wc_get_template(
            $this->template_html, 
            array( 
                'order'         => $this->object, 
                'email_heading' => $this->get_heading(),
                'email'         => $this,
            ), 
            '', 
            $this->template_base
        );
        return ob_get_clean();
    }

    /**
     * Get the plain text for the email.
     */
    public function get_content_plain() {
        ob_start();
        wc_get_template(
            $this->template_plain, 
            array( 
                'order'         => $this->object, 
                'email_heading' => $this->get_heading(),
                'email'         => $this,
            ), 
            '', 
            $this->template_base
        );
        return ob_get_clean();
    }
}
