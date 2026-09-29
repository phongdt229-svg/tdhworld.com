<?php
function apr_recipe_meta_data() {
    return array(
        array(
            "name" => "desc",
            "title" => esc_html__("Description", 'efarm'),
            "type" => "editor"
        ),
        array(
            "name" => "ingre",
            "title" => esc_html__("Ingredient", 'efarm'),
            "type" => "editor"
        ),
        array(
            "name" => "time",
            "title" => esc_html__("Time", 'efarm'),
            "type" => "textfield"
        ),
        array(
            "name" => "serving",
            "title" => esc_html__("Servings", 'efarm'),
            "type" => "text"
        ),   

        array(
            "name" => "cals",
            "title" => esc_html__("Cals", 'efarm'),
            "type" => "text"
        ),   
        array(
            "name" => "recipe_video",
            "title" => esc_html__("Video link", 'efarm'),
            "type" => "textfield",
        ),                      
    );
}
function apr_view_recipe_meta_option() {
    $meta_box = apr_recipe_meta_data();
    apr_show_meta_box($meta_box);
}
function apr_save_recipe_meta_option($post_id) {
    $meta_box = apr_default_meta_data();
    return apr_save_meta_data($post_id, $meta_box);
}
function apr_save_recipe2_meta_option($post_id) {
    $meta_box_recipe = apr_recipe_meta_data();
    $meta_box = array_merge($meta_box_recipe); 
    return apr_save_meta_data($post_id, $meta_box);
}
function apr_save_recipe_page_meta_option($post_id) {
    $meta_box = apr_default_meta_data();
    $meta_box['single_recipe_layout'] = array(
        'name'  => 'single_recipe_style',
        'type' => 'select',
        'title' => esc_html__('Single recipe layout', 'efarm'),
        'options' => array(
            "default" => esc_html__("Default","efarm"),
                "1" => esc_html__("Layout 1","efarm"),
                "2" => esc_html__("Layout 2","efarm"),
            ),
        'default' => 'default' 
    );    
    return apr_save_meta_data($post_id, $meta_box);
}
function apr_show_recipe_page_meta_option() {
    $meta_box = apr_default_meta_data();
    $meta_box['single_gallery_layout'] = array(
        'name'  => 'single_gallery_style',
        'type' => 'select',
        'title' => esc_html__('Single gallery layout', 'efarm'),
        'options' => array(
            "default" => esc_html__("Default","efarm"),
                    "1" => esc_html__("Layout 1","efarm"),
                    "2" => esc_html__("Layout 2","efarm"),
                ),
        'default' => 'default' 
    );
    apr_show_meta_box($meta_box);
}
function apr_add_recipe_metaboxes() {
    if (function_exists('add_meta_box')) {  
        add_meta_box('view-meta-boxes', esc_html__('Layout Options', 'efarm'), 'apr_show_recipe_page_meta_option', 'recipe', 'side', 'low');
        add_meta_box('show-meta-boxes', esc_html__('Recipe Options', 'efarm'), 'apr_view_recipe_meta_option', 'recipe', 'normal', 'low');
    }
}

add_action('add_meta_boxes', 'apr_add_recipe_metaboxes');
add_action('save_post', 'apr_save_recipe_meta_option');
add_action('save_post', 'apr_save_recipe2_meta_option');
add_action('save_post', 'apr_save_recipe_page_meta_option');
