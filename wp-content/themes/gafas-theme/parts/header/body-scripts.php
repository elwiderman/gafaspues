<?php
// tracking scripts to go in the body section
if (get_field('body_scripts', 'option')) {
    echo get_field('body_scripts', 'option');
}