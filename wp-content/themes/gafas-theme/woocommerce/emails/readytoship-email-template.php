<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$order_id       = $order->get_id();
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<p>Hola Administrador,</p>

<p>El pedido #<?php echo $order->get_order_number(); ?> está listo para enviar al cliente. Por favor haz lo que es necesario.</p>

<p>Gracias</p>

<?php do_action( 'woocommerce_email_footer', $email ); ?>
