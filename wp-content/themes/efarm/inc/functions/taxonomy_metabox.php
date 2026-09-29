<?php 
function apr_get_post_banner_block(){
    global $post, $apr_settings,$wp_query;
    $cat = $wp_query->get_queried_object();
    $static = "";  
    if(is_category()){
        $block_bottom = get_metadata('category', $cat->term_id, 'top_banner', true);
        if(isset($block_bottom) && $block_bottom != 'default' &&  $block_bottom != '' && $block_bottom != 'none'){
            $static = get_metadata('category', $cat->term_id, 'top_banner', true);
        }else if(isset($apr_settings['top_banner']) && $apr_settings['top_banner']!=''){
            $static = $apr_settings['top_banner'];
        }
    }else{
        if( is_singular() &&  get_post_type() == 'post' && (get_post_meta($post->ID,'top_banner',true) != 'default')){
            if(get_post_meta($post->ID,'top_banner',true) == 'none'){
                $static ='';
            }else{        
                $static = get_post_meta($post->ID,'top_banner',true) != "" ? get_post_meta($post->ID,'top_banner',true) :"";
            }
        }else if(isset($apr_settings['post_banner_block']) && $apr_settings['post_banner_block'] != ''){
            $static = $apr_settings['post_banner_block'];

        }
    }
    if($static != ''){      
        $block = get_post($static);
        $post_content = $block->post_content;
        if (class_exists('Ultimate_VC_Addons')) {

            $uvc_addons = new Ultimate_VC_Addons();
            $uvc_addons->aio_front_scripts();
            $apr_ult_assets = str_replace('js/', '', $uvc_addons->assets_js);
            $isAjax = false;
            $ultimate_ajax_theme = get_option('ultimate_ajax_theme');
            if($ultimate_ajax_theme == 'enable')
                $isAjax = true;
            $dependancy = array('jquery');
  
            // register js

            wp_register_script('ultimate-script', $apr_ult_assets . 'min-js/ultimate.min.js', array('jquery'), ULTIMATE_VERSION, false);
            wp_register_script('ultimate-appear', $apr_ult_assets . 'min-js/jquery.appear.min.js', array('jquery'), ULTIMATE_VERSION);
            wp_register_script('ultimate-custom', $apr_ult_assets . 'min-js/custom.min.js', array('jquery'), ULTIMATE_VERSION);
            wp_register_script('ultimate-vc-params', $apr_ult_assets . 'min-js/ultimate-params.min.js', array('jquery'), ULTIMATE_VERSION);

            // register css
            wp_register_style('ultimate-animate', $apr_ult_assets . 'min-css/animate.min.css', array(), ULTIMATE_VERSION);
            wp_register_style('ultimate-style', $apr_ult_assets . 'min-css/style.min.css', array(), ULTIMATE_VERSION);
            wp_register_style('ultimate-style-min', $apr_ult_assets . 'min-css/ultimate.min.css', array(), ULTIMATE_VERSION);

            if(stripos($post_content, 'font_call:'))
            {
                preg_match_all('/font_call:(.*?)"/',$post_content, $display);
                enquque_ultimate_google_fonts_optimzed($display[1]);
            }

            $ultimate_js = get_option('ultimate_js');
            if($ultimate_js == 'enable' || $isAjax == true)
            {
                wp_enqueue_script('ultimate-script');

                if( stripos( $post_content, '[icon_timeline') ) {
                    wp_enqueue_script('masonry');
                }
                if( stripos( $post_content, '[ultimate_google_map') ) {
                    wp_enqueue_script('googleapis');
                }
                if($isAjax == true) { // if ajax site load all js
                    wp_enqueue_script('masonry');
                }
            }
            else if($ultimate_js == 'disable')
            {
                wp_enqueue_script('ultimate-vc-params');

                if(
                    stripos( $post_content, '[ultimate_spacer')
                    || stripos( $post_content, '[ult_buttons')
                    || stripos( $post_content, '[ultimate_icon_list')
                ) {
                    wp_enqueue_script('ultimate-custom');
                }
                if(
                    stripos( $post_content, '[just_icon')
                    || stripos( $post_content, '[ult_animation_block')
                    || stripos( $post_content, '[icon_counter')
                    || stripos( $post_content, '[ultimate_google_map')
                    || stripos( $post_content, '[icon_timeline')
                    || stripos( $post_content, '[bsf-info-box')
                    || stripos( $post_content, '[info_list')
                    || stripos( $post_content, '[ultimate_info_table')
                    || stripos( $post_content, '[interactive_banner_2')
                    || stripos( $post_content, '[interactive_banner')
                    || stripos( $post_content, '[ultimate_pricing')
                    || stripos( $post_content, '[ultimate_icons')
                ) {
                    wp_enqueue_script('ultimate-appear');
                    wp_enqueue_script('ultimate-custom');
                }
                if( stripos( $post_content, '[ultimate_heading') ) {
                    wp_enqueue_script("ultimate-headings-script");
                }
                if( stripos( $post_content, '[ultimate_carousel') ) {
                    wp_enqueue_script('ult-slick');
                    wp_enqueue_script('ultimate-appear');
                    wp_enqueue_script('ult-slick-custom');
                }
                if( stripos( $post_content, '[ult_countdown') ) {
                    wp_enqueue_script('jquery.timeapr');
                    wp_enqueue_script('jquery.countdown');
                }
                if( stripos( $post_content, '[icon_timeline') ) {
                    wp_enqueue_script('masonry');
                }
                if( stripos( $post_content, '[ultimate_info_banner') ) {
                    wp_enqueue_script('ultimate-appear');
                    wp_enqueue_script('utl-info-banner-script');
                }
                if( stripos( $post_content, '[ultimate_google_map') ) {
                    wp_enqueue_script('googleapis');
                }
                if( stripos( $post_content, '[swatch_container') ) {
                    wp_enqueue_script('modernizr-79639-js');
                    wp_enqueue_script('swatchbook-js');
                }
                if( stripos( $post_content, '[ult_ihover') ) {
                    wp_enqueue_script('ult_ihover_js');
                }
                if( stripos( $post_content, '[ult_hotspot') ) {
                    wp_enqueue_script('ult_hotspot_js');
                    wp_enqueue_script('ult_hotspot_tooltipster_js');
                }
                if( stripos( $post_content, '[bsf-info-box') ) {
                    wp_enqueue_script('info_box_js');
                }
                if( stripos( $post_content, '[icon_counter') ) {
                    wp_enqueue_script('flip_box_js');
                }
                if( stripos( $post_content, '[ultimate_ctation') ) {
                    wp_enqueue_script('utl-ctaction-script');
                }
                if( stripos( $post_content, '[stat_counter') ) {
                    wp_enqueue_script('ultimate-appear');
                    wp_enqueue_script('front-js');
                    wp_enqueue_script('ult-slick-custom');
                    array_push($dependancy,'front-js');
                }
                if( stripos( $post_content, '[ultimate_video_banner') ) {
                    wp_enqueue_script('ultimate-video-banner-script');
                }
                if( stripos( $post_content, '[ult_dualbutton') ) {
                    wp_enqueue_script('jquery.dualbtn');

                }
                if( stripos( $post_content, '[ult_createlink') ) {
                    wp_enqueue_script('jquery.ult_cllink');
                }
                if( stripos( $post_content, '[ultimate_img_separator') ) {
                    wp_enqueue_script('ultimate-appear');
                    wp_enqueue_script('ult-easy-separator-script');
                }
            }

            $ultimate_css = get_option('ultimate_css');

            if($ultimate_css == "enable"){
                wp_enqueue_style('ultimate-style-min');
            } else {
                wp_enqueue_style('ultimate-style');


                if( stripos( $post_content, '[ult_animation_block') ) {
                    wp_enqueue_style('ultimate-animate');
                }
                if( stripos( $post_content, '[icon_counter') ) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style('ultimate-style');
                    wp_enqueue_style('aio-flip-style', $apr_ult_assets . 'min-css/flip-box.min.css');
                }
                if( stripos( $post_content, '[ult_countdown') ) {
                    wp_enqueue_style('countdown_shortcode', $apr_ult_assets . 'min-css/countdown.min.css');
                }
                if( stripos( $post_content, '[ultimate_icon_list') ) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style('aio-tooltip', $apr_ult_assets . 'min-css/tooltip.min.css');
                }
                if( stripos( $post_content, '[ultimate_carousel') ) {
                    wp_enqueue_style("ult-slick", $apr_ult_assets . 'slick/slick.css');
                    wp_enqueue_style("ult-icons", $apr_ult_assets . 'slick/icons.css');
                    wp_enqueue_style("ult-slick-animate", $apr_ult_assets . 'slick/animate.min.css');

                }
                if( stripos( $post_content, '[ultimate_fancytext') ) {
                    wp_enqueue_style('ultimate-fancytext-style');
                }
                if( stripos( $post_content, '[icon_counter') ) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style('aio-flip-style', $apr_ult_assets . 'min-css/flip-box.min.css');

                }
                if( stripos( $post_content, '[ultimate_ctation') ) {
                    wp_enqueue_style('utl-ctaction-style');
                }
                if( stripos( $post_content, '[ult_buttons') ) {
                    wp_enqueue_style( 'ult-btn', $apr_ult_assets . 'min-css/btn-min.css' );
                }
                if( stripos( $post_content, '[ultimate_heading') ) {
                    wp_enqueue_style("ultimate-headings-style");
                }
                if( stripos( $post_content, '[ultimate_icons') || stripos( $post_content, '[single_icon')) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style('aio-tooltip', $apr_ult_assets . 'min-css/tooltip.min.css');
                }
                if( stripos( $post_content, '[ult_ihover') ) {
                    wp_enqueue_style( 'ult_ihover_css' );
                }
                if( stripos( $post_content, '[ult_hotspot') ) {
                    wp_enqueue_style( 'ult_hotspot_css' );
                    wp_enqueue_style( 'ult_hotspot_tooltipster_css' );
                }
                if( stripos( $post_content, '[bsf-info-box') ) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style('info-box-style', $apr_ult_assets . 'min-css/info-box.min.css');
                }
                if( stripos( $post_content, '[info_apr') ) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style('info-apr', $apr_ult_assets . 'min-css/info-apr.min.css');
                }
                if( stripos( $post_content, '[ultimate_info_banner') ) {
                    wp_enqueue_style('utl-info-banner-style');
                    wp_enqueue_style('ultimate-animate');
                }
                if( stripos( $post_content, '[icon_timeline') ) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style('aio-timeline', $apr_ult_assets . 'min-css/timeline.min.css');
                }
                if( stripos( $post_content, '[just_icon') ) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style('aio-tooltip', $apr_ult_assets . 'min-css/tooltip.min.css');
                }
                if( stripos( $post_content, '[interactive_banner_2') ) {
                    wp_enqueue_style('utl-ib2-style', $apr_ult_assets . 'min-css/ib2-style.min.css');
                }
                if( stripos( $post_content, '[interactive_banner') ) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style('aio-interactive-styles', $apr_ult_assets . 'min-css/interactive-styles.min.css');
                }
                if( stripos( $post_content, '[info_list') ) {
                    wp_enqueue_style('ultimate-animate');
                }
                if( stripos( $post_content, '[ultimate_modal') ) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style('ultimate-modal', $apr_ult_assets . 'min-css/modal.min.css');
                }
                if( stripos( $post_content, '[ultimate_info_table') ) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style("ultimate-pricing", $apr_ult_assets . 'min-css/pricing.min.css');
                }
                if( stripos( $post_content, '[ultimate_pricing') ) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style("ultimate-pricing", $apr_ult_assets . 'min-css/pricing.min.css');
                }
                if( stripos( $post_content, '[swatch_container') ) {
                    wp_enqueue_style('swatchbook-css', $apr_ult_assets . 'min-css/swatchbook.min.css');
                }
                if( stripos( $post_content, '[stat_counter') ) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style('stats-counter-style', $apr_ult_assets . 'min-css/stats-counter.min.css');
                }
                if( stripos( $post_content, '[ultimate_video_banner') ) {
                    wp_enqueue_style('ultimate-video-banner-style');
                }
                if( stripos( $post_content, '[ult_dualbutton') ) {
                    wp_enqueue_style('ult-dualbutton');
                }
                if( stripos( $post_content, '[ult_createlink') ) {
                    wp_enqueue_style('ult_cllink');
                }
                if( stripos( $post_content, '[ultimate_img_separator') ) {
                    wp_enqueue_style('ultimate-animate');
                    wp_enqueue_style('ult-easy-separator-style');
                }
            }

            wp_register_script('ultimate-appear', $apr_ult_assets . 'min-js/jquery.appear.min.js', array('jquery'), ULTIMATE_VERSION, true);
            wp_register_script('ultimate-custom', $apr_ult_assets . 'min-js/custom.min.js', $dependancy, ULTIMATE_VERSION, true);
            wp_register_script('ultimate-smooth-scroll', $apr_ult_assets . 'js/SmoothScroll.js', array('jquery'), ULTIMATE_VERSION, true);

            $ultimate_smooth_scroll = get_option('ultimate_smooth_scroll');
            if($ultimate_smooth_scroll == "enable")
                wp_enqueue_script('ultimate-smooth-scroll');

            if(function_exists('vc_is_editor')){
                if(vc_is_editor()){
                    wp_enqueue_style('vc-fronteditor', $apr_ult_assets . 'min-css/vc-fronteditor.min.css');
                }
            }
            $fonts = get_option('smile_fonts');
            if(is_array($fonts))
            {
                foreach($fonts as $font => $info)
                {
                    $style_url = $info['style'];
                    if(strpos($style_url, 'http://' ) !== false) {
                        wp_enqueue_style('bsf-'.$font, $info['style']);
                    } else {
                        $paths = wp_upload_dir();
                        $paths['fonts'] = 'smile_fonts';
                        $paths['fonturl'] = set_url_scheme(trailingslashit($paths['baseurl']).$paths['fonts']);
                        wp_enqueue_style('bsf-'.$font, trailingslashit($paths['fonturl']).$info['style']);
                    }
                }
            }

        }
        $shortcodes_custom_css = get_post_meta( $static, '_wpb_shortcodes_custom_css', true );
        if ( ! empty( $shortcodes_custom_css ) ) {
            $output = '<style type="text/css" data-type="vc_shortcodes-custom-css">';
            $output .= $shortcodes_custom_css;
            $output .= '</style>';
            echo $output;
        }        
        $hide_static = true;
        if($hide_static){
            echo apply_filters('the_content', get_post_field('post_content', $static));
        }
    }
}
function apr_sidebars() {
    global $wp_registered_sidebars;

    $sidebar_options = array();
    $sidebar_options['default'] = esc_html__('Default sidebar', 'efarm');
    $sidebar_options['none'] = esc_html__('None', 'efarm');
    if (!empty($wp_registered_sidebars)) {
        foreach ($wp_registered_sidebars as $sidebar) {
            $sidebar_options[$sidebar['id']] = $sidebar['name'];
        }
    }
    return $sidebar_options;
} 

