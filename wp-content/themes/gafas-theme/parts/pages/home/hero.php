<?php
// hero section
if (have_rows('hero_slider_repeater')) : ?>
<section class="section-block section-hero">
    <div class="home-hero-slider" id="homeHero">
    <?php
    while (have_rows('hero_slider_repeater')) : the_row();
        $left       = get_sub_field('left_gradient_text');
        $right      = get_sub_field('right_gradient_text');
        $logo       = get_sub_field('logo_img');
        $main       = get_sub_field('slide_main_img');
        $text       = nl2br(get_sub_field('slide_content'));
        $cta        = get_sub_field('slide_cta_link');

        echo "
        <div>
            <div class='slide'>
                <div class='slide__left' style='{$left}'></div>
                <div class='slide__right' style='{$right}'></div>
                <figure class='slide__logo mb-0'>
                    <img src='{$logo['url']}' alt='{$logo['alt']}'>
                </figure>
                <figure class='slide__main mb-0'>
                    <img src='{$main['url']}' alt='{$main['alt']}'>
                </figure>
                <div class='slide__content'>
                    <p class='slide__content--text to-stagger'>{$text}</p>
                    <div class='slide__content--wrap to-stagger'>
                        <a href='{$cta['url']}' class='btn-outline-dark' target='{$cta['target']}'>{$cta['title']}</a>
                    </div>
                </div>
            </div>
        </div>
        ";
    endwhile;
    ?>
    </div>
</section>
<?php
endif;