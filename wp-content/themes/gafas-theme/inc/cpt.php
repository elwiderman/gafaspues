<?php
/* 
    DEBUGGER for custom rewrite rules !!
*/
function acq_debug_rewrite_rules() {
    global $wp, $template, $wp_rewrite;

    echo '<pre style="margin: 120px 0 0 150px;">';
    echo 'Request: ';
    echo empty($wp->request) ? 'None' : esc_html($wp->request) . PHP_EOL;
    echo 'Matched Rewrite Rule: ';
    echo empty($wp->matched_rule) ? 'None' : esc_html($wp->matched_rule) . PHP_EOL;
    echo 'Matched Rewrite Query: ';
    echo empty($wp->matched_query) ? 'None' : esc_html($wp->matched_query) . PHP_EOL;
    echo 'Loaded Template: ';
    echo basename($template);
    echo '</pre>' . PHP_EOL;

    echo '<pre>';
    print_r($wp_rewrite->rules);
    echo '</pre>';
}
// add_action( 'wp_head', 'acq_debug_rewrite_rules' );

// flush_rewrite_rules(true);
// wp_cache_flush();