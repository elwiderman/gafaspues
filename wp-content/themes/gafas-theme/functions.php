<?php
// ACF
require_once(get_template_directory().'/inc/acf.php');

// Register scripts and stylesheets
require_once(get_template_directory().'/inc/enqueue-scripts.php');

// Custom theme functions
require_once(get_template_directory().'/inc/theme-functions.php');

// Register custom menus and menu walkers
require_once(get_template_directory().'/inc/menu.php');

// Custom image sizes for the theme
require_once(get_template_directory().'/inc/image.php');

// cf7 functions
require_once(get_template_directory().'/inc/cf7-functions.php');

// cf7 functions
require_once(get_template_directory().'/inc/woo-functions.php');