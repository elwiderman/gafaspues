<?php
/* generic functions for the theme */

/* add excerpt to pages */
add_action('init', 'gafas_add_excerpts_to_pages');
function gafas_add_excerpts_to_pages() {
    add_post_type_support('page', 'excerpt');
}


/* hide admin bar */
// show_admin_bar(false);


/* post format */
add_action('after_setup_theme', 'gafas_remove_post_formats', 100);
function gafas_remove_post_formats() {
    remove_theme_support('post-formats');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}


/* custom backend footer */
add_filter('admin_footer_text', 'gafas_custom_admin_footer');
function gafas_custom_admin_footer() {
    _e('<span id="footer-thankyou">Developed by <a href="https://www.linkedin.com/in/ajasra/" target="_blank">El Widerman</a></span>', 'gafas');
}


/* quick image path */
function gafas_image($name) {
    $path = get_bloginfo('template_directory') . '/assets/images/' . $name;
    return $path;
}


/* adding favicon to admin pages */
function gafas_add_favicon() {
    $favicon    = get_field('admin_favicon_img', 'option');
    if ($favicon) :
        echo "<link rel='shortcut icon' type='image/x-icon' href='{$favicon['url']}'/>";
    endif;

}


/* adding custom logo to wp login page */
function gafas_login_logo() { 
    $logo = get_field('logo_img', 'option');
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo $logo['url']; ?>);
            height: 57px;
            width: 100%;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            background-color: transparent;
            margin-bottom: 0px;
            pointer-events: none;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'gafas_login_logo' );

// need to make sure that function runs when you're on the login page and admin pages
add_action('login_head', 'gafas_add_favicon');
add_action('admin_head', 'gafas_add_favicon');


/* get placeholder image */
function gafas_placeholder_src($size) {
    if (class_exists('ACF')) {
        $thumb      = get_field('placeholder_img', 'option');
        $thumb_size = ($size) ? $size : 'thumbnail';
    
        if ($thumb_size == 'full') {
            $url    = $thumb['url'];
        } else {
            $url    = $thumb['sizes'][$size];
        }

        return [
            'url'   => $url,
            'alt'   => $thumb['alt']
        ];
    }
}

/* quick image path */
function image($name) {
    $path = get_bloginfo('template_directory') . '/assets/images/' . $name;
    return $path;
}


// prevent pages from being displayed in the search results
add_action('pre_get_posts', 'gafas_exclude_posts_from_search');
function gafas_exclude_posts_from_search( $query ) {
    if (get_field('exclude_posts_from_search_post', 'option')) :
        if ($query->is_search && $query->is_main_query()) :
            $query->set('post__not_in', get_field('exclude_posts_from_search_post', 'option'));
        endif;
    endif;
}


/* move yoast metaboxes to bottom */
add_filter('wpseo_metabox_prio', 'gafas_yoast_metabox_to_have_low_priority', 10);
function gafas_yoast_metabox_to_have_low_priority() {
    return 'low';
}

/* get vimeo video id */
function gafas_vimeo_id($video) {
    $regs = array();
    $video_id = '';
    if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $video, $regs)) {
        $video_id = $regs[3];
    }
    return $video_id;
}

/* get youtube video id */
function gafas_youtube_id($video) {
    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $video, $matches);
    $video_id = $matches[1];
    return $video_id;
}

/* return video url and type for embeding */
function gafas_return_oembed_url_type($video) {
    if (strpos($video, 'vimeo') !== false) :
        $video_id = gafas_vimeo_id($video);
        $video_embed = 'https://player.vimeo.com/video/' . $video_id . '?background=0&loop=1&autopause=0&muted=1';
        $video_type = 'vimeo';
    else :
        $video_id = gafas_youtube_id($video);
        $video_embed = 'https://www.youtube.com/embed/' . $video_id . '?rel=0&controls=1&showinfo=0&iv_load_policy=3&modestbranding=1&mute=1&autoplay=1&loop=1';
        $video_type = 'youtube';
    endif;

    return array(
        'id'    => $video_id,
        'url'   => $video_embed,
        'type'  => $video_type
    );
}


/* 
    add custom color palette to the block editor and front end 
    ref: https://www.wpdiaries.com/gutenberg-color-palette/    
*/
add_action('after_setup_theme', 'gafas_add_custom_theme_color_palette');
function gafas_add_custom_theme_color_palette() {
    // try to get the current theme default color palette
    $default_color_palette  = current((array)get_theme_support('editor-color-palette'));

    // get default core color palette from wp-includes/theme.json
    if (false === $default_color_palette && class_exists('WP_Theme_JSON_Resolver')) :
        $settings           = WP_Theme_JSON_Resolver::get_core_data()->get_settings();
        if (isset($settings['color']['palette']['default'])) :
            $default_color_palette = $settings['color']['palette']['default'];
        endif;
    endif;


    if (have_rows('theme_color_palette_repeater', 'option')) :
        $color_palette      = [];
        while(have_rows('theme_color_palette_repeater', 'option')) : the_row();
            $name           = get_sub_field('color_name');
            $slug           = sanitize_title($name);
            $color          = get_sub_field('color');
            array_push($color_palette, [
                'name'      => $name,
                'slug'      => $slug,
                'color'     => $color
            ]);
        endwhile;

        // merge the default and new color palettes
        if (!empty($default_color_palette)) {
            $color_palette = array_merge($default_color_palette, $color_palette);
        }

        // add the color palette to the main
        add_theme_support('editor-color-palette', $color_palette);
    endif;
}
// add the css to admin_head and wp_head the corresponding styles
add_action('wp_head', 'gafas_custom_color_palette_css');
add_action('admin_head', 'gafas_custom_color_palette_css');
function gafas_custom_color_palette_css() {
    // if the repeater has info add the relevant css
    if (have_rows('theme_color_palette_repeater', 'option')) :
        echo "<style type='text/css' media='all'>";
        while(have_rows('theme_color_palette_repeater', 'option')) : the_row();
            $name           = get_sub_field('color_name');
            $slug           = sanitize_title($name);
            $color          = get_sub_field('color');
            
            echo "
                .has-{$slug}-color {
                    color: {$color};
                }
                .has-background.has-{$slug}-background-color {
                    background-color: {$color};
                }
            ";
        endwhile;
        echo "</style>";
    endif;
}


/* WMPL stuff */
// add language class to body
if (function_exists('icl_object_id')) {
    //add lang class
    add_filter('body_class', function($classes) {
        $classes[] = ICL_LANGUAGE_CODE;
        return $classes;
    });
    
    // returns the current language elements
    function gafas_wpml_current_lang() {
        $languages = icl_get_languages('skip_missing=0');
        $curr_lang = array();
        if (!empty($languages)) :
            foreach ($languages as $language) :
                if (!empty($language['active'])) :
                    $curr_lang = $language; // this will contain current language info.
                    break;
                endif;
            endforeach;
        endif;
        return $curr_lang;
    }
}



