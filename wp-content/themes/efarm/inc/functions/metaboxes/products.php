<?php
function apr_product_meta_data(){
    return array(
        "sub_title_product" => array(
            "name" => "sub_title_product",
            "title" => esc_html__("Sub Title", 'efarm'),
            "desc" => esc_html__("Enter Sub Title for product.", 'efarm'),
            "type" => "textfield"
        ),
        "unit_product" => array(
            "name" => "unit_product",
            "title" => esc_html__("Product Unit", 'efarm'),
            "desc" => esc_html__("Enter units for product.", 'efarm'),
            "type" => "textfield"
        ),
        // Custom Tab Title
        "custom_tab_title" => array(
            "name" => "custom_tab_title",
            "title" => esc_html__("Custom Tab Title", 'efarm'),
            "desc" => esc_html__("Input the custom tab title.", 'efarm'),
            "type" => "textfield"
        ),
        // Content Tab Content
        "custom_tab_content" => array(
            "name" => "custom_tab_content",
            "title" => esc_html__("Custom Tab Content", 'efarm'),
            "desc" => esc_html__("Input the custom tab content.", 'efarm'),
            "type" => "editor"
        )
    );
}

function apr_show_product_tab_meta_option() {
    $meta_box = apr_product_meta_data();
    apr_show_meta_box($meta_box);
}

function apr_save_product_tab_meta_option($post_id) {
    $meta_box = apr_product_meta_data();
    return apr_save_meta_data($post_id, $meta_box);
}

function apr_add_product_tab_metaboxes() {
    if (function_exists('add_meta_box')) {
        add_meta_box('view-meta-boxes', esc_html__('Product Custom Options', 'efarm'), 'apr_show_product_tab_meta_option', 'product', 'normal', 'low');
    }
}

add_action('add_meta_boxes', 'apr_add_product_tab_metaboxes');
add_action('save_post', 'apr_save_product_tab_meta_option');
function apr_product_sidebar_option(){
    $apr_sidebar_position = apr_sidebar_position();
    $apr_sidebars = apr_sidebars();
    $apr_header_layout = apr_header_types();
    $apr_footer_layout = apr_footer_types();
    $apr_layout = apr_layouts();
    return array(
        'header' => array(
            'name' => 'header',
            'title' => esc_html__('Header Layout', 'efarm'),
            'type' => 'select',
            'options' => $apr_header_layout,
            'default' => 'default'
        ),
        //footer
        'footer' => array(
            'name' => 'footer',
            'title' => esc_html__('Footer Layout', 'efarm'),
            'type' => 'select',
            'options' => $apr_footer_layout,
            'default' => 'default'
        ),
        'left-sidebar' => array(
            'name' => 'left-sidebar',
            'type' => 'select',
            'title' => esc_html__('Left Sidebar', 'efarm'),
            'options' => $apr_sidebars,
            'default' => 'default'
        ),
        'right-sidebar' => array(
            'name' => 'right-sidebar',
            'type' => 'select',
            'title' => esc_html__('Right Sidebar', 'efarm'),
            'options' => $apr_sidebars,
            'default' => 'default'
        ),
        // layout
        'layout' => array(
            'name' => 'layout',
            'title' => esc_html__('Layout', 'efarm'),
            'type' => 'select',
            'options' => $apr_layout,
            'default' => 'default'
        ),
		'related_col' => array(
            'name'  => 'related_col',
            'type' => 'select',
            'title' => esc_html__('Related product columns', 'efarm'),
            'options' => array(
                "default" => esc_html__("Default","efarm"),
                "2" => esc_html__("2","efarm"),
                "3" => esc_html__("3","efarm"),
                "4" => esc_html__("4","efarm"),
            ),
            'default' => 'default'            
        ),
    );
}
function apr_show_product_default_meta_option() {
    $meta_box = apr_product_sidebar_option();
    apr_show_meta_box($meta_box);
}


function apr_save_product_meta_option($post_id) {
    $meta_box = apr_product_sidebar_option();
    return apr_save_meta_data($post_id, $meta_box);
}

function apr_add_product_metaboxes() {
    if (function_exists('add_meta_box')) {
        add_meta_box('show-meta-boxes', esc_html__('Sidebar Options', 'efarm'), 'apr_show_product_default_meta_option', 'product', 'side', 'low');
    }
}

add_action('add_meta_boxes', 'apr_add_product_metaboxes');
add_action('save_post', 'apr_save_product_meta_option');
