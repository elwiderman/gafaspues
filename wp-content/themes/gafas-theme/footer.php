<?php
/* this is common footer partial */
$bg         = get_field('footer_background_img', 'option');
?>

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
