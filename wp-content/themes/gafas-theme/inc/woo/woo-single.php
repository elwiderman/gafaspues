<?php
/* all woo hooks for the product single page */

// add category and collection below the title
// add_action('woocommerce_single_product_summary', 'gafas_add_category_collection_below_title', 5);
function gafas_add_category_collection_below_title() {
    global $product;

    echo "<div class='product-meta-top'>";
    // get the collections
    echo get_the_term_list(
        $product->get_id(), 
        'collection', 
        '<div class="product-meta-top__collection">', 
        ', ', 
        '</div>');


    // get the product categories
    echo wc_get_product_category_list( 
        $product->get_id(), 
        ', ',
        '<div class="product-meta-top__category">',
        '</div>');

    echo "</div>";
}

// Replace Variable Price With Variation Price | WooCommerce
// add_action( 'woocommerce_variable_add_to_cart', 'gafas_update_price_with_variation_price' );
function gafas_update_price_with_variation_price() {
    global $product;
    $price = $product->get_price_html();
    wc_enqueue_js("     
        $(document).on('found_variation', 'form.cart', function( event, variation ) {   
            if(variation.price_html) $('.entry-summary > p.price').html(variation.price_html);
            $('.woocommerce-variation-price').hide();
        });
        $(document).on('hide_variation', 'form.cart', function( event, variation ) {   
            $('.entry-summary > p.price').html('" . $price . "');
        });
    ");
}



// 1. Show plus minus buttons
// add_action( 'woocommerce_after_quantity_input_field', 'gafas_display_quantity_plus' );
function gafas_display_quantity_plus() {
    echo '<button type="button" class="plus quantity__btn"><i class="icon-plus"></i></button>';
}
  
// add_action( 'woocommerce_before_quantity_input_field', 'gafas_display_quantity_minus' );
function gafas_display_quantity_minus() {
    echo '<button type="button" class="minus quantity__btn"><i class="icon-minus"></i></button>';
}
  
// -------------
// 2. Trigger update quantity script
  
// add_action( 'wp_footer', 'gafas_add_cart_quantity_plus_minus' );  
function gafas_add_cart_quantity_plus_minus() {
 
   if (!is_product() && !is_cart()) return;
    
   wc_enqueue_js( "   
           
      $(document).on( 'click', 'button.plus, button.minus', function() {
  
         var qty = $( this ).parent( '.quantity' ).find( '.qty' );
         var val = parseFloat(qty.val());
         var max = parseFloat(qty.attr( 'max' ));
         var min = parseFloat(qty.attr( 'min' ));
         var step = parseFloat(qty.attr( 'step' ));
 
         if ( $( this ).is( '.plus' ) ) {
            if ( max && ( max <= val ) ) {
               qty.val( max ).trigger('change');
            } else {
               qty.val( val + step ).trigger('change');
            }
         } else {
            if ( min && ( min >= val ) ) {
               qty.val( min ).trigger('change');
            } else if ( val > 1 ) {
               qty.val( val - step ).trigger('change');
            }
         }
      });
        
   " );
}



// setting max and min quantity input
// add_filter( 'woocommerce_quantity_input_max', 'gafas_woo_quantity_input_max', 10, 2 );
function gafas_woo_quantity_input_max($max, $product) {
    // allow purchase of only one frame at a time for the rest allow normal
    // $max = gafas_is_prod_in_monturas($product->get_id()) ? 1 : 10;
    $max = 10;
    return $max;
}
// add_filter( 'woocommerce_quantity_input_min', 'gafas_woo_quantity_input_min', 10, 2 );
function gafas_woo_quantity_input_min($min, $product) {
    $min = 1;
    return $min;
}


// move the star rating after the title and before the short desc
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 6);

// move the short desc after the star rating and before the price
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 9);



// remove the product tabs from default location
// remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs');


// add the product tabs to the right section below the share
// add_action('woocommerce_single_product_summary', 'gafas_custom_product_accordions', 51);
function gafas_custom_product_accordions() {
    global $product;

    wc_get_template('single-product/tabs/tabs.php');
}