function apr_use_default_meta() {
    global $wp_query;

    $value = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        $value = get_metadata('category', $cat->term_id, 'default', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop()) {
            $value = get_post_meta(wc_get_page_id('shop'), 'default', true);
        } else {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            if ($term) {
                $value = get_metadata($term->taxonomy, $term->term_id, 'default', true);
            }
        }
    } else {
        if (is_singular()) {
            $value = get_post_meta(get_the_ID(), 'default', true);
        }
    }

    return ($value != 'default') ? true : false;
}

function apr_get_meta_value($meta_key, $boolean = false) {
    global $wp_query, $apr_settings;

    $value = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        if(isset($cat) && !empty($cat)){
            $value = get_metadata('category', $cat->term_id, $meta_key, true);
        }else{
            $value = '';
        }        
       
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $value = get_post_meta(wc_get_page_id( 'shop' ), $meta_key, true);
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ($term) {
                $value = get_metadata($term->taxonomy, $term->term_id, $meta_key, true);
            }
        }
    } else {
        if (is_singular()) {
            $value = get_post_meta(get_the_id(), $meta_key, true);
        } else {
            if (!is_home() && is_front_page()) {
                if (isset($apr_settings[$meta_key]))
                    $value = $apr_settings[$meta_key];
            } else if (is_home() && !is_front_page()) {
                if (isset($apr_settings['blog-'.$meta_key])){
                    $value = $apr_settings['blog-'.$meta_key];
                }else{
                    $value = get_post_meta(get_queried_object_id(), $meta_key, true);
                }
            } else if (is_home() || is_front_page()) {
                if (isset($apr_settings[$meta_key]))
                    $value = $apr_settings[$meta_key];
            }
        }
    }

    if ($boolean) {
        $value = ($value != $meta_key) ? true : false;
    }

    return $value;
}
// Show Taxonomy Add Meta Boxes
function apr_show_tax_add_meta_boxes($meta_boxes) {
    if (!isset($meta_boxes) || empty($meta_boxes))
        return;

    foreach ($meta_boxes as $meta_box) {
        apr_show_tax_add_meta_box($meta_box);
    }
}

