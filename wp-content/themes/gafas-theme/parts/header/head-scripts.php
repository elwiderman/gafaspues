<?php
// tracking scripts to go in the head section
if (get_field('head_scripts', 'option')) {
    echo get_field('head_scripts', 'option');
}