<?php
/**
 * Change the strength requirement for WooCommerce passwords
 *
 * @author Misha Rudrastyh
 * @url https://rudrastyh.com/woocommerce/password-strength-meter.html#change-minimum-strength
 *
 * Strength Settings
 * 4 = Strong
 * 3 = Medium (default) 
 * 2 = Also Weak but a little bit stronger 
 * 1 = Password should be at least Weak
 * 0 = Very Weak / Anything
 */
add_filter( 'woocommerce_min_password_strength', 'gafas_change_password_strength' );
function gafas_change_password_strength( $strength ) {
    return 3;
}



// shop no posts found wrap
// add_action('woocommerce_after_shop_loop', 'gafas_no_posts_found', 9);
function gafas_no_posts_found() {
    echo "<div class='no-products-found'></div>";
}

// update link for the product to show master product instead of variation
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
add_action('woocommerce_before_shop_loop_item', 'gafas_woocommerce_template_loop_product_link_open', 10);
function gafas_woocommerce_template_loop_product_link_open() {
    global $product;

    // temporary assignment for the product checking if its a variation or not
    $temp_product   = $product;

    // this means that its a variation
    if ($temp_product->get_parent_id() !== 0) {
        $product    = wc_get_product($temp_product->get_parent_id());
    } else {
        $product    = $temp_product;
    }

    // refer - /woocommerce/includes/wc-template-functions.php for the output
    $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink($product->get_id()), $product );
    echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
}

// thumb wrapper and starting of content wrap
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'gafas_woo_loop_thumb_modifier', 9);
function gafas_woo_loop_thumb_modifier() {
	global $product;

    // temporary assignment for the product checking if its a variation or not
    $temp_product   = $product;

    // this means that its a variation
    if ($temp_product->get_parent_id() !== 0) {
        $product    = wc_get_product($temp_product->get_parent_id());
    } else {
        $product    = $temp_product;
    }
	?>
	<figure class="product__image">
        <?php
            $img_size = 'prod-thumb';
            $attr = array(
                'class' =>'img-fluid',
                'alt'   => $product->get_name()
            );

            if (has_post_thumbnail($product->get_id())) :
                echo $product->get_image($img_size, $attr);
            else :
                $src = gafas_placeholder_src($img_size);

                echo "<img src='{$src['url']}' class='img-fluid'>";
            endif;
        ?>

		
	</figure>
	<?php
}

add_action('woocommerce_shop_loop_item_title', 'gafas_woo_loop_wrap_title_price_start', 9);
function gafas_woo_loop_wrap_title_price_start() {
    echo "<div class='product__meta'>";
}

add_action('woocommerce_after_shop_loop_item_title', 'gafas_woo_loop_wrap_title_price_end', 11);
function gafas_woo_loop_wrap_title_price_end() {
    echo "</div>";
}


// show the rating always even if its zero
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'gafas_custom_loop_rating', 10);
function gafas_custom_loop_rating() {
    $product = wc_get_product();
    
    echo "<div class='product__meta--rating'>";
    if ( $product->get_average_rating() ) {
        echo wc_get_rating_html( $product->get_average_rating() );
    } else {
        // the rating will be zero but still will show the blank stars
        $rating = 0;
        $count  = 0;
        // from the core functions
        /* translators: %s: rating */
		$label = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
		$html  = '<div class="star-rating" role="img" aria-label="' . esc_attr( $label ) . '">' . wc_get_star_rating_html( $rating, $count ) . '</div>';

        echo $html;
    }
    
    echo "</div>";

}


// Change add to cart text on product archives page
add_filter( 'woocommerce_loop_add_to_cart_link', 'gafas_add_to_cart_button_text_archives', 10, 2 );  
function gafas_add_to_cart_button_text_archives($button, $product) {
    // Replace the button text with a custom icom
    $button = sprintf(
        '<a href="%s" class="product__add-to-cart button add_to_cart_button ajax_add_to_cart" data-product_id="%s" data-product_sku="%s" aria-label="%s" rel="nofollow"><i class="icon-shopping-bag"></i></a>',
        esc_url($product->add_to_cart_url()),
        esc_attr($product->get_id()),
        esc_attr($product->get_sku()),
        esc_attr($product->add_to_cart_description())
    );
    return $button;
}

// remove add to cart from thumbs
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// add the wishlist and the quick view buttons
// add_action('woocommerce_after_shop_loop_item', 'gafas_woo_loop_thumb_wishlist_quickview', 6);
function gafas_woo_loop_thumb_wishlist_quickview() {
    global $product;
    ?>
    <div class="product__reveal">
        <div class="product__reveal--wishlist">
            <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]');?>
        </div>
    </div>
    <?php
}