// Show Taxonomy Add Meta Box
function apr_show_tax_add_meta_box($meta_box) {

    extract(shortcode_atts(array(
        "name" => '',
        "title" => '',
        "desc" => '',
        "type" => '',
        "default" => '',
        "options" => '',
        "number_after" =>'',
    ), $meta_box));

    ?>

    <input type="hidden" name="<?php echo esc_attr($name) ?>_noncename" id="<?php echo esc_attr($name) ?>_noncename"
        value="<?php echo wp_create_nonce( plugin_basename(__FILE__) ) ?>" />

    <?php
    if ($type == "text") : // text ?>
        <div class="form-field">
            <label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label>
            <input type="text" id="<?php echo esc_attr($name) ?>" name="<?php echo esc_attr($name) ?>" value="<?php echo stripslashes($meta_box_value) ?>" size="50%" />
            <?php if ($desc) : ?><p><?php echo esc_html($desc) ?></p><?php endif; ?>
        </div>
    <?php endif;
    if ($type == "select") : // select ?>
        <div class="form-field">
            <label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label>
            <select name="<?php echo esc_attr($name) ?>" id="<?php echo esc_attr($name) ?>">
                <?php if (is_array($options)) :
                    foreach ($options as $key => $value) : ?>
                        <option value="<?php echo esc_attr($key) ?>"><?php echo esc_html( $value ); ?></option>
                    <?php endforeach;
                endif; ?>
            </select>
            <?php if ($desc) : ?><p><?php echo esc_html($desc) ?></p><?php endif; ?>
        </div>
    <?php endif;
    if ($type == "number") : ?>
        <div class="form-field">
            <label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label>
                <input type="number" id="<?php echo esc_attr($name) ?>" name="<?php echo esc_attr($name) ?>" value="<?php echo stripslashes($meta_box_value) ?>" size="50%" />
                <p class="number_after"><?php echo esc_html($number_after); ?></p>
                <div class="box-info"><label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($desc) ?></label></div>
            </div>
        <?php endif;
    if ($type == "upload") : // upload image ?>
        <div class="form-field">
            <label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label>
            <label for='upload_image'>
                <input style="margin-bottom:5px;" type="text" name="<?php echo esc_attr($name) ?>"  id="<?php echo esc_attr($name) ?>" /><br/>
                <button class="button_upload_image button" id="<?php echo esc_attr($name) ?>"><?php echo esc_html__('Upload Image', 'efarm') ?></button>
                <button class="button_remove_image button" id="<?php echo esc_attr($name) ?>"><?php echo esc_html__('Remove Image', 'efarm') ?></button>
            </label>
            <?php if ($desc) : ?><p><?php echo esc_html($desc) ?></p><?php endif; ?>
        </div>
    <?php endif; 

    if ($type == "editor") : // editor ?>
        <div class="form-field">
            <label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label>
            <?php wp_editor( '', $name ) ?>
            <?php if ($desc) : ?><p><?php echo esc_html($desc) ?></p><?php endif; ?>
        </div>
    <?php endif;

    if ($type == "textarea") : // textarea ?>
        <div class="form-field">
            <label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label>
            <textarea id="<?php echo esc_attr($name) ?>" name="<?php echo esc_attr($name) ?>"></textarea>
            <?php if ($desc) : ?><p><?php echo esc_html($desc) ?></p><?php endif; ?>
        </div>
    <?php endif;

    if (($type == 'radio') && (!empty($options))) : // radio buttons ?>
        <div class="form-field">
            <label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label>
            <?php foreach ($options as $key => $value) : ?>
                <input style="display:inline-block; width:auto;" type="radio" id="<?php echo esc_attr($name) ?>_<?php echo esc_attr($key) ?>" name="<?php echo esc_attr($name) ?>"  value="<?php echo esc_attr($key) ?>"/>
                <label style="display:inline-block" for="<?php echo esc_attr($name) ?>_<?php echo esc_attr($key) ?>"><?php echo esc_html( $value ); ?></label>
            <?php endforeach; ?>
            <?php if ($desc) : ?><p><?php echo esc_html($desc) ?></p><?php endif; ?>
        </div>
    <?php endif;

    if ($type == "checkbox") : // checkbox ?>
        <div class="form-field">
            <label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label>
            <label><input style="display:inline-block; width:auto;" type="checkbox" name="<?php echo esc_attr($name) ?>" value="<?php echo esc_attr($name) ?>" /> <?php echo esc_html($desc) ?></label>
        </div>
    <?php endif;

    if (($type == 'multi_checkbox') && (!empty($options))) : // radio buttons ?>
        <div class="form-field">
            <label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label>
            <?php foreach ($options as $key => $value) : ?>
                <input style="display:inline-block; width:auto;" type="checkbox" id="<?php echo esc_attr($name) ?>_<?php echo esc_attr($key) ?>" name="<?php echo esc_attr($name) ?>[]" value="<?php echo esc_attr($key) ?>" />
                <label style="display:inline-block" for="<?php echo esc_attr($name) ?>_<?php echo esc_attr($key) ?>"><?php echo esc_html( $value ); ?></label>
            <?php endforeach; ?>
            <?php if ($desc) : ?><p><?php echo esc_html($desc) ?></p><?php endif; ?>
        </div>
    <?php endif;
}

