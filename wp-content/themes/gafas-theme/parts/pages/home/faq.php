<?php
// the faq section
if (get_field('show_faq_bool')) : 
    $pretitle   = get_field('faq_pretitle_text');
    $title      = get_field('faq_title_text');
    $desc       = nl2br(get_field('faq_desc_text'));
    ?>
    <section class="section-block section-faq">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-auto">
                    <h6 class="pre-title text-uppercase"><?php echo $pretitle;?></h6>
                </div>
                <div class="w-100"></div>
                <div class="col-auto text-center">
                    <h3 class="section-title h2 styled"><?php echo $title;?></h3>
                </div>
                <div class="col-12 col-md-11 col-xl-10">
                    <p class="section-desc"><?php echo $desc;?></p>
                </div>
            </div>
            <?php
            if (have_rows('faq_repeater')) :
                echo "<div class='row justify-content-center faq-block'>";
                while (have_rows('faq_repeater')) : the_row();
                    $icon   = get_sub_field('faq_img');
                    $label  = get_sub_field('faq_title_text');
                    $link   = get_sub_field('faq_link');

                    echo "<div class='col-6 col-md-auto'>
                        <div class='faq'>
                            <a href='{$link['url']}' target='{$link['target']}' class='faq__perma'>
                                <img src='{$icon['url']}' alt='{$icon['alt']}' class='faq__perma--icon'>
                                <h6 class='faq__perma--title'>{$label}</h6>
                            </a>
                        </div>
                    </div>";
                endwhile;
                echo "</div>";
            endif;
            ?>
        </div>
    </section>
    <?php
endif;