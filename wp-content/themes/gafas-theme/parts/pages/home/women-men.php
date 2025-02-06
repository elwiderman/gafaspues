<?php
// partial for women-men offers
if (get_field('show_men_women_bool')) :
    $title          = nl2br(get_field('men_women_title_text'));
    $cta            = get_field('men_women_cta_link');
    $women_img      = get_field('women_img');
    $women_link     = get_field('women_link');
    $men_img        = get_field('men_img');
    $men_link       = get_field('men_link');
    ?>
    <section class="section-block section-women-men">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-12 col-md">
                    <div class="women-men">
                        <a href="<?php echo $women_link['url'];?>" class="women-men__perma" target="<?php echo $women_link['target'];?>">
                            <figure class="women-men__perma--img mb-0">
                                <img src="<?php echo $women_img['url'];?>" alt="GafasPues - Mujeres" class="img-fluid">
                                <figcaption class="women"><?php echo $women_link['title'];?></figcaption>
                            </figure>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md">
                    <div class="offers text-center">
                        <h3 class="offers__text"><?php echo $title;?></h3>
                        <div class="offers__cta">
                            <a href="<?php echo $cta['url'];?>" class="btn-outline-dark btn-xl" target="<?php echo $cta['target'];?>">
                                <?php echo $cta['title'];?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md">
                    <div class="women-men">
                        <a href="<?php echo $men_link['url'];?>" class="women-men__perma" target="<?php echo $men_link['target'];?>">
                            <figure class="women-men__perma--img mb-0">
                                <img src="<?php echo $men_img['url'];?>" alt="GafasPues - Hombres" class="img-fluid">
                                <figcaption><?php echo $men_link['title'];?></figcaption>
                            </figure>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
endif;