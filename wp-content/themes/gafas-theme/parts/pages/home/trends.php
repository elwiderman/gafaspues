<?php
// the trending products section
if (get_field('show_trends_bool')) : ?>
<section class="section-block section-trends">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-auto">
                <h1 class="section-title h3 styled"><?php echo get_field('trends_title_text');?></h1>
            </div>
        </div>

        <div class="row trends-products">
            <?php
            // for trends
            if (sizeof(get_field('trend_prods_rel')) > 0) :
                foreach (get_field('trend_prods_rel') as $post_object) :
                    // $post_object = get_post($post_id);

                    setup_postdata($GLOBALS['post'] =& $post_object);
                    wc_get_template_part('content', 'product');
                    wp_reset_postdata();
                endforeach;
            endif;
            ?>
        </div>

        <?php
        if (get_field('trends_cta_link')) :
            $link = get_field('trends_cta_link');
            echo "
            <div class='row justify-content-center mt-4'>
                <div class='col-auto'>
                    <a href='{$link['url']}' class='btn-dark' target='{$link['target']}'>{$link['title']}</a>
                </div> 
            </div>
            ";
        endif;
        ?>
    </div>
</section>
<?php
endif;