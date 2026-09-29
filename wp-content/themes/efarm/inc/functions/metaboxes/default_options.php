<?php

function apr_default_meta_data() {
    $apr_layout = apr_layouts();
    $apr_sidebar_position = apr_sidebar_position();
    $apr_sidebars = apr_sidebars();
    $apr_header_layout = apr_header_types();
    $apr_preload_layout = apr_preload_types();
    $apr_header_positions = apr_header_positions();
    $apr_footer_layout = apr_footer_types();
    $apr_popup_layout = apr_popup_layouts();
    $apr_block_name = apr_get_block_name();
    $apr_block_name['default'] ='default';
    $apr_slider = apr_rev_sliders_in_array();
    $apr_breadcrumbs_type = apr_get_breadcrumbs_type();
    $apr_breadcrumbs_type['default'] ='default';
    return array(
        //Preload
		'preload' => array(
            'name' => 'preload',
            'title' => esc_html__('Preload Layout', 'efarm'),
            'type' => 'select',
            'options' => $apr_preload_layout,
            'default' => 'default'
        ),
		// header
        'header' => array(
            'name' => 'header',
            'title' => esc_html__('Header Layout', 'efarm'),
            'type' => 'select',
            'options' => $apr_header_layout,
            'default' => 'default'
        ),
		'header-position' => array(
            'name' => 'header-position',
            'title' => esc_html__('Header Mobile Position', 'efarm'),
            'type' => 'select',
            'options' => $apr_header_positions,
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
        // Breadcrumbs
        'breadcrumbs' => array(
            'name' => 'breadcrumbs',
            'title' => esc_html__('Breadcrumbs', 'efarm'),
            'desc' => esc_html__('Hide breadcrumbs', 'efarm'),
            'type' => 'checkbox',
        ), 
        'breadcrumbs_style' =>   array(
            'name'=>'breadcrumbs_style',
            'type' => 'select',
            'title' => esc_html__('Select Breadcrumbs Type', 'efarm'),
            'options' => $apr_breadcrumbs_type,
            'default' => 'default'
        ), 
        "breadcrumbs_bg"=> array(
            "name" => "breadcrumbs_bg",
            "title" => esc_html__("Breadcrumbs Background", 'efarm'),
            'desc' => esc_html__("Upload breadcrumbs background", "efarm"),
            "type" => "upload"
        ),                   
        'page_title' => array(
            'name' => 'page_title',
            'title' => esc_html__('Page Title', 'efarm'),
            'desc' => esc_html__('Hide Page Title', 'efarm'),
            'type' => 'checkbox'
        ),
        'show_header' => array(
            'name' => 'show_header',
            'title' => esc_html__('Header', 'efarm'),
            'desc' => esc_html__('Hide header', 'efarm'),
            'type' => 'checkbox'
        ),
        //  Show Footer
        'show_footer' => array(
            'name' => 'show_footer',
            'title' => esc_html__('Footer', 'efarm'),
            'desc' => esc_html__('Hide footer', 'efarm'),
            'type' => 'checkbox'
        ),
        //sidebar position
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
        'hide_f_info' => array(
            'name' => 'hide_f_info',
            'title' => esc_html__('Hide footer info', 'efarm'),
            'desc' => esc_html__('Hide footer info', 'efarm'),
            'type' => 'checkbox'
        ), 
        'remove_space_br' => array(
            'name' => 'remove_space_br',
            'title' => esc_html__('Remove top space', 'efarm'),
            'desc' => esc_html__('Remove top space', 'efarm'),
            'type' => 'checkbox'
        ),   
        'remove_space' => array(
            'name' => 'remove_space',
            'title' => esc_html__('Remove bottom space', 'efarm'),
            'desc' => esc_html__('Remove bottom space', 'efarm'),
            'type' => 'checkbox'
        ), 
        'show_slider' => array(
            'name' => 'show_slider',
            'title' => esc_html__('Show Revolution Slider', 'efarm'),
            'desc' => esc_html__('Enable Slider', 'efarm'),
            'type' => 'checkbox'
        ), 
        'category_slider' => array(
            'name' => 'category_slider',
            'title' => esc_html__('Select Revolution Slider', 'efarm'),
            'desc' => esc_html__('Slider will show if you show revolution slider', 'efarm'),
            'type' => 'select',
            'options' => $apr_slider,
            'default' => 'default'
        ),    
		'block_bottom' => array(
            'name' => 'block_bottom',
            'title' => esc_html__('Select Bottom Banner', 'efarm'),
            'desc' => esc_html__('Choose a block to display at the bottom of pages. You can create a block in Static Block/Add New.', 'efarm'),
            'type' => 'select',
            'options' => $apr_block_name,
            'default' => 'default'
        ),        
    );
}

