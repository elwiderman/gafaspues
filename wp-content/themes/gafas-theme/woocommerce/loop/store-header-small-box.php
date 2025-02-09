<?php
/**
 * Vendor store header template. SMALL BOX style
 *
 * @since 1.0.0
 * @package YITH\MultiVendor
 * @var YITH_Vendor $vendor $vendor instance
 * @var string $header_image Header image url.
 * @var integer $header_height Header height value.
 */

/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

defined( 'YITH_WPV_INIT' ) || exit; // Exit if accessed directly.

$style = '';
if ( ! empty( $header_image ) ) {
	$style = "background: url({$header_image}) top center; background-size: cover;min-height:{$header_height}px";
}
?>


<h1 class="woocommerce-products-header__title page-title">
	<?php _e('Productos de ', 'gafas');?>
	<?php echo esc_html( $vendor->get_name() ); ?>
</h1>

<?php
echo woocommerce_breadcrumb();
?>

<?php
/**
 * The yith_wcmv_vendor_header_store_description hook. Print store description.
 *
 * @since 4.0.0
 */
do_action( 'yith_wcmv_vendor_header_store_description', $vendor );
