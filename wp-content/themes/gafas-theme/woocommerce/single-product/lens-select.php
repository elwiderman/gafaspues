<?php
// partial to render the content of the modal in the lens selection for single product page
global $product;
?>

<div class="modal fade" id="lensSelectionModal" tabindex="-1" aria-labelledby="lensSelectionModal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title styled" id="lensSelectionModal"><?php _e('Configura tu lente', 'gafas');?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-area form-lens-formula" id="">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <form id="lensFormula" class="form-area form-formula-select">
                                    <input type="hidden" name="frame_id" value="<?php echo $product->get_id();?>">
                                    <input type="hidden" name="action" value="gafas_render_lens_variations">
                                    <?php
                                    $all_lens = get_terms([
                                        'taxonomy'      => 'product_cat',
                                        'exclude'       => 55,
                                        'parent'        => 46,
                                        'hide_empty'    => false,
                                    ]);
                                    $all_lens_tint = get_terms([
                                        'taxonomy'      => 'product_cat',
                                        'parent'        => 55,
                                        'hide_empty'    => false,
                                    ]);
                                    ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title styled">1. <?php _e('Tipo de visión', 'gafas');?></h5>
                                            <div class="lens-type-wrap type">
                                                <?php
                                                foreach ($all_lens as $lens) :
                                                    $lens_name      = $lens->name;
                                                    $lens_slug      = $lens->slug;
                                                    $lens_id        = $lens->term_id;
                                                    $thumb_id       = get_term_meta($lens_id, 'thumbnail_id', true);
                                                    $lens_thumb     = wp_get_attachment_image_url($thumb_id, 'full');
                                                    $lens_desc      = $lens->description;
                                                    $tooltip        = '';
                                                    if ($lens_desc) :
                                                        $tooltip        = "
                                                        <button type='button' class='btn-info' data-bs-toggle='tooltip' data-bs-html='true' data-bs-title='{$lens_desc}'>
                                                            <i class='icon-info'></i>
                                                        </button>
                                                        ";
                                                    endif;
            
                                                    echo "
                                                    <div class='form-check'>
                                                        <input class='form-check-input' type='radio' name='lens_type' value='{$lens_slug}' id='lensType-{$lens_slug}' data-id='{$lens_id}'>
                                                        <label class='form-check-label' for='lensType-{$lens_slug}'>
                                                            <figure class='lens-type-wrap__name mb-0'>
                                                                <img src='{$lens_thumb}' alt='{$lens_name}' class='img-fluid'>
                                                                <figcaption>
                                                                    {$lens_name}{$tooltip}
                                                                </figcaption>
                                                            </figure>
                                                        </label>
                                                    </div>
                                                    ";
                                                endforeach;
                                                ?>
                                            </div>
                                            <hr>
                                        </div>

                                        <div class="col-12">
                                            <h5 class="form-title styled">2. <?php _e('Los deseas de sol con aumento?', 'gafas');?></h5>
                                            <div class="lens-type-wrap tint">
                                                <?php
                                                foreach ($all_lens_tint as $lens) :
                                                    $lens_name      = $lens->name;
                                                    $lens_slug      = $lens->slug;
                                                    $lens_id        = $lens->term_id;
                                                    $thumb_id       = get_term_meta($lens_id, 'thumbnail_id', true);
                                                    $lens_thumb     = wp_get_attachment_image_url($thumb_id, 'full');
                
                                                    echo "
                                                    <div class='form-check'>
                                                        <input class='form-check-input' type='radio' name='lens_tint' value='{$lens_slug}' id='lensTintType-{$lens_slug}' data-id='{$lens_id}'>
                                                        <label class='form-check-label' for='lensTintType-{$lens_slug}'>
                                                            <figure class='lens-type-wrap__name mb-0'>
                                                                <img src='{$lens_thumb}' alt='{$lens_name}' class='img-fluid'>
                                                                <figcaption>{$lens_name}</figcaption>
                                                            </figure>
                                                        </label>
                                                    </div>
                                                    ";
                                                endforeach;
                                                ?>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6 formula-wrap">
                                            <h5 class="form-title styled">3. <?php _e('Formula', 'gafas');?></h5>
                                            <div id="formFormula" class="formula-input">
                                                <div class="row mb-0">
                                                    <div class="col"></div>
                                                    <div class="col">
                                                        <h6 class="formula-input__title text-center"><?php _e('ESF.', 'gafas');?></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="formula-input__title text-center"><?php _e('CIL.', 'gafas');?></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="formula-input__title text-center"><?php _e('EJE.', 'gafas');?></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="formula-input__title text-center"><?php _e('ADD.', 'gafas');?></h6>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-2">
                                                    <div class="col">
                                                        <h6 class="formula-input__title"><?php _e('Ojo Izq.', 'gafas');?></h6>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-select-wrap">
                                                            <select name="left_esf" id="leftEsf" class="form-select">
                                                                <?php echo generateSelectOptions(-8.00, 8.00, 0.25, 2);?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-select-wrap">
                                                            <select name="left_cil" id="leftCil" class="form-select">
                                                                <?php echo generateSelectOptions(-6.00, 0, 0.25, 2);?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-select-wrap">
                                                            <select name="left_eje" id="leftEje" class="form-select">
                                                                <?php echo generateSelectOptions(0, 180, 1, 0);?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-select-wrap">
                                                            <select name="left_add" id="leftAdd" class="form-select">
                                                                <option value="0.00">0.00</option>
                                                                <?php echo generateSelectOptions(0.75, 3.50, 0.25, 2);?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-2">
                                                    <div class="col">
                                                        <h6 class="formula-input__title"><?php _e('Ojo Der.', 'gafas');?></h6>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-select-wrap">
                                                            <select name="right_esf" id="rightEsf" class="form-select">
                                                                <?php echo generateSelectOptions(-8.00, 8.00, 0.25, 2);?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-select-wrap">
                                                            <select name="right_cil" id="rightCil" class="form-select">
                                                                <?php echo generateSelectOptions(-6.00, 0, 0.25, 2);?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-select-wrap">
                                                            <select name="right_eje" id="rightEje" class="form-select">
                                                                <?php echo generateSelectOptions(0, 180, 1, 0);?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-select-wrap">
                                                            <select name="right_add" id="rightAdd" class="form-select">
                                                                <option value="0.00">0.00</option>
                                                                <?php echo generateSelectOptions(0.75, 3.50, 0.25, 2);?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <h6 class="formula-input__title"><?php _e('Distancia Pupilar', 'gafas');?></h6>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="dp" id="dp" placeholder="<?php _e('Distancia Pupilar', 'gafas');?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <h5 class="form-title styled">4. <?php _e('Escoge tu lente', 'gafas');?></h5>
                                            <div class="available-lens" id="availableLens"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="col-12 col-md-4">
                                <form class="form-area form-lens-addcart" id="lensAddToCart">
                                    <h5 class="selected-title styled"><?php _e('Tus Selecciones', 'gafas');?></h5>
                                    <div class="selected-wrap">
                                        <div class="selected-wrap__row frame">
                                            <?php
                                            $prod_thumb = get_the_post_thumbnail_url($product->get_id(), 'thumbnail');
                                            $prod_title = $product->get_name();
                                            $prod_price = $product->get_price();
                                            ?>
                                            <div class="selected-wrap__label"><?php _e('Montura', 'gafas');?></div>
                                            <div class="selected-wrap__prod">
                                                <figure class="mb-0">
                                                    <img src="<?php echo $prod_thumb;?>" alt="<?php echo $prod_title;?>" class="img-fluid">
                                                    <figcaption><?php echo $prod_title;?></figcaption>
                                                </figure>
                                            </div>
                                            <div class="selected-wrap__price" data-prod_price="<?php echo $prod_price;?>">
                                                <?php echo $product->get_price_html();?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="selected-wrap__row lens">
                                            <div class="selected-wrap__label"><?php _e('Lentes', 'gafas');?></div>
                                            <div class="selected-wrap__prod">
                                                <figure class="mb-0">
                                                    <img src="" alt="" class="img-fluid">
                                                    <figcaption>-</figcaption>
                                                </figure>
                                            </div>
                                            <div class="selected-wrap__price" data-prod_price="">-</div>
                                        </div>
                                        <hr>
                                        <div class="selected-wrap__row total">
                                            <div class="selected-wrap__label"><?php _e('Total', 'gafas');?></div>
                                            <div class="selected-wrap__price"><?php echo $product->get_price_html();?></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="frame_id" value="<?php echo $product->get_id();?>">
                                    <input type="hidden" name="lens_id" value="">
                                    <input type="hidden" name="variation_id" value="">
                                    <input type="hidden" name="left_esf" value="">
                                    <input type="hidden" name="right_esf" value="">
                                    <input type="hidden" name="left_cil" value="">
                                    <input type="hidden" name="right_cil" value="">
                                    <input type="hidden" name="left_eje" value="">
                                    <input type="hidden" name="right_eje" value="">
                                    <input type="hidden" name="left_add" value="">
                                    <input type="hidden" name="right_add" value="">
                                    <input type="hidden" name="dp" value="">
                                    <input type="hidden" name="action" value="gafas_add_lens_config_to_cart">

                                    <button class="btn-outline-dark" type="submit">
                                        <span><?php _e('Agregar al carrito', 'gafas');?></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>