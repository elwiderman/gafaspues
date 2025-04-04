<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details">

	<?php if ( $show_shipping ) : ?>

	<section class="woocommerce-columns woocommerce-columns--addresses addresses">

		<div class="row justify-content-between">
			<div class="woocommerce-column woocommerce-column--billing-address col-12 col-md-6 col-xl-5">

	<?php endif; ?>

			<div class="address-wrap">
				<h6 class="woocommerce-column__title"><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></h6>

				<address>
					<?php echo wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>

					<?php if ( $order->get_billing_phone() ) : ?>
						<p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
					<?php endif; ?>

					<?php if ( $order->get_billing_email() ) : ?>
						<p class="woocommerce-customer-details--email"><?php echo esc_html( $order->get_billing_email() ); ?></p>
					<?php endif; ?>

					<?php
					// print the custom fields here
					if ($order->get_meta('_meta_tipo_de_documento')) :
						$value = '';
						switch ($order->get_meta('_meta_tipo_de_documento')) :
							case 'cedula':
								$value = 'Cedula';
								break;
							
							case 'cedula_de_extranjeria':
								$value = 'Cedula de extranjería';
								break;
							
							case 'tarjeta_de_identidad':
								$value = 'Tarjeta de Identidad';
								break;
							
							case 'pasaporte':
								$value = 'Pasaporte';
								break;
							
							default:
								$value = 'Otro';
								break;
						endswitch;

						echo '<strong>'.__('Tipo de Documento').':</strong> ' . $value;
					endif;

					if ($order->get_meta('_meta_numero_de_documento')) :
						echo '<br><strong>'.__('Numero de Documento').':</strong> ' . $order->get_meta('_meta_numero_de_documento');
					endif;
					if ($order->get_meta('_meta_quiero_factura_electronica') !== '') :
						echo '<br><strong>'.__('Quiero factura electronica').':</strong> Si';
					endif;
					?>

					<?php
						/**
						 * Action hook fired after an address in the order customer details.
						 *
						 * @since 8.7.0
						 * @param string $address_type Type of address (billing or shipping).
						 * @param WC_Order $order Order object.
						 */
						do_action( 'woocommerce_order_details_after_customer_address', 'billing', $order );
					?>
				</address>
			</div>

	<?php if ( $show_shipping ) : ?>

		</div><!-- /.col-1 -->

		<div class="woocommerce-column woocommerce-column--shipping-address col-12 col-md-6 col-xl-5">
			<div class="address-wrap">
				<h6 class="woocommerce-column__title"><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></h6>
				<address>
					<?php echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>

					<?php if ( $order->get_shipping_phone() ) : ?>
						<p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_shipping_phone() ); ?></p>
					<?php endif; ?>

					<?php
						/**
						 * Action hook fired after an address in the order customer details.
						 *
						 * @since 8.7.0
						 * @param string $address_type Type of address (billing or shipping).
						 * @param WC_Order $order Order object.
						 */
						do_action( 'woocommerce_order_details_after_customer_address', 'shipping', $order );
					?>
				</address>
			</div>
		</div><!-- /.col-2 -->

	</section><!-- /.col2-set -->

	<?php endif; ?>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

</section>