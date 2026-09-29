<?php
function arrow_get_option_var_css() {
	$config = apr_check_theme_options();
	$css    = '';
	if ( isset( $config ) ) {
		$theme_options = array(
			'general_bg_color'         => esc_attr( $config['general-bg']['background-color'] ),
			'general_bg_image'         => esc_attr( $config['general-bg']['background-image'] ),
			'general_bg_repeat'        => esc_attr( $config['general-bg']['background-repeat'] ),
			'general_bg_position'      => esc_attr( $config['general-bg']['background-position'] ),
			'general_bg_size'          => esc_attr( $config['general-bg']['background-size'] ),
			'general_bg_attachment'    => esc_attr( $config['general-bg']['background-attachment'] ),
			'general_font_family'      => esc_attr( $config['general-font']['font-family'] ),
			'general_font_weight'      => esc_attr( $config['general-font']['font-weight'] ),
			'general_font_size'        => esc_attr( $config['general-font']['font-size'] ),
			'general_font_color'       => esc_attr( $config['general-font']['color'] ),
			'general_line_height'      => esc_attr( $config['general-font']['line-height'] ),
			'primary_color'            => esc_attr( $config['primary-color']['from'] ),
			'primary_color2'           => esc_attr( $config['primary-color']['to'] ),
			'highlight_color'          => esc_attr( $config['highlight-color'] ),
			'footer_color'             => esc_attr( $config['footer-color'] ),
			'newsletter_bg_color'      => esc_attr( $config['newsletter-bg']['background-color'] ),
			'newsletter_bg_image'      => esc_url( $config['newsletter-bg']['background-image'] ),
			'newsletter_bg_repeat'     => esc_attr( $config['breadcrumbs-bg']['background-repeat'] ),
			'newsletter_bg_position'   => esc_attr( $config['newsletter-bg']['background-position'] ),
			'newsletter_bg_size'       => esc_attr( $config['newsletter-bg']['background-size'] ),
			'newsletter_bg_attachment' => esc_attr( $config['newsletter-bg']['background-attachment'] ),
			'breadcrumb_bg_image'      => esc_url( $config['breadcrumbs-bg']['background-image'] ),
			'breadcrumb_bg_repeat'     => esc_attr( $config['breadcrumbs-bg']['background-repeat'] ),
			'breadcrumb_bg_position'   => esc_attr( $config['breadcrumbs-bg']['background-position'] ),
			'breadcrumb_bg_size'       => esc_attr( $config['breadcrumbs-bg']['background-size'] ),
			'breadcrumb_bg_attachment' => esc_attr( $config['breadcrumbs-bg']['background-attachment'] ),
			'breadcrumb_font_family'   => esc_attr( $config['title-breadcrumbs-font']['font-family'] ),
			'breadcrumb_font_size'     => esc_attr( $config['title-breadcrumbs-font']['font-size'] ),
			'breadcrumb_font_color'    => esc_attr( $config['title-breadcrumbs-font']['color'] ),
			'h1_font_family'           => esc_attr( $config['h1-font']['font-family'] ),
			'h1_font_size'             => esc_attr( $config['h1-font']['font-size'] ),
			'h1_font_color'            => esc_attr( $config['h1-font']['color'] ),
			'h2_font_family'           => esc_attr( $config['h2-font']['font-family'] ),
			'h2_font_size'             => esc_attr( $config['h2-font']['font-size'] ),
			'h2_font_color'            => esc_attr( $config['h2-font']['color'] ),
			'h3_font_family'           => esc_attr( $config['h3-font']['font-family'] ),
			'h3_font_size'             => esc_attr( $config['h3-font']['font-size'] ),
			'h3_font_color'            => esc_attr( $config['h3-font']['color'] ),
			'h4_font_family'           => esc_attr( $config['h4-font']['font-family'] ),
			'h4_font_size'             => esc_attr( $config['h4-font']['font-size'] ),
			'h4_font_color'            => esc_attr( $config['h4-font']['color'] ),
			'h5_font_family'           => esc_attr( $config['h5-font']['font-family'] ),
			'h5_font_size'             => esc_attr( $config['h5-font']['font-size'] ),
			'h5_font_color'            => esc_attr( $config['h5-font']['color'] ),
			'h6_font_family'           => esc_attr( $config['h6-font']['font-family'] ),
			'h6_font_size'             => esc_attr( $config['h6-font']['font-size'] ),
			'h6_font_color'            => esc_attr( $config['h6-font']['color'] ),
		);

		foreach ( $theme_options as $key => $val ) {
			if ( in_array( $key, array( 'newsletter_bg_image', 'general_bg_image', 'breadcrumb_bg_image' ) ) ) {
				$val_opt = 'url("' . $val . '")';
				$css     .= '--' . str_replace( '_', '-', $key ) . ':' . $val_opt . ';';
			} else {
				$css .= '--' . str_replace( '_', '-', $key ) . ':' . $val . ';';
			}
		}
	}


	return apply_filters( 'arrow_get_var_css_customizer', $css );
}

