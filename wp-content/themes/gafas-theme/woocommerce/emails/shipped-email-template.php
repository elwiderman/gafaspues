<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$order_id       = $order->get_id();
$shipper        = get_field('shipping_partner_text', $order_id);
$awb            = get_field('awb_text', $order_id);
$link           = get_field('shipping_link_text', $order_id);
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<p>Hola <?php echo $order->get_billing_first_name(); ?>,</p>

<p>Queríamos informarle que su pedido #<?php echo $order->get_order_number(); ?> ha sido ENVIADO a través de <?php echo $shipper;?>.</p>

<?php
if ($link) {
    echo "<p>Para seguir su pedido haga <a href='{$link}' target='_blank'>clic aquí</a>.</p>";
}
?>

<p>Encuentre los detalles de seguimiento del pedido a continuación -</p>
<p>Empresa de mensajería - <b><?php echo $shipper;?></b></p>
<p>Número de carta de porte - <b><?php echo $awb;?></b></p>

<p>Gracias por comprar con nosotros!</p>

<?php do_action( 'woocommerce_email_footer', $email ); ?>
