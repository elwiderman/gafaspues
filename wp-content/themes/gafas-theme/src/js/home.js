// all js for the home page
import ready from 'domready';
import $ from 'jquery';
import 'slick-carousel';
import gsap from 'gsap';

export default class Home {
    constructor() {
        this.init();
    }

    init() {
        this.heroSlider();
        this.prodCatSlider();
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