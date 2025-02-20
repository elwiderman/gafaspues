<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		
		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
					?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>
	<?php
endif;

wp_reset_postdata();

$vendor         = get_the_terms(22, 'yith_shop_vendor')[0];

$all_lenses_with_cats = new WC_Product_Query([
	'limit'     => -1,
	'return'    => 'ids',
	'tax_query' => [
		'relation'	=> 'AND',
		[
			'taxonomy'      => 'product_cat',
            'field'         => 'slug',
            'terms'         => 'lentes',
            'include_children'  => false,
            'operator'      => 'IN'
		], [
			'taxonomy'      => 'yith_shop_vendor',
            'field'         => 'slug',
            'terms'         => [$vendor->slug],
            'operator'      => 'IN'
		], [
			'taxonomy'      => 'lente',
            'field'         => 'slug',
            'terms'         => 'solo-para-descanso',
            'operator'      => 'IN'
		], [
			'taxonomy'      => 'filtro',
            'field'         => 'slug',
            'terms'         => 'claros',
            'operator'      => 'IN'
		]
	]
]);

echo '<pre>';
// var_dump($all_lenses_with_cats->get_products());
echo '</pre>';

$esf    = 'standard';
$cil    = 'standard';
$attributes = [
	'attribute_pa_esferico'     => $esf,
	'attribute_pa_cilindro'     => $cil,
];

$variations = [];

foreach ($all_lenses_with_cats->get_products() as $prod) {
	$product        = wc_get_product($prod);
	$prod_title     = $product->get_name();
	$prod_desc      = $product->get_description();

	$variation_id   = $product->get_matching_variation($attributes);
	$var_prod       = wc_get_product($variation_id);
	echo '<pre>';
	// var_dump($var_prod);
	var_dump($variation_id);
	echo '</pre>';
	$price          = $var_prod->get_price();
	$price_html     = $var_prod->get_price_html();

	array_push($variations, [
		'lens_id'       => $prod,
		'lens_name'     => $prod_title,
		'lens_desc'     => $prod_desc,
		'lens_children' => $product->get_available_variations(),
		'variation'     => $variation_id,
		'price'         => $price,
		'price_html'    => $price_html
	]);
}

echo '<pre>';
var_dump($variations);
echo '</pre>';