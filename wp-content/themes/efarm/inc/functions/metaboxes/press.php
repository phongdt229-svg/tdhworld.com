<?php
function apr_press_meta_data() {
    return array(
		"link_press" => array(
            "name" => "link_press",
            "title" => esc_html__("Input Link or Video", 'efarm'),
            "desc" => esc_html__("Input Link PDF or Video", 'efarm'),
            "type" => "text"
        ), 
        "desc" => array(
            "name" => "desc",
            "title" => esc_html__("Short Description", 'efarm'),
            "desc" => esc_html__("Content", 'efarm'),
            "type" => "editor"
        ),                
    );
}
function apr_view_press_meta_option() {
    $meta_box = apr_press_meta_data();
    apr_show_meta_box($meta_box);
}
function apr_save_press_meta_option($post_id) {
    $meta_box = apr_default_meta_data();
    return apr_save_meta_data($post_id, $meta_box);
}
function apr_save_press2_meta_option($post_id) {
    $meta_box_press = apr_press_meta_data();
    $meta_box = array_merge($meta_box_press); 
    return apr_save_meta_data($post_id, $meta_box);
}
function apr_save_press_page_meta_option($post_id) {
    $meta_box = apr_default_meta_data();   
    return apr_save_meta_data($post_id, $meta_box);
}
function apr_show_press_page_meta_option() {
    $meta_box = apr_default_meta_data();
    apr_show_meta_box($meta_box);
}
function apr_add_press_metaboxes() {
    if (function_exists('add_meta_box')) {  
        add_meta_box('view-meta-boxes', esc_html__('Layout Options', 'efarm'), 'apr_show_press_page_meta_option', 'press', 'side', 'low');
        add_meta_box('show-meta-boxes', esc_html__('Press Media Options', 'efarm'), 'apr_view_press_meta_option', 'press', 'normal', 'low');
    }
}

add_action('add_meta_boxes', 'apr_add_press_metaboxes');
add_action('save_post', 'apr_save_press_meta_option');
add_action('save_post', 'apr_save_press2_meta_option');
add_action('save_post', 'apr_save_press_page_meta_option');
