<?php
require_once( APR_WIDGETS . '/apr_contact_info.php' );
require_once( APR_WIDGETS . '/apr_recent_posts.php' );
require_once( APR_WIDGETS . '/apr_recent_comments.php' );
require_once( APR_WIDGETS . '/apr_recent_recipe.php' );
require_once( APR_WIDGETS . '/apr_recipe_categories.php' );
require_once( APR_WIDGETS . '/apr_recent_knowledge.php' );
require_once( APR_WIDGETS . '/apr_knowledge_categories.php' );
require_once( APR_WIDGETS . '/apr_recent_press.php' );
require_once( APR_WIDGETS . '/apr_press_categories.php' );

// socical widget
require_once APR_WIDGETS. '/social-widget/facebook/arrowpress-likebox-facebook.php';
require_once APR_WIDGETS. '/social-widget/twitter/settings.php';
require_once APR_WIDGETS. '/social-widget/twitter/api/Abraham/TwitterOAuth/TwitterOAuth.php';
require_once APR_WIDGETS. '/social-widget/twitter/widget.php';
require_once APR_WIDGETS. '/social-widget/instagram/settings.php';
require_once APR_WIDGETS. '/social-widget/instagram/widget.php';


if ( ! function_exists( 'arrowpress_sh_commons' ) ) {
	function arrowpress_sh_commons( $asset = '' ) {
		switch ( $asset ) {
			case 'text_align':
				return ArrowPress_ShSharedLibrary::getTextAlign();
			case 'products_view_mode':
				return ArrowPress_ShSharedLibrary::getProductsViewMode();
			case 'products_columns':
				return ArrowPress_ShSharedLibrary::getProductsColumns();
			default:
				return array();
		}
	}
}
function arrowpress_remove_cssjs_ver( $src ) {
	if ( strpos( $src, '?ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}

	return $src;
}

add_filter( 'style_loader_src', 'arrowpress_remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'arrowpress_remove_cssjs_ver', 10, 2 );
// Build the string of values in an Array
function arrowpress_getFontsData( $fontsString ) {

	// Font data Extraction
	$googleFontsParam = new Vc_Google_Fonts();
	$fieldSettings    = array();
	$fontsData        = strlen( $fontsString ) > 0 ? $googleFontsParam->_vc_google_fonts_parse_attributes( $fieldSettings, $fontsString ) : '';

	return $fontsData;

}

// return responsive data
function arrowpress_get_responsive_media_css( $args ) {
	$content = '';
	if ( isset( $args ) && is_array( $args ) ) {
		//  get targeted css class/id from array
		if ( array_key_exists( 'target', $args ) ) {
			if ( ! empty( $args['target'] ) ) {
				$content .= " data-arrowpress-target='" . $args['target'] . "' ";
			}
		}
		if ( array_key_exists( 'csstarget', $args ) ) {
			if ( ! empty( $args['csstarget'] ) ) {
				$content .= " data-arrowpress-csstarget='" . $args['csstarget'] . "' ";
			}
		}

		//  get media sizes
		if ( array_key_exists( 'desktop', $args ) ) {
			if ( ! empty( $args['desktop'] ) ) {
				$content .= " data-arrowpress-responsive-desktop='" . json_encode( $args['desktop'] ) . "' ";
			}
		}
		if ( array_key_exists( 'tablet', $args ) ) {
			if ( ! empty( $args['tablet'] ) ) {
				$content .= " data-arrowpress-responsive-tablet='" . json_encode( $args['tablet'] ) . "' ";
			}
		}
		if ( array_key_exists( 'tablet-port', $args ) ) {
			if ( ! empty( $args['tablet-port'] ) ) {
				$content .= " data-arrowpress-responsive-tablet-port='" . json_encode( $args['tablet-port'] ) . "' ";
			}
		}
		if ( array_key_exists( 'mobile-land', $args ) ) {
			if ( ! empty( $args['mobile-land'] ) ) {
				$content .= " data-arrowpress-responsive-mob-land='" . json_encode( $args['mobile-land'] ) . "' ";
			}
		}
		if ( array_key_exists( 'mobile', $args ) ) {
			if ( ! empty( $args['mobile'] ) ) {
				$content .= " data-arrowpress-responsive-mob='" . json_encode( $args['mobile'] ) . "' ";
			}
		}
	}
	?>
	<?php
	return $content;
}

// Build the inline style starting from the data
function arrowpress_googleFontsStyles( $fontsData ) {

	$styles[] = '';
	// Inline styles
	if ( isset( $fontsData['values']['font_family'] ) ) {
		$fontFamily = explode( ':', $fontsData['values']['font_family'] );
		$styles[]   = 'font-family:' . $fontFamily[0];
	}
	if ( isset( $fontsData['values']['font_style'] ) ) {
		$fontStyles = explode( ':', $fontsData['values']['font_style'] );
		$styles[]   = 'font-weight:' . $fontStyles[1];
		$styles[]   = 'font-style:' . $fontStyles[2];
	}
	$inline_style = '';
	if ( count( $styles ) > 0 && ( is_array( $styles ) || is_object( $styles ) ) ) {
		foreach ( $styles as $attribute ) {
			if ( $attribute != '' ) {
				$inline_style .= $attribute . '; ';
			}
		}
	}

	return $inline_style;

}

// Enqueue right google font from Googleapis
function arrowpress_enqueueGoogleFonts( $fontsData ) {

	// Get extra subsets for settings (latin/cyrillic/etc)
	$settings = get_option( 'wpb_js_google_fonts_subsets' );
	if ( is_array( $settings ) && ! empty( $settings ) ) {
		$subsets = '&subset=' . implode( ',', $settings );
	} else {
		$subsets = '';
	}

	// We also need to enqueue font from googleapis
	if ( isset( $fontsData['values']['font_family'] ) ) {
		wp_enqueue_style(
			'vc_google_fonts_' . vc_build_safe_css_class( $fontsData['values']['font_family'] ),
			'//fonts.googleapis.com/css?family=' . $fontsData['values']['font_family'] . $subsets
		);
	}

}

function arrowpress_iconpicker_type_themifyfont( $icons ) {
	$themify_icons = array(
		array( 'ti-flag-alt' => 'Flag Alt' ),
		array( 'ti-flag' => 'Flag' ),
		array( 'ti-hand-drag' => 'Hand drag' ),
		array( 'ti-hand-open' => 'Hand open' ),
		array( 'ti-hand-stop' => 'Hand Stop' ),
		array( 'ti-anchor' => 'Archor' ),
		array( 'ti-world' => 'World' ),
		array( 'ti-panel' => 'Panel' ),
		array( 'ti-pulse' => 'Pulse' ),
		array( 'ti-map' => 'Map' ),
		array( 'ti-home' => 'Home' ),
		array( 'ti-location-pin' => 'location pin' ),
		array( 'ti-calendar' => 'Calender' ),
		array( 'ti-face-smile' => 'Smile' ),
		array( 'ti-lock' => 'Lock' ),
		array( 'ti-location-arrow' => 'Location' ),
	);

	return array_merge( $icons, $themify_icons );
}

add_filter( 'vc_iconpicker-type-themifyfont', 'arrowpress_iconpicker_type_themifyfont' );
if ( ! class_exists( 'ArrowPress_ShSharedLibrary' ) ) {
	class ArrowPress_ShSharedLibrary {

		public static function getTextAlign() {
			return array(
				__( 'None', 'arrowpress-core' )    => '',
				__( 'Left', 'arrowpress-core' )    => 'left',
				__( 'Right', 'arrowpress-core' )   => 'right',
				__( 'Center', 'arrowpress-core' )  => 'center',
				__( 'Justify', 'arrowpress-core' ) => 'justify'
			);
		}

		public static function getProductsViewMode() {
			return array(
				__( 'Grid', 'arrowpress-core' )   => 'grid',
				__( 'List', 'arrowpress-core' )   => 'list',
				__( 'Slider', 'arrowpress-core' ) => 'products-slider',
			);
		}

		public static function getProductsColumns() {
			return array(
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
				'5' => 5,
				'6' => 6,
			);
		}
	}
}
function arrowpress_vc_animation_type() {
	return array(
		"type"        => "arrowpress_animation_type",
		"heading"     => esc_html__( "Animation Type", 'arrowpress-core' ),
		"param_name"  => "animation_type",
		"admin_label" => true
	);
}

function arrowpress_vc_woo_order_by() {
	return array(
		'',
		esc_html__( 'Date', 'arrowpress-core' )          => 'date',
		esc_html__( 'ID', 'arrowpress-core' )            => 'ID',
		esc_html__( 'Author', 'arrowpress-core' )        => 'author',
		esc_html__( 'Title', 'arrowpress-core' )         => 'title',
		esc_html__( 'Modified', 'arrowpress-core' )      => 'modified',
		esc_html__( 'Random', 'arrowpress-core' )        => 'rand',
		esc_html__( 'Comment count', 'arrowpress-core' ) => 'comment_count',
		esc_html__( 'Menu order', 'arrowpress-core' )    => 'menu_order',
	);
}

function arrowpress_vc_woo_order_way() {
	return array(
		'',
		esc_html__( 'Descending', 'arrowpress-core' ) => 'DESC',
		esc_html__( 'Ascending', 'arrowpress-core' )  => 'ASC',
	);
}

function arrowpress_animation_custom() {
	return array(
		'',
		esc_html__( 'bounce', 'arrowpress-core' )             => 'bounce',
		esc_html__( 'flash', 'arrowpress-core' )              => 'flash',
		esc_html__( 'pulse', 'arrowpress-core' )              => 'pulse',
		esc_html__( 'rubberBand', 'arrowpress-core' )         => 'rubberBand',
		esc_html__( 'shake', 'arrowpress-core' )              => 'shake',
		esc_html__( 'swing', 'arrowpress-core' )              => 'swing',
		esc_html__( 'tada', 'arrowpress-core' )               => 'swing',
		esc_html__( 'wobble', 'arrowpress-core' )             => 'wobble',
		esc_html__( 'jello', 'arrowpress-core' )              => 'jello',
		esc_html__( 'bounceIn', 'arrowpress-core' )           => 'bounceIn',
		esc_html__( 'bounceInDown', 'arrowpress-core' )       => 'bounceInDown',
		esc_html__( 'bounceInLeft', 'arrowpress-core' )       => 'bounceInLeft',
		esc_html__( 'bounceInRight', 'arrowpress-core' )      => 'bounceInRight',
		esc_html__( 'bounceInUp', 'arrowpress-core' )         => 'bounceInUp',
		esc_html__( 'bounceOut', 'arrowpress-core' )          => 'bounceOut',
		esc_html__( 'bounceOutDown', 'arrowpress-core' )      => 'bounceOutDown',
		esc_html__( 'bounceOutLeft', 'arrowpress-core' )      => 'bounceOutLeft',
		esc_html__( 'bounceOutRight', 'arrowpress-core' )     => 'bounceOutRight',
		esc_html__( 'bounceOutUp', 'arrowpress-core' )        => 'bounceOutUp',
		esc_html__( 'fadeIn', 'arrowpress-core' )             => 'fadeIn',
		esc_html__( 'fadeInDown', 'arrowpress-core' )         => 'fadeInDown',
		esc_html__( 'fadeInDownBig', 'arrowpress-core' )      => 'fadeInDownBig',
		esc_html__( 'fadeInLeft', 'arrowpress-core' )         => 'fadeInLeft',
		esc_html__( 'fadeInLeftBig', 'arrowpress-core' )      => 'fadeInLeftBig',
		esc_html__( 'fadeInRight', 'arrowpress-core' )        => 'fadeInRight',
		esc_html__( 'fadeInUp', 'arrowpress-core' )           => 'fadeInUp',
		esc_html__( 'fadeInUpBig', 'arrowpress-core' )        => 'fadeInUpBig',
		esc_html__( 'fadeOut', 'arrowpress-core' )            => 'fadeOut',
		esc_html__( 'fadeOutDown', 'arrowpress-core' )        => 'fadeOutDown',
		esc_html__( 'fadeOutDownBig', 'arrowpress-core' )     => 'fadeOutDownBig',
		esc_html__( 'fadeOutLeft', 'arrowpress-core' )        => 'fadeOutLeft',
		esc_html__( 'fadeOutLeftBig', 'arrowpress-core' )     => 'fadeOutLeftBig',
		esc_html__( 'fadeOutRight', 'arrowpress-core' )       => 'fadeOutRight',
		esc_html__( 'fadeOutUp', 'arrowpress-core' )          => 'fadeOutUp',
		esc_html__( 'fadeOutUpBig', 'arrowpress-core' )       => 'fadeOutUpBig',
		esc_html__( 'flip', 'arrowpress-core' )               => 'flip',
		esc_html__( 'flipInX', 'arrowpress-core' )            => 'flipInX',
		esc_html__( 'flipInY', 'arrowpress-core' )            => 'flipInY',
		esc_html__( 'flipOutX', 'arrowpress-core' )           => 'flipOutX',
		esc_html__( 'flipOutY', 'arrowpress-core' )           => 'flipOutY',
		esc_html__( 'lightSpeedIn', 'arrowpress-core' )       => 'lightSpeedIn',
		esc_html__( 'lightSpeedOut', 'arrowpress-core' )      => 'lightSpeedOut',
		esc_html__( 'rotateIn', 'arrowpress-core' )           => 'rotateIn',
		esc_html__( 'rotateInDownLeft', 'arrowpress-core' )   => 'rotateInDownLeft',
		esc_html__( 'rotateInDownRight', 'arrowpress-core' )  => 'rotateInDownRight',
		esc_html__( 'rotateInUpLeft', 'arrowpress-core' )     => 'rotateInUpLeft',
		esc_html__( 'rotateInUpRight', 'arrowpress-core' )    => 'rotateInUpRight',
		esc_html__( 'rotateOut', 'arrowpress-core' )          => 'rotateOut',
		esc_html__( 'rotateOutDownLeft', 'arrowpress-core' )  => 'rotateOutDownLeft',
		esc_html__( 'rotateOutDownRight', 'arrowpress-core' ) => 'rotateOutDownRight',
		esc_html__( 'rotateOutUpLeft', 'arrowpress-core' )    => 'rotateOutUpLeft',
		esc_html__( 'rotateOutUpRight', 'arrowpress-core' )   => 'rotateOutUpRight',
		esc_html__( 'slideInUp', 'arrowpress-core' )          => 'slideInUp',
		esc_html__( 'slideInDown', 'arrowpress-core' )        => 'slideInDown',
		esc_html__( 'slideInLeft', 'arrowpress-core' )        => 'slideInLeft',
		esc_html__( 'slideInRight', 'arrowpress-core' )       => 'slideInRight',
		esc_html__( 'slideOutUp', 'arrowpress-core' )         => 'slideOutUp',
		esc_html__( 'zoomIn', 'arrowpress-core' )             => 'zoomIn',
		esc_html__( 'zoomInDown', 'arrowpress-core' )         => 'zoomInDown',
		esc_html__( 'zoomInLeft', 'arrowpress-core' )         => 'zoomInLeft',
		esc_html__( 'zoomInRight', 'arrowpress-core' )        => 'zoomInRight',
		esc_html__( 'zoomInUp', 'arrowpress-core' )           => 'zoomInUp',
		esc_html__( 'zoomOut', 'arrowpress-core' )            => 'zoomOut',
		esc_html__( 'zoomOutDown', 'arrowpress-core' )        => 'zoomOutDown',
		esc_html__( 'zoomOutLeft', 'arrowpress-core' )        => 'zoomOutLeft',
		esc_html__( 'zoomOutRight', 'arrowpress-core' )       => 'zoomOutRight',
		esc_html__( 'zoomOutUp', 'arrowpress-core' )          => 'zoomOutUp',
		esc_html__( 'hinge', 'arrowpress-core' )              => 'hinge',
		esc_html__( 'rollIn', 'arrowpress-core' )             => 'rollIn',
		esc_html__( 'rollOut', 'arrowpress-core' )            => 'rollOut',
	);
}

function arrowpress_vc_slider_item_device_type_field( $settings, $value ) {
	$output = '<input type="number" min="0" max="5" class="wpb_vc_param_value ' . $settings['param_name'] . '" name="' . $settings['param_name'] . '" value="' . $value . '" style="max-width:100px; margin-right: 10px;" />';

	return $output;
}

function arrowpress_shortcode_template( $name = false ) {
	if ( ! $name ) {
		return false;
	}

	if ( $overridden_template = locate_template( 'vc_templates' . $name . '.php' ) ) {
		return $overridden_template;
	} else {
		// If neither the child nor parent theme have overridden the template,
		// we load the template from the 'templates' sub-directory of the directory this file is in
		return ARROWPRESS_SHORTCODES_TEMPLATES . $name . '.php';
	}
}

// function arrowpress_shortcode_woo_template( $name = false ) {
//     if (!$name)
//     return false;
//     if ( $overridden_template = locate_template( 'vc_templates' . $name . '.php' ) ) {
//     return $overridden_template;
//     } else {
//     // If neither the child nor parent theme have overridden the template,
//     // we load the template from the 'templates' sub-directory of the directory this file is in
//     return ARROWPRESS_SHORTCODES_WOO_TEMPLATES . $name . '.php';
//     }
// }
function arrowpress_shortcode_extract_class( $el_class ) {
	$output = '';
	if ( $el_class != '' ) {
		$output = " " . str_replace( ".", "", $el_class );
	}

	return $output;
}

function arrowpress_shortcode_js_remove_wpautop( $content, $autop = false ) {

	if ( $autop ) {
		$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
	}

	return do_shortcode( shortcode_unautop( $content ) );
}

function arrowpress_shortcode_end_block_comment( $string ) {
	return WP_DEBUG ? '<!-- END ' . $string . ' -->' : '';
}

function arrowpress_shortcode_image_resize( $width, $height,$attach_id = null, $img_url = null, $crop = false ) {
	// this is an attachment, so we have the ID
	$image_src = array();
	if ( $attach_id ) {
		$image_src        = wp_get_attachment_image_src( $attach_id, 'full' );
		$actual_file_path = get_attached_file( $attach_id );
		// this is not an attachment, let's use the image url
	} else if ( $img_url ) {
		$file_path        = parse_url( $img_url );
		$actual_file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
		$actual_file_path = ltrim( $file_path['path'], '/' );
		$actual_file_path = rtrim( ABSPATH, '/' ) . $file_path['path'];
		$orig_size        = getimagesize( $actual_file_path );
		$image_src[0]     = $img_url;
		$image_src[1]     = $orig_size[0];
		$image_src[2]     = $orig_size[1];
	}
	if ( ! empty( $actual_file_path ) ) {
		$file_info = pathinfo( $actual_file_path );
		$extension = '.' . $file_info['extension'];

		// the image path without the extension
		$no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];

		$cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

		// checking if the file size is larger than the target size
		// if it is smaller or the same size, stop right here and return
		if ( $image_src[1] > $width || $image_src[2] > $height ) {

			// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
			if ( file_exists( $cropped_img_path ) ) {
				$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
				$vt_image        = array(
					'url'    => $cropped_img_url,
					'width'  => $width,
					'height' => $height
				);

				return $vt_image;
			}

			// $crop = false
			if ( $crop == false ) {
				// calculate the size proportionaly
				$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
				$resized_img_path  = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

				// checking if the file already exists
				if ( file_exists( $resized_img_path ) ) {
					$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

					$vt_image = array(
						'url'    => $resized_img_url,
						'width'  => $proportional_size[0],
						'height' => $proportional_size[1]
					);

					return $vt_image;
				}
			}

			// no cache files - let's finally resize it
			$img_editor = wp_get_image_editor( $actual_file_path );

			if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
				return array(
					'url'    => '',
					'width'  => '',
					'height' => ''
				);
			}

			$new_img_path = $img_editor->generate_filename();

			if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
				return array(
					'url'    => '',
					'width'  => '',
					'height' => ''
				);
			}
			if ( ! is_string( $new_img_path ) ) {
				return array(
					'url'    => '',
					'width'  => '',
					'height' => ''
				);
			}

			$new_img_size = getimagesize( $new_img_path );
			$new_img      = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

			// resized output
			$vt_image = array(
				'url'    => $new_img,
				'width'  => $new_img_size[0],
				'height' => $new_img_size[1]
			);

			return $vt_image;
		}

		// default output - without resizing
		$vt_image = array(
			'url'    => $image_src[0],
			'width'  => $image_src[1],
			'height' => $image_src[2]
		);

		return $vt_image;
	}

	return false;
}

