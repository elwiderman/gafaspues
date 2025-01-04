<?php
// calling custom nav walker for BS
require_once('bs4navwalker.php');

// Register menus
register_nav_menus(
    array(
        'main-nav'          => __('Main Menu', 'gafas'),
        'footer-links'      => __('Footer Menu', 'gafas'),
        'nav-cart'          => __('Nav Location for Cart', 'gafas'),
        'nav-wishlist'      => __('Nav Location for Wishlist', 'gafas'),
    )
);

function main_menu() {
    wp_nav_menu(
        array(
            'container'     => false,
            'menu_class'    => 'main-menu__list',
            'items_wrap'    => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'theme_location' => 'main-nav',
            'depth'         => 5,
            'fallback_cb'   => 'bs4navwalker::fallback',
            'walker'        => new bs4navwalker()
        )
    );
}

// The Footer Menu
function footer_menu() {
    wp_nav_menu(array(
        'container'         => false,
        'menu_class'        => 'footer-links',
        'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'theme_location'    => 'footer-links',
        'depth'             => 5,
        'fallback_cb'       => false
    ));
}

// The Footer Credits Menu
function footer_credits() {
    wp_nav_menu(array(
        'container'         => false,
        'menu_class'        => 'links',
        'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'theme_location'    => 'footer-links'
    ));
}

function nav_cart() {
    wp_nav_menu(
        array(
            'container'     => false,
            'menu_class'    => 'navbar-cart',
            'items_wrap'    => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'theme_location'=> 'nav-cart',
            'depth'         => 1,
            'fallback_cb'   => 'bs4navwalker::fallback',
            'walker'        => new bs4navwalker()
        )
    );
}

function nav_wishlist() {
    wp_nav_menu(
        array(
            'container'     => false,
            'menu_class'    => 'navbar-wishlist',
            'items_wrap'    => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'theme_location'=> 'nav-wishlist',
            'depth'         => 1,
            'fallback_cb'   => 'bs4navwalker::fallback',
            'walker'        => new bs4navwalker()
        )
    );
}