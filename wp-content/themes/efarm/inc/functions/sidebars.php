<?php
add_action('widgets_init', 'apr_register_sidebars');

function apr_register_sidebars() {
    
    register_sidebar(array(
        'name' => esc_html__('General Sidebar', 'efarm'),
        'id' => 'general-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget general-sidebar %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title widget-title-border">',
        'after_title' => '</h3>',
    ));
     register_sidebar( array(
        'name' => esc_html__('Blog Sidebar', 'efarm'),
        'id' => 'blog-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title widget-title-border">',
        'after_title' => '</h3>',
    ));
    register_sidebar( array(
        'name' => esc_html__('Recipe Sidebar', 'efarm'),
        'id' => 'recipe-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title widget-title-border">',
        'after_title' => '</h3>',
    ));
    register_sidebar( array(
        'name' => esc_html__('Knowledge Sidebar', 'efarm'),
        'id' => 'knowledge-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title widget-title-border">',
        'after_title' => '</h3>',
    ));
    register_sidebar( array(
        'name' => esc_html__('Press Media Sidebar', 'efarm'),
        'id' => 'press-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title widget-title-border">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Newsletter', 'efarm'),
        'id' => 'footer-newsletter',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="widget-title widget-title-border">',
        'after_title' => '</h4> ',
    )); 
    register_sidebar(array(
        'name' => esc_html__('Footer Menu', 'efarm'),
        'id' => 'footer-menu',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="widget-title widget-title-border">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Widget 1', 'efarm'),
        'id' => 'footer-column-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="widget-title widget-title-border">',
        'after_title' => '</h4> ',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget 2', 'efarm'),
        'id' => 'footer-column-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="widget-title widget-title-border">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget 3', 'efarm'),
        'id' => 'footer-column-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="widget-title widget-title-border">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget 4', 'efarm'),
        'id' => 'footer-column-4',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="widget-title widget-title-border">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 3 Widget 1', 'efarm'),
        'id' => 'footer-column3-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="widget-title widget-title-border">',
        'after_title' => '</h4> ',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 3 Widget 2', 'efarm'),
        'id' => 'footer-column3-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="widget-title widget-title-border">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 3 Widget 3', 'efarm'),
        'id' => 'footer-column3-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="widget-title widget-title-border">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 3 Widget 4', 'efarm'),
        'id' => 'footer-column3-4',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="widget-title widget-title-border">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 4 Widget 1', 'efarm'),
        'id' => 'footer4-column-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="widget-title widget-title-border">',
        'after_title' => '</h4> ',
    ));
     register_sidebar(array(
        'name' => esc_html__('Footer 4 Widget 2', 'efarm'),
        'id' => 'footer4-column-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="widget-title widget-title-border">',
        'after_title' => '</h4> ',
    ));
      register_sidebar(array(
        'name' => esc_html__('Footer 4 Widget 3', 'efarm'),
        'id' => 'footer4-column-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="widget-title widget-title-border">',
        'after_title' => '</h4> ',
    ));
    if (class_exists('Woocommerce')) {

        register_sidebar(array(
            'name' => esc_html__('Shop Sidebar', 'efarm'),
            'id' => 'shop-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title widget-title-border">',
            'after_title' => '</h3>',
        ));

        register_sidebar(array(
            'name' => esc_html__('Single Product Sidebar', 'efarm'),
            'id' => 'single-product-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title widget-title-border">',
            'after_title' => '</h3>',
        ));
    }
}