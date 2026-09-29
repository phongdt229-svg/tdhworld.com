<?php
function apr_knowledge_meta_data() {
    return array(
        "desc" => array(
            "name" => "desc",
            "title" => esc_html__("Short Description", 'efarm'),
            "desc" => esc_html__("Content", 'efarm'),
            "type" => "editor"
        ),                
    );
}
function apr_view_knowledge_meta_option() {
    $meta_box = apr_knowledge_meta_data();
    apr_show_meta_box($meta_box);
}
function apr_save_knowledge_meta_option($post_id) {
    $meta_box = apr_default_meta_data();
    return apr_save_meta_data($post_id, $meta_box);
}
function apr_save_knowledge2_meta_option($post_id) {
    $meta_box_knowledge = apr_knowledge_meta_data();
    $meta_box = array_merge($meta_box_knowledge); 
    return apr_save_meta_data($post_id, $meta_box);
}
function apr_save_knowledge_page_meta_option($post_id) {
    $meta_box = apr_default_meta_data();   
    return apr_save_meta_data($post_id, $meta_box);
}
function apr_show_knowledge_page_meta_option() {
    $meta_box = apr_default_meta_data();
    apr_show_meta_box($meta_box);
}
function apr_add_knowledge_metaboxes() {
    if (function_exists('add_meta_box')) {  
        add_meta_box('view-meta-boxes', esc_html__('Layout Options', 'efarm'), 'apr_show_knowledge_page_meta_option', 'knowledge', 'side', 'low');
        add_meta_box('show-meta-boxes', esc_html__('knowledge Options', 'efarm'), 'apr_view_knowledge_meta_option', 'knowledge', 'normal', 'low');
    }
}

add_action('add_meta_boxes', 'apr_add_knowledge_metaboxes');
add_action('save_post', 'apr_save_knowledge_meta_option');
add_action('save_post', 'apr_save_knowledge2_meta_option');
add_action('save_post', 'apr_save_knowledge_page_meta_option');