function arrowpress_shortcode_get_image_by_size(
	$params = array(
		'post_id'    => null,
		'attach_id'  => null,
		'thumb_size' => 'thumbnail',
		'class'      => ''
	)
) {
	//array( 'post_id' => $post_id, 'thumb_size' => $grid_thumb_size )
	if ( ( ! isset( $params['attach_id'] ) || $params['attach_id'] == null ) && ( ! isset( $params['post_id'] ) || $params['post_id'] == null ) ) {
		return false;
	}
	$post_id = isset( $params['post_id'] ) ? $params['post_id'] : 0;

	if ( $post_id ) {
		$attach_id = get_post_thumbnail_id( $post_id );
	} else {
		$attach_id = $params['attach_id'];
	}

	$thumb_size  = $params['thumb_size'];
	$thumb_class = ( isset( $params['class'] ) && $params['class'] != '' ) ? $params['class'] . ' ' : '';

	global $_wp_additional_image_sizes;
	$thumbnail = '';

	if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[$thumb_size] ) && is_array( $_wp_additional_image_sizes[$thumb_size] ) ) || in_array( $thumb_size, array(
				'thumbnail',
				'thumb',
				'medium',
				'large',
				'full'
			) ) )
	) {
		$thumbnail = wp_get_attachment_image( $attach_id, $thumb_size, false, array( 'class' => $thumb_class . 'attachment-' . $thumb_size ) );
	} elseif ( $attach_id ) {
		if ( is_string( $thumb_size ) ) {
			preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
			if ( isset( $thumb_matches[0] ) ) {
				$thumb_size = array();
				if ( count( $thumb_matches[0] ) > 1 ) {
					$thumb_size[] = $thumb_matches[0][0]; // width
					$thumb_size[] = $thumb_matches[0][1]; // height
				} elseif ( count( $thumb_matches[0] ) > 0 && count( $thumb_matches[0] ) < 2 ) {
					$thumb_size[] = $thumb_matches[0][0]; // width
					$thumb_size[] = $thumb_matches[0][0]; // height
				} else {
					$thumb_size = false;
				}
			}
		}
		if ( is_array( $thumb_size ) ) {
			// Resize image to custom size
			$p_img      = arrowpress_shortcode_image_resize($thumb_size[0], $thumb_size[1], $attach_id, null, true );
			$alt        = trim( strip_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
			$attachment = get_post( $attach_id );
			if ( ! empty( $attachment ) ) {
				$title = trim( strip_tags( $attachment->post_title ) );

				if ( empty( $alt ) ) {
					$alt = trim( strip_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
				}
				if ( empty( $alt ) ) {
					$alt = $title;
				} // Finally, use the title
				if ( $p_img ) {
					$img_class = '';
					//if ( $grid_layout == 'thumbnail' ) $img_class = ' no_bottom_margin'; class="'.$img_class.'"
					$thumbnail = '<img class="' . esc_attr( $thumb_class ) . '" src="' . esc_attr( $p_img['url'] ) . '" width="' . esc_attr( $p_img['width'] ) . '" height="' . esc_attr( $p_img['height'] ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $title ) . '" />';
				}
			}
		}
	}

	$p_img_large = wp_get_attachment_image_src( $attach_id, 'large' );

	return apply_filters( 'vc_wpb_getimagesize', array(
		'thumbnail'   => $thumbnail,
		'p_img_large' => $p_img_large
	), $attach_id, $params );
}

function arrowpress_vc_animation_duration() {
	return array(
		"type"        => "textfield",
		"heading"     => esc_html__( "Animation Duration", 'arrowpress-core' ),
		"param_name"  => "animation_duration",
		"description" => esc_html__( "numerical value (unit: milliseconds)", 'arrowpress-core' ),
		"value"       => '1000'
	);
}

function arrowpress_vc_animation_delay() {
	return array(
		"type"        => "textfield",
		"heading"     => esc_html__( "Animation Delay", 'arrowpress-core' ),
		"param_name"  => "animation_delay",
		"description" => esc_html__( "numerical value (unit: milliseconds)", 'arrowpress-core' ),
		"value"       => '0'
	);
}

function arrowpress_vc_custom_class() {
	return array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Extra class name', 'arrowpress-core' ),
		'param_name'  => 'el_class',
		'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'arrowpress-core' )
	);
}

