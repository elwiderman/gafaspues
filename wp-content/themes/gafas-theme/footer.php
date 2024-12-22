<?php
/* this is common footer partial */
?>

    </div>

    <footer class="footer">
        <?php get_template_part('parts/footer/footer', 'framework'); ?>
    </footer>

    <?php
    // add the sharethis script
    $sharethis	= get_field('sharethis_key', 'option');

    if (!empty($sharethis) && is_singular(['post'])) : ?>
        <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=<?php echo $sharethis;?>&source=platform" async="async"></script>
    <?php endif; ?>

    <?php wp_footer(); ?>

    </body>

</html>
