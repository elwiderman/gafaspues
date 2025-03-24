<?php
/* 
    Template name: Page Sitemap
*/
get_header();
?>
<div class="single-page single-sitemap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php echo do_shortcode('[wp_sitemap_page]'); ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();