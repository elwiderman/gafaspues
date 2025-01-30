// all js for the home page
import ready from 'domready';
import $ from 'jquery';
import 'slick-carousel';
import gsap from 'gsap';
import * as bootstrap from 'bootstrap';

export default class Home {
    constructor() {
        this.init();
    }

    init() {
        this.heroSlider();
        this.prodCatSlider();
        this.featuredProdSlider();
        this.brandsSlider();
    }

    // the home hero slider
    heroSlider() {
        let slider = $('#homeHero');

        slider.on('init', (evt, slick) => {
            let slide = $(slider).find('.slick-current.slick-active'),
                animItems = gsap.utils.toArray(slide.find('.to-stagger'));

            let left = slide.find('.slide__left'),
                right = slide.find('.slide__right'),
                logo = slide.find('.slide__logo'),
                main = slide.find('.slide__main');

            let tl = gsap.timeline();
            tl.from(left, {
                autoAlpha: 0,
                xPercent: -100,
                duration: 0.3
            }).from(right, {
                autoAlpha: 0,
                xPercent: 100,
                duration: 0.3
            }, '-=0.3').from(logo, {
                autoAlpha: 0,
                yPercent: -100,
                duration: 0.3
            }, '+=0.2').from(main, {
                autoAlpha: 0,
                yPercent: 100,
                duration: 0.4
            }, '-=0.2').from(animItems, {
                autoAlpha: 0,
                yPercent: 100,
                stagger: 0.2
            }, '+=0.1');
        });

        slider.slick({
            dots: true,
            arrows: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 5000,
            rows: 0,
            speed: 800,
            fade: true,
            cssEase: 'ease',
            lazyLoad: 'ondemand',
            pauseOnHover: true,
        });

        slider.on('beforeChange', (evt, slick, currentSlide, nextSlide) => {
            let slide = slick.$slides[nextSlide],
                animItems = gsap.utils.toArray($(slide).find('.to-stagger'));

            let left = $(slide).find('.slide__left'),
                right = $(slide).find('.slide__right'),
                logo = $(slide).find('.slide__logo'),
                main = $(slide).find('.slide__main');

            let tl = gsap.timeline();
            tl.from(left, {
                autoAlpha: 0,
                xPercent: -100,
                duration: 0.3
            }).from(right, {
                autoAlpha: 0,
                xPercent: 100,
                duration: 0.3
            }, '-=0.3').from(logo, {
                autoAlpha: 0,
                yPercent: -100,
                duration: 0.3
            }, '+=0.2').from(main, {
                autoAlpha: 0,
                yPercent: 100,
                duration: 0.4
            }, '-=0.2').from(animItems, {
                autoAlpha: 0,
                yPercent: 100,
                stagger: 0.1
            }, '+=0.2');
        });
    }

    // the slider for the prod cats
    prodCatSlider() {
        let slider = $('#prodCatsSlider');

        slider.slick({
            dots: false,
            arrows: true,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 5000,
            rows: 0,
            speed: 800,
            fade: false,
            cssEase: 'ease',
            lazyLoad: 'ondemand',
            pauseOnHover: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            appendArrows: $('#prodCatsSliderNav'),
            prevArrow: '<button class="slick-prev slick-arrow"><i class="icon-chevron-left"></i></button>',
            nextArrow: '<button class="slick-next slick-arrow"><i class="icon-chevron-right"></i></button>',
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });
    }

    // featured products slider
    featuredProdSlider() {
        let settings = {
            dots: false,
            arrows: false,
            infinite: false,
            speed: 800,
            fade: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            swipeToSlide: true,
            waitForAnimate: true,
            centerMode: false,
            lazyLoad: 'ondemand',
            adaptiveHeight: false,
            variableWidth: false,
            autoplay: true,
            autoplaySpeed: 4000,
            pauseOnHover: true,
            rows: 0,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    infinite: true
                }
            }]
        };

        $('button[data-bs-toggle="tab"]').each((i, elem) => {
            let target = $(elem).data('bs-target'),
                slider = $(target).find('.product-slider');

            elem.addEventListener('show.bs.tab', event => {
                slider.slick(settings);
            });
            elem.addEventListener('hidden.bs.tab', event => {
                if (slider.hasClass('slick-initialized')) {
                    slider.slick('unslick');
                }
            });
        });

        $(window).on('load', e => {
            $('#featProdsTab .nav-item').first().find('.nav-link').trigger('click');
        });
    }

    brandsSlider() {
        let slider = $('#brandsSlider');

        slider.slick({
            dots: false,
            arrows: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 0,
            rows: 0,
            speed: 5000,
            fade: false,
            cssEase: 'linear',
            lazyLoad: 'ondemand',
            pauseOnHover: true,
            centerMode: true,
            variableWidth: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            // responsive: [{
            //     breakpoint: 1024,
            //     settings: {
            //         slidesToShow: 3,
            //         slidesToScroll: 1
            //     }
            // }, {
            //     breakpoint: 768,
            //     settings: {
            //         slidesToShow: 2,
            //         slidesToScroll: 1
            //     }
            // }, {
            //     breakpoint: 480,
            //     settings: {
            //         slidesToShow: 1,
            //         slidesToScroll: 1
            //     }
            // }]
        });
    }
}

ready(() => {
    new Home();
});