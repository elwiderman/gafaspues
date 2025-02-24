<?php
if (have_rows('socials_repeater', 'option')) :
    echo "<ul class='socials'>";
    while (have_rows('socials_repeater', 'option')) : the_row();
        $icon   = get_sub_field('social_network_select');
        $link   = get_sub_field('social_network_link');

        echo "
        <li>
            <a href='{$link['url']}' target='_blank'>
                <i class='icon-{$icon}'></i>
            </a>
        </li>";
    endwhile;
    echo "</ul>";
endif;