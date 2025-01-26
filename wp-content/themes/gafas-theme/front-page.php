<?php
/*
    Template name: Homepage
*/
get_header();
?>

<div class="single-page single-home woocommerce">
    <?php
    get_template_part('parts/pages/home/hero');
    get_template_part('parts/pages/home/prod-cats');
    get_template_part('parts/pages/home/trends');
    get_template_part('parts/pages/home/brands');
    get_template_part('parts/pages/home/featured');
    get_template_part('parts/pages/home/women-men');
    get_template_part('parts/pages/home/faq');
    ?>
</div>

<?php
get_footer();