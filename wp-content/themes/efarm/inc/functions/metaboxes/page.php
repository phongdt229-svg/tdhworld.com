<?php
function apr_page_meta_data() {
    $apr_fonts =  array(
                        'default' => esc_html__( 'default', 'efarm' ),
                        'Oswald'  => 'Oswald',                         
                    );    
    return array(
        'main_color' => array(
            "name" => "main_color",
            "title" => esc_html__("Main Color", 'efarm'),
            "type" => "color",
            'desc' => esc_html__("Select different main color for page", "efarm"),
        ),
        'header_fixed' => array(
            'name' => 'header_fixed',
            'title' => esc_html__('Header Fixed', 'efarm'),
            'type' => 'checkbox'
        ),
		'footer_fixed' => array(
            'name' => 'footer_fixed',
            'title' => esc_html__('Footer Fixed', 'efarm'),
            'type' => 'checkbox'
        ),
        "logo_header_page"=> array(
            "name" => "logo_header_page",
            "title" => esc_html__("Logo header for page", 'efarm'),
            'desc' => esc_html__("Upload logo header only page", 'efarm'),
            "type" => "upload"
        ),                           
        'header_layout_style' => array(
            'name' => 'header_layout_style',
            'title' => esc_html__('Select header layout for this page', 'efarm'),
            'type' => 'select',
            'options' => array(
                    "default" => esc_html__("Default","efarm"),
                    "1" => esc_html__("Wide","efarm"),
                    "2" => esc_html__("FullWidth","efarm"),
                    "3" => esc_html__("Boxed","efarm"),
                ),
            'default' => 'default',
        ), 
        'cus_font' => array(
            'name' => 'cus_font',
            'title' => esc_html__('Select font family for header menu', 'efarm'),
            'type' => 'select',
            'options' => $apr_fonts,
            'default' => 'default',
            'group' => 'font',
        ),        
        'body_bg' => array(
            'name' => 'body_bg',
            'title' => esc_html__('Body Background', 'efarm'),
            'desc' => esc_html__("You should input hex color(ex: #e1e1e1).", 'efarm'),
            'type' => 'color',
        ),  
        'footer_bg' => array(
            'name' => 'footer_bg',
            'title' => esc_html__('Footer Background', 'efarm'),
            'desc' => esc_html__("You should input hex color(ex: #e1e1e1).", 'efarm'),
            'type' => 'color',
        ),
		'footer_text_color' => array(
            'name' => 'footer_text_color',
            'title' => esc_html__('Footer Color', 'efarm'),
            'desc' => esc_html__("You should input hex color(ex: #e1e1e1).", 'efarm'),
            'type' => 'color',
        ),
        "logo_footer_page"=> array(
            "name" => "logo_footer_page",
            "title" => esc_html__("Logo footer for page", 'efarm'),
            'desc' => esc_html__("Upload logo footer only page", 'efarm'),
            "type" => "upload"
        ),  
		'newletter_bg_img' => array(
            'name' => 'newletter_bg_img',
            'title' => esc_html__('Newsletter Background Image', 'efarm'),
            'desc' => esc_html__("Upload image newsletter only page", 'efarm'),
            'type' => 'upload',
        ),
		'newletter_bg' => array(
            'name' => 'newletter_bg',
            'title' => esc_html__('Newsletter Background Color', 'efarm'),
            'desc' => esc_html__("You should input hex color(ex: #d09f65).", 'efarm'),
            'type' => 'color',
        ),
		'newletter_color' => array(
            'name' => 'newletter_color',
            'title' => esc_html__('Newsletter Color', 'efarm'),
            'desc' => esc_html__("You should input hex color(ex: #fff).", 'efarm'),
            'type' => 'color',
        ),
		'copyright_bg' => array(
            'name' => 'copyright_bg',
            'title' => esc_html__('Copyright Background Color', 'efarm'),
            'desc' => esc_html__("You should input hex color(ex: #d09f65).", 'efarm'),
            'type' => 'color',
        ),
		'copyright_color' => array(
            'name' => 'copyright_color',
            'title' => esc_html__('Copyright Color', 'efarm'),
            'desc' => esc_html__("You should input hex color(ex: #d09f65).", 'efarm'),
            'type' => 'color',
        ),
    );
}
function apr_view_page_meta_option() {
    $meta_box = apr_page_meta_data();
    apr_show_meta_box($meta_box);
}
function apr_save_page2_meta_option($post_id) {
    $meta_box = apr_page_meta_data();
    return apr_save_meta_data($post_id, $meta_box);
}
function apr_show_page_meta_option() {
    $meta_box = apr_default_meta_data();
    apr_show_meta_box($meta_box);
}
function apr_save_page_meta_option($post_id) {
    $meta_box = apr_default_meta_data();
    return apr_save_meta_data($post_id, $meta_box);
}

function apr_add_page_metaboxes() {
    if (function_exists('add_meta_box')) {
        add_meta_box('view-meta-boxes', esc_html__('Layout Options', 'efarm'), 'apr_show_page_meta_option', 'page', 'side', 'low');
        add_meta_box('view-skin-boxes', esc_html__('Skin Options', 'efarm'), 'apr_view_page_meta_option', 'page', 'normal', 'low');        
    }
}
add_action('add_meta_boxes', 'apr_add_page_metaboxes');
add_action('save_post', 'apr_save_page_meta_option');
add_action('save_post', 'apr_save_page2_meta_option');
 