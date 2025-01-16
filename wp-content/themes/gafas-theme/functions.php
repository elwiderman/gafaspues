<?php
// ACF
require_once(get_template_directory().'/inc/acf.php');

// Register scripts and stylesheets
require_once(get_template_directory().'/inc/enqueue-scripts.php');

// All Ajax
require_once(get_template_directory().'/inc/ajax.php');

// Custom theme functions
require_once(get_template_directory().'/inc/theme-functions.php');

// Register custom menus and menu walkers
require_once(get_template_directory().'/inc/menu.php');

// Custom image sizes for the theme
require_once(get_template_directory().'/inc/image.php');

// Adds the sidebar widget areas
require_once(get_template_directory().'/inc/sidebar.php');

// cf7 functions
require_once(get_template_directory().'/inc/cf7-functions.php');

// woo functions
require_once(get_template_directory().'/inc/woo-functions.php');

// Cpt
require_once(get_template_directory().'/inc/cpt.php');