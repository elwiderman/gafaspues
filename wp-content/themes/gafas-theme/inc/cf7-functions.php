<?php
/* 
    modify and override the cf7 hooks
*/

// remove the unwanted html from cf7 
add_filter('wpcf7_autop_or_not', '__return_false');