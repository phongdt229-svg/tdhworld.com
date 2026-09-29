<?php
//remove action
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20); 
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5); 
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20); 
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail',10 ); 
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display',10, 1 ); 
//remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_add_to_cart', 25 );

//add action
add_action( 'woocommerce_before_shop_loop_item_title_packery', 'woocommerce_show_product_loop_sale_flash',10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'apr_template_loop_product_thumbnail',10 );
add_action('woocommerce_related_after', 'woocommerce_output_related_products', 10);
add_action('woocommerce_shop_loop_item_title', 'apr_wishlist_custom', 10);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20);
add_action('woocommerce_shop_loop_item_title', 'apr_quickview', 30);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 12);
add_action('init', 'apr_woocommerce_clear_cart_url');
 
add_action('woocommerce_after_shop_loop_item_title', 'apr_woocommerce_single_excerpt', 40);


//product action
add_action('woocommerce_product_action', 'apr_wishlist_custom', 10);
add_action('woocommerce_product_action', 'woocommerce_template_loop_add_to_cart', 20);
add_action('woocommerce_product_action', 'apr_quickview', 30);
//product action list
add_action('woocommerce_product_action_list', 'apr_wishlist_custom', 20);
add_action('woocommerce_product_action_list', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_product_action_list', 'apr_quickview', 30);
//end product action

add_action('woocommerce_template_single_add_to_cart','apr_wishlist_custom', 30);
add_action( 'woocommerce_single_product_summary', 'apr_sharing', 52 );
add_action('woocommerce_before_shop_loop', 'apr_product_loop_view_mode', 10);
add_action('filter_count_view', 'apr_view_count', 20);
add_action( 'woocommerce_single_product_summary', 'apr_stock_text_shop_page', 15 );
add_action('woocommerce_single_product_summary','apr_single_info', 40);
//remove filter
remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );
//add filter
add_filter( 'wp_calculate_image_srcset', 'apr_disable_srcset' );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 30 );
add_filter('loop_shop_per_page', 'apr_product_shop_per_page', 20);
add_filter( 'gettext', 'apr_sort_change', 20, 3 );
add_filter('woocommerce_add_to_cart_fragments', 'apr_woocommerce_header_add_to_cart_fragment');
/*add_filter('woocommerce_checkout_fields', 'apr_custom_override_checkout_fields');
add_filter("woocommerce_checkout_fields", "apr_order_fields");
add_filter("woocommerce_checkout_fields", "apr_order_shipping_fields");*/
//add_filter('woocommerce_product_get_rating_html', 'apr_get_rating_html', 10, 2);
add_filter( 'woocommerce_product_tabs', 'apr_overide_product_tabs', 98 );

add_filter( 'woocommerce_subcategories', 'woocommerce_maybe_show_product_subcategories' );
//add placeholder for checkout postcode field
add_filter( 'woocommerce_default_address_fields' , 'apr_override_default_address_fields' );
add_filter( 'apr_get_woocommerce_template_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart');
//Define woocommerce support
add_action( 'after_setup_theme', 'apr_woocommerce_support' );

add_filter('woocommerce_save_account_details_required_fields', 'wc_save_account_details_required_fields' );
function wc_save_account_details_required_fields( $required_fields ){
    unset( $required_fields['account_display_name'] );
    return $required_fields;
}

