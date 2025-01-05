<?php
// the product categories section
if (get_field('show_prod_cat_bool')) :
    
    echo "
    <section class='section-block section-prod-cats'>
        <div class='container prod-cats-nav-container'>
            <div class='prod-cats-nav' id='prodCatsSliderNav'></div>
        </div>
        <div class='prod-cats-slider' id='prodCatsSlider'>";
        foreach (get_field('prod_cats_tax') as $term) :
            $term_name      = $term->name;
            $term_link      = get_term_link($term);

            echo "
            <div>
                <div class='slide'>
                    <a href='{$term_link}' class='slide__perma'>
                        <span>#{$term_name}</span>
                    </a>
                </div>
            </div>
            ";
        endforeach;
    echo "</div>
    </section>";
endif;