<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-item-data.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// taking the wpced_date out of the array
$wpced_date = $item_data['wpced_date'];
unset($item_data['wpced_date']);

if (sizeof($item_data) > 0) :
?>
<ul class="product-detail__meta--variation">
	<?php 
		foreach ( $item_data as $key => $data ) : ?>
		<li>
			<span class="<?php echo sanitize_html_class( 'variation-' . $data['key'] ); ?>"><?php echo wp_kses_post( $data['key'] ); ?>:</span>
			<span class="<?php echo sanitize_html_class( 'variation-' . $data['key'] ); ?>"><?php echo wp_kses_post( wpautop( $data['display'] ) ); ?></span>
		</li>
	<?php endforeach; ?>
</ul>
<?php
endif;

// print the estimated date 
if ($wpced_date) :
	echo "
	<div class='product-detail__meta--est-delivery'>
		<span>{$wpced_date['key']}</span>
		<span>{$wpced_date['display']}</span>
	</div>";
endif;