// Show Taxonomy Add Meta Boxes
function apr_show_tax_edit_meta_boxes($tag, $taxonomy, $meta_boxes) {
    if (!isset($meta_boxes) || empty($meta_boxes))
        return;

    foreach ($meta_boxes as $meta_box) {
        apr_show_tax_edit_meta_box($tag, $taxonomy, $meta_box);
    }
}

// Show Taxonomy Add Meta Box
function apr_show_tax_edit_meta_box($tag, $taxonomy, $meta_box) {

    extract(shortcode_atts(array(
        "name" => '',
        "title" => '',
        "desc" => '',
        "type" => '',
        "default" => '',
        "options" => ''
    ), $meta_box));

    ?>

    <input type="hidden" name="<?php echo esc_attr($name) ?>_noncename" id="<?php echo esc_attr($name) ?>_noncename" 
        value="<?php echo wp_create_nonce( plugin_basename(__FILE__) ) ?>" />

    <?php
    $meta_box_value = '';
    if(get_metadata($tag->taxonomy, $tag->term_id, $name, true)!=''){
        $meta_box_value = get_metadata($tag->taxonomy, $tag->term_id, $name, true);
    }else{
        $meta_box_value = '';
    }
    if ($meta_box_value == "")
        $meta_box_value = $default;

    if ($type == "text") : // text ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label></th>
            <td>
                <input type="text" id="<?php echo esc_attr($name) ?>" name="<?php echo esc_attr($name) ?>" value="<?php echo stripslashes($meta_box_value) ?>" size="50%" />
                <?php if ($desc) : ?><p class="description"><?php echo esc_html($desc) ?></p><?php endif; ?>
            </td>
        </tr>
    <?php endif;
    if ($type == "number") : // text ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label></th>
            <td>
                 <input type="number" id="<?php echo esc_attr($name) ?>" name="<?php echo esc_attr($name) ?>" value="<?php echo stripslashes($meta_box_value) ?>" size="50%" />
                <?php if ($desc) : ?><p class="description"><?php echo esc_html($desc) ?></p><?php endif; ?>
            </td>
        </tr>
    <?php endif;
    if ($type == "select") : // select ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label></th>
            <td>
                <select name="<?php echo esc_attr($name) ?>" id="<?php echo esc_attr($name) ?>">
                    <?php if (is_array($options)) :
                        foreach ($options as $key => $value) : ?>
                            <option value="<?php echo esc_attr($key) ?>"<?php echo esc_attr($meta_box_value == $key ? ' selected="selected"' : '') ?>><?php echo esc_html( $value ); ?></option>
                        <?php endforeach;
                    endif; ?>
                </select>
                <?php if ($desc) : ?><p class="description"><?php echo esc_html($desc) ?></p><?php endif; ?>
            </td>
        </tr>
    <?php endif; 

    if ($type == "upload") : // upload image ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label></th>
            <td>
                <label for='upload_image'>
                    <input style="margin-bottom:5px;" value="<?php echo stripslashes($meta_box_value) ?>" type="text" name="<?php echo esc_attr($name) ?>"  id="<?php echo esc_attr($name) ?>" size="50%" />
                    <br/>
                    <button class="button_upload_image button" id="<?php echo esc_attr($name) ?>"><?php echo esc_html__('Upload Image', 'efarm') ?></button>
                    <button class="button_remove_image button" id="<?php echo esc_attr($name) ?>"><?php echo esc_html__('Remove Image', 'efarm') ?></button>
                </label>
                <?php if ($desc) : ?><p class="description"><?php echo esc_html($desc) ?></p><?php endif; ?>
            </td>
        </tr>
    <?php endif; 

    if ($type == "editor") : // editor ?>
        <tr class="form-field">
            <th colspan="2" scope="row" valign="top"><label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label></th>
        <tr>
            <td colspan="2">
                <?php wp_editor( $meta_box_value, $name ) ?>
                <?php if ($desc) : ?><p class="description"><?php echo esc_html($desc) ?></p><?php endif; ?>
            </td>
        </tr>
    <?php endif;

    if ($type == "textarea") : // textarea ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label></th>
            <td>
                <textarea id="<?php echo esc_attr($name) ?>" name="<?php echo esc_attr($name) ?>"><?php echo stripslashes($meta_box_value) ?></textarea>
                <?php if ($desc) : ?><p class="description"><?php echo esc_html($desc) ?></p><?php endif; ?>
            </td>
        </tr>
    <?php endif;

    if (($type == 'radio') && (!empty($options))) : // radio buttons ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label></th>
            <td>
                <?php foreach ($options as $key => $value) : ?>
                    <input style="display:inline-block; width:auto;" type="radio" id="<?php echo esc_attr($name) ?>_<?php echo esc_attr($key) ?>" name="<?php echo esc_attr($name) ?>"  value="<?php echo esc_attr($key) ?>"
                        <?php echo (isset($meta_box_value) && ($meta_box_value == $key) ? ' checked="checked"' : '') ?>/>
                    <label for="<?php echo esc_attr($name) ?>_<?php echo esc_attr($key) ?>"><?php echo esc_html( $value ); ?></label>
                <?php endforeach; ?>
                <?php if ($desc) : ?><p class="description"><?php echo esc_html($desc) ?></p><?php endif; ?>
            </td>
        </tr>
    <?php endif; 

    if ($type == "checkbox") :  // checkbox ?>
        <?php if ( $meta_box_value == $name ) {
            $checked = "checked=\"checked\"";
        } else {
            $checked = "";
        } ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label></th>
            <td>
                <label><input style="display:inline-block; width:auto;" type="checkbox" name="<?php echo esc_attr($name) ?>" value="<?php echo esc_attr($name) ?>" <?php echo esc_attr($checked) ?> /> <?php echo esc_html($desc) ?></label>
            </td>
        </tr>
    <?php endif;

    if (($type == 'multi_checkbox') && (!empty($options))) : // radio buttons ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="<?php echo esc_attr($name) ?>"><?php echo esc_html($title) ?></label></th>
            <td>
                <?php foreach ($options as $key => $value) : ?>
                    <input style="display:inline-block; width:auto;" type="checkbox" id="<?php echo esc_attr($name) ?>_<?php echo esc_attr($key) ?>" name="<?php echo esc_attr($name) ?>[]" value="<?php echo esc_attr($key) ?>" <?php echo ((isset($meta_box_value) && in_array($key, explode(',', $meta_box_value))) ? ' checked="checked"' : '') ?>/>
                    <label for="<?php echo esc_attr($name) ?>_<?php echo esc_attr($key) ?>"> <?php echo esc_html( $value ); ?></label>
                <?php endforeach; ?>
                <?php if ($desc) : ?><p class="description"><?php echo esc_html($desc) ?></p><?php endif; ?>
            </td>
        </tr>
    <?php endif;
}

