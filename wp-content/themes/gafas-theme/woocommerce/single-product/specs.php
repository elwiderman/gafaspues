<?php
// renders the product attributes 
global $product;
$pid    = $product->get_id();

$seller_id      = $product->get_post_data()->post_author;
$seller         = dokan()->vendor->get($seller_id);
$seller_name    = $seller->get_shop_name();
// create the seller url from the shop url
$store_url      = get_permalink(wc_get_page_id('shop'));
$seller_url     = add_query_arg(['marca' => $seller_id], $store_url);
$string         = __('Marca:', 'gafas');
?>

<div class="woocommerce-product-details__product-specs">
    <h6 class="specs-title"><?php _e('Especificaciones del producto', 'gafas');?></h6>
    <ul class="specs">
        <?php
        if (get_field('full_width_num')) :
            $val    = get_field('full_width_num');
            echo "<li>
                <span class='specs__label'>Ancho Completo</span>
                <span class='specs__value'>{$val}mm</span>
            </li>";
        endif;
        if (get_field('lens_width_num')) :
            $val    = get_field('lens_width_num');
            echo "<li>
                <span class='specs__label'>Ancho Lente</span>
                <span class='specs__value'>{$val}mm</span>
            </li>";
        endif;
        if (get_field('bridge_num')) :
            $val    = get_field('bridge_num');
            echo "<li>
                <span class='specs__label'>Puente</span>
                <span class='specs__value'>{$val}mm</span>
            </li>";
        endif;
        if (get_field('arms_num_copy')) :
            $val    = get_field('arms_num_copy');
            echo "<li>
                <span class='specs__label'>Brazo</span>
                <span class='specs__value'>{$val}mm</span>
            </li>";
        endif;

        if ($product->get_attribute('pa_material')) :
            echo "<li>
                <span class='specs__label'>Material</span>
                <span class='specs__value'>{$product->get_attribute('pa_material')}</span>
            </li>";
        endif;

        if ($product->get_attribute('pa_agarre-del-lente')) :
            echo "<li>
                <span class='specs__label'>Agarre del lente</span>
                <span class='specs__value'>{$product->get_attribute('pa_agarre-del-lente')}</span>
            </li>";
        endif;

        if ($product->get_attribute('pa_estilo')) :
            echo "<li>
                <span class='specs__label'>Estilo</span>
                <span class='specs__value'>{$product->get_attribute('pa_estilo')}</span>
            </li>";
        endif;

        if ($product->get_attribute('pa_color')) :
            echo "<li>
                <span class='specs__label'>Color</span>
                <span class='specs__value'>{$product->get_attribute('pa_color')}</span>
            </li>";
        endif;

        if ($seller) :
            echo "<li>
                <span class='specs__label'>{$string}</span>
                <a class='specs__value' href='{$seller_url}' target='_blank'>{$seller_name}</a>
            </li>";
        endif;
        ?>
    </ul>
</div>