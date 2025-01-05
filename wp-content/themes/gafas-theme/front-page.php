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
    ?>
</div>

<?php
get_footer();