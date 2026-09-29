<?php
function apr_show_gallery_page_meta_option() {
    $meta_box = apr_default_meta_data();
    $meta_box['single_gallery_layout'] = array(
        'name'  => 'single_gallery_style',
        'type' => 'select',
        'title' => esc_html__('Single gallery layout', 'efarm'),
        'options' => array(
            "default" => esc_html__("Default","efarm"),
                    "1" => esc_html__("Wide","efarm"),
                    "2" => esc_html__("Slider","efarm"),
                    "3" => esc_html__("Side Information","efarm"),
                ),
        'default' => 'default' 
    );
    apr_show_meta_box($meta_box);
}
function apr_save_gallery_page_meta_option($post_id) {
    $meta_box = apr_default_meta_data();
    $meta_box['single_gallery_layout'] = array(
        'name'  => 'single_gallery_style',
        'type' => 'select',
        'title' => esc_html__('Single gallery layout', 'efarm'),
        'options' => array(
            "default" => esc_html__("Default","efarm"),
                "1" => esc_html__("Wide","efarm"),
                "2" => esc_html__("Slider","efarm"),
                "3" => esc_html__("Side Information","efarm"),
            ),
        'default' => 'default' 
    );    
    return apr_save_meta_data($post_id, $meta_box);
}
function apr_add_gallery_metaboxes() {
    if (function_exists('add_meta_box')) {
        add_meta_box('view-meta-boxes', esc_html__('Layout Options', 'efarm'), 'apr_show_gallery_page_meta_option', 'gallery', 'side', 'low');
    }
}

add_action('add_meta_boxes', 'apr_add_gallery_metaboxes');
add_action('save_post', 'apr_save_gallery_page_meta_option');
