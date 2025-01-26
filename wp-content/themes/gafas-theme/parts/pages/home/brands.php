<?php
// partials for the brands
if (get_field('show_brands_bool')) :
    $title  = get_field('brands_title_text');
    ?>
    <section class="section-block section-brands">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-auto">
                    <h3 class="h2 styled section-title"><?php echo $title;?></h3>
                </div>
            </div>
        </div>
        <?php
        if (have_rows('select_brands_repeater')) :
            echo "<div class='brands-slider' id='brandsSlider'>";
            while (have_rows('select_brands_repeater')) : the_row();
                $brand_img  = get_sub_field('logo_img');
                $brand_link = get_sub_field('link');
                ?>
                <div>
                    <div class="brand">
                        <a class="brand__perma" href="<?php echo $brand_link['url'];?>" target="<?php echo $brand_link['target'];?>">
                            <img class="img-fluid" src="<?php echo $brand_img['url'];?>" alt="<?php echo $brand_img['alt'];?>">
                        </a>
                    </div>
                </div>
                <?php
            endwhile;
            echo "</div>";
        endif;
        ?>
    </section>
    <?php
endif;