// Save Tax Data
function apr_save_taxdata( $term_id, $tt_id, $taxonomy, $meta_boxes ) {
    if (!isset($meta_boxes) || empty($meta_boxes))
        return;

    foreach ($meta_boxes as $meta_box) {

        extract(shortcode_atts(array(
            "name" => '',
            "title" => '',
            "desc" => '',
            "type" => '',
            "default" => '',
            "options" => ''
        ), $meta_box));

        if ( !isset($_POST[$name.'_noncename']))
            return;

        if ( !wp_verify_nonce( $_POST[$name.'_noncename'], plugin_basename(__FILE__) ) ) {
            return;
        }

        $meta_box_value = get_metadata($taxonomy, $term_id, $name, true);

        if (!isset($_POST[$name])) {
            delete_metadata($taxonomy, $term_id, $name, $meta_box_value);
            continue;
        }

        $data = $_POST[$name];

        if (is_array($data))
            $data = implode(',', $data);

        if (!$meta_box_value && !$data)
            add_metadata($taxonomy, $term_id, $name, $data, true);
        elseif ($data != $meta_box_value)
            update_metadata($taxonomy, $term_id, $name, $data);
        elseif (!$data)
            delete_metadata($taxonomy, $term_id, $name, $meta_box_value);
    }
}

