// all the js for the main nav goes here

let jQuery = require('jquery');
window.$ = window.jQuery = jQuery;
let $ = jQuery.noConflict();

const tabletThreshold           = 768;
const desktopThreshold          = 1200;

export default class MainNav {
    constructor() {
        this.init();
    }

    init() {
        this.nav();
        this.mobileOffcanvas();
        this.triggerSubMenu();
    }

    nav() {
        $(window).on('load resize', e => {
            if ($(window).width() < desktopThreshold) {
                // Closes the mobile menu when the nav links are clicked on
                $('.nav-link').on('click', () => {
                    $('.header__nav--toggler, .header__nav--collapse').removeClass('open');
                });
            }
        });
    }
    
    // toggle the offcanvas 
    mobileOffcanvas() {
        $('header.header').on('click', '.header__nav--toggler', e => {
            e.preventDefault();
            e.stopPropagation();
    
            let $this = $(e.currentTarget),
                mainNav = $('header .header__nav--collapse');
    
            if ($this.hasClass('open')) {
                $this.removeClass('open');
                mainNav.removeClass('open');
                $('body').css('overflow', 'unset');
            } else {
                $this.addClass('open');
                mainNav.addClass('open');
                $('body').css('overflow', 'hidden');
            }
        });
    }

    // show the sub menu
    triggerSubMenu() {
        // $('header.header').on('mouseenter', 'a.dropdown-toggle', e => {
        //     e.preventDefault();
        //     e.stopPropagation();

        //     console.log('asdasdas');
            
    
        //     let $this = $(e.currentTarget),
        //         subMenu = $this.next('.dropdown-menu');
    
        //     if ($this.hasClass('show')) {
        //         $this.removeClass('show');
        //         subMenu.removeClass('show');
        //     } else {
        //         $this.addClass('show');
        //         subMenu.addClass('show');
        //     }
        // });


        if ($(window).width() >= desktopThreshold) {
            // Removes submenu when mouse leaves the menu item
            $('.header').find('li.dropdown').on('mouseleave', e => {
                $(e.currentTarget).find('.dropdown-toggle').removeClass('show').siblings('.dropdown-menu').removeClass('show');
            });

            // Add event listener for .dropdown-toggle
            $('.header').find('.dropdown-toggle').on('mouseenter', e => {
                $(e.currentTarget).addClass('show').siblings('.dropdown-menu').addClass('show');
            });
        }
    }
}