//Functions
if ( ! function_exists( 'woocommerce_subcategories' ) ) {

	/**
	 * Output the start of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function woocommerce_subcategories( $echo = true ) {
		ob_start();

		$loop_start = apply_filters( 'woocommerce_subcategories', ob_get_clean() );

		if ( $echo ) {
			echo $loop_start; // WPCS: XSS ok.
		} else {
			return $loop_start;
		}
	}
}
function apr_disable_srcset( $sources ) {
return false;
}
function apr_single_info(){
    global $product, $apr_settings;
    $compare = (get_option('yith_woocompare_compare_button_in_products_list') == 'yes');
    ?>
    <div class="add-to">
            <?php    
            if (class_exists('YITH_WCWL') && $apr_settings['product-wishlist']) {
                echo do_shortcode('[yith_wcwl_add_to_wishlist]');
            }
            ?>
        <?php
        if ($compare && $apr_settings['product-compare']){
                printf('<div class="add-to-compare"><a title="'.esc_html__("compare","efarm").'" data-toggle="tooltip" href="%s" class="%s" data-product_id="%d"><i class="fa fa-retweet"></i></a></div>', apr_add_compare_action($product->get_id()), 'add_to_compare compare button', $product->get_id(), esc_html__('Compare', 'efarm'));
            }
        ?>
    </div>
    <?php
}
function apr_stock_text_shop_page() {
    global $product;
     $availability = $product->get_availability();
    if ( $product->is_in_stock() ) {
        echo '<div class="availability"><p>'.esc_html__('Availability:', 'efarm').'</p><p class="stock">' .$product->get_stock_quantity(). esc_html__( 'In Stock & Ready to Ship', 'efarm') . '</p></div>';
    }
    else{
         echo '<div class="availability"><p>'.esc_html__('Availability:', 'efarm').'</p><p class="stock">' . esc_html__( 'Out Stock', 'efarm') . '</p></div>';
    }
}
function apr_compare_product(){
    global $product, $apr_settings;
    $compare = (get_option('yith_woocompare_compare_button_in_products_list') == 'yes');
    ?>
    <?php
    if ($compare && $apr_settings['product-compare'] && class_exists('YITH_WOOCOMPARE')){
            printf('<div class="action_item compare_product"><a title="'.esc_html__("compare","efarm").'" data-toggle="tooltip" href="%s" class="%s" data-product_id="%d"><i class="fa fa-retweet"></i></a></div>', apr_add_compare_action($product->get_id()), 'add_to_compare compare button', $product->get_id(), esc_html__('Compare', 'efarm'));
        }
    ?>
    <?php
}   
function apr_add_compare_action($product_id) {
    $action = 'yith-woocompare-add-product';
    $url_args = array('action' => $action, 'id' => $product_id);
    return wp_nonce_url(add_query_arg($url_args), $action);
}
function apr_quickview(){
    global $product, $apr_settings;
    ?>
    <?php 
        if($apr_settings['product-quickview'] && class_exists('YITH_WCQV')){
            printf('<div class="quick-view action_item" data-toggle="tooltip" title="'.esc_html__("Quick view","efarm").'"><a href="#" class="yith-wcqv-button" data-product_id="%d" title="%s"><span class="pe-7s-look"></span></a></div>', $product->get_id(), esc_html__('Quick View', 'efarm'), esc_html__('Quick View', 'efarm'));
        }
    ?>
    <?php
}
function apr_wishlist_custom(){
    global $apr_settings;
    ?>
    <?php if (class_exists('YITH_WCWL') && isset($apr_settings['product-wishlist']) && $apr_settings['product-wishlist']) :?>
    <div class="action_item wishlist-btn">
            <?php    
                echo do_shortcode('[yith_wcwl_add_to_wishlist]');
            ?>
    </div>
    <?php endif;?>
    <?php
}
//count view
function apr_view_count(){
    global $wp_query, $apr_settings;

    if ($apr_settings['category-item']) {
        $per_page = explode(',', $apr_settings['category-item']);
    } else {
        $per_page = explode(',', '12,24,36');
    }
    $page_count = apr_product_shop_per_page();
    ?>
    <form class="woocommerce-viewing result-count" method="get">
        <label><?php echo esc_html__('Show ', 'efarm') ?> </label>
        <select name="count" class="count">
            <?php foreach ( $per_page as $count ) : ?>
                <option value="<?php echo esc_attr( $count ); ?>" <?php selected( $page_count, $count ); ?>><?php echo esc_html( $count ); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="paged" value=""/>
        <?php
        // Keep query string vars intact
        foreach ( $_GET as $key => $val ) {
            if ( 'count' === $key || 'submit' === $key || 'paged' === $key ) {
                continue;
            }
            if ( is_array( $val ) ) {
                foreach( $val as $innerVal ) {
                    echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
                }
            } else {
                echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
            }
        }
        ?>
    </form>
    <?php
}
//grid and list cart
function apr_product_loop_view_mode() {
    global $apr_settings, $wp_query;
    $cat = $wp_query->get_queried_object();
    if(isset($cat->term_id)){
    $woo_cat = $cat->term_id;
    }else{
        $woo_cat = '';
    }
    $product_list_setting = $apr_settings['product-layouts'];
    $product_list_mode = get_metadata('product_cat', $woo_cat, 'list_mode_product', true);
    ?>
        <div class="viewmode-toggle">
            <?php if($product_list_mode == 'only-list' || $product_list_mode == 'only-grid') : ?>
                <?php if($product_list_mode == 'only-list') : ?>
                <a href="#" id="list_mode" class="active" data-isotope-layout="list" data-isotope-container=".product-isotope" title="<?php echo esc_html__('List View', 'efarm') ?>"><i class="fa fa-list"></i></a>
                <?php endif;?>
                <?php if($product_list_mode == 'only-grid') : ?>
                <a href="#" id="grid_mode" class="active" data-isotope-layout="grid" data-isotope-container=".product-isotope" title="<?php echo esc_html__('Grid View', 'efarm') ?>"><i class="fa fa-th-large"></i></a>
                <?php endif;?>              
            <?php else:?>
                <?php if($product_list_mode != 'only-list') : ?>
                <a href="#" id="grid_mode" class="<?php if($product_list_setting == 'only-grid'){echo 'active';}?>" data-isotope-layout="grid" data-isotope-container=".product-isotope" title="<?php echo esc_html__('Grid View', 'efarm') ?>"><i class="fa fa-th-large"></i></a>
                <?php endif;?>
                <?php if($product_list_mode != 'only-grid') : ?>
                <a href="#" id="list_mode" class="<?php if($product_list_setting == 'only-list'){echo 'active';}?>" data-isotope-layout="list" data-isotope-container=".product-isotope" title="<?php echo esc_html__('List View', 'efarm') ?>"><i class="fa fa-list"></i></a>
                <?php endif;?>
            <?php endif;?>
        </div> 

    <?php
}
// Redirect users after add to cart.
function apr_add_to_cart_redirect( $url ) {
    $url = wc_get_cart_url();
    return $url;
}
add_filter( 'woocommerce_add_to_cart_redirect', 'apr_add_to_cart_redirect' );
function apr_override_default_address_fields( $address_fields ) {
     $address_fields['postcode']['placeholder'] = esc_html__('Postcode / Zip *','efarm');

     return $address_fields;
}
function apr_get_rating_html($rating_html, $rating) {
  if ( $rating > 0 ) {
    $title = sprintf( esc_html__( 'Rated %s out of 5', 'efarm' ), $rating );
  } else {
    $title = 'Not yet rated';
    $rating = 0;
  }

  $rating_html  = '<div class="star-rating" title="' . $title . '">';
  $rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . esc_html__( 'out of 5', 'efarm' ) . '</span>';
  $rating_html .= '</div>';

  return $rating_html;
}
//add theme support woocommerce
function apr_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

function apr_overide_product_tabs( $tabs ) {
    global $apr_settings, $product,$post;
    if(isset($apr_settings['product-destab']) && $apr_settings['product-destab']){
        unset( $tabs['description'] );   
    }else{
        if ( $post->post_content ) {
            if(isset($apr_settings['product-destab-name']) && $apr_settings['product-destab-name'] !=''){
                $tabs['description']['title'] = $apr_settings['product-destab-name'];  
            }     
        }   
    }
    
    if(isset($apr_settings['product-reviewtab']) && $apr_settings['product-reviewtab']){
        unset( $tabs['reviews'] );
    }else{
        if ( comments_open() ) {
            if(isset($apr_settings['product-reviewtab-name']) && $apr_settings['product-reviewtab-name'] !=''){
                $tabs['reviews']['title'] = $apr_settings['product-reviewtab-name'];      
            }     
        }   
    }   
    
    if(isset($apr_settings['product-infotab']) && $apr_settings['product-infotab']) {
        unset( $tabs['additional_information'] );  
    }else{
        if ( $product && ( $product->has_attributes() || apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) {            
            if(isset($apr_settings['product-infotab-name']) && $apr_settings['product-infotab-name'] !=''){
                $tabs['additional_information']['title'] = $apr_settings['product-infotab-name']; 
            }        
        } 
    }

    return $tabs;
}
function apr_template_loop_product_thumbnail() {
    global $product;
    $second_image = '';
    $attachment_ids = $product->get_gallery_image_ids();
    if (count($attachment_ids) && isset($attachment_ids[0])) {
            $second_image = wp_get_attachment_image($attachment_ids[0], 'shop_catalog');
    }
    ?>
    <?php if ($second_image != ''): ?>
    <a class="product-image-hover" href="<?php the_permalink(); ?>">
        <?php echo  woocommerce_get_product_thumbnail(); ?>   
        <div class="img-base">  
            <?php echo wp_kses($second_image ,array(
                              'img' =>  array(
                                'width' => array(),
                                'height'  => array(),
                                'src' => array(),
                                'class' => array(),
                                'alt' => array(),
                                'id' => array(),
                                )
                            ));?>    
        </div>   
    </a>
    <?php else:?>
        <a href="<?php the_permalink(); ?>">
            <?php echo  woocommerce_get_product_thumbnail(); ?>
        </a>
    <?php endif; ?>
    <?php
}
function apr_product_image(){
    global $post, $product, $woocommerce;
?>
    <div class="images">
        <?php
            if ( has_post_thumbnail() ) {
                $attachment_count = count( $product->get_gallery_image_ids() );
                $gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
                $props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
                $image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                    'title'  => $props['title'],
                    'alt'    => $props['alt'],
                    'data-zoom-image' => $image_link,
                    'class' => 'gallery-img zoom',    
                ) );
                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $props['url'], $props['caption'], $image ), $post->ID );
            } else {
                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'efarm' ) ), $post->ID );
            }

        ?>
    </div>
    <?php 
        $attachment_ids = $product->get_gallery_image_ids();

        if ( $attachment_ids ) {
            $loop       = 0;
            $columns    = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
            ?>
            <div data-max-items="4" class="owl-prd-thumbnail thumbnails <?php echo 'columns-' . $columns; ?>"><?php

                foreach ( $attachment_ids as $attachment_id ) {

                    $classes = array( 'zoom' );

                    if ( $loop === 0 || $loop % $columns === 0 )
                        $classes[] = 'first';

                    if ( ( $loop + 1 ) % $columns === 0 )
                        $classes[] = 'last';

                    $image_link = wp_get_attachment_url( $attachment_id );

                    if ( ! $image_link )
                        continue;

                    $image_title    = esc_attr( get_the_title( $attachment_id ) );
                    $image_caption  = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

                    $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
                        'title' => $image_title,
                        'alt'   => $image_title
                        ) );

                    $image_class = esc_attr( implode( ' ', $classes ) );

                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-image="'.$image_link.'" data-image-zoom="'.$image_link.'">%s</a>', $image_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );

                    $loop++;
                }

            ?></div>
            <?php
        }
    ?>
    <?php
}

function apr_sharing(){
    global $apr_settings;
    if(isset($apr_settings['product-share']) && $apr_settings['product-share']):?>
        <div class="product-share">
        <?php echo '<h5>'.esc_html__('Share this:','efarm').'</h5>'; ?>  
        <a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
        <a href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-x-twitter"></i></a>
        <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_the_permalink()); ?>&media=<?php echo urlencode(wp_get_attachment_url( get_post_thumbnail_id() )); ?>&description=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>  
        <a href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>" target="_blank">
            <i class="fa fa-google-plus"></i>
        </a>
        </div>
    <?php endif;
}
function apr_template_title_custom() {
    ?>
    <h3><a href="<?php the_permalink(); ?>" class="product-name"><?php the_title(); ?></a></h3
    <?php
}
function apr_woocommerce_single_excerpt() {
    global $post;

    if ( ! $post->post_excerpt ) {
        return;
    }
    ?>
    <div class="desc">
        <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?> 
    </div>
    <?php
}
function apr_product_shop_per_page() {
    global $apr_settings;
    global $wp_query, $woocommerce_loop;
    $cat = $wp_query->get_queried_object();
    if(isset($cat->term_id)){
        $woo_cat = $cat->term_id;
    }else{
        $woo_cat = '';
    }
    $category_per_page = get_metadata('product_cat', $woo_cat, 'category-item-count', true);
    parse_str($_SERVER['QUERY_STRING'], $params);
    // replace it with theme option
    if(isset($category_per_page) ? $category_per_page :'') {
        $per_page = explode(',', $category_per_page);
    }elseif ($apr_settings['category-item']) {
        $per_page = explode(',', $apr_settings['category-item']);
    }else {
        $per_page = explode(',', '8,16,24');
    }

    $item_count = !empty($params['count']) ? $params['count'] : $per_page[0];

    return $item_count;
}
function apr_order_fields($fields) {
    $order = array(
        "billing_country",
        "billing_state",
        "billing_first_name", 
        "billing_last_name", 
        "billing_company", 
        "billing_address_1", 
        "billing_address_2",
        "billing_city",   
        "billing_postcode",       
        "billing_email", 
        "billing_phone",
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }

    $fields["billing"] = $ordered_fields;
    return $fields;

}
function apr_order_shipping_fields($fields) {
    $order = array(
        "shipping_country",
        "shipping_state",
        "shipping_first_name", 
        "shipping_last_name", 
        "shipping_company", 
        "shipping_address_1",
        "shipping_address_2",
        "shipping_city",        
        "shipping_postcode",
        "shipping_phone",       
        "shipping_email",        
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["shipping"][$field];
    }

    $fields["shipping"] = $ordered_fields;
    return $fields;

}
function apr_woocommerce_product_add_to_cart_text() {
    global $product;
    
    $product_type = $product->product_type;
    
    switch ( $product_type ) {
        case 'external':
            return esc_html__( 'Buy product', 'efarm' );
        break;
        case 'grouped':
            return esc_html__( 'View products', 'efarm' );
        break;
        case 'simple':
            return esc_html__( 'Add to cart', 'efarm' );
        break;
        case 'variable':
            return esc_html__( 'Select options', 'efarm' );
        break;
        default:
            return esc_html__( 'Read more', 'efarm' );
    }
    
}
//update cart items on minicart
function apr_woocommerce_header_add_to_cart_fragment($fragments) {
    $_cartQty = WC()->cart->cart_contents_count;
    $_cartTotal = WC()->cart->get_cart_total();
    $fragments['#mini-scart .cart_count'] = '<p class="cart_count">' . $_cartQty . '</p>';
    $fragments['#mini-scart .cart_nu_count'] = '<p class="cart_nu_count">' . $_cartQty . '</p>';
    $fragments['#mini-scart-2 .cart_nu_count'] = '<p class="cart_nu_count">' . $_cartQty . '</p>';
    $fragments['.count-item p .cart_nu_count2'] = '<span class="cart_nu_count2">' . $_cartQty . '</span>';
    $fragments['header .mini-cart .cart_qty .woocommerce-Price-amount'] = '' . $_cartTotal . '';
    ?>
    <div class="widget_shopping_cart_content">
        <?php woocommerce_mini_cart(); ?>
    </div>

    <?php $fragments['.widget_shopping_cart_content'] = ob_get_clean();
    return $fragments;
}

//update wishlist items on header
if( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ){
  function yith_wcwl_ajax_update_count(){
    wp_send_json( array(
      'count' => yith_wcwl_count_all_products()
    ) );
  }
  add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
  add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}

// check for empty-cart get param to clear the cart
function apr_woocommerce_clear_cart_url() {
    global $woocommerce;
    if (isset($_GET['empty-cart'])) {
        $woocommerce->cart->empty_cart();
    }
}
function apr_custom_override_checkout_fields($fields) {

    $fields['billing']['billing_first_name'] = array(
        'label' => esc_html__('First Name','efarm'),
        'placeholder' => _x('First Name *', 'placeholder', 'efarm'),
        'required' => true,
    );
    $fields['billing']['billing_last_name'] = array(
        'label' => esc_html__('Last Name','efarm'),
        'placeholder' => _x('Last Name *', 'placeholder', 'efarm'),
        'required' => true,
    );
    $fields['billing']['billing_company'] = array(
        'label' => '',
        'placeholder' => _x('Company Name', 'placeholder', 'efarm'),
        'required' => false,
        'class'     => array('form-row-wide'),
    );
    $fields['billing']['billing_address_1'] = array(
        'label' => '',
        'placeholder' => _x('Address', 'placeholder', 'efarm'),
        'required' => false,
        'class'     => array('form-row-wide'),
    );
    $fields['billing']['billing_address_2'] = array(
        'label' => '',
        'placeholder' => _x('Enter Your Apartment', 'placeholder', 'efarm'),
        'required' => false,
    );
    $fields['billing']['billing_city'] = array(
        'label' => esc_html__('City','efarm'),
        'placeholder' => _x('City *', 'placeholder', 'efarm'),
        'required' => true,
    );
    $fields['billing']['billing_email'] = array(
        'label' => esc_html__('Email Address','efarm'),
        'placeholder' => _x('E-mail *', 'placeholder', 'efarm'),
        'required' => true,
    );
    $fields['billing']['billing_phone'] = array(
        'label' => esc_html__('Phone','efarm'),
        'placeholder' => _x('Phone *', 'placeholder', 'efarm'),
        'required' => true,
    );
    $fields['billing']['billing_state'] = array(
        'label' => esc_html__('State / County','efarm'),
        'placeholder' => _x('State / County', 'placeholder', 'efarm'),
        'required' => false,
    );
    $fields['shipping']['shipping_phone'] = array(
        'label' => esc_html__('Phone','efarm'),
        'placeholder'   => _x('Phone Number *', 'placeholder', 'efarm'),
        'required'  => true,
     );
    $fields['shipping']['shipping_first_name'] = array(
        'label' => esc_html__('First Name','efarm'),
        'placeholder' => _x('First Name *', 'placeholder', 'efarm'),
        'required' => true,
    );
    $fields['shipping']['shipping_last_name'] = array(
        'label' => esc_html__('Last Name','efarm'),
        'placeholder' => _x('Last Name *', 'placeholder', 'efarm'),
        'required' => true,
    );
    $fields['shipping']['shipping_company'] = array(
        'label' => esc_html__('Company Name','efarm'),
        'placeholder' => _x('Company Name', 'placeholder', 'efarm'),
        'required' => false,
        'class'     => array('form-row-wide'),
    );
    $fields['shipping']['shipping_city'] = array(
        'label' => esc_html__('City','efarm'),
        'placeholder' => _x('City *', 'placeholder', 'efarm'),
        'required' => true,
    );
    $fields['shipping']['shipping_state'] = array(
        'label' => esc_html__('Enter State/Country','efarm'),
        'placeholder' => _x('Enter State/Country', 'placeholder', 'efarm'),
        'required' => false,
    );
    $fields['shipping']['shipping_email'] = array(
        'label' => esc_html__('Email Address','efarm'),
        'placeholder' => _x('E-mail *', 'placeholder', 'efarm'),
        'required' => true,
    );
    $fields['shipping']['shipping_address_1'] = array(
        'label' => esc_html__('Adress','efarm'),
        'placeholder' => _x('Address *', 'placeholder', 'efarm'),
        'required' => true,
        'class'     => array('form-row-wide'),
    );
    $fields['order']['order_comments'] = array(
        'label' => esc_html__('Order notes','efarm'),
        'placeholder' => _x('Order Notes', 'placeholder', 'efarm'),
        'required' => false,
        'type' => 'textarea',
        'class'     => array('form-row-wide'),
    );
    

    return $fields;
}
function apr_sort_change( $translated_text, $text, $domain ) {

    if ( is_woocommerce() ) {

        switch ( $translated_text ) {
            case 'Sort by popularity' :

                $translated_text = esc_html__( 'Popularity', 'efarm' );
                break;
            case 'Sort by average rating' :

                $translated_text = esc_html__( 'Average rating', 'efarm' );
                break;    
            case 'Sort by newness' :

                $translated_text = esc_html__( 'Newest', 'efarm' );
                break;
            case 'Sort by price: low to high' :

                $translated_text = esc_html__( 'Low to high', 'efarm' );
                break;    
            case 'Sort by price: high to low' :

                $translated_text = esc_html__( 'High to low', 'efarm' );
                break;    
        }

    }

    return $translated_text;
} 

/**
* Check if WooCommerce is active
**/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || ( get_site_option('active_sitewide_plugins') && array_key_exists( 'woocommerce/woocommerce.php', get_site_option('active_sitewide_plugins') ) ) ) {
	
	/**
	* Create the section beneath the products tab
	**/
	 
	add_filter( 'woocommerce_get_sections_products', 'wc_ajax_add_to_cart_variable_add_section' );
	function wc_ajax_add_to_cart_variable_add_section( $sections ) {
		
		$sections['wc_ajax_add_to_cart_variable'] = __( 'Ajax for Variable Products', 'rc_wc_variable_ajax' );
		return $sections;
		
	}
	
	add_filter( 'woocommerce_get_settings_products', 'wc_ajax_add_to_cart_variable_all_settings', 10, 2 );
	
	function wc_ajax_add_to_cart_variable_all_settings( $settings, $current_section ) {
	 
		/**
		 * Check the current section is what we want
		 **/
	 
		if ( $current_section == 'wc_ajax_add_to_cart_variable' ) {
	 
			$settings_slider = array();
	 
			// Add Title to the Settings
			$settings_slider[] = array( 'name' => __( 'Ajax for Variable Products Settings', 'rc_wc_variable_ajax' ), 'type' => 'title', 'desc' => __( 'The following options are used to configure WC Ajax for Variable Products', 'rc_wc_variable_ajax' ), 'id' => 'wc_ajax_add_to_cart_variable' );
	 
			// Add first checkbox option
			$settings_slider[] = array(
	 
				'name'     => __( 'Add Selection option to Category Page', 'rc_wc_variable_ajax' ),
				'desc_tip' => __( 'This will automatically insert variable selection options on product Category Archive Page', 'rc_wc_variable_ajax' ),
				'id'       => 'wc_ajax_add_to_cart_variable_category_page',
				'type'     => 'checkbox',
				'css'      => 'min-width:300px;',
				'desc'     => __( 'Enable Varition select option on Category Archive page', 'rc_wc_variable_ajax' ),
	 
			);
			
			$settings_slider[] = array( 'type' => 'sectionend', 'id' => 'wc_ajax_add_to_cart_variable' );
	 
			return $settings_slider;
		
		/**
		 * If not, return the standard settings
		 **/
	 
		} else {
	 
			return $settings;
	 
		}
	 
	}
	
	$category_page = get_option( 'wc_ajax_add_to_cart_variable_category_page' );
	
	if(isset($category_page) && $category_page == "yes" ) {

		if ( ! function_exists( 'woocommerce_template_loop_add_to_cart' ) ) {
			
			function woocommerce_template_loop_add_to_cart( $args = array()) {
				global $product;

				$product_type = $product->get_type();
				
				if ( $product ) {
					$defaults = array(
						'quantity' => 1,
						'class'    => implode( ' ', array_filter( array(
							'button',
							'product_type_' . $product_type,
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
						) ) ),
						'attributes' => array('data-product_id' => $product->get_id(), 'data-product_sku' => $product->get_sku() ),
					);
				
					$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );
		
					if ($product_type == "variable" ) {
						woocommerce_variable_add_to_cart();
					}
					else {
						wc_get_template( 'loop/add-to-cart.php', $args );
					}
				}
			}
		}
	}
	
	function ajax_add_to_cart_script() {
	  wp_enqueue_script( 'add-to-cart-variation_ajax', get_template_directory_uri() . '/js/un-minify/add-to-cart-variation.js', array('jquery'), '', true );
	}
	add_action( 'wp_enqueue_scripts', 'ajax_add_to_cart_script',99 );
	
	/* AJAX add to cart variable added by Rishi Mehta - rishi@rcreators.com */
	add_action( 'wp_ajax_woocommerce_add_to_cart_variable_rc', 'woocommerce_add_to_cart_variable_rc_callback' );
	add_action( 'wp_ajax_nopriv_woocommerce_add_to_cart_variable_rc', 'woocommerce_add_to_cart_variable_rc_callback' );
	
	function woocommerce_add_to_cart_variable_rc_callback() {
		ob_start();
		
		$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
		$quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
		$variation_id = $_POST['variation_id'];
		$variation  = $_POST['variation'];
		if(!$variation_id){
			//$variation_id = WC_Product_Variation::get_variation_id();	
			echo json_encode( $variation);
			die();
		}
		
		foreach ($variation as $key=>$value) { $variation[$key] = stripslashes($value); }
		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
	
		if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation  ) ) {
			do_action( 'woocommerce_ajax_added_to_cart', $product_id );
			if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
				wc_add_to_cart_message( $product_id );
			}
			global $woocommerce;
			$items = $woocommerce->cart->get_cart();
			wc_setcookie( 'woocommerce_items_in_cart', count( $items ) );
            wc_setcookie( 'woocommerce_cart_hash', md5( json_encode( $items ) ) );
            do_action( 'woocommerce_set_cart_cookies', true );
			// Return fragments
			WC_AJAX::get_refreshed_fragments();
		} else {
			$this->json_headers();
	
			// If there was an error adding to the cart, redirect to the product page to show any errors
			$data = array(
				'error' => true,
				'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
				);
			echo json_encode( $data );
		}
		die();
	}  
}
