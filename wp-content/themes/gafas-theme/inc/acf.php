<?php
/* 
    setup the acf to save the jsons for syncing between intallations
*/
// set the row indices for the repeaters to start with 0
add_filter('acf/settings/row_index_offset', '__return_zero');

// save point
add_filter('acf/settings/save_json', 'gafas_acf_json_save_point');
 
function gafas_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
        
    // return
    return $path;
    
}

// load point
add_filter('acf/settings/load_json', 'gafas_acf_json_load_point');
 
function gafas_acf_json_load_point( $path ) {
    // Remove original path
    unset( $path[0] );
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
        
    // return
    return $path;   
}


// allow addition of iframes
add_filter( 'wp_kses_allowed_html', 'gafas_acf_add_allowed_iframe_tag', 10, 2 );
function gafas_acf_add_allowed_iframe_tag( $tags, $context ) {
    if ( $context === 'post' ) {
        $tags['iframe'] = array(
            'src'             => true,
            'height'          => true,
            'width'           => true,
            'frameborder'     => true,
            'allowfullscreen' => true,
        );
    }

    return $tags;
}


/* add theme option pages */
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'position'      => 61
    ));    
}


// add default image setting to ACF image fields
// let's you select a defualt image
// this is simply taking advantage of a field setting that already exists
add_action('acf/render_field_settings/type=image', 'gafas_add_default_value_to_image_field');
function gafas_add_default_value_to_image_field($field) {
    acf_render_field_setting( $field, array(
        'label'			=> __('Default Image', 'gafas'),
        'instructions'  => __('Appears when creating a new post', 'gafas'),
        'type'			=> 'image',
        'name'			=> 'default_value',
    ));
}