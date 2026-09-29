<?php
function apr_post_meta_data() {
    $apr_page_single_blog_layouts = apr_page_single_blog_layouts(); 
    $apr_page_single_blog_layouts['default'] ='Default';
    return array( 
        /*array(
            "name" => "single-post-layout-version",
            'type' => 'select',
            'title' => esc_html__('Single Blog Layout', 'efarm'),
            'options' => $apr_page_single_blog_layouts,
            'default' => 'default'
        ),  */
        "highlight" => array(
            "name" => "highlight",
            "title" => esc_html__("Short Description", 'efarm'), 
            "desc" => esc_html__("Content", 'efarm'),
            "type" => "editor"
        ),
    );
}
function apr_post_format(){
    return array(
        "video_code" => array(
            "name" => "video_code",
            "title" => esc_html__("Video & Audio Embed Code", 'efarm'),
            "desc" => esc_html__('Enter the embed link (Youtube or Vimeo). ', 'efarm'),
            "type" => "textarea",
            'display_condition' => 'post-type-video', 
        ),
        "link_code" => array(
            "name" => "link_code",
            "title" => esc_html__("Link", 'efarm'),
            "desc" => esc_html__('Enter link. ', 'efarm'),
            "type" => "textfield",
            'display_condition' => 'post-type-link', 
        ),
        "link_title" => array(
            "name" => "link_title",
            "title" => esc_html__("Link title", 'efarm'),
            "desc" => esc_html__('Enter link title. ', 'efarm'),
            "type" => "textfield",
            'display_condition' => 'post-type-link', 
        ),
        "quote_code" => array(
            "name" => "quote_code",
            "title" => esc_html__("Quote", 'efarm'),
            "desc" => esc_html__('Enter quote. ', 'efarm'),
            "type" => "textarea",
            'display_condition' => 'post-type-quote', 
        ),
        "quote_author" => array(
            "name" => "quote_author",
            "title" => esc_html__("Quote author", 'efarm'),
            "desc" => esc_html__('Enter quote author. ', 'efarm'),
            "type" => "textfield",
            'display_condition' => 'post-type-quote', 
        ),
    );
}
function apr_view_post_meta_option() {
    $meta_box = apr_post_meta_data();
    apr_show_meta_box($meta_box);
}
function apr_view_post_format_meta_option() {
    $meta_box = apr_post_format();
    apr_show_meta_box($meta_box);
}

function apr_show_post_meta_option() {
    $meta_box = apr_default_meta_data();
    apr_show_meta_box($meta_box);
}
function apr_save_post2_meta_option($post_id) {
    $meta_box_post = apr_post_meta_data();
    $meta_box_format = apr_post_format();
    $meta_box = array_merge($meta_box_post,$meta_box_format); 
    return apr_save_meta_data($post_id, $meta_box);
}
function apr_save_post_meta_option($post_id) {
    $meta_box = apr_default_meta_data();
    return apr_save_meta_data($post_id, $meta_box);
}

function apr_add_post_metaboxes() {
    if (function_exists('add_meta_box')) {
        add_meta_box('view-format-boxes', esc_html__('Post Format', 'efarm'), 'apr_view_post_format_meta_option', 'post', 'normal', 'low');        
        add_meta_box('show-meta-boxes', esc_html__('Blog Options', 'efarm'), 'apr_view_post_meta_option', 'post', 'normal', 'low');
        add_meta_box('view-meta-boxes', esc_html__('Layout Options', 'efarm'), 'apr_show_post_meta_option', 'post', 'normal', 'low');
    }
}

add_action('add_meta_boxes', 'apr_add_post_metaboxes');
add_action('save_post', 'apr_save_post_meta_option');
add_action('save_post', 'apr_save_post2_meta_option');

 