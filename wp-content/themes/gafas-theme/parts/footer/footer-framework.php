<?php
// the footer partial
$pg_icons   = get_field('footer_payment_icons_img', 'option');
$copy_text  = get_field('copyright_text', 'option');

?>

<div class="footer__top">
    <div class="container">
        <div class="row">
            <?php
            if (have_rows('footer_link_group', 'option')) :
                while (have_rows('footer_link_group', 'option')) : the_row();
                    $title  = get_sub_field('title_text');
                    
                    if (have_rows('links_repeater', 'option')) :
                        echo "<div class='col col-md-4 col-xl-2'>
                                <h4 class='footer__title'>{$title}</h4>
                                <ul class='footer__link'>";
                        while (have_rows('links_repeater', 'option')) : the_row();
                            $link   = get_sub_field('link');

                            echo "<li><a href='{$link['url']}'>{$link['title']}</a></li>";
                        endwhile;

                        echo "</ul>
                            </div>";
                    endif;
                endwhile;
            endif;

            echo "<div class='col-12 col-md-4 col-xl-2'>";
            get_template_part('parts/footer/socials');
            echo "</div>";

            if (get_field('footer_newsletter_group', 'option')['show_newsletter_bool']) :
                echo "<div class='col-12 col-md-4 col-xl-3 float-end'>";
                get_template_part('parts/footer/newsletters');
                echo "</div>";
            endif;
            ?>
        </div>
    </div>
</div>

<div class="footer__separator">
    <div class="container">
        <div class="row">
            <div class="col">
                <hr class="footer__separator--hr">
            </div>
        </div>
    </div>
</div>

<div class="footer__bottom">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <?php
            if ($copy_text !== '') :
                $copy   = str_replace('{current_year}', date('Y'), $copy_text);
                echo "
                <div class='col-12 col-md-auto'>
                    <p class='footer__bottom--copy mb-0'>{$copy}</p>
                </div>";
            endif;

            if ($pg_icons) :
                echo "
                <div class='col-12 col-md-auto'>
                    <figure class='footer__bottom--pg-icons mb-0'>
                        <img src='{$pg_icons['url']}' alt='{$pg_icons['alt']}' class='img-fluid'>
                    </figure>
                </div>";
            endif;
            ?>
        </div>
    </div>
</div>