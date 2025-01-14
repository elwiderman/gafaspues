/* 
**  All the common js methods are called here
*/

import $ from 'jquery';
import 'bootstrap';
import select2 from 'select2';
//Hook up select2 to jQuery
select2($);
// import 'select2/dist/js/i18n/it.js';

const desktopThreshold  = 1200,
    tabletThreshold = 768;

export default class AppCommon {
    constructor() {
        this.init();
    }

    // init the class
    init() {
        this.pageLoading();
        this.goTop();
        this.selectDropdown();
        // this.shopSortingDropdown();
    }

    // page loading anim
    pageLoading() {
        /* Loader for page */
        $(window)
            .on('load', function () {
                $('.spinner').delay(300).fadeOut();
                $('.animationload').delay(600).fadeOut('slow');
            })
            .on('beforeunload', function () {
                // turn the spinner back on before unload
                $('.spinner').fadeIn();
                $('.animationload').fadeIn();
            });
    }

    // go to top of the page action
    goTop() {
        $('.go-top').click(function (e) {
            e.preventDefault();

            $('html, body').animate({
                scrollTop: $('html, body').offset().top
            }, 1000);
        });
    }
    
    // refresh the page if its resizing
    refreshIfMobile() {
        window.resize(() => {
            setTimeout(() => {
                location.reload();
            }, 100);
        });
    }

    // trigger the fancybox 
    fancyLightbox() {
        $('.wp-block-gallery').each((i, elem) => {
            let target = $(elem).find('.blocks-gallery-item > figure > a');

            target.attr('data-fancybox', `gallery-${i}`);

            target.fancybox();
        });
    }

    checkEmailInput() {
        $('.footer .wpcf7-email').on('input', function () {
            let emailInput = $('.footer .wpcf7-email');
            let submitButton = $('.footer .form-submit');

            // If email input is empty, disable the submit button
            if (emailInput.val().trim() === '') {
                submitButton.prop('disabled', true);
            } else {
                submitButton.prop('disabled', false);
            }
        });

        // Call the event listener initially to set the button state
        $('.footer .wpcf7-email').trigger('input');
    }

    selectDropdown() {
        $('select.form-control').each((i, elem) => {
            let placeholder = $(elem).data('placeholder'),
                dropdownParent = $(elem).closest('.form-group');
            // add the placeholder for the dropdown as the first option of the select if cf7 form
            if ($(elem).hasClass('wpcf7-select')) {
                placeholder = $(elem).find('option:first-child').html();
                // remove the first elem
                $(elem).find('option:first-child').html('');

                dropdownParent = $(elem).closest('.wpcf7-form-control-wrap');
            }

            $(elem).select2({
                width: '100%',
                placeholder: placeholder,
                dropdownParent: dropdownParent,
                minimumResultsForSearch: -1
            });
        });
    }

    shopSortingDropdown() {
        let wrap = $('.woocommerce-ordering');
        wrap.find('select').select2({
            width: '100%',
            dropdownParent: wrap.find('.woocommerce-ordering__wrap'),
            minimumResultsForSearch: -1
        });
    }
}