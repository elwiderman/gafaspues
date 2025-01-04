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
    }

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
}

ready(() => {
    new Home();
});