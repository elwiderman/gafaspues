<?php
// the featured products section
if (get_field('show_feat_prods_bool')) :
    $pre_title  = get_field('feat_prods_title_text');
    $tabs       = '<ul class="nav nav-tabs" id="featProdsTab" role="tablist">';
    $tab_content = '<div class="tab-content" id="featProdsTabContent">';

    if (have_rows('feat_prods_groups_repeater')) :
        $i = 0;
        while (have_rows('feat_prods_groups_repeater')) : the_row();
            $i++;
            if (get_sub_field('show_group_bool')) :
                $title    = get_sub_field('group_title_text');
                $tab_active = $i == 1 ? 'active' : '';
                $tabs .= "
                <li class='nav-item' role='presentation'>
                    <button class='nav-link' id='featProdsTab{$i}-tab' data-bs-toggle='tab' data-bs-target='#featProdsTab{$i}-pane' type='button' role='tab' aria-controls='featProdsTab{$i}-pane' aria-selected='true'>{$title}</button>
                </li>";

                $tab_content .= "<div class='tab-pane fade' id='featProdsTab{$i}-pane' role='tabpanel' aria-labelledby='featProdsTab{$i}-tab' tabindex='0'>";
                ob_start();
                $prods = '';

                foreach (get_sub_field('group_prods_rel') as $post_object) :
                    setup_postdata($GLOBALS['post'] =& $post_object);
                    wc_get_template_part('content-product-slider');
                    wp_reset_postdata();
                endforeach;
                
                $prods = ob_get_contents();
                ob_end_clean();

                if (sizeof(get_sub_field('group_prods_rel')) > 0) :
                    $tab_content .= "<div class='product-slider'>{$prods}</div>";
                endif;
                $tab_content .= "</div>";
            endif;
        endwhile;
    endif;

    $tabs       .= '</ul>';
    $tab_content .= '</div>';
    ?>

    <section class="section-block section-featured">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto"><h6 class="pre-title"><?php echo $pre_title;?></h6></div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto"><?php echo $tabs;?></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php echo $tab_content;?>
                </div>
            </div>
        </div>
    </section>

    <?php
endif;