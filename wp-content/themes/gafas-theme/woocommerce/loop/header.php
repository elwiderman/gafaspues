<?php
/**
 * Product taxonomy archive header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<header class="woocommerce-products-header">
	<?php
	// the banner img
	$default_banner = get_field('placeholder_banner_img', 'option');
	if (is_shop()) :
		$pid 		= wc_get_page_id('shop');
		$banner		= has_post_thumbnail($pid) ? get_the_post_thumbnail_url($pid) : $default_banner['url'];
	endif;
	if (is_tax('product_cat')) :
		$query_obj	= get_queried_object();
		if (isset($query_obj->term_id)) :
			$thumb	= get_term_meta($query_obj->term_id, 'thumbnail_id', true);
			$banner	= wp_get_attachment_url($thumb) ? wp_get_attachment_url($thumb) : $default_banner['url'];
		endif;
	endif;

	$banner			= isset($banner) ? $banner : $default_banner['url'];

	echo "<div class='woocommerce-products-header__banner' style='background-image:url({$banner})'></div>";
	?>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php
				/**
				 * Hook: woocommerce_show_page_title.
				 *
				 * Allow developers to remove the product taxonomy archive page title.
				 *
				 * @since 2.0.6.
				 */
				if ( apply_filters( 'woocommerce_show_page_title', true ) ) :
					?>
					<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?>

				<?php
				/**
				 * Hook: woocommerce_archive_description.
				 *
				 * @since 1.6.2.
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */
				do_action( 'woocommerce_archive_description' );
				?>
			</div>
		</div>
	</div>
</header>