if ( ! function_exists( 'config_custom_style_css' ) ) :
	function config_custom_style_css() {
		global $apr_settings;
		$apr_primary_color   = ( isset( $apr_settings['primary-color']['from'] ) && $apr_settings['primary-color']['from'] != '' ) ? $apr_settings['primary-color']['from'] : '';
		$apr_main_color      = apr_get_meta_value( 'main_color' ) != '' ? apr_get_meta_value( 'main_color' ) : $apr_primary_color;
		$apr_main_color2     = ( isset( $apr_settings['primary-color']['to'] ) && $apr_settings['primary-color']['to'] != '' ) ? $apr_settings['primary-color']['to'] : '';
		$apr_highlight_color = ( isset( $apr_settings['highlight-color'] ) && $apr_settings['highlight-color'] != '' ) ? $apr_settings['highlight-color'] : '';
		$apr_cus_font        = apr_get_meta_value( 'cus_font' );
		$apr_custom_css      = '';
		if ( isset( $apr_main_color ) && $apr_main_color != '' ) :
			?>
			<?php
			$apr_custom_css .= "
             .cart-block::-webkit-scrollbar-thumb{
                background-color: {$apr_main_color} !important;
            }
            .ie-11,.ie-10,.ie-9,.ie-8,.ie-7,.ie-5{
                .vc_icon_element-inner .vc_icon_element-icon::before{
                color:{$apr_main_color};
                }
                .ult_countdown-row .ult_countdown-section .ult_countdown-amount{
                color: {$apr_main_color} !important;
                }
            }            
            a:focus, a:hover,.blog-info .info a:hover,
            .info-cat:hover i, .info-tag:hover i,
            .post-name a:hover,.arrowpress-heading.heading-5 .small-title p,
            .product-filter-isotope .nav-tabs li a:hover, .product-filter-isotope .nav-tabs li a.active,
            .product-content .price .amount, .product-content .price .unit_price,
            .product-content h3 a:hover,.blog-container .blog-post-title .post-name a:hover,
            .blog-item .read-more a,.blog-container .blog-date a:hover,
            .footer-newsletter .mc4wp-form label,.list-info-footer li i,
            .widget_nav_menu ul li a:hover,
            [class*='header-'] .open-menu-mobile:hover, [class*='header-'] .searchform_wrap form button:hover, 
            [class*='header-'] .header-contact a:hover,
            [class*='header-'] .mega-menu .sub-menu li.current-menu-item > a, 
            [class*='header-'] .widget_shopping_cart_content ul li a:hover,
            .search-block-top .btn-search:hover,
            .mega-menu li .sub-menu li a:hover,
            .footer-newsletter .mc4wp-form label,
            .mini-cart .cart_label:hover,
            .mega-menu > li.menu-item.current-menu-item > a, .mega-menu > li.menu-item.current-menu-parent > a,
            .icon_box i,.icon_box,
            .product-content .price .amount span, .product-content .price .unit_price span,
            .desc-icon h4:hover,.text-primary,.layout_style_2.layout_style_3 .slick-arrow:hover,
            .text-content-banner.text-right .btn.btn-white,
            .icon_box_content.icon_style2 .icon_box i,
            .banner-type3:hover .banner-btn .btn.btn-noborder,
            .recipe-gallery.arrows-custom .slick-arrow,
            .caption_testimonial .tes_info h6,.slick-default > .btn-next.slick-arrow:hover,
            .member-info .member_social ul li a:hover,
            .viewmode-toggle a:hover, .viewmode-toggle a:focus, .viewmode-toggle a.active,
            .info .price span, #yith-quick-view-content .price span,
            .blog-media .quote_section blockquote i,.blog-media .quote_section .author_info,
            .widget_archive li.current-cat > a, .widget_categories li.current-cat > a, 
            .widget_apr_recipe_categories li.current-cat > a, .widget_apr_knowledge_categories li.current-cat > a, 
            .widget_product_categories li.current-cat > a, 
            .widget_pages li.current-cat > a, .widget_meta li.current-cat > a,
            .widget_archive li a:before, .widget_categories li a:before, .widget_apr_recipe_categories li a:before, 
            .widget_apr_knowledge_categories li a:before, .widget_product_categories li a:before, 
            .widget_pages li a:before, .widget_meta li a:before,
            .widget_recent_recipe .blog-post-info .blog-time a, .widget_post_blog .blog-post-info .blog-time a, 
            .widget_recent_knowledge .blog-post-info .blog-time a,
            .widget_recent_recipe .blog-post-info .post-name > a:hover, 
            .widget_post_blog .blog-post-info .post-name > a:hover, 
            .widget_recent_knowledge .blog-post-info .post-name > a:hover,
            .tagcloud a:hover,
            .widget_archive li:hover > a, 
            .widget_categories li:hover > a, .widget_apr_recipe_categories li:hover > a, 
            .widget_apr_knowledge_categories li:hover > a, .widget_product_categories li:hover > a, 
            .widget_pages li:hover > a, .widget_meta li:hover > a,
            .breadcrumb li a:hover,
            .addthis_sharing_toolbox .f-social li a:hover,
            .blog-media .post_link i,.blog-media .post_link:hover,
            .shop_table .product-subtotal span, .shop_table .product-price span,
            .shop_table .cart_item .product-remove a,
            .shop_table .cart_item .product-name a:hover,
            .box_contact .wpb_text_column a,
            .quantity .qty-number:hover span,
            .title-cart-sub,.footer-bottom p a,
            .payment li a:hover,.btn.btn-default,
            .showlogin, .showcoupon,
            .payment_method_paypal label a,
            .header-profile ul a:hover,
            .social_icon li a,.close-menu, .close-menu-mobile,
            .wishlist_table tr td.product-stock-status span.wishlist-in-stock,
            .wishlist_table .product-remove a,
            .woocommerce .wishlist_table .product-name a.yith-wcqv-button,
            .woocommerce-page .wishlist_table .product-price .amount,
            .shop_table .product-subtotal span, .shop_table .product-price span,
            .yith-woocompare-widget ul.products-list li .remove,
            .close_search_form:hover,.search-title p,
            .yith-woocompare-widget ul.products-list li .title:hover,
            .widget_post_blog .blog-post-info .post-name > a:hover,
            .woocommerce-message,
            .tt-instagram .uvc-sub-heading > a,
            .header-myaccount i:hover,
            .header-profile ul a:hover,
            .member-type2 .btn-prev,
            .uvc-sub-heading > a,
            .menu-block1 .columns-1 .product-grid .product-desc h3 a:hover, 
            .menu-block2 .columns-1 .product-grid .product-desc h3 a:hover,
            .info .product_meta > span a, #yith-quick-view-content .product_meta > span a,
            .wishlist_table .product-name a:hover,
            .header-sidebar h4,.open-menu:hover,
            .footer-v1 .footer-newsletter .mc4wp-form label,
            .layout_style_2 .product_style_2 .product-desc .term_name a,
            .header-toplink .top-link li a:hover,
            .icon_box_content:hover .icon_box_title h3,
            .footer-top a:hover,
            .blog-container .grid_style_4 .blog-content:hover .blog-post-title .post-name a,
            .btn.btn-white,
            .header-myaccount i:hover,.info-icon,
            .button-group .btn-filter.is-checked, .button-group .btn-filter:hover,
            .gallery-img a.btn-fancybox:hover i,.tes_title .tt-big,.caption_testimonial .tes_name h4,
            .header-v5 .mini-cart .cart_label p.cart_qty,
            .header-v5 .icon-header,.header-v5 .text-header a,
            .footer-v2 .footer-newsletter .submit:before,
            .widget_product_categories li:hover span,
            .footer-v2 .footer-bottom a:hover,
            .woocommerce-Address-title a, .my_account_orders a, 
            .woocommerce-MyAccount-content a, .woocommerce-MyAccount-navigation li a,
            .widget_archive li:hover span, .widget_categories li:hover span, 
            .widget_apr_recipe_categories li:hover span, .widget_apr_knowledge_categories li:hover span, 
            .widget_product_categories li:hover span, 
            .widget_pages li:hover span, .widget_meta li:hover span,
            .recipe-info .info i,.read-more .btn-recipe,
            .recipe-info a:hover,
            .recipe-list .recipe-content:hover .recipe-name a,
            .review-star .review-result-wrapper > i,
            .review-star .review-result-wrapper .review-result,
            .tab-pane.recipe_share a,
            .recipe-single-content .recipe_post_desc .recipes-content .ingredients-container .icon,
            .recipe_direction .action-direction a:hover,
            .direction_list li .direction_text .step_no,
            .comment-body .comment-bottom .links-info a:hover,
            .widget_search form .btn-search:hover, .widget_product_search form .btn-search:hover,
            .apr-comment-rate,
            .widget_archive li.current-cat > span.count, 
            .widget_categories li.current-cat > span.count, 
            .widget_apr_recipe_categories li.current-cat > span.count, 
            .widget_apr_knowledge_categories li.current-cat > span.count, 
            .widget_product_categories li.current-cat > span.count, 
            .widget_pages li.current-cat > span.count, .widget_meta li.current-cat > span.count,
            .product_list_widget .product-content .product-title:hover,
            .woocommerce-review-link:hover,
            .icon_box_content.icon_style3:hover .icon_box i,
            .widget_add_to_cart a:hover,
            .header-v6 .mini-cart .cart_label,
            .product_layout_list.arrowpress-products .product-content h3 a:hover,
            .layout_style_2.layout_style_5 .product-content .product-action-list .action_item a:hover span:before,
            .layout_style_2.layout_style_5 .product-content .term_name a:hover,
            .banner-type6 .banner-btn .btn.btn-noborder:hover,
            .see-more a, .form-home-10 .submit input.wpcf7-form-control,
            .nav-page .link-text:hover, .nav-page .link-icon:hover,
            .press_filter .button-group .btn-filter:hover,
            .press-content .blog-info .info a,
            .cate-archive li a:hover .woocommerce-loop-category__title, 
            .cate-archive li a:hover .count,
            .product-content:hover .button.add_to_cart_button:hover,
            .wpb-js-composer .vc_tta-container .vc_tta.vc_tta-accordion .vc_tta-panel-body .read-more > a,.gallery-style3 .figcaption .btn.btn-white:hover,.uni-cpo-total-sum,
            .vc_toggle_size_md.vc_toggle_default .vc_toggle_title .vc_toggle_icon:before,
            .gallery-slide .item:hover .post-name a,
            .gallery-slide .item .read-more a.btn-icon,
            .blog-container .blog-packery.blog-style2 .blog-post-title .post-name a:hover,
            .item_testimonial4:before,
                .footer-v4 .widget_post_blog .blog-post-info .post-name > a:hover,
                .icon_box_content.type_4:hover .icon_box i,
                .ie-8 .icon_box_content.type_4:hover .icon_box i:before,
                .ie-9 .icon_box_content.type_4:hover .icon_box i:before,
                .ie-10 .icon_box_content.type_4:hover .icon_box i:before,
                .ie-11 .icon_box_content.type_4:hover .icon_box i:before,
                .footer-v4 .footer-bottom p a:hover,
                .blog-packery .info-tag:hover a,
                footer .footer-v4 .footer-newsletter .mc4wp-form .submit input, 
            .product-list .product-content:hover .action_item_box > .button{
                color: {$apr_main_color};
            }
            .brand-content .slick-next:hover i:before, 
            .brand-content .slick-next:active i:before, 
            .brand-content .slick-prev:hover i:before, 
            .brand-content .slick-prev:active i:before,
            .brand-content .slick-next:hover, 
            .brand-content .slick-next:active, .brand-content .slick-prev:hover, 
            .brand-content .slick-prev:active,
            .mega-menu li a:hover, .mega-menu li a:focus,.slick-arrow:hover,
            .product_layout_list.arrowpress-products .product-content .product-action-list .product_type_simple:hover, .product_layout_list.arrowpress-products .product-content .product-action-list .add_to_cart_button:hover,
            .ult_tabs .ult_tabmenu.style1 li.ult_tab_li.current a, .ult_tabs .ult_tabmenu.style1 li.ult_tab_li:hover a,
            .control-type2 .slick-next:hover, .control-type2 .slick-prev:hover,
            .menu-block1 .columns-1 .product_types .product-content .product-action a:hover, .menu-block2 .columns-1 .product_types{
                color: {$apr_main_color} !important;
            }                

        .main-bg_color, .main-bg_color.ult-content-box-container, 
        .main-bg_color > .vc_column-inner,
        .main-bg_color > .upb_row_bg,
        .main-bg_color.vc_row,
        .footer-newsletter .mc4wp-form [type='submit'],
        .scroll-to-top, .action_item a:hover, .add_to_cart_button:hover, .product_type_simple:hover, 
        .btn.btn-primary, .banner-type2, .separator-h2 .vc_sep_line, .box-right .ult-content-box,
        .layout_style_2 .slick-slider .slick-dots li.slick-active button,
        .layout_style_2 .slick-slider .slick-dots li:hover button,
        .instagram-img a:before, .blog-img a:before, .lable-sale .text-sale,
        .wpcf7-submit, .footer .widget-title:after,
        .footer-social li a:hover, .mini-cart .cart_nu_count,
        .ult-carousel-wrapper .slick-dots li.slick-active,
        .ult-carousel-wrapper .slick-dots li:hover,
        .arrowpress-heading.heading-5 .small-title p:before,
        .arrowpress-heading.heading-5 .small-title p:after,
        .vc_icon_element-inner:hover:before,
        .separator-h2 .vc_sep_line:after,
        .layout_style_2.layout_style_3 .product_style_2 .product-content > .product-action-list .action_item a:hover,
        .layout_style_2.layout_style_3 .product_style_2 .product-content > .product-action-list .product_type_simple:hover,
        .layout_style_2.layout_style_3 .product_style_2 .product-content > .product-action-list .add_to_cart_button:hover,
        .blog-packery .blog-img a:after, .service-content .service-box:hover,
        .btn.btn-default:hover, .btn.btn-default:focus, .btn.btn-default:active,
        .recipe-gallery.arrows-custom .slick-arrow:hover,
        .bg-primary, .arrows-custom .slick-dots li.slick-active button,
        .overlay_bg:before, .item-member-content:hover .member-info,
        .page-numbers li .page-numbers:hover, .page-numbers li .page-numbers.current,
        .woocommerce-pagination .page-numbers > li .current,
        .woocommerce-pagination .page-numbers > li a:hover,
        .info .single_add_to_cart_button, .info .add_to_cart_button,
        #yith-quick-view-content .single_add_to_cart_button,
        #yith-quick-view-content .add_to_cart_button,
        .product-tab .nav-tabs > li.active a,
        .product-tab .nav-tabs > li a:hover, .product-tab .nav-tabs > li a:focus,
        .single-product .products > h2.title_related:before,
        .info .add-to a:hover, #yith-quick-view-content .add-to a:hover,
        .blog-info .blog-date,
        .list-items.style1 li:before,
        .comment-reply-title:before, .post-comments .widget-title:before,
        #comments .widget-title:before, .gallery-img:before,
        .arrowpress-heading.heading-6:after,
        .title-sub2.title-cart:before,
        .title-cart:before, .woocommerce-page .wishlist_table .product-add-to-cart .button,
        .footer-v1 .footer-newsletter .mc4wp-form [type='submit'],
        .product-categories-shortcode li.product-category.product:before,
        .bg-counter:before,
        .layout_style_4 .slick-dots li.slick-active button,
        .layout_style_4 .slick-dots li button:hover, .cate-menu .title-cate,
        .recipe-search .btn-search,
        .recipes-details .nav-pills > li.active > a,
        .recipes-details .nav-pills > li.active > a:focus,
        .recipes-details .nav-pills > li.active > a:hover,
        .recipe-single-content .recipe_post_desc .title-desc:before,
        .tab-pane.recipe_share a:hover,
        .recipe-single-content .recipe_post_desc .recipes-desc ul li:before,
        #cart_added_msg_popup, #compare_added_msg_popup,
        .icon_box_content.icon_style3 .icon_box,
        .services-overlay::before,
        .icon_box_content.icon_style4.icon_style3 .icon_box,
        .icon_box_content.icon_style4.icon_style3 .icon_box i,
        .product-label span.new, .ult-carousel-wrapper.button-slide-tes .slick-dots li.slick-active,
            .blog-info .blog-date,.arrowpress-heading.heading-5 .small-title p:before,
            .arrowpress-heading.heading-5 .small-title p:after,
            .instagram-img a::before,.post-password-form input[type='submit'],
            a.ais-pagination--link:hover,
            .header-v7 .cate-menu .title-cate:hover, .header-v7 .cate-menu .title-cate.active,
            .ult_tabs .ult_tabmenu.style1 li.ult_tab_li a:before,
            .form-home-10 .submit input.wpcf7-form-control:hover, 
            .press_filter .button-group .btn-filter::before,
            a.ais-pagination--link:hover,.blog_post_desc .page-links > *:not(.page-links-title),
            .sticky_post,.object,object-9,.object-2,
            .page-coming-soon .mc4wp-form input[type='submit'],
            footer  .footer-v4 .footer-newsletter,
            .woocommerce-mini-cart__buttons .button,
            .woocommerce-Button,
            .checkout-button,
            .checkout_coupon .button,
            .woocommerce-address-fields .button,
            .place-order .button,
            .uni_cpo_fields_container .irs-from, .uni_cpo_fields_container .irs-to, .uni_cpo_fields_container .irs-single, .uni_cpo_fields_container .irs-bar,.uni_cpo_fields_container .irs-bar-edge{
                background: {$apr_main_color};
            }
            .tp-caption.rev-btn,
            .vc_icon_element-inner:hover .vc_icon_element-icon,
            .arrowpress-heading.heading-5 .small-title p:before,
            .arrowpress-heading.heading-5 .small-title p:after,
            .instagram-img a::before,.blog-info .blog-date,
            .list-items.style1 li:before,
            .header-v6 .search-block-top > .btn-search > i,
            .banner-type4, .preloader8 span,
            .banner-type4::before,.cate-archive .slick-arrow:hover,
            .product_layout_list.arrowpress-products .product-content .product-image::before,
            .vc_row .hotspot:before,.product-content:hover .button.add_to_cart_button,
            .wpb-js-composer .vc_tta-container .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading, .wpb-js-composer .vc_tta-container .vc_tta.vc_tta-accordion .vc_tta-panel:hover .vc_tta-panel-heading,
            .wpb-js-composer .vc_tta-container .vc_tta.vc_tta-accordion .vc_tta-panel-title .vc_tta-controls-icon,
            footer  .footer-v4 .footer-newsletter, footer  .footer-v1 .footer-newsletter,

            .member-type2 .member-info .member_social::before {
                background-color: {$apr_main_color};
            }
            .icon_box_content.type_4,
            .tp-caption.rev-btn,
            .vc_icon_element-inner:hover .vc_icon_element-icon,
            .icon_box_content.type_3:hover{
                background-color: {$apr_main_color} !important;
            }
            .line_main_color .uvc-headings-line,
            .product-filter-isotope .nav-tabs li a:hover, 
            .product-filter-isotope .nav-tabs li a.active,
            .footer-social li a:hover,
            .mini-cart .count-item,
            .mini-cart .cart-block,
            .banner-type1 .banner-btn .btn.btn-default:hover, 
            .banner-type1 .banner-btn .btn.btn-default:active, 
            .banner-type1 .banner-btn .btn.btn-default:focus,
            .icon_box_content.icon_style2 .icon_box,
            .recipe-gallery.arrows-custom .slick-arrow,
            .viewmode-toggle a:hover, .viewmode-toggle a:focus, .viewmode-toggle a.active,
            .page-numbers li .page-numbers:hover, .page-numbers li .page-numbers.current,
            .info .add-to a:hover, #yith-quick-view-content .add-to a:hover,
            .tagcloud a:hover,blockquote,
            .wpcf7-form-control.wpcf7-textarea:focus, .wpcf7-form-control.wpcf7-text:focus, 
            .wpcf7-form-control.wpcf7-select:focus,
            .wpcf7-form-control.wpcf7-date:focus,
            .top-search .search-field, .top-search .search-form input[type='text'],
            .btn.btn-default,.content-filter,.social_icon li a,
            .button-group .btn-filter.is-checked, .button-group .btn-filter:hover,
            .border-primary.vc_separator.vc_sep_color_grey .vc_sep_line,
            .tab-pane.recipe_share a,
            .single-product .thumbs_list li a.zoomGalleryActive img,
            .icon_box_content.icon_style3 .icon_box,
            .icon_box_content.icon_style3:hover .icon_box,
            .close-menu, .close-menu-mobile,.recipe-gallery .recipe_body,
            .woosearch-results, .layout_style_1 .slick-arrow:hover,
            .header-v6 .search-block-top > .btn-search:hover > i,
            .product_layout_list.arrowpress-products .product-content .product-action-list .product_type_simple:hover, .product_layout_list.arrowpress-products .product-content .product-action-list .add_to_cart_button:hover,
            .header-v7 .cate-menu .title-cate:hover, .header-v7 .cate-menu .title-cate.active, .btn-slick-circle .slick-arrow:hover,
            .blog_post_desc .page-links >*:not(.page-links-title),
            .product-content:hover .button.add_to_cart_button:hover,
            .wpb-js-composer .vc_tta-container .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading, .wpb-js-composer .vc_tta-container .vc_tta.vc_tta-accordion .vc_tta-panel:hover .vc_tta-panel-heading,
            .wpb-js-composer .vc_tta-container .vc_tta.vc_tta-accordion.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-body, .wpb-js-composer .vc_tta-container .vc_tta.vc_tta-accordion.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-body::after, .wpb-js-composer .vc_tta-container .vc_tta.vc_tta-accordion.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-body::before,
            .wpb-js-composer .vc_tta-container .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title .vc_tta-controls-icon::before, .wpb-js-composer .vc_tta-container .vc_tta.vc_tta-accordion .vc_tta-panel:hover .vc_tta-panel-heading .vc_tta-panel-title .vc_tta-controls-icon::before,.wpb-js-composer .vc_tta-container .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title .vc_tta-controls-icon::after, .wpb-js-composer .vc_tta-container .vc_tta.vc_tta-accordion .vc_tta-panel:hover .vc_tta-panel-heading .vc_tta-panel-title .vc_tta-controls-icon::after,.uni_cpo_fields_container .irs-bar, .uni_cpo_fields_container .irs-bar-edge,
            .product-list .product-content:hover .action_item_box > .button{
                border-color:{$apr_main_color};
            }
            .layout_style_2.layout_style_3 .product_style_2 .product-content > .product-action-list .product_type_simple:hover, 
            .layout_style_2.layout_style_3 .product_style_2 .product-content > .product-action-list .add_to_cart_button:hover, 
            .layout_style_2.layout_style_3 .product_style_2 .product-content > .product-action-list .action_item a:hover{
                border-color: {$apr_main_color} !important;
            }                
            .shop_table tbody tr:first-child td{
                    border-top-color:{$apr_main_color};
            }
            .custom-progress.vc_progress_bar .vc_single_bar .vc_bar:before{
                border-color:transparent transparent transparent {$apr_main_color};
            }
            .custom-progress.vc_progress_bar .vc_progress_value::before {
                border-color:{$apr_main_color} transparent transparent;
            }  
            @media (min-width: 601px){
                .product-content .product-action-list .product_type_simple, 
                .product-content .product-action-list .add_to_cart_button{
                    background: {$apr_main_color};
                }
            }  
            @media (min-width: 768px){
                .header-profile ul a:before,
                .icon_box_content:hover .icon_box,.icon_box_content:hover .icon_box i {
                    background:{$apr_main_color};
                }
            }  
            @media (min-width: 992px){
                .countdown-2.countdown-3 .ult_countdown-row::before{
                    background:{$apr_main_color};
                }
                .mega-menu > li:not(.megamenu) .sub-menu, .mega-menu > li > .sub-menu {
                    border-top-color: {$apr_main_color};
                }
            }
            @media (max-width: 991px){
                .nav-sections .nav-tabs > li.active > a, 
                .nav-sections .nav-tabs > li.active > a:focus, 
                .nav-sections .nav-tabs > li.active > a:hover {
                    color: {$apr_main_color} !important;
                }
            } 
            @media (max-width: 767px){
                .gallery-style3 .figcaption .gallery_content .post-name > a:hover,
                .member-type2 .member-info .member_social ul li a:hover{
                    color: {$apr_main_color};
                }
            }
            @media (max-width:375px){
                .recipe-search .btn-search span:hover:before{
                color: {$apr_main_color};
                }
            }  
            .object, .object-2, .loader:before,
            .busy-loader .w-ball-wrapper .w-ball,
            #object-7,.pacman > div:nth-child(3),
            .pacman > div:nth-child(4),
            .pacman > div:nth-child(5),
            .pacman > div:nth-child(6),
            .object-9 {
                background-color: {$apr_main_color};
            }
            .object-3{
                border-top-color: {$apr_main_color};
                border-left-color: {$apr_main_color};
            }
            .pacman > div:first-of-type,
            .pacman > div:nth-child(2){
                border-top-color: {$apr_main_color};
                border-left-color: {$apr_main_color};
                border-bottom-color: {$apr_main_color};
            }
            .object-6{
                border-color: {$apr_main_color};
            }                                                                                     
        ";
			?>
			<?php if ( isset( $apr_main_color2 ) && $apr_main_color2 != '' ) : ?>
			<?php
			$apr_custom_css .= "
                .box-offer.vc_row:before,
                .box-offer .vc_column_container>.vc_column-inner.vc_row:before{
                    background: -moz-linear-gradient(0deg, {$apr_main_color} 0%, {$apr_main_color2} 100%,{$apr_main_color2}  100%);
                    background: -webkit-linear-gradient(0deg, {$apr_main_color} 0%,{$apr_main_color2} 100%,{$apr_main_color2} 100%);
                    background: linear-gradient(0deg, {$apr_main_color} 0%,{$apr_main_color2} 100%,{$apr_main_color2} 100%);
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$apr_main_color}', endColorstr='{$apr_main_color2}',GradientType=1 );
                }
                .icon_style1 .icon_box, .ult_countdown-row .ult_countdown-section,.slide-sale .vc_single_image-wrapper:before{
                    background: -moz-linear-gradient(0deg, {$apr_main_color2} 0%, {$apr_main_color} 100%,{$apr_main_color}  100%);
                    background: -webkit-linear-gradient(0deg, {$apr_main_color2} 0%,{$apr_main_color} 100%,{$apr_main_color} 100%);
                    background: linear-gradient(0deg, {$apr_main_color2} 0%,{$apr_main_color} 100%,{$apr_main_color} 100%);
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$apr_main_color2}', endColorstr='{$apr_main_color}',GradientType=1 );    
                }

                .lable-sale .text-sale::before {
                    box-shadow: 25px 8px 0 0 {$apr_main_color};
                    -webkit-box-shadow: 25px 8px 0 0 {$apr_main_color};
                }
                .ult_countdown-row .ult_countdown-section .ult_countdown-amount,
                .icon_style1 .icon_box i:before,.vc_icon_element-icon:before{
                    background: -webkit-gradient(linear, left top, left bottom, from({$apr_main_color}), to({$apr_main_color2}));
                        -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                }
                .slide-sale .vc_single_image-wrapper:before {
                    border-top: 10px solid {$apr_main_color};
                    border-bottom: 10px solid {$apr_main_color2};
                    background-image: -webkit-linear-gradient(top, {$apr_main_color} 0%, {$apr_main_color2} 100%), -webkit-linear-gradient(top, {$apr_main_color} 0%, {$apr_main_color2} 100%);
                    background-image: -moz-linear-gradient(top, {$apr_main_color} 0%, {$apr_main_color2} 100%), -moz-linear-gradient(top, {$apr_main_color} 0%, {$apr_main_color2} 100%);
                    background-image: -o-linear-gradient(top, {$apr_main_color} 0%, {$apr_main_color2} 100%), -o-linear-gradient(top, {$apr_main_color} 0%, {$apr_main_color2} 100%);
                    background-image: linear-gradient(to bottom, {$apr_main_color} 0%, {$apr_main_color2} 100%), linear-gradient(to bottom, {$apr_main_color} 0%, {$apr_main_color2} 100%);
                    -webkit-box-sizing: border-box;
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                    background-position: 0 0, 100% 0;
                    background-repeat: no-repeat;
                    -webkit-background-size: 10px 100%;
                    -moz-background-size: 10px 100%;
                    background-size: 10px 100%;
                }
                
                .img-gradient:before,
                .comment-body .comment-author:before,
                .vc_icon_element-inner:before {
                    background: -moz-linear-gradient(0deg, {$apr_main_color} 0%, {$apr_main_color2} 100%, {$apr_main_color2} 100%);
                    background: -webkit-linear-gradient(0deg, {$apr_main_color} 0%, {$apr_main_color2} 100%, {$apr_main_color2} 100%);
                    background: linear-gradient(0deg, {$apr_main_color} 0%, {$apr_main_color2} 100%, {$apr_main_color2} 100%);
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$apr_main_color2}', endColorstr='{$apr_main_color}',GradientType=1 );
                }
                .bg_left_gradient:before {
                    background: -webkit-linear-gradient({$apr_main_color}, {$apr_main_color2});
                    background: -o-linear-gradient({$apr_main_color}, {$apr_main_color2});
                    background: -moz-linear-gradient({$apr_main_color}, {$apr_main_color2});
                    background: linear-gradient({$apr_main_color}, {$apr_main_color2});
                }
                .layout_style_2::before,
                .icon_box-container:hover .icon_style5 .icon_box i {
                    background: -moz-linear-gradient(0deg, {$apr_main_color} 0%, {$apr_main_color2} 100%, {$apr_main_color2} 100%);
                    background: -webkit-linear-gradient(0deg, {$apr_main_color} 0%, {$apr_main_color2} 100%, {$apr_main_color2} 100%);
                    background: linear-gradient(0deg, {$apr_main_color} 0%, {$apr_main_color2} 100%, {$apr_main_color2} 100%);
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$apr_main_color2}', endColorstr='{$apr_main_color}',GradientType=1 );
                } 
                .header-v9:before,
                .bg-gradient .upb_row_bg:before{
                        background: -moz-linear-gradient(left,{$apr_main_color} 0%,{$apr_main_color2} 65%);
                        background: -webkit-gradient(left top, right top, color-stop(0%, {$apr_main_color}), color-stop(65%, {$apr_main_color2}));
                        background: -webkit-linear-gradient(left, {$apr_main_color} 0%, {$apr_main_color2} 65%);
                        background: -o-linear-gradient(left, {$apr_main_color} 0%, {$apr_main_color2} 65%);
                        background: -ms-linear-gradient(left, {$apr_main_color} 0%, {$apr_main_color2}65%);
                        background: linear-gradient(to right, {$apr_main_color} 0%, {$apr_main_color2}65%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$apr_main_color}', endColorstr='{$apr_main_color2}', GradientType=1 );
                    }
                }  
                                
            ";
			?>
		<?php endif; ?>
		<?php endif;
		if ( isset( $apr_highlight_color ) && $apr_highlight_color != '' ) :
			?>
			<?php
			$apr_custom_css .= "
            .btn.btn-primary:hover, .btn.btn-primary:focus, .btn.btn-primary:active,
            .blog_post_desc .page-links > *:not(.page-links-title):hover{
                background-color: {$apr_highlight_color};
                border-color: {$apr_highlight_color};
            }
            .blog-item .read-more a:hover{
                color: {$apr_highlight_color};
            }
            .footer-newsletter .mc4wp-form .submit:hover [type='submit'],
            .scroll-to-top:hover,.wpcf7-form-control.btn-primary:hover, .wpcf7-form-control.btn-primary:focus,
            .info .single_add_to_cart_button:hover, .info .add_to_cart_button:hover, 
            #yith-quick-view-content .single_add_to_cart_button:hover, 
            #yith-quick-view-content .add_to_cart_button:hover,
            .woocommerce-page .wishlist_table .product-add-to-cart .button:hover, 
            .woocommerce-page .wishlist_table .product-add-to-cart .button:focus,
            .footer-v1 .footer-newsletter .mc4wp-form .submit:hover [type='submit'],
            .banner-type2 .banner-btn .btn:hover,.blog_post_desc .page-links a:hover,
            .page-coming-soon .mc4wp-form input[type='submit']:hover{
                background-color:{$apr_highlight_color};
            }
            .woocommerce-mini-cart__buttons .button:hover,
            .woocommerce-Button:hover,
            .checkout-butto:hovern,
            .checkout_coupon .button:hover,
            .woocommerce-address-fields .button:hover,
            .place-order .button:hover{
                background:{$apr_highlight_color}!important;
            }
            .woocommerce-page .cart-block .btn.btn-primary:hover{
                background-color: {$apr_highlight_color} !important;
            }   
            @media (min-width: 601px){
                .product-content .product-action-list .product_type_simple:hover, .product-content .product-action-list .add_to_cart_button:hover {
                    background: {$apr_highlight_color};
                }   
            }          
        ";
			?>
		<?php endif;
		if ( isset( $apr_cus_font ) && $apr_cus_font != 'default' && $apr_cus_font != '' ) :
			?>
			<?php
			$apr_custom_css .= "
        header,
        .megamenu.notsub_level-2 ul.sub-menu > li > a{
            font-family: '{$apr_cus_font}';
        }";
			?>
		<?php endif;
		if ( isset( $apr_settings['breadcrumbs3-overlay-color'] ) && $apr_settings['breadcrumbs3-overlay-color'] != '' ) {

			$apr_custom_css .= "
    .side-breadcrumb.type-3.has-overlay:before{
        background: {$apr_settings['breadcrumbs3-overlay-color']};
    }
    ";
		}
		if ( isset( $apr_settings['header-bg'] ) && $apr_settings['header-bg'] != '' ) {
			$apr_custom_css .= "
        .header-v1, .header-v2, .header-v4,
        .header-v1.is-sticky, 
        .header-v2.is-sticky, 
        .header-v4.is-sticky,
        .fixed-header .header-v1.is-sticky,
        .fixed-header .header-v2.is-sticky,
        .fixed-header .header-v4.is-sticky,
        .mega-menu li .sub-menu,
        .content-filter, .header-ver,
        .searchform_wrap,
        .top-search .search-field, 
        .top-search .search-form input{
            background-color: {$apr_settings['header-bg']};
        }
        @media (min-width: 992px){
            .fixed-header .header-v2:before{
                background-color: {$apr_settings['header-bg']};
            }
        }
        @media (max-width: 991px){
            .fixed-header .header-bottom,
            .header-center{
                background-color: {$apr_settings['header-bg']};
            }
        }
    ";
		}
		if ( isset( $apr_settings['header-bg-hover'] ) && $apr_settings['header-bg-hover'] != '' ) {
			$apr_custom_css .= "
        .mega-menu li .sub-menu li a:hover,
        .header-profile ul li:hover a{
            background-color: {$apr_settings['header-bg-hover']};
        }
    ";
		}
		if ( isset( $apr_settings['header-menu-color'] ) && $apr_settings['header-menu-color'] != '' ) {
			$apr_custom_css .= "
        .header_icon,
        .languges-flags a,
        .search-block-top, 
        .mini-cart > a,
        .mega-menu > li > a,
        .mega-menu li .sub-menu li a,
        .slogan,.header-contact a, 
        .searchform_wrap input,
        .searchform_wrap form button,
        .widget_shopping_cart_content ul li.empty,
        .open-menu-mobile,
        .nav-sections .nav-tabs > li > a,
        .social-mobile h5, .contact-mobile h5,
        .social-sidebar .twitter-tweet .tweet-text,
        .widget_shopping_cart_content ul li a,
        .widget_shopping_cart_content .total,
        .mini-cart .product_list_widget .product-content .product-title,
        .mega-menu .product_list_widget .product-content .product-title,
        .header-profile ul a
        {
            color: {$apr_settings['header-menu-color']};
        }
    ";
		}

		if ( isset( $apr_settings['header-border-color'] ) && $apr_settings['header-border-color'] != '' ) {
			$apr_custom_css .= "
        .mega-menu li .sub-menu li a,
        .searchform_wrap .vc_child,
        .header-v1, .social-mobile,
        .main-navigation .mega-menu li .sub-menu li:last-child > a,
        .widget_shopping_cart_content ul li,
        .header-profile ul li,
        .contact-mobile, #account .mega-menu li a,
        .nav-sections .nav-tabs > li {
            border-color: {$apr_settings['header-border-color']};
        }
        @media (max-width: 991px){
            .main-navigation .mega-menu > li.menu-item > a,
            .nav-sections ul.nav-tabs,
            .nav-tabs > li > a,
            .header-container .mega-menu,
            .main-navigation .caret-submenu,
            .main-navigation .menu-block1,
            .main-navigation .menu-block2,
            .header-v7 .header-center,
            .header-bottom.header-v7 .header-center{
                border-color: {$apr_settings['header-border-color']};
            }
        }
    ";
		}

		if ( isset( $apr_settings['header2-bg'] ) && $apr_settings['header2-bg'] != '' ) {
			$apr_custom_css .= "
        .header-v3,
        .header-v3.is-sticky,
        .fixed-header .header-v3.is-sticky,
        .header-v3 .mega-menu li .sub-menu,
        .header-v3 .content-filter,
        .header-v3 .header-ver,
        .header-v3 .searchform_wrap,
        .header-v3 .top-search .search-field, 
        .header-v3 .top-search .search-form input{
            background-color: {$apr_settings['header2-bg']};
        }
        @media (max-width: 991px){
            .fixed-header .header-v3.header-bottom,
            .header-v3 .header-center{
                background-color: {$apr_settings['header2-bg']};
            }
        }

        .header-v8,
        .header-v8.is-sticky,
        .fixed-header .header-v8.is-sticky,
        .header-v8 .mega-menu li .sub-menu,
        .header-v8 .content-filter,
        .header-v8 .header-ver,
        .header-v8 .searchform_wrap,
        .header-v8 .top-search .search-field, 
        .header-v8 .top-search .search-form input{
            background-color: {$apr_settings['header2-bg']};
        }
        @media (max-width: 991px){
            .fixed-header .header-v8.header-bottom,
            .header-v8 .header-center{
                background-color: {$apr_settings['header2-bg']};
            }
        }
    ";
		}
		if ( isset( $apr_settings['header2-bg-hover'] ) && $apr_settings['header2-bg-hover'] != '' ) {
			$apr_custom_css .= "
        .header-v3 .mega-menu li .sub-menu li a:hover,
        .header-v3 .header-profile ul li:hover a{
            background-color: {$apr_settings['header2-bg-hover']};
        }
        .header-v5 .mega-menu li .sub-menu li a:hover{
            background-color: {$apr_settings['header2-bg-hover']};
        }
        .header-v8 .mega-menu li .sub-menu li a:hover,
        .header-v8 .header-profile ul li:hover a{
            background-color: {$apr_settings['header2-bg-hover']};
        }
    ";
		}
		if ( isset( $apr_settings['header2-menu-color'] ) && $apr_settings['header2-menu-color'] != '' ) {
			$apr_custom_css .= "
        .header-v3 .header_icon,
        .header-v3 .languges-flags a,
        .header-v3 .search-block-top, 
        .header-v3 .mini-cart > a,
        .header-v3 .mega-menu > li > a,
        .header-v3 .mega-menu li .sub-menu li a,
        .header-v3 .slogan,
        .header-v3 .header-contact a, 
        .header-v3 .searchform_wrap input,
        .header-v3 .searchform_wrap form button,
        .header-v3 .widget_shopping_cart_content ul li.empty,
        .header-v3 .open-menu-mobile,
        .header-v3 .nav-sections .nav-tabs > li > a,
        .header-v3 .social-mobile h5,
        .header-v3 .contact-mobile h5,
        .header-v3 .social-sidebar .twitter-tweet .tweet-text,
        .header-v3 .widget_shopping_cart_content ul li a,
        .header-v3 .widget_shopping_cart_content .total,
        .header-v3 .header-profile ul a,
        .header-v3 .top-search .search-field, 
        .header-v3 .top-search .search-form input,
        .header-v3 .mini-cart .count-item > p,
        .header-v3 .product_list_widget .product-content .product-title{
            color: {$apr_settings['header2-menu-color']};
        }

        .header-v5 .header_icon,
        .header-v5 .languges-flags a,
        .header-v5 .search-block-top, 
        .header-v5 .mini-cart > a,
        .header-v5 .mega-menu > li > a,
        .header-v5 .mega-menu li .sub-menu li a,
        .header-v5 .searchform_wrap input,
        .header-v5 .searchform_wrap form button,
        .header-v5 .open-menu-mobile,
        .header-v5 .nav-sections .nav-tabs > li > a,
        .header-v5 .social-mobile h5,
        .header-v5 .contact-mobile h5,
        .header-v5 .social-sidebar .twitter-tweet .tweet-text,
        .header-v5 .top-search .search-field, 
        .header-v5 .top-search .search-form input,
        .header-v5 .product_list_widget .product-content .product-title{
            color: {$apr_settings['header2-menu-color']};
        }

        .header-v8 .header_icon,
        .header-v8 .languges-flags a,
        .header-v8 .search-block-top, 
        .header-v8 .mini-cart > a,
        .header-v8 .mega-menu > li > a,
        .header-v8 .mega-menu li .sub-menu li a,
        .header-v8 .searchform_wrap input,
        .header-v8 .searchform_wrap form button,
        .header-v8 .open-menu-mobile,
        .header-v8 .nav-sections .nav-tabs > li > a,
        .header-v8 .social-mobile h5,
        .header-v8 .contact-mobile h5,
        .header-v8 .social-sidebar .twitter-tweet .tweet-text,
        .header-v8 .top-search .search-field, 
        .header-v8 .top-search .search-form input,
        .header-v8 .product_list_widget .product-content .product-title{
            color: {$apr_settings['header2-menu-color']};
        }
    ";
		}

		if ( isset( $apr_settings['header2-border-color'] ) && $apr_settings['header2-border-color'] != '' ) {
			$apr_custom_css .= "
        .header-v3 .mega-menu li .sub-menu li a,
        .header-v3 .searchform_wrap .vc_child,
        .header-v3 .social-mobile,
        .header-v3 .contact-mobile,
        .header-v3 .widget_shopping_cart_content ul li,
        .header-v3 .header-profile ul li,
        .header-v3 #account .mega-menu li a,
        .header-v3 .nav-sections .nav-tabs > li{
            border-color: {$apr_settings['header2-border-color']};
        }
        @media (max-width: 991px){
            .header-v3 .main-navigation .mega-menu > li.menu-item > a,
            .header-v3 .nav-sections ul.nav-tabs,
            .header-v3 .header-tops,
            .header-v3 .main-navigation,
            .header-v3 .header-container .mega-menu,
            .header-v3 .main-navigation .mega-menu li .sub-menu li:last-child > a,
            .header-v3 .main-navigation .caret-submenu,
            .header-v3 .main-navigation .menu-block1,
            .header-v3 .main-navigation .menu-block2{
                border-color: {$apr_settings['header2-border-color']};
            }
            .header-v2 .nav-sections .nav-tabs > li > a{
                border-color: {$apr_settings['header2-border-color']} !important;
            }
        }

        .header-v5 .mega-menu li .sub-menu li a,
        .header-v5 .searchform_wrap .vc_child,
        .header-v5 .social-mobile,
        .header-v5 .contact-mobile,
        .header-v5 #account .mega-menu li a{
            border-color: {$apr_settings['header2-border-color']};
        }
        @media (max-width: 991px){
            .header-v5 .main-navigation .mega-menu > li.menu-item > a,
            .header-v5 .nav-sections ul.nav-tabs,
            .header-v5 .header-tops,
            .header-v5 .header-container .mega-menu,
            .header-v5 .main-navigation .mega-menu li .sub-menu li:last-child > a,
            .header-v5 .main-navigation .caret-submenu,
            .header-v5 .main-navigation .menu-block1,
            .header-v5 .main-navigation .menu-block2,
            .header-v5 .nav-sections .nav-tabs > li{
                border-color: {$apr_settings['header2-border-color']};
            }
        }

        .header-v8 .mega-menu li .sub-menu li a,
        .header-v8 .searchform_wrap .vc_child,
        .header-v8 .social-mobile,
        .header-v8 .contact-mobile,
        .header-v8 .widget_shopping_cart_content ul li,
        .header-v8 .header-profile ul li,
        .header-v8 #account .mega-menu li a,
        .header-v8 .nav-sections .nav-tabs > li{
            border-color: {$apr_settings['header2-border-color']};
        }
        @media (max-width: 991px){
            .header-v8 .main-navigation .mega-menu > li.menu-item > a,
            .header-v8 .nav-sections ul.nav-tabs,
            .header-v8 .header-tops,
            .header-v8 .main-navigation,
            .header-v8 .header-container .mega-menu,
            .header-v8 .main-navigation .mega-menu li .sub-menu li:last-child > a,
            .header-v8 .main-navigation .caret-submenu,
            .header-v8 .main-navigation .menu-block1,
            .header-v8 .main-navigation .menu-block2{
                border-color: {$apr_settings['header2-border-color']};
            }
        }
    ";
		}
		if ( isset( $apr_settings['header5-bg'] ) && $apr_settings['header5-bg'] != '' ) {
			$apr_custom_css .= "
        .header-v5 .mega-menu li .sub-menu,
        .header-v5 .header-ver,
        .header-v5 .searchform_wrap,
        .header-v5 .top-search .search-field, 
        .header-v5 .top-search .search-form input{
            background-color: {$apr_settings['header5-bg']};
        }
        @media (max-width: 991px){
            .fixed-header .header-v5.header-bottom,
            .header-v5 .header-center{
                background-color: {$apr_settings['header5-bg']};
            }
        }
    ";
		}
		if ( isset( $apr_settings['header7-text-top'] ) && $apr_settings['header7-text-top'] ) {
			$apr_custom_css .= "
        .header-v7 .header-toplink a {
            color: {$apr_settings['header7-text-top']} !important;
        }
    ";
		}
		if ( isset( $apr_settings['footer1-bg-color'] ) && $apr_settings['footer1-bg-color'] != '' ) {
			$apr_custom_css .= "
        .footer-v1 .footer-top{
            background: {$apr_settings['footer1-bg-color']};
        }
    ";
		}
		if ( isset( $apr_settings['footer-bg-color'] ) && $apr_settings['footer-bg-color'] != '' ) {
			$apr_custom_css .= "
        .footer-v3 .footer-top,
        .footer-v2 .footer-top{
            background: {$apr_settings['footer-bg-color']};
        }
    ";
		}
		if ( isset( $apr_settings['footer-color'] ) && $apr_settings['footer-color'] != '' ) {
			$apr_custom_css .= "
        .footer-top, .footer-top a,
        .footer-v3 .footer-newsletter .title-2 {
            color: {$apr_settings['footer-color']};
        }
    ";
		}
		if ( isset( $apr_settings['footer-t-color'] ) && $apr_settings['footer-t-color'] != '' ) {
			$apr_custom_css .= "
        .footer .widget-title{
            color: {$apr_settings['footer-t-color']};
        }
    ";
		}

		if ( isset( $apr_settings['footer1-copyright-bg'] ) && $apr_settings['footer1-copyright-bg'] != '' ) {
			$apr_custom_css .= "
        .footer-v1 .footer-bottom{
            color: {$apr_settings['footer1-copyright-bg']};
        }
    ";
		}
		if ( isset( $apr_settings['footer-copyright-bg'] ) && $apr_settings['footer-copyright-bg'] != '' ) {
			$apr_custom_css .= "
        .footer-v2 .footer-bottom,
        .footer-v3 .footer-bottom{
            color: {$apr_settings['footer-copyright-bg']};
        }
    ";
		}
		if ( isset( $apr_settings['footer1-copyright-color'] ) && $apr_settings['footer1-copyright-color'] != '' ) {
			$apr_custom_css .= "
        .footer-v1 .footer-bottom p{
            color: {$apr_settings['footer1-copyright-color']};
        }
    ";
		}
		if ( isset( $apr_settings['footer-copyright-color'] ) && $apr_settings['footer-copyright-color'] != '' ) {
			$apr_custom_css .= "
        .footer-v2 .footer-bottom p,
        .footer-v3 .footer-bottom p,
        .footer-menu .widget_nav_menu ul li a{
            color: {$apr_settings['footer-copyright-color']};
        }
    ";
		}
		if ( isset( $apr_settings['footer-social-color'] ) && $apr_settings['footer-social-color'] != '' ) {
			$apr_custom_css .= "
        .footer-social li a{
            color: {$apr_settings['footer-social-color']};
        }
    ";
		}
		if ( isset( $apr_settings['footer4-bg-color'] ) && $apr_settings['footer4-bg-color'] != '' ) {
			$apr_custom_css .= "
        .footer-v4 .footer-top{
            background-color: {$apr_settings['footer4-bg-color']};
        }
    ";
		}
		if ( isset( $apr_settings['footer4-copyright-bg'] ) && $apr_settings['footer4-copyright-bg'] != '' ) {
			$apr_custom_css .= "
        .footer-v4 .footer-bottom{
            background-color: {$apr_settings['footer4-copyright-bg']};
        }
    ";
		}
		if ( isset( $apr_settings['footer4-color'] ) && $apr_settings['footer4-color'] != '' ) {
			$apr_custom_css .= "
        .footer-v4 .footer_info,.footer-v4 .footer-top a,
        .footer .footer-v4 .widget-title,
        .footer-v4 .widget_post_blog .blog-post-info .post-name > a,
        .footer-v4 .footer-bottom p{
            color: {$apr_settings['footer4-color']};
        }
    ";
		}
		// Preload Options
		if ( ( isset( $apr_settings['preloader-bg'] ) && $apr_settings['preloader-bg'] != '' ) ) {
			$apr_custom_css .= "
        #loading, #loading-2, #loading-3, 
        .preloader-4, .preloader-5, #loading-6,
        #loading-7, #loading-9, .loader-8{
            background: {$apr_settings['preloader-bg']};
        }
    ";
		}
		if ( isset( $apr_settings['preloader-color'] ) && $apr_settings['preloader-color'] != '' ) {
			$apr_custom_css .= "
        .object, .object-2, .loader:before,
        .busy-loader .w-ball-wrapper .w-ball,
        #object-7,.pacman > div:nth-child(3),
        .pacman > div:nth-child(4),
        .pacman > div:nth-child(5),
        .pacman > div:nth-child(6),
        .object-9, .preloader8 span {
            background-color: {$apr_settings['preloader-color']};
        }
        .object-3{
            border-top-color: {$apr_settings['preloader-color']};
            border-left-color: {$apr_settings['preloader-color']};
        }
        .pacman > div:first-of-type,
        .pacman > div:nth-child(2){
            border-top-color: {$apr_settings['preloader-color']};
            border-left-color: {$apr_settings['preloader-color']};
            border-bottom-color: {$apr_settings['preloader-color']};
        }
        .object-6{
            border-color: {$apr_settings['preloader-color']};
        }
    ";
		}
		//Metabox options
		$apr_body_bg           = ( apr_get_meta_value( 'body_bg' ) != '' ) ? apr_get_meta_value( 'body_bg' ) : '';
		$apr_footer_bg         = ( apr_get_meta_value( 'footer_bg' ) != '' ) ? apr_get_meta_value( 'footer_bg' ) : '';
		$apr_f_text_color      = ( apr_get_meta_value( 'footer_text_color' ) != '' ) ? apr_get_meta_value( 'footer_text_color' ) : '';
		$apr_f_link_color      = ( apr_get_meta_value( 'footer_link_color' ) != '' ) ? apr_get_meta_value( 'footer_link_color' ) : '';
		$apr_footer_bg         = ( apr_get_meta_value( 'footer_bg' ) != '' ) ? apr_get_meta_value( 'footer_bg' ) : '';
		$apr_newsletter_bg     = ( apr_get_meta_value( 'newletter_bg' ) != '' ) ? apr_get_meta_value( 'newletter_bg' ) : '';
		$apr_newsletter_bg_img = ( apr_get_meta_value( 'newletter_bg_img' ) != '' ) ? apr_get_meta_value( 'newletter_bg_img' ) : '';
		$apr_newsletter_color  = ( apr_get_meta_value( 'newletter_color' ) != '' ) ? apr_get_meta_value( 'newletter_color' ) : '';
		$apr_copyright_bg      = ( apr_get_meta_value( 'copyright_bg' ) != '' ) ? apr_get_meta_value( 'copyright_bg' ) : '';
		$apr_copyright_color   = ( apr_get_meta_value( 'copyright_color' ) != '' ) ? apr_get_meta_value( 'copyright_color' ) : '';

		//$apr_header_menu_hcolor =    (apr_get_meta_value('header_menu_hcolor') != '') ? apr_get_meta_value('header_menu_hcolor') : '';
		if ( isset( $apr_f_text_color ) ) {
			$apr_custom_css .= "
        .footer{
            color: {$apr_f_text_color} !important;
        }
    ";
		}
		if ( isset( $apr_f_link_color ) ) {
			$apr_custom_css .= "
        footer a{
            color: {$apr_f_link_color} !important;
        }
    ";
		}
		if ( isset( $apr_body_bg ) ) {
			$apr_custom_css .= "
        body{
            background: {$apr_body_bg} !important;
        }
    ";
		}
		if ( isset( $apr_footer_bg ) && $apr_footer_bg != '' ) {
			$apr_custom_css .= "
        footer .footer-v2 .footer-top{
            background: {$apr_footer_bg};
        }
    ";
		}
		if ( isset( $apr_f_text_color ) && $apr_f_text_color != '' ) {
			$apr_custom_css .= "
        footer .footer-top a,
        footer .footer-top p,.footer-top{
            color: {$apr_f_text_color};
        }
    ";
		}
		if ( isset( $apr_newsletter_bg ) && $apr_newsletter_bg != '' ) {
			$apr_custom_css .= "
        footer  .footer-v4 .footer-newsletter,
        footer  .footer-v1 .footer-newsletter{
            background: {$apr_newsletter_bg};
        }
        footer .footer-v4 .footer-newsletter .mc4wp-form .submit input,
        footer .footer-v1 .footer-newsletter .mc4wp-form .submit input{
            color: {$apr_newsletter_bg};
        }
    ";
		}
		if ( isset( $apr_newsletter_color ) && $apr_newsletter_color != '' ) {
			$apr_custom_css .= "
        footer .footer-v1 .footer-newsletter .mc4wp-form label,
        footer .footer-v1 .footer-newsletter .mc4wp-form label span,
        footer .footer-v1 .footer-newsletter .mc4wp-form .input input.placeholder, 
        footer .footer-v1 .footer-newsletter .mc4wp-form .input  input:focus, 
        footer .footer-v1 .footer-newsletter .mc4wp-form .input input:active,
        footer .footer-v1 .footer-newsletter .mc4wp-form label::before,
        footer .footer-v2 .footer-newsletter .mc4wp-form .input input.placeholder, 
        footer .footer-v2 .footer-newsletter .mc4wp-form .input  input:focus, 
        footer .footer-v2 .footer-newsletter .mc4wp-form .input input:active,
        footer .footer-v2 .widget-title,
        footer .footer-v2 .center_footer .footer_info > p,
        .footer-v2 .footer-newsletter .submit:hover::before{
            color: {$apr_newsletter_color};
        }
        footer .footer-v1 .footer-newsletter .mc4wp-form .input input,
        footer .footer-v2 .footer-newsletter .mc4wp-form .input input{
            border-color: {$apr_newsletter_color};
        }
        footer .footer-v1 .footer-newsletter .mc4wp-form .submit input{
            background-color: {$apr_newsletter_color};
        }
    ";
		}
		if ( isset( $apr_newsletter_bg_img ) && $apr_newsletter_bg_img != '' ) {
			$apr_custom_css .= "
        footer .footer-v1 .footer-newsletter,
        footer .footer-v2 .footer-section{
            background-image: url({$apr_newsletter_bg_img});
        }
    ";
		}
		if ( isset( $apr_copyright_bg ) && $apr_copyright_bg != '' ) {
			$apr_custom_css .= "
        footer .footer-v1 .footer-bottom,
        footer .footer-v2 .footer-bottom{
            background: {$apr_copyright_bg};
        }
    ";
		}
		if ( isset( $apr_copyright_color ) ) {
			$apr_custom_css .= "
        footer .footer-v1 .footer-bottom p, 
        footer .footer-v1 .footer-bottom p a,
        footer .footer-v1 .payment li a,
        footer .footer-v2 .footer-bottom p,
        footer .footer-v2 .payment li a{
            color: {$apr_copyright_color};
        }
    ";
		}
		if ( isset( $apr_settings['menu_spacing'] ) && $apr_settings['menu_spacing'] != '' ) {
			if ( isset( $apr_settings['menu_spacing']['margin-left'] ) && $apr_settings['menu_spacing']['margin-left'] != '' ) {
				$apr_custom_css .= "
            @media (min-width: 991px){
                .mega-menu > li > a{
                    padding-left: {$apr_settings['menu_spacing']['margin-left']} !important;
                }
            }
        ";
			}
			if ( isset( $apr_settings['menu_spacing']['margin-top'] ) && $apr_settings['menu_spacing']['margin-top'] != '' ) {
				$apr_custom_css .= "
            @media (min-width: 991px){
                .mega-menu > li > a{
                    padding-top: {$apr_settings['menu_spacing']['margin-top']} !important;
                }
            }
        ";
			}
			if ( isset( $apr_settings['menu_spacing']['margin-right'] ) && $apr_settings['menu_spacing']['margin-right'] != '' ) {
				$apr_custom_css .= "
            @media (min-width: 991px){
                .mega-menu > li > a{
                    padding-right: {$apr_settings['menu_spacing']['margin-right']} !important;
                }
            }
        ";
			}
			if ( isset( $apr_settings['menu_spacing']['margin-bottom'] ) && $apr_settings['menu_spacing']['margin-bottom'] != '' ) {
				$apr_custom_css .= "
            @media (min-width: 991px){
                .mega-menu > li > a{
                    padding-bottom: {$apr_settings['menu_spacing']['margin-bottom']} !important;
                }
            }
        ";
			}
		}
		if ( isset( $apr_settings['logo_padding'] ) && $apr_settings['logo_padding'] != '' ) {
			$apr_custom_css .= "
        @media (min-width: 992px){
            .header-logo{
                padding-left: {$apr_settings['logo_padding']['margin-left']} !important;
                padding-top: {$apr_settings['logo_padding']['margin-top']} !important;
                padding-right: {$apr_settings['logo_padding']['margin-right']} !important;
                padding-bottom: {$apr_settings['logo_padding']['margin-bottom']} !important;
            }
        }
    ";
		}
		if ( isset( $apr_settings['height_header'] ) && $apr_settings['height_header'] != '' ) {
			if ( isset( $apr_settings['height_header']['height'] ) && $apr_settings['height_header']['height'] != '' ) {
				$apr_custom_css .= "
            .header-v7 .cate-menu .title-cate,
            .header-v7 .search-block-top > .btn-search, 
            .header-v7 .header-info .open-menu{
                height: {$apr_settings['height_header']['height']} !important;
            }
            @media (min-width: 992px){
                .flex-row,
                .mega-menu > li.menu-item > a{
                    height: {$apr_settings['height_header']['height']} !important;
                }
            }
        ";
			}
		}
		if ( isset( $apr_settings['height_header_sticky'] ) && $apr_settings['height_header_sticky'] != '' ) {
			if ( isset( $apr_settings['height_header_sticky']['height'] ) && $apr_settings['height_header_sticky']['height'] != '' ) {
				$apr_custom_css .= "
            @media (min-width: 992px){
                .is-sticky .flex-row,
                .is-sticky .mega-menu > li.menu-item > a{
                    height: {$apr_settings['height_header_sticky']['height']} !important;
                }
            }
            .header-v7.is-sticky.site-header .mini-cart .cart_label, 
            .header-v7.is-sticky.site-header .cate-menu .title-cate, 
            .header-v7.is-sticky.site-header .search-block-top > .btn-search, 
            .header-v7.is-sticky.site-header .header-info .open-menu {
                height: {$apr_settings['height_header_sticky']['height']} !important;
            }
        ";
			}
		}
		if ( isset( $apr_settings['logo_width'] ) && $apr_settings['logo_width'] != '' ) {
			if ( isset( $apr_settings['logo_width']['height'] ) && $apr_settings['logo_width']['height'] != '' ) {
				$apr_custom_css .= "
            .header-logo img{
                height: {$apr_settings['logo_width']['height']} !important;
            }
        ";
			}
			if ( isset( $apr_settings['logo_width']['width'] ) && $apr_settings['logo_width']['width'] != '' ) {
				$apr_custom_css .= "
            .header-logo img{
                width: {$apr_settings['logo_width']['width']} !important;
            }
        ";
			}
		}
		if ( isset( $apr_settings['logo_mobile'] ) && $apr_settings['logo_mobile'] != '' ) {
			if ( isset( $apr_settings['logo_mobile']['height'] ) && $apr_settings['logo_mobile']['height'] != '' ) {
				$apr_custom_css .= "
        @media (max-width: 991px){
            .logo-mobile img,.header-logo img{
                height: {$apr_settings['logo_mobile']['height']} !important;
            }
        }
        ";
			}
			if ( isset( $apr_settings['logo_mobile']['width'] ) && $apr_settings['logo_mobile']['width'] != '' ) {
				$apr_custom_css .= "
        @media (max-width: 991px){
            .logo-mobile img,.header-logo img{
                width: {$apr_settings['logo_mobile']['width']} !important;
            }
        }
        ";
			}
		}
		if ( isset( $apr_settings['404-bg-image'] ) && $apr_settings['404-bg-image'] != '' && $apr_settings['404-bg-image']['url'] ) {
			$apr_custom_css .= "
        .page-404{
            background: url({$apr_settings['404-bg-image']['url']});   
            background-size: cover;
            background-position: center center;
        }
        #bkDiv{
            background-image:url({$apr_settings['404-bg-image']['url']});   
        }
        .title404{
            background: url({$apr_settings['404-bg-image']['url']});  
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text; 
            background-size: contain;
            line-height: 100%;              
        }
    ";
		}
		if ( isset( $apr_settings['under-bg-image'] ) && $apr_settings['under-bg-image'] != '' && $apr_settings['under-bg-image']['url'] ) {
			$apr_custom_css .= "
        .page-coming-soon{
            background: url({$apr_settings['under-bg-image']['url']});   
            background-size: cover;
            background-position: center center;
        }
    ";
		}
		if ( isset( $apr_settings['coming-overlay-color'] ) && $apr_settings['coming-overlay-color'] != '' ) {
			$apr_custom_css .= "
        .page-coming-soon.has-overlay:before{
            background: {$apr_settings['coming-overlay-color']} !important;
            opacity: 0.3;
        }
    ";
		}
		if ( isset( $apr_settings['404-color'] ) && $apr_settings['404-color'] != '' ) {
			$apr_custom_css .= "
        .page-404-container{
            color: {$apr_settings['404-color']} !important;
        }
    ";
		}
		if ( isset( $apr_settings['header6-bg'] ) && $apr_settings['header6-bg'] != '' ) {
			$apr_custom_css .= "
        .header-v6.site-header{
            background: {$apr_settings['header6-bg']} !important;
        }
    ";
		}
		if ( isset( $apr_settings['header6-stickybg'] ) && $apr_settings['header6-stickybg'] != '' ) {
			$apr_custom_css .= "
        .header-v6.site-header.is-sticky{
            background: {$apr_settings['header6-stickybg']} !important;
        }
    ";
		}
		if ( isset( $apr_settings['header6-menu-color'] ) && $apr_settings['header6-menu-color'] != '' ) {
			$apr_custom_css .= "
        .header-v6 .header-right,.header-v6 .mega-menu > li > a,.header-v6 .social_icon li a,
        .header-v6 .mini-cart .cart_label{
            color: {$apr_settings['header6-menu-color']} !important;
        }
    ";
		}
		if ( isset( $apr_newletter_bg ) ) {
			$apr_custom_css .= "
        .footer .footer-top{
            background-color: {$apr_newletter_bg} !important;
        }
        .footer-newsletter.type1 .mc4wp-form .submit input:hover,
        .footer-newsletter.type1 .mc4wp-form .submit:hover input,
        .footer-newsletter.type1 .mc4wp-form .submit:hover::before{
            color: {$apr_newletter_bg} !important;
        }
    ";
		}
		if ( isset( $apr_newletter_title_bg ) ) {
			$apr_custom_css .= "
        .footer-newsletter.type1 .mc4wp-form .submit input{
            background-color: {$apr_newletter_title_bg} !important;
        }
        .footer-newsletter.type1 .mc4wp-form label span{
            color: {$apr_newletter_title_bg} !important;
        }
    ";
		}
		$apr_breadcrumbs_bg = apr_get_meta_value( 'breadcrumbs_bg' );
		if ( $apr_breadcrumbs_bg != '' ) {
			$apr_custom_css .= "
    .side-breadcrumb.use_bg_image{
        background-image: url({$apr_breadcrumbs_bg}) !important;
    }
    ";
		}
		if ( isset( $apr_settings['breadcrumbs-overlay-color'] ) && $apr_settings['breadcrumbs-overlay-color'] != '' ) {
			$apr_custom_css .= "
        .side-breadcrumb.has-overlay::before{
            background-color: {$apr_settings['breadcrumbs-overlay-color']};
        }
    ";
		}
		if ( isset( $apr_settings['breadcrumbs_align'] ) && $apr_settings['breadcrumbs_align'] != '' ) {
			$apr_custom_css .= "
        .side-breadcrumb{
            text-align: {$apr_settings['breadcrumbs_align']};
        }
    ";
		}
		if ( isset( $apr_settings['title-breadcrumbs-font'] ) && $apr_settings['title-breadcrumbs-font'] != '' ) {
			if ( isset( $apr_settings['title-breadcrumbs-font']['font-weight'] ) && $apr_settings['title-breadcrumbs-font']['font-weight'] != '' ) {
				$apr_custom_css .= "
            .side-breadcrumb .page-title h1{
                font-weight: {$apr_settings['title-breadcrumbs-font']['font-weight']};
            }
        ";
			}
			if ( isset( $apr_settings['title-breadcrumbs-font']['font-size'] ) && $apr_settings['title-breadcrumbs-font']['font-size'] != '' ) {
				$apr_custom_css .= "
            .side-breadcrumb .page-title h1{
                font-size: {$apr_settings['title-breadcrumbs-font']['font-size']};
            }
        ";
			}
			if ( isset( $apr_settings['title-breadcrumbs-font']['font-family'] ) && $apr_settings['title-breadcrumbs-font']['font-family'] != '' ) {
				$apr_custom_css .= "
            .side-breadcrumb .page-title h1{
                font-family: {$apr_settings['title-breadcrumbs-font']['font-family']};
            }
        ";
			}
			if ( isset( $apr_settings['title-breadcrumbs-font']['color'] ) && $apr_settings['title-breadcrumbs-font']['color'] != '' ) {
				$apr_custom_css .= "
            .side-breadcrumb .page-title h1{
                color: {$apr_settings['title-breadcrumbs-font']['color']};
            }
        ";
			}
		}
		if ( isset( $apr_settings['link-breadcrumbs-font'] ) && $apr_settings['link-breadcrumbs-font'] != '' ) {
			if ( isset( $apr_settings['link-breadcrumbs-font']['font-weight'] ) && $apr_settings['link-breadcrumbs-font']['font-weight'] != '' ) {
				$apr_custom_css .= "
            .breadcrumb,
            .breadcrumb li a,
            .breadcrumb > li + li::before{
                font-weight: {$apr_settings['link-breadcrumbs-font']['font-weight']};
            }
        ";
			}
			if ( isset( $apr_settings['link-breadcrumbs-font']['font-size'] ) && $apr_settings['link-breadcrumbs-font']['font-size'] != '' ) {
				$apr_custom_css .= "
            .breadcrumb,
            .breadcrumb li a,
            .breadcrumb > li + li::before{
                font-size: {$apr_settings['link-breadcrumbs-font']['font-size']};
            }
        ";
			}
			if ( isset( $apr_settings['link-breadcrumbs-font']['font-family'] ) && $apr_settings['link-breadcrumbs-font']['font-family'] != '' ) {
				$apr_custom_css .= "
            .breadcrumb,
            .breadcrumb li a,
            .breadcrumb > li + li::before{
                font-family: {$apr_settings['link-breadcrumbs-font']['font-family']};
            }
        ";
			}
			if ( isset( $apr_settings['link-breadcrumbs-font']['color'] ) && $apr_settings['link-breadcrumbs-font']['color'] != '' ) {
				$apr_custom_css .= "
            .breadcrumb,
            .breadcrumb li a,
            .breadcrumb > li + li::before{
                color: {$apr_settings['link-breadcrumbs-font']['color']};
            }
        ";
			}
		}
		if ( isset( $apr_settings['blog_date_size'] ) && $apr_settings['blog_date_size'] != '' ) {
			if ( isset( $apr_settings['blog_date_size']['height'] ) && $apr_settings['blog_date_size']['height'] != '' ) {
				$apr_custom_css .= "
            .blog-info .blog-date{
                height: {$apr_settings['blog_date_size']['height']} !important;
            }
        ";
			}
			if ( isset( $apr_settings['blog_date_size']['width'] ) && $apr_settings['blog_date_size']['width'] != '' ) {
				$apr_custom_css .= "
            .blog-info .blog-date{
                width: {$apr_settings['blog_date_size']['width']} !important;
            }
        ";
			}
		}
		if ( isset( $apr_settings['product-breadcrumb'] ) && $apr_settings['product-breadcrumb'] ) {
			if ( function_exists( 'is_product_category' ) && is_product_category() ) {
				global $wp_query;
				$cat   = $wp_query->get_queried_object();
				$image = '';
				if ( isset( $cat ) && ! empty( $cat ) ) {
					$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
				}
				if ( isset( $thumbnail_id ) && $thumbnail_id != '' ) {
					$image = wp_get_attachment_url( $thumbnail_id );
				}
				if ( $image != '' ) {
					$apr_custom_css .= "
                .side-breadcrumb{
                    background-image: url({$image}) !important;
                }
            ";
				}
			}
		}
		if ( isset( $apr_settings['custom-css-code'] ) && $apr_settings['custom-css-code'] != '' ) {
			$apr_custom_css .= $apr_settings['custom-css-code'];
		}

		return apply_filters( 'arrowcore_get_custom_style_css', $apr_custom_css );
	}
endif;
