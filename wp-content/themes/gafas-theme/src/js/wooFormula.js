// all js for creating the product options

import ready from 'domready';
import $, { error } from 'jquery';
import * as bootstrap from 'bootstrap';
import '@popperjs/core';
import select2 from 'select2';
//Hook up select2 to jQuery
select2($);
import 'select2/dist/js/i18n/es.js';

export default class WooFormula {
    constructor() {
        this.init();
    }

    init() {
        console.log('WooFormula initialized');
        
        if ($('.single-page.single-product').length) {
            this.selectFrameOption();
            this.initSelectDropdown();
            this.renderLensVariations();
            this.addToCartLensConfig();
        }
    }

    selectFrameOption() {
        let cartForm = $('form.cart'),
            addCartBtn = cartForm.find('button[type="submit"].single_add_to_cart_button.btn-frame'),
            quantity = addCartBtn.siblings('.quantity');
        
        addCartBtn.hide();
        quantity.hide();

        cartForm.on('change', '.frame-option', e => {
            let value = $(e.currentTarget).val();
            
            if (value === 'frame') {
                addCartBtn.show();
                quantity.show();
            } else if (value === 'powered') {
                addCartBtn.hide();
                quantity.hide();

                let modal = new bootstrap.Modal($('#lensSelectionModal')[0]);
                modal.show();
            }
        });

        // select the first options for lens type and lens tint
        let form = $('#lensFormula');
        $('#lensSelectionModal').on('shown.bs.modal', e => {
            form.find('.lens-type-wrap.type > .form-check:first-child input[name="lens_type"]').prop('checked', true);
            form.find('.lens-type-wrap.tint > .form-check:first-child input[name="lens_tint"]').prop('checked', true).trigger('change');
            
            $('#lensSelectionModal').find('[data-bs-toggle="tooltip"]').tooltip({
                'container': '#lensSelectionModal'
            }).show();
        });
    }

    initSelectDropdown() {
        $('select.form-select').each((i, elem) => {
            let dropdownParent = $(elem).closest('.form-select-wrap.to-dropdown');

            $(elem).select2({
                width: '100%',
                dropdownParent: dropdownParent,
                minimumResultsForSearch: 1
            });
        });
    }

    renderLensVariations() {
        let form = $('#lensFormula'),
            formulaWrap = form.find('.formula-wrap');

        form.on('change', 'input[name="lens_type"]', e => {
            e.preventDefault();

            let value = $(e.currentTarget).val();
            if (value === 'solo-para-descanso') {
                formulaWrap.fadeOut();
            } else {
                formulaWrap.fadeIn();
            }
        });

        form.on('change', 'input[name="lens_type"], input[name="lens_tint"], .form-select, .form-control', e => {
            e.preventDefault();

            let data = {
                'action': 'gafas_render_lens_variations',
                'lens_type': form.find('input[name="lens_type"]:checked').val(),
                'lens_tint': form.find('input[name="lens_tint"]:checked').val(),
                'frame_id': form.find('input[name="frame_id"]').val()
            };

            form.trigger('submit');
        });

        form.on('submit', e => {
            e.preventDefault();

            let data = form.serializeArray(),
                addToCartForm = $('#lensAddToCart');

            $.ajax({
                data: data,
                type: 'post',
                dataType: 'json',
                url: WPURLS.ajaxurl,
                beforeSend: xhr => {
                    console.log('loading lens ...');
                    form.find('.available-lens').html('Recogiendo las lentes....');
                    console.log(data);
                    form.find('input[name="lens_type"], input[name="lens_tint"]').siblings('.form-check-label').addClass('no-click');
                },
                success: response => {
                    // console.log(response);
                    if (response.results) {
                        let html = '';

                        response.results.forEach((elem, i) => {
                            console.log(elem);

                            html += `
                            <div class='lens'>
                                <div class='lens__select' 
                                    data-lens_id='${elem.lens_id}'
                                    data-variation_id='${elem.variation}'
                                    data-lens_name='${elem.lens_name}'
                                    data-lens_price='${elem.price_html}'>
                                    <h4 class='lens__select--title'>${elem.lens_name}</h4>
                                    <div class='lens__select--price' data-price='${elem.price}'>${elem.price_html}</div>
                                </div>
                            </div>
                            `;
                        });

                        form.find('.available-lens').html(html);
                    }
                    // add the formula to add to cart form
                    if (response.formula) {
                        // console.log(response.formula);
                        $.each(response.formula, (key, val) => {
                            // console.log(key);
                            // console.log(val);
                            addToCartForm.find(`input[name="${key}"]`).val(val);
                        });
                    }

                    form.find('input[name="lens_type"], input[name="lens_tint"]').siblings('.form-check-label').removeClass('no-click');

                    this.handleFinalLensSelect();
                },
                error: err => {
                    console.log(err);
                    form.find('input[name="lens_type"], input[name="lens_tint"]').siblings('.form-check-label').removeClass('no-click');
                }
            });
        });
    }

    handleFinalLensSelect() {
        let lensWrap = $('#availableLens'),
            addToCartForm = $('#lensAddToCart');

        lensWrap.on('click', '.lens__select', e => {
            e.preventDefault();

            let lens = $(e.currentTarget),
                lens_id = lens.data('lens_id'),
                lens_varation = lens.data('variation_id'),
                lens_name = lens.data('lens_name'),
                lens_price = lens.data('lens_price'),
                lens_price_raw = lens.find('.lens__select--price').data('price'),
                frame_price = addToCartForm.find('.selected-wrap__row.frame .selected-wrap__price').data('prod_price');
            
            addToCartForm.find('input[name="lens_id"]').val(lens_id);
            addToCartForm.find('input[name="variation_id"]').val(lens_varation);

            addToCartForm.find('.selected-wrap__row.lens figcaption').html(lens_name);
            addToCartForm.find('.selected-wrap__row.lens .selected-wrap__price').html(lens_price);
            
            let total = lens_price_raw + frame_price,
                totalFormatted = total.toLocaleString('es-CO');
            // console.log(lens_price_raw);
            // console.log(frame_price);
            
            addToCartForm.find('.selected-wrap__row.total .selected-wrap__price').html(`$${totalFormatted}`);
        });
    }

    addToCartLensConfig() {
        let formulaForm = $('#lensAddToCart');

        formulaForm.on('submit', e => {
            e.preventDefault();

            let data = formulaForm.serializeArray(),
                btn = formulaForm.find('button[type="submit"]');

            $.ajax({
                data: data,
                type: 'post',
                dataType: 'json',
                url: WPURLS.ajaxurl,
                beforeSend: xhr => {
                    console.log('adding to cart ...');
                    // console.log(data);
                    btn.addClass('loading');
                },
                success: response => {
                    console.log(response);
                    btn.removeClass('loading');
                    if (response.cart) {
                        window.location.replace(response.cart);
                    }
                },
                error: err => {
                    console.log(err);
                    btn.removeClass('loading');
                }
            });
        });
    }
}

ready(() => {
    new WooFormula();
});