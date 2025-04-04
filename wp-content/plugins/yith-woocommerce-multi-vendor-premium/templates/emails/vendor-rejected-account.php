<?php
/**
 * Vendor rejected account
 *
 * @author  YITH
 * @package YITH\MultiVendor
 * @version 5.0.0
 *
 * @var string   $email_heading     The email heading.
 * @var string   $blogname          The blog name.
 * @var string   $user_display_name The user display name.
 * @var string   $feedback_message  Additional feedback message to add in the email.
 * @var WC_Email $email             The email object.
 * @var bool     $sent_to_admin     True if it is an admin email, false otherwise.
 * @var bool     $plain_text        True if is plain email, false otherwise.
 */

defined( 'YITH_WPV_INIT' ) || exit; // Exit if accessed directly.

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer username */ ?>
	<p><?php printf( esc_html__( 'Hi %s,', 'yith-woocommerce-product-vendors' ), esc_html( $user_display_name ) ); ?></p>
	<p><?php echo esc_html__( 'After a careful review of your vendor application, we regret to inform you that your request has been declined.', 'yith-woocommerce-product-vendors' ); ?></p>
<?php if ( ! empty( $feedback_message ) ) : ?>
	<?php /* translators: %1$s: Username */ ?>
	<p><?php echo esc_html__( 'Our feedback:', 'yith-woocommerce-product-vendors' ); ?></p>
	<p class="yith-vendor-quote">
		<svg class="quotation-mark" fill="none" height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M18.8533 9.11599C11.3227 13.9523 7.13913 19.5812 6.30256 26.0029C5.00021 36 13.9404 40.8933 18.4703 36.4967C23.0002 32.1002 20.2848 26.5196 17.0047 24.9942C13.7246 23.4687 11.7187 24 12.0686 21.9616C12.4185 19.9231 17.0851 14.2713 21.1849 11.6392C21.4569 11.4079 21.5604 10.9591 21.2985 10.6187C21.1262 10.3947 20.7883 9.95557 20.2848 9.30114C19.8445 8.72888 19.4227 8.75029 18.8533 9.11599Z" fill="#979797" fill-rule="evenodd"/><path clip-rule="evenodd" d="M38.6789 9.11599C31.1484 13.9523 26.9648 19.5812 26.1282 26.0029C24.8259 36 33.7661 40.8933 38.296 36.4967C42.8259 32.1002 40.1105 26.5196 36.8304 24.9942C33.5503 23.4687 31.5443 24 31.8943 21.9616C32.2442 19.9231 36.9108 14.2713 41.0106 11.6392C41.2826 11.4079 41.3861 10.9591 41.1241 10.6187C40.9519 10.3947 40.614 9.95557 40.1105 9.30114C39.6702 8.72888 39.2484 8.75029 38.6789 9.11599Z" fill="#979797" fill-rule="evenodd"/></svg>
		<?php echo wp_kses_post( $feedback_message ); ?>
	</p>
<?php endif; ?>
	<p><?php echo esc_html__( 'We wish you all the best and thank you for taking the time to apply.', 'yith-woocommerce-product-vendors' ); ?></p>
	<p><?php echo esc_html__( 'Kind regards', 'yith-woocommerce-product-vendors' ); ?>,</p>
	<p><?php echo esc_html( $blogname ); ?></p>
<?php
do_action( 'woocommerce_email_footer', $email );