// unset the additional information from the tabs to be shown after the share buttons 
add_filter('woocommerce_product_tabs', 'gafas_add_custom_product_tabs');
function gafas_add_custom_product_tabs($tabs) {
    unset($tabs['additional_information']);

    // rename product description
    $tabs['description']['title']       = __('Sobre el producto', 'gafas');
    $tabs['description']['priority']    = 20;

    return $tabs;
}

// render the product spects after the share icons 
add_action('woocommerce_single_product_summary', 'gafas_render_custom_attributes', 51);
function gafas_render_custom_attributes() {
    wc_get_template('single-product/specs.php');
}


// render the product specs table 
function gafas_woo_product_spec_table_tab() {
    wc_get_template('single-product/tabs/specs.php');
}

// render the product shipping tab 
function gafas_woo_product_shipping_tab() {
    wc_get_template('single-product/tabs/shipping.php');
}

// set custom image for user in the comments 
remove_action('woocommerce_review_before', 'woocommerce_review_display_gravatar');
add_action('woocommerce_review_before', 'gafas_display_review_gravatar', 10);
function gafas_display_review_gravatar($comment) {
    // Get the comment author's email
    $comment_author_email = $comment->comment_author_email;

    // Get the Gravatar image URL
    $gravatar_url       = get_avatar_url($comment_author_email, array('size' => 64));
    if (!$gravatar_url) {
        $placeholder    = get_field('user_placeholder_img', 'option');
        $gravatar_url   = $placeholder['url'];
    }
    $thumb              = esc_url($gravatar_url);

    // Output custom Gravatar markup
    echo "
    <div class='comment-wrap__img'>
        <figure class='user-img'>
            <img class='img-fluid user-img__thumb' src='{$thumb}'>
        </figure>
    </div>
    ";
}


// show wishlist after add to cart
add_action('woocommerce_single_product_summary', 'gafas_show_wishlisht_after_add_to_cart', 32);
function gafas_show_wishlisht_after_add_to_cart() {
    echo "<div class='woocommerce-product-details__wishlist'>";
    echo do_shortcode('[woosw]');
    echo "</div>";
}
// show shipping info after add to cart
add_action('woocommerce_single_product_summary', 'gafas_show_shipping_strings_after_add_to_cart', 33);
function gafas_show_shipping_strings_after_add_to_cart() {
    echo "<div class='woocommerce-product-details__shipping-info'>";
    echo do_shortcode('[wpced]');
    echo "</div>";
}






/* the image section */
// remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
// remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

// add_action('woocommerce_before_single_product_summary', 'gafas_woo_custom_product_images', 20);
function gafas_woo_custom_product_images() {
    if (is_product()) {
        get_template_part('woocommerce/single-product/custom-images');
    }
}


// remove the zoom on hover anim
// add_action( 'wp', 'gafas_remove_zoom_lightbox_theme_support', 99 ); 
function gafas_remove_zoom_lightbox_theme_support() { 
    remove_theme_support( 'wc-product-gallery-zoom' );
}





// add the custom form for the selection of lenses in the product page
add_action('woocommerce_before_add_to_cart_quantity', 'gafas_add_lens_selection_form');
function gafas_add_lens_selection_form() {
    global $product; 
    // show only for frames product_cat
    if (has_term('gafas-recetadas', 'product_cat', $product->get_id())) :
    ?>
    <div class="lens-selection-form">
        <h6 class="select-title"><?php _e('Selecciona tus opciones', 'gafas');?></h6>
        
        <div class="form-conditional-radios">
            <div class="form-check">
                <input class="form-check-input frame-option" type="radio" name="frame_option" id="frame_option_wo_power" value="frame">
                <label class="form-check-label" for="frame_option_wo_power">
                    <?php _e('Solo quiero la montura', 'gafas');?>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input frame-option" type="radio" name="frame_option" id="frame_option_powered" value="powered" data-pid="<?php echo $product->get_id();?>">
                <label class="form-check-label" for="frame_option_powered">
                    <?php _e('Quiero la montura con lentes graduadas', 'gafas');?>
                </label>
            </div>
        </div>
    </div>
    <?php
    endif;
}

// add the modal after the add to cart button
add_action('woocommerce_after_add_to_cart_form', 'gafas_add_lens_selection_modal');
function gafas_add_lens_selection_modal() {
    get_template_part('woocommerce/single-product/lens-select');
}