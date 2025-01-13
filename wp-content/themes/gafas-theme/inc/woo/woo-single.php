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
add_action( 'woocommerce_after_quantity_input_field', 'gafas_display_quantity_plus' );
function gafas_display_quantity_plus() {
    echo '<button type="button" class="plus quantity__btn"><i class="icon-plus"></i></button>';
}
  
add_action( 'woocommerce_before_quantity_input_field', 'gafas_display_quantity_minus' );
function gafas_display_quantity_minus() {
    echo '<button type="button" class="minus quantity__btn"><i class="icon-minus"></i></button>';
}
  
// -------------
// 2. Trigger update quantity script
  
add_action( 'wp_footer', 'gafas_add_cart_quantity_plus_minus' );  
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
add_filter( 'woocommerce_quantity_input_max', 'gafas_woo_quantity_input_max', 10, 2 );
function gafas_woo_quantity_input_max($max, $product) {
    // allow purchase of only one frame at a time for the rest allow normal
    // $max = gafas_is_prod_in_monturas($product->get_id()) ? 1 : 10;
    $max = 10;
    return $max;
}
add_filter( 'woocommerce_quantity_input_min', 'gafas_woo_quantity_input_min', 10, 2 );
function gafas_woo_quantity_input_min($min, $product) {
    $min = 1;
    return $min;
}


// move the short desc after the add to cart
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'gafas_template_single_excerpt', 32);
function gafas_template_single_excerpt() {
    wc_get_template_part('single-product/short-description');
}


// add wishlist button after the add to cart button
// add_action('woocommerce_single_product_summary', 'gafas_add_wishlist_after_add_to_cart_shop_sinlge', 31);
function gafas_add_wishlist_after_add_to_cart_shop_sinlge() {
    global $product;

    echo '<div class="wishlist">';
	echo do_shortcode('[yith_wcwl_add_to_wishlist]');
    echo '</div>';
}

// remove the product tabs from default location
// remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs');


// add the product tabs to the right section below the share
// add_action('woocommerce_single_product_summary', 'gafas_custom_product_accordions', 51);
function gafas_custom_product_accordions() {
    global $product;

    wc_get_template('single-product/tabs/tabs.php');
}

// add custom product tab for the product spec
// add_filter('woocommerce_product_tabs', 'gafas_add_custom_product_tabs');
function gafas_add_custom_product_tabs($tabs) {
    global $product;

    $pid = $product->get_id();

    // rename product description
    $tabs['description']['title']       = __('Product Description', 'shady');
    $tabs['description']['priority']    = 20;

    // set review tab priority to 40
    $tabs['reviews']['priority']        = 40;

    // specs tab
    if (get_field('show_product_spec_bool', $pid)) :
        $title  = get_field('product_spec_title_text', $pid);
        // Add a custom tab
        $tabs['additional_information'] = array(
            'title'     => $title,
            'priority'  => 10,
            'callback'  => 'gafas_woo_product_spec_table_tab'
        );
    endif;
    // shipping tab
    if (get_field('show_shipping_tab_bool', $pid)) :
        $title  = get_field('product_shipping_tab_title_text', $pid);
        // Add a custom tab
        $tabs['shipping'] = array(
            'title'     => $title,
            'priority'  => 30,
            'callback'  => 'gafas_woo_product_shipping_tab'
        );
    endif;

    return $tabs;
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


// render the size chart here
// add_action('woocommerce_before_add_to_cart_quantity', 'gafas_size_chart_before_quantity');
function gafas_size_chart_before_quantity() {
    global $product;
    $size_chart_pid = get_field('select_size_chart_post', $product->get_id());
    $fabric_pid     = get_field('select_fabric_guide_post', $product->get_id());

    // get the size chart images
    if ($size_chart_pid && get_field('show_size_chart_bool', $product->get_id())) :
        $desk       = get_field('size_chart_for_desktops', $size_chart_pid);
        $mob        = get_field('size_chart_for_mobiles', $size_chart_pid);
        ?>
        
        <div class="sizechart-wrap">
            <a href="#" class="sizechart-wrap__trigger-sizechart" data-bs-toggle="modal" data-bs-target="#sizeChartPop">
                <?php _e('See Size-Chart', 'shady');?>
            </a>
    
            <div class="modal fade" id="sizeChartPop" tabindex="-1" aria-labelledby="sizeChartPopLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="icon-x"></i>
                        </button>
                        <div class="modal-body">
                            <figure class="size-chart mb-0 d-none d-lg-block">
                                <img src="<?php echo $desk['url'];?>" alt="<?php echo $desk['alt'];?>" class="img-fluid">
                            </figure>
                            <figure class="size-chart mb-0 d-lg-none">
                                <img src="<?php echo $mob['url'];?>" alt="<?php echo $mob['alt'];?>" class="img-fluid">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endif;

    // get the fabric guide images
    if ($fabric_pid && get_field('show_fabric_guide_bool', $product->get_id())) :
        $desk       = get_field('size_chart_for_desktops', $fabric_pid);
        $mob        = get_field('size_chart_for_mobiles', $fabric_pid);
        ?>
        
        <div class="fabricguide-wrap">
            <a href="#" class="fabricguide-wrap__trigger-fabricguide" data-bs-toggle="modal" data-bs-target="#fabricGuidePop">
                <?php _e('See Fabric-Guide', 'shady');?>
            </a>
    
            <div class="modal fade" id="fabricGuidePop" tabindex="-1" aria-labelledby="fabricGuidePopLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="icon-x"></i>
                        </button>
                        <div class="modal-body">
                            <figure class="size-chart mb-0 d-none d-lg-block">
                                <img src="<?php echo $desk['url'];?>" alt="<?php echo $desk['alt'];?>" class="img-fluid">
                            </figure>
                            <figure class="size-chart mb-0 d-lg-none">
                                <img src="<?php echo $mob['url'];?>" alt="<?php echo $mob['alt'];?>" class="img-fluid">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endif;
}

// show shipping info after add to cart
add_action('woocommerce_single_product_summary', 'gafas_show_shipping_strings_after_add_to_cart', 32);
function gafas_show_shipping_strings_after_add_to_cart() {
    echo "<div class='woocommerce-product-details__shipping-info'>";
    echo do_shortcode('[wpced]');
    echo "</div>";
}

// add extra suffix to woo price in single product
// add_filter('woocommerce_get_price_suffix', 'gafas_add_extra_price_suffix', 99, 4);
function gafas_add_extra_price_suffix($html, $product, $price, $qty) {
    if (is_product()) {
        $price_suffix   = get_field('prod_price_second_suffix_text', 'option');
        if ($price_suffix) {
            $html       .= "<span class='woocommerce-price-suffix-second'>{$price_suffix}</span>";
            return $html;
        }
    }
    return;
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
    global $product; ?>
    <div class="lens-selection-form">
        <h5 class="select-title"><?php _e('Selecciona tus opciones', 'gafas');?></h5>
        
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
}

// add the modal after the add to cart button
add_action('woocommerce_after_add_to_cart_form', 'gafas_add_lens_selection_modal');
function gafas_add_lens_selection_modal() {
    get_template_part('woocommerce/single-product/lens-select');
}