// Create Meta Table
function apr_create_metadata_table($table_name, $type) {
    global $wpdb;

    if (!empty ($wpdb->charset))
        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
    if (!empty ($wpdb->collate))
        $charset_collate .= " COLLATE {$wpdb->collate}";

    if ( get_option( 'apr_'.$table_name ) )
        return false;
    $type_id = $type.'_id';
    if (!$wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
        $sql = "CREATE TABLE {$table_name} (
            meta_id bigint(20) NOT NULL AUTO_INCREMENT,
            {$type}_id bigint(20) NOT NULL default 0,
            meta_key varchar(255) DEFAULT NULL,
            meta_value longtext DEFAULT NULL,
            UNIQUE KEY meta_id (meta_id)
        ) {$charset_collate};";
        $wpdb->query($sql);
        update_option( 'apr_'.$table_name, true );
    }

    return true;
}
function apr_add_categorymeta_product_table() {
    // Create Product Cat Meta
    global $wpdb;
    $type = 'product_cat';
    $table_name = $wpdb->prefix . $type . 'meta';
    $variable_name = $type . 'meta';
    $wpdb->$variable_name = $table_name;

    // Create Product Cat Meta Table
    apr_create_metadata_table($table_name, $type);
}
add_action( 'init', 'apr_add_categorymeta_product_table' );
//Taxonomy
function apr_default_product_tax_meta_data() {
    $apr_sidebar_position = apr_sidebar_position();
    $apr_sidebars = apr_sidebars();   
    $apr_list_mode = apr_product_type();
    $apr_header_layout = apr_header_types();
    $apr_footer_layout = apr_footer_types(); 
    return array(
        // Breadcrumbs
        'breadcrumbs' => array(
            'name' => 'breadcrumbs',
            'title' => esc_html__('Breadcrumbs', 'efarm'),
            'desc' => esc_html__('Hide breadcrumbs', 'efarm'),
            'type' => 'checkbox'
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
        'category-item-count' => array(
            'name' => 'category-item-count',
            'type' => 'number',
            'title' => esc_html__('Products per Page', 'efarm'),
        ),
        'list_mode_product' => array(
            'name' => 'list_mode_product',
            'type' => 'select',
            'title' => esc_html__('List mode', 'efarm'),
            'options' => $apr_list_mode,
            'default' => 'only-grid'
        ),
        'category_cols' => array(
            'name' => 'category_cols',
            'type' => 'select',
            'title' => esc_html__('Number of grid column', 'efarm'),
            'options' =>  
                    array(
                    "3" => esc_html__("3 columns", 'efarm'),
                    "1" => esc_html__("1 columns", 'efarm'),
                    "2" => esc_html__("2 columns", 'efarm'),
                    "4" => esc_html__("4 columns", 'efarm'),
                    "5" => esc_html__("5 columns", 'efarm'),
                    "column-default" => esc_html__("Default", 'efarm'), 
                    ),
            'default' => 'column-default'
        ),
    );
}

add_action( 'product_cat_add_form_fields', 'apr_add_product_cat', 10, 2);
function apr_add_product_cat() {
    $product_cat_meta_boxes = apr_default_product_tax_meta_data();

    apr_show_tax_add_meta_boxes($product_cat_meta_boxes);
}

add_action( 'product_cat_edit_form_fields', 'apr_edit_product_cat', 10, 2);
function apr_edit_product_cat($tag, $taxonomy) {
    $product_cat_meta_boxes = apr_default_product_tax_meta_data();

    apr_show_tax_edit_meta_boxes($tag, $taxonomy, $product_cat_meta_boxes);
}

add_action( 'created_term', 'apr_save_product_cat', 10,3 );
add_action( 'edit_term', 'apr_save_product_cat', 10,3 );

function apr_save_product_cat($term_id, $tt_id, $taxonomy) {
    if (!$term_id) return;
    
    $product_cat_meta_boxes = apr_default_product_tax_meta_data();
    return apr_save_taxdata( $term_id, $tt_id, $taxonomy, $product_cat_meta_boxes );
}  



function apr_add_categorymeta_knowledge_table() {
    // Create knowledge Cat Meta
    global $wpdb;
    $type = 'knowledge_cat';
    $table_name = $wpdb->prefix . $type . 'meta';
    $variable_name = $type . 'meta';
    $wpdb->$variable_name = $table_name;
    
    // Create knowledge Cat Meta Table
    apr_create_metadata_table($table_name, $type);
}
add_action( 'init', 'apr_add_categorymeta_knowledge_table' );
//Taxonomy
function apr_default_knowledge_tax_meta_data() {
    $apr_layout = apr_layouts();
    $apr_sidebar_position = apr_sidebar_position();
    $apr_sidebars = apr_sidebars();   
    $apr_header_layout = apr_header_types();
    $apr_footer_layout = apr_footer_types(); 
    $apr_knowledge_layout = apr_page_knowledge_layouts();
    $apr_knowledge_columns = apr_page_knowledge_columns();
    $apr_knowledge_layout['default']= esc_html__('Default','efarm');
    $apr_knowledge_columns['default']= esc_html__('Default','efarm');
    $apr_block_name = apr_get_block_name();
    $apr_block_name['default'] ='default';   
    $apr_block_name['none'] ='none';  
    return array(
        // header
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
        'top_banner' => array(
            'name' => 'top_banner',
            'title' => esc_html__('Select Top Banner', 'efarm'),
            'desc' => esc_html__('Choose a block to display at the top of pages (after header). You should create a block in Static Block/Add New', 'efarm'),
            'type' => 'select',
            'options' => $apr_block_name,
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
        // Breadcrumbs
        'page_title' => array(
            'name' => 'page_title',
            'title' => esc_html__('Page Title', 'efarm'),
            'desc' => esc_html__('Hide Page Title', 'efarm'),
            'type' => 'checkbox'
        ),
        // Breadcrumbs
        'breadcrumbs' => array(
            'name' => 'breadcrumbs',
            'title' => esc_html__('Breadcrumbs', 'efarm'),
            'desc' => esc_html__('Hide breadcrumbs', 'efarm'),
            'type' => 'checkbox',
        ),        
        'show_header' => array(
            'name' => 'show_header',
            'title' => esc_html__('Header', 'efarm'),
            'desc' => esc_html__('Hide header', 'efarm'),
            'type' => 'checkbox'
        ),
        'knowledge_layout' => array(
            'name' => 'knowledge_layout',
            'title' => esc_html__('knowledge layout', 'efarm'),
            'desc' => esc_html__('Select knowledge layout', 'efarm'),
            'type' => 'select',
            'options' => $apr_knowledge_layout,
            'default' => 'default'            
        ),
        'knowledge_columns' => array(
            'name' => 'knowledge_columns',
            'title' => esc_html__('knowledge columns', 'efarm'),
            'desc' => esc_html__('Select knowledge columns', 'efarm'),
            'type' => 'select',
            'options' => $apr_knowledge_columns,
            'default' => 'default'            
        ),       
        'knowledge_pagination' => array(
            'name' => 'knowledge_pagination',
            'title' => esc_html__('Pagination type', 'efarm'),
            'desc' => esc_html__('Select knowledge pagination', 'efarm'),
            'type' => 'select',
            'options' => array(
                'default' => esc_html__('Default','efarm'), 
                '1' => esc_html__('Load more','efarm'), 
                '2' => esc_html__('Next/Prev','efarm'),
                '3' => esc_html__('Number','efarm'),
                ),
            'default' => 'default'            
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
    );
}

add_action( 'knowledge_cat_add_form_fields', 'apr_add_knowledge_cat', 10, 2);
function apr_add_knowledge_cat() {
    $knowledge_cat_meta_boxes = apr_default_knowledge_tax_meta_data();

    apr_show_tax_add_meta_boxes($knowledge_cat_meta_boxes);
}

add_action( 'knowledge_cat_edit_form_fields', 'apr_edit_knowledge_cat', 10, 2);
function apr_edit_knowledge_cat($tag, $taxonomy) {
    $knowledge_cat_meta_boxes = apr_default_knowledge_tax_meta_data();

    apr_show_tax_edit_meta_boxes($tag, $taxonomy, $knowledge_cat_meta_boxes);
}

add_action( 'created_term', 'apr_save_knowledge_cat', 10,3 );
add_action( 'edit_term', 'apr_save_knowledge_cat', 10,3 );

function apr_save_knowledge_cat($term_id, $tt_id, $taxonomy) {
    if (!$term_id) return;
    
    $knowledge_cat_meta_boxes = apr_default_knowledge_tax_meta_data();
    return apr_save_taxdata( $term_id, $tt_id, $taxonomy, $knowledge_cat_meta_boxes );
}

function apr_add_categorymeta_gallery_table() {
    // Create Gallery Cat Meta
    global $wpdb;
    $type = 'gallery_cat';
    $table_name = $wpdb->prefix . $type . 'meta';
    $variable_name = $type . 'meta';
    $wpdb->$variable_name = $table_name;
    
    // Create Gallery Cat Meta Table
    apr_create_metadata_table($table_name, $type);
}
add_action( 'init', 'apr_add_categorymeta_gallery_table' );
//Taxonomy
function apr_default_gallery_tax_meta_data() {
    $apr_layout = apr_layouts();
    $apr_sidebar_position = apr_sidebar_position();
    $apr_sidebars = apr_sidebars();   
    $apr_header_layout = apr_header_types();
    $apr_footer_layout = apr_footer_types(); 
    $gallery_style= apr_page_gallery_layouts();
    $gallery_style['default'] ='Default';
    $gallery_cols = apr_gallery_columns();
    $gallery_cols['default'] ='Default';
    $apr_style = apr_gallery_style();
    $apr_style['default'] ='Default';
    return array(
                // layout
        'layout' => array(
            'name' => 'layout',
            'title' => esc_html__('Layout', 'efarm'),
            'type' => 'select',
            'options' => $apr_layout,
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
        'gallery_filter' => array(
            'name'  => 'gallery_filter',
            'type'  => 'select',
            'title' => esc_html__('Gallery filter','efarm'),
            'options'   => array(
                'default' => esc_html__('Default','efarm'),
                '1' => esc_html__('Yes','efarm'),
                '2' => esc_html__('No','efarm'),
                ),
            'default' => 'default',
        ),
        'gallery-style-version' => array(
            'name' => 'gallery-style-version',
            'type' => 'select',
            'title' => esc_html__('Gallery Layouts', 'efarm'),
            'options' => $gallery_style,
            'default' => 'default'
        ),
        'gallery-loadmore-style' => array(
            'name'  => 'gallery-loadmore-style',
            'type'  => 'select',
            'title' => esc_html__('Gallery loadmore style','efarm'),
            'options'   => array(
                                'default' => esc_html__('Default','efarm'),
                                '1' => esc_html__('Button style 1','efarm'),
                                '2' => esc_html__('Button style 2','efarm'),
                                ),
            'default' => 'default',
        ),
        'gallery-cols' => array(
            'name' => 'gallery-cols',
            'type' => 'select',
            'title' => esc_html__('Gallery columns', 'efarm'),
            'options' => $gallery_cols,
            'default' => 'default'
        ), 
        'gallery-style' => array(
            'name'  => 'gallery-style',
            'type'  => 'select',
            'title' => esc_html__('Gallery Style','efarm'),
            'options'   => $apr_style,
            'default' => 'default',
        ),
            'gallery-space' => array(
            'name'  => 'gallery-space',
            'type'  => 'select',
            'title' => esc_html__('Remove Space Items','efarm'),
            'options'   => array(
                'default' => esc_html__('Default','efarm'),
                '1' => esc_html__('Yes','efarm'),
                '2' => esc_html__('No','efarm'),
                ),
            'default' => 'default',
        ),
        'gallery_per_page' => array(
            'name' => 'gallery_per_page',
            'type' => 'number',
            'title' => esc_html__('Post show per page', 'efarm'),
            'default' => 'default',
        ),                
    );
}

add_action( 'gallery_cat_add_form_fields', 'apr_add_gallery_cat', 10, 2);
function apr_add_gallery_cat() {
    $gallery_cat_meta_boxes = apr_default_gallery_tax_meta_data();

    apr_show_tax_add_meta_boxes($gallery_cat_meta_boxes);
}

add_action( 'gallery_cat_edit_form_fields', 'apr_edit_gallery_cat', 10, 2);
function apr_edit_gallery_cat($tag, $taxonomy) {
    $gallery_cat_meta_boxes = apr_default_gallery_tax_meta_data();

    apr_show_tax_edit_meta_boxes($tag, $taxonomy, $gallery_cat_meta_boxes);
}

add_action( 'created_term', 'apr_save_gallery_cat', 10,3 );
add_action( 'edit_term', 'apr_save_gallery_cat', 10,3 );

function apr_save_gallery_cat($term_id, $tt_id, $taxonomy) {
    if (!$term_id) return;
    
    $gallery_cat_meta_boxes = apr_default_gallery_tax_meta_data();
    return apr_save_taxdata( $term_id, $tt_id, $taxonomy, $gallery_cat_meta_boxes );
}



function apr_add_categorymeta_press_table() {
    // Create press Cat Meta
    global $wpdb;
    $type = 'press_cat';
    $table_name = $wpdb->prefix . $type . 'meta';
    $variable_name = $type . 'meta';
    $wpdb->$variable_name = $table_name;
    
    // Create press Cat Meta Table
    apr_create_metadata_table($table_name, $type);
}
add_action( 'init', 'apr_add_categorymeta_press_table' );
//Taxonomy
function apr_default_press_tax_meta_data() {
    $apr_layout = apr_layouts();
    $apr_sidebar_position = apr_sidebar_position();
    $apr_sidebars = apr_sidebars();   
    $apr_header_layout = apr_header_types();
    $apr_footer_layout = apr_footer_types(); 
    $apr_press_layout = apr_page_press_layouts();
    $apr_press_columns = apr_page_press_columns();
    $apr_press_layout['default']= esc_html__('Default','efarm');
    $apr_press_columns['default']= esc_html__('Default','efarm');
    $apr_block_name = apr_get_block_name();
    $apr_block_name['default'] ='default';   
    $apr_block_name['none'] ='none';  
    return array(
        // header
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
        'top_banner' => array(
            'name' => 'top_banner',
            'title' => esc_html__('Select Top Banner', 'efarm'),
            'desc' => esc_html__('Choose a block to display at the top of pages (after header). You should create a block in Static Block/Add New', 'efarm'),
            'type' => 'select',
            'options' => $apr_block_name,
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
        // Breadcrumbs
        'page_title' => array(
            'name' => 'page_title',
            'title' => esc_html__('Page Title', 'efarm'),
            'desc' => esc_html__('Hide Page Title', 'efarm'),
            'type' => 'checkbox'
        ),
        // Breadcrumbs
        'breadcrumbs' => array(
            'name' => 'breadcrumbs',
            'title' => esc_html__('Breadcrumbs', 'efarm'),
            'desc' => esc_html__('Hide breadcrumbs', 'efarm'),
            'type' => 'checkbox',
        ),        
        'show_header' => array(
            'name' => 'show_header',
            'title' => esc_html__('Header', 'efarm'),
            'desc' => esc_html__('Hide header', 'efarm'),
            'type' => 'checkbox'
        ),
        'press_layout' => array(
            'name' => 'press_layout',
            'title' => esc_html__('Press layout', 'efarm'),
            'desc' => esc_html__('Select press layout', 'efarm'),
            'type' => 'select',
            'options' => $apr_press_layout,
            'default' => 'default'            
        ),
        'press_columns' => array(
            'name' => 'press_columns',
            'title' => esc_html__('Press columns', 'efarm'),
            'desc' => esc_html__('Select press columns', 'efarm'),
            'type' => 'select',
            'options' => $apr_press_columns,
            'default' => 'default'            
        ),       
        'press_pagination' => array(
            'name' => 'press_pagination',
            'title' => esc_html__('Pagination type', 'efarm'),
            'desc' => esc_html__('Select press pagination', 'efarm'),
            'type' => 'select',
            'options' => array(
                'default' => esc_html__('Default','efarm'), 
                '1' => esc_html__('Load more','efarm'), 
                '2' => esc_html__('Next/Prev','efarm'),
                '3' => esc_html__('Number','efarm'),
                ),
            'default' => 'default'            
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
    );
}

add_action( 'press_cat_add_form_fields', 'apr_add_press_cat', 10, 2);
function apr_add_press_cat() {
    $press_cat_meta_boxes = apr_default_press_tax_meta_data();

    apr_show_tax_add_meta_boxes($press_cat_meta_boxes);
}

add_action( 'press_cat_edit_form_fields', 'apr_edit_press_cat', 10, 2);
function apr_edit_press_cat($tag, $taxonomy) {
    $press_cat_meta_boxes = apr_default_press_tax_meta_data();

    apr_show_tax_edit_meta_boxes($tag, $taxonomy, $press_cat_meta_boxes);
}

add_action( 'created_term', 'apr_save_press_cat', 10,3 );
add_action( 'edit_term', 'apr_save_press_cat', 10,3 );

function apr_save_press_cat($term_id, $tt_id, $taxonomy) {
    if (!$term_id) return;
    
    $press_cat_meta_boxes = apr_default_press_tax_meta_data();
    return apr_save_taxdata( $term_id, $tt_id, $taxonomy, $press_cat_meta_boxes );
}


function apr_add_categorymeta_recipe_table() {
    // Create recipe Cat Meta
    global $wpdb;
    $type = 'recipe_cat';
    $table_name = $wpdb->prefix . $type . 'meta';
    $variable_name = $type . 'meta';
    $wpdb->$variable_name = $table_name;
    
    // Create recipe Cat Meta Table
apr_create_metadata_table($table_name, $type);
}
add_action( 'init', 'apr_add_categorymeta_recipe_table' );
//Taxonomy
function apr_default_recipe_tax_meta_data() {
    $apr_layout = apr_layouts();
    $apr_sidebar_position = apr_sidebar_position();
    $apr_sidebars = apr_sidebars();   
    $apr_header_layout = apr_header_types();
    $apr_footer_layout = apr_footer_types(); 
    $apr_recipe_layout = apr_page_recipe_layouts();
    $apr_recipe_columns = apr_page_recipe_columns();
    $apr_recipe_layout['default']= esc_html__('Default','efarm');
    $apr_block_name = apr_get_block_name();
    $apr_block_name['default'] ='default';   
    $apr_block_name['none'] ='none';  
    return array(
        // header
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
        'top_banner' => array(
            'name' => 'top_banner',
            'title' => esc_html__('Select Top Banner', 'efarm'),
            'desc' => esc_html__('Choose a block to display at the top of pages (after header). You should create a block in Static Block/Add New', 'efarm'),
            'type' => 'select',
            'options' => $apr_block_name,
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
        // Breadcrumbs
        'page_title' => array(
            'name' => 'page_title',
            'title' => esc_html__('Page Title', 'efarm'),
            'desc' => esc_html__('Hide Page Title', 'efarm'),
            'type' => 'checkbox'
        ),
        // Breadcrumbs
        'breadcrumbs' => array(
            'name' => 'breadcrumbs',
            'title' => esc_html__('Breadcrumbs', 'efarm'),
            'desc' => esc_html__('Hide breadcrumbs', 'efarm'),
            'type' => 'checkbox',
        ),        
        'show_header' => array(
            'name' => 'show_header',
            'title' => esc_html__('Header', 'efarm'),
            'desc' => esc_html__('Hide header', 'efarm'),
            'type' => 'checkbox'
        ),
        'recipe_layout' => array(
            'name' => 'recipe_layout',
            'title' => esc_html__('Recipe layout', 'efarm'),
            'desc' => esc_html__('Select recipe layout', 'efarm'),
            'type' => 'select',
            'options' => $apr_recipe_layout,
            'default' => 'default'            
        ),
        'recipe_columns' => array(
            'name' => 'recipe_columns',
            'title' => esc_html__('Recipe columns', 'efarm'),
            'desc' => esc_html__('Select recipe columns', 'efarm'),
            'type' => 'select',
            'options' => $apr_recipe_columns,
            'default' => 'default'            
        ),       
        'recipe_pagination' => array(
            'name' => 'recipe_pagination',
            'title' => esc_html__('Pagination type', 'efarm'),
            'desc' => esc_html__('Select recipe pagination', 'efarm'),
            'type' => 'select',
            'options' => array(
                'default' => esc_html__('Default','efarm'), 
                '1' => esc_html__('Load more','efarm'), 
                '2' => esc_html__('Next/Prev','efarm'),
                '3' => esc_html__('Number','efarm'),
                ),
            'default' => 'default'            
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
    );
}

add_action( 'recipe_cat_add_form_fields', 'apr_add_recipe_cat', 10, 2);
function apr_add_recipe_cat() {
    $recipe_cat_meta_boxes = apr_default_recipe_tax_meta_data();

    apr_show_tax_add_meta_boxes($recipe_cat_meta_boxes);
}

add_action( 'recipe_cat_edit_form_fields', 'apr_edit_recipe_cat', 10, 2);
function apr_edit_recipe_cat($tag, $taxonomy) {
    $recipe_cat_meta_boxes = apr_default_recipe_tax_meta_data();

    apr_show_tax_edit_meta_boxes($tag, $taxonomy, $recipe_cat_meta_boxes);
}

add_action( 'created_term', 'apr_save_recipe_cat', 10,3 );
add_action( 'edit_term', 'apr_save_recipe_cat', 10,3 );

function apr_save_recipe_cat($term_id, $tt_id, $taxonomy) {
    if (!$term_id) return;
    
    $recipe_cat_meta_boxes = apr_default_recipe_tax_meta_data();
    return apr_save_taxdata( $term_id, $tt_id, $taxonomy, $recipe_cat_meta_boxes );
}

function apr_default_post_tax_meta_data() {
    $apr_sidebar_position = apr_sidebar_position();
    $apr_sidebars = apr_sidebars();
    $apr_header_layout = apr_header_types();
    $apr_footer_layout = apr_footer_types();
    $apr_blog_layout = apr_page_blog_layouts();
    $apr_blog_columns = apr_page_blog_columns();
    $apr_blog_layout['default']= esc_html__('Default','efarm');
    $apr_block_name = apr_get_block_name();
    $apr_block_name['default'] ='default';   
    $apr_block_name['none'] ='none';  
    return array(
        // header
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
        'top_banner' => array(
            'name' => 'top_banner',
            'title' => esc_html__('Select Top Banner', 'efarm'),
            'desc' => esc_html__('Choose a block to display at the top of pages (after header). You should create a block in Static Block/Add New', 'efarm'),
            'type' => 'select',
            'options' => $apr_block_name,
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
        // Breadcrumbs
        'page_title' => array(
            'name' => 'page_title',
            'title' => esc_html__('Page Title', 'efarm'),
            'desc' => esc_html__('Hide Page Title', 'efarm'),
            'type' => 'checkbox'
        ),
        // Breadcrumbs
        'breadcrumbs' => array(
            'name' => 'breadcrumbs',
            'title' => esc_html__('Breadcrumbs', 'efarm'),
            'desc' => esc_html__('Hide breadcrumbs', 'efarm'),
            'type' => 'checkbox',
        ),        
        'show_header' => array(
            'name' => 'show_header',
            'title' => esc_html__('Header', 'efarm'),
            'desc' => esc_html__('Hide header', 'efarm'),
            'type' => 'checkbox'
        ),
        'blog_layout' => array(
            'name' => 'blog_layout',
            'title' => esc_html__('Blog layout', 'efarm'),
            'desc' => esc_html__('Select blog layout', 'efarm'),
            'type' => 'select',
            'options' => $apr_blog_layout,
            'default' => 'default'            
        ),
		'blog_columns' => array(
            'name' => 'blog_columns',
            'title' => esc_html__('Blog columns', 'efarm'),
            'desc' => esc_html__('Select blog columns', 'efarm'),
            'type' => 'select',
            'options' => $apr_blog_columns,
            'default' => 'default'            
        ),       
        'post_pagination' => array(
            'name' => 'post_pagination',
            'title' => esc_html__('Pagination type', 'efarm'),
            'desc' => esc_html__('Select blog pagination', 'efarm'),
            'type' => 'select',
            'options' => array(
                'default' => esc_html__('Default','efarm'), 
                '1' => esc_html__('Load more','efarm'), 
                '2' => esc_html__('Next/Prev','efarm'),
                '3' => esc_html__('Number','efarm'),
             ),
            'default' => 'default'            
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
    );
}
//category taxonomy
function apr_add_categorymeta_table() {
    // Create Product Cat Meta
    global $wpdb;
    $type = 'category';
    $table_name = $wpdb->prefix . $type . 'meta';
    $variable_name = $type . 'meta';
    $wpdb->$variable_name = $table_name;

    // Create Category Meta Table
    apr_create_metadata_table($table_name, $type);
}
add_action( 'init', 'apr_add_categorymeta_table' );

// category meta
add_action( 'category_add_form_fields', 'apr_add_category', 10, 2);
function apr_add_category() {
    $category_meta_boxes = apr_default_post_tax_meta_data();
    apr_show_tax_add_meta_boxes($category_meta_boxes);
}

add_action( 'category_edit_form_fields', 'apr_edit_category', 10, 2);
function apr_edit_category($tag, $taxonomy) {
    $category_meta_boxes = apr_default_post_tax_meta_data();
    apr_show_tax_edit_meta_boxes($tag, $taxonomy, $category_meta_boxes);
}

add_action( 'created_term', 'apr_save_category', 10,3 );
add_action( 'edit_term', 'apr_save_category', 10,3 );
function apr_save_category($term_id, $tt_id, $taxonomy) {
    if (!$term_id) return;
    
    $category_meta_boxes = apr_default_post_tax_meta_data();
    return apr_save_taxdata( $term_id, $tt_id, $taxonomy, $category_meta_boxes );
}
