<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$order_id       = $order->get_id();
$shipper        = get_field('shipping_partner_text', $order_id);
$awb            = get_field('awb_text', $order_id);
$link           = get_field('shipping_link_text', $order_id);
?>

Hola <?php echo $order->get_billing_first_name(); ?>,

Queríamos informarle que su pedido #<?php echo $order->get_order_number(); ?> ha sido ENVIADO a través de <?php echo $shipper;?>.

<?php
if ($link) {
    echo "Para seguir su pedido haga <a href='{$link}' target='_blank'>clic aquí</a>.";
}
?>

Encuentre los detalles de seguimiento del pedido a continuación -
Empresa de mensajería - <?php echo $shipper;?>
Número de carta de porte - <?php echo $awb;?>

Gracias por comprar con nosotros!