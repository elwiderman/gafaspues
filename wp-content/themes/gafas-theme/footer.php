<?php
/* this is common footer partial */
$bg         = get_field('footer_background_img', 'option');
?>
    </div>

    <?php
    // placeholder wrapper for the sidebar only for mobiles 
    if (is_tax(['product_cat']) || is_shop()) :
        echo '<button class="filter-toggler" id="sidebarFilterToggle" data-target="#sidebar"><i class="icon-filter"></i></button>';
    endif;
    ?>

    <div class="footer-bar">
        <div class="container">
            <?php
            if (have_rows('footer_icon_blocks_repeater', 'option')) :
                echo "<div class='row footer-bar__row'>";
                while (have_rows('footer_icon_blocks_repeater', 'option')) : the_row();
                    $icon   = get_sub_field('icon_select');
                    $title  = get_sub_field('titulo_text');
                    $desc   = get_sub_field('desc_text');

                    echo "
                    <div class='col-12 col-md-4'>
                        <div class='info'>
                            <i class='{$icon}'></i>
                            <div class='info__meta'>
                                <h6 class='info__meta--title'>{$title}</h6>
                                <p class='info__meta--desc mb-0'>{$desc}</p>
                            </div>
                        </div>
                    </div>
                    ";
                endwhile;
                echo "</div>";
            endif;
            ?>
        </div>
    </div>

    <footer class="footer" style="background-image: url(<?php echo $bg['url']; ?>);">
        <?php get_template_part('parts/footer/footer', 'framework'); ?>
    </footer>

    <?php
    // add the sharethis script
    $sharethis	= get_field('sharethis_key', 'option');

    if (!empty($sharethis) && is_singular(['product'])) : ?>
        <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=<?php echo $sharethis;?>&source=platform" async="async"></script>
    <?php endif; ?>

    <?php wp_footer(); ?>

    </body>

</html>
