<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php bloginfo('name'); ?> - <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php
    $favicon    = get_field('favicon_img', 'option');
    if ($favicon) :
        echo "<link rel='shortcut icon' type='image/x-icon' href='{$favicon['url']}'/>";
    endif;
    ?>

    <?php wp_head(); ?>
    <?php get_template_part('parts/header/head-scripts'); ?>
</head>

<body <?php body_class(); ?>>
<?php get_template_part('parts/header/body-scripts'); ?>

<?php
// add required template part
get_template_part('parts/header/nav', 'framework');

// content wrap class for 404 page to identify it in the 404 page
?>
<div class="main-content-wrap <?php echo is_404() ? 'error-page' : '';?>">