function arrowpress_shortcode_widget_title( $params = array( 'title' => '' ) ) {
	if ( $params['title'] == '' ) {
		return '';
	}

	$extraclass = ( isset( $params['extraclass'] ) ) ? " " . $params['extraclass'] : "";
	$output     = '<h2 class="wpb_heading' . $extraclass . '">' . $params['title'] . '</h2>';

	return apply_filters( 'wpb_widget_title', $output, $params );
}

function arrowpress_vc_slider_pagination_style_type_field( $settings, $value ) {
	$param_line = '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value dropdown wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '">';

	$options = array(
		'none',
		'load more',
		'pagination',
	);
	foreach ( $options as $option ) {
		$selected = '';
		if ( $option == $value ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
	}
	$param_line .= '</select>';

	return $param_line;
}

if ( function_exists( 'vc_add_shortcode_param' ) ) {
	vc_add_shortcode_param( 'arrowpress_animation_type', 'arrowpress_vc_animation_type_field' );
}
function arrowpress_vc_animation_type_field( $settings, $value ) {
	$param_line = '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value dropdown wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '">';

	$param_line .= '<option value="">none</option>';

	$param_line .= '<optgroup label="' . __( 'Attention Seekers', 'arrowpress-core' ) . '">';
	$options    = array( "bounce", "flash", "pulse", "rubberBand", "shake", "swing", "tada", "wobble" );
	foreach ( $options as $option ) {
		$selected = '';
		if ( $option == $value ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
	}
	$param_line .= '</optgroup>';

	$param_line .= '<optgroup label="' . __( 'Bouncing Entrances', 'arrowpress-core' ) . '">';
	$options    = array( "bounceIn", "bounceInDown", "bounceInLeft", "bounceInRight", "bounceInUp" );
	foreach ( $options as $option ) {
		$selected = '';
		if ( $option == $value ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
	}
	$param_line .= '</optgroup>';

	$param_line .= '<optgroup label="' . __( 'Bouncing Exits', 'arrowpress-core' ) . '">';
	$options    = array( "bounceOut", "bounceOutDown", "bounceOutLeft", "bounceOutRight", "bounceOutUp" );
	foreach ( $options as $option ) {
		$selected = '';
		if ( $option == $value ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
	}
	$param_line .= '</optgroup>';

	$param_line .= '<optgroup label="' . __( 'Fading Entrances', 'arrowpress-core' ) . '">';
	$options    = array( "fadeIn", "fadeInDown", "fadeInDownBig", "fadeInLeft", "fadeInLeftBig", "fadeInRight", "fadeInRightBig", "fadeInUp", "fadeInUpBig" );
	foreach ( $options as $option ) {
		$selected = '';
		if ( $option == $value ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
	}
	$param_line .= '</optgroup>';

	$param_line .= '<optgroup label="' . __( 'Fading Exits', 'arrowpress-core' ) . '">';
	$options    = array( "fadeOut", "fadeOutDown", "fadeOutDownBig", "fadeOutLeft", "fadeOutLeftBig", "fadeOutRight", "fadeOutRightBig", "fadeOutUp", "fadeOutUpBig" );
	foreach ( $options as $option ) {
		$selected = '';
		if ( $option == $value ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
	}
	$param_line .= '</optgroup>';

	$param_line .= '<optgroup label="' . __( 'Flippers', 'arrowpress-core' ) . '">';
	$options    = array( "flip", "flipInX", "flipInY", "flipOutX", "flipOutY" );
	foreach ( $options as $option ) {
		$selected = '';
		if ( $option == $value ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
	}
	$param_line .= '</optgroup>';

	$param_line .= '<optgroup label="' . __( 'Lightspeed', 'arrowpress-core' ) . '">';
	$options    = array( "lightSpeedIn", "lightSpeedOut" );
	foreach ( $options as $option ) {
		$selected = '';
		if ( $option == $value ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
	}
	$param_line .= '</optgroup>';

	$param_line .= '<optgroup label="' . __( 'Rotating Entrances', 'arrowpress-core' ) . '">';
	$options    = array( "rotateIn", "rotateInDownLeft", "rotateInDownRight", "rotateInUpLeft", "rotateInUpRight" );
	foreach ( $options as $option ) {
		$selected = '';
		if ( $option == $value ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
	}
	$param_line .= '</optgroup>';

	$param_line .= '<optgroup label="' . __( 'Rotating Exits', 'arrowpress-core' ) . '">';
	$options    = array( "rotateOut", "rotateOutDownLeft", "rotateOutDownRight", "rotateOutUpLeft", "rotateOutUpRight" );
	foreach ( $options as $option ) {
		$selected = '';
		if ( $option == $value ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
	}
	$param_line .= '</optgroup>';

	$param_line .= '<optgroup label="' . __( 'Sliding Entrances', 'arrowpress-core' ) . '">';
	$options    = array( "slideInUp", "slideInDown", "slideInLeft", "slideInRight" );
	foreach ( $options as $option ) {
		$selected = '';
		if ( $option == $value ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
	}
	$param_line .= '</optgroup>';

	$param_line .= '<optgroup label="' . __( 'Sliding Exit', 'arrowpress-core' ) . '">';
	$options    = array( "slideOutUp", "slideOutDown", "slideOutLeft", "slideOutRight" );
	foreach ( $options as $option ) {
		$selected = '';
		if ( $option == $value ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
	}
	$param_line .= '</optgroup>';

	$param_line .= '<optgroup label="' . __( 'Specials', 'arrowpress-core' ) . '">';
	$options    = array( "hinge", "rollIn", "rollOut" );
	foreach ( $options as $option ) {
		$selected = '';
		if ( $option == $value ) {
			$selected = ' selected="selected"';
		}
		$param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
	}
	$param_line .= '</optgroup>';

	$param_line .= '</select>';

	return $param_line;
}

function arrowpress_print_button_shortcode( $atts ) {
	return '<a class="print-link" href="javascript:window.print()">' . '<i class="fa fa-print" aria-hidden="true"></i>' . esc_html__( 'Print', 'arrowpress-core' ) . '</a>';
}

add_shortcode( 'print_button', 'arrowpress_print_button_shortcode' );
