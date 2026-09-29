<?php
if ( class_exists( 'WooCommerce' ) ) {
	$output  = $title = $orderby = $parent = $pad_count = $order = $hide_empty = $btn_text = $dis_img = $bg_hcolor = $bg_color = $title_color = $el_class = $ex_cat = '';
	$number  = 6;
	$columns = 3;
	extract(
		shortcode_atts( array(
			'parent'           => '',
			'number'           => 6,
			'ex_cat'           => '',
			'columns'          => 3,
			'orderby'          => 'date',
			'order'            => 'desc',
			'view_more'        => 'yes',
			'hide_empty'       => 'yes',
			'btn_text'         => '',
			'pad_count'        => '',
			'dis_img'          => 'yes',
			'el_class'         => '',
			'title_color'      => '',
			'background_color' => '',
			'bg_hcolor'        => '',
			'title_hcolor'     => '',
		), $atts )
	);
	$id           = '';
	$el_class     = arrowpress_shortcode_extract_class( $el_class );
	$hide_empty_v = $hide_empty == 'yes' ? true : false;
	$pad_count_v  = $pad_count == 'yes' ? true : false;
	if ( $parent != '' ) {
		if ( $parent == '0' ) {
			$id = '';
		} else {
			$idObj = get_term_by( 'slug', $parent, 'product_cat' );
			if ( isset( $idObj ) && $idObj != '' ) {
				$id = $idObj->term_id;
			}
		}
	}
	// get terms and workaround WP bug with parents/pad counts
	if ( $id != '' ) {
		if ( $ex_cat != '' ) {
			$args = array(
				'orderby'    => $orderby,
				'order'      => $order,
				'hide_empty' => $hide_empty_v,
				'pad_counts' => $pad_count_v,
				'child_of'   => $id,
				'taxonomy'   => 'product_cat',
				'number'     => $number,
				'exclude'    => $ex_cat,
			);
		} else {
			$args = array(
				'orderby'    => $orderby,
				'order'      => $order,
				'hide_empty' => $hide_empty_v,
				'pad_counts' => $pad_count_v,
				'child_of'   => $id,
				'taxonomy'   => 'product_cat',
				'number'     => $number,
			);
		}
	} else {
		$args = array(
			'orderby'    => $orderby,
			'order'      => $order,
			'hide_empty' => $hide_empty_v,
			'pad_counts' => $pad_count_v,
			'taxonomy'   => 'product_cat',
			'number'     => $number,
		);
		if ( $parent == '0' ) {
			$args['parent'] = 0;
		}
		if ( $ex_cat != '' ) {
			$args['exclude'] = $ex_cat;
		}
	}
	$class  = 'apr-product-categories' . wp_rand();
	$output = '<div class="product-categories-shortcode wpb_content_element ' . $el_class . ' ' . $class . '"';
	$output .= '>';
	global $woocommerce_loop;

	$product_categories          = get_terms( $args );
	$columns_v                   = absint( $columns );
	$woocommerce_loop['columns'] = $columns_v;
	ob_start();
	//=============Style Inline for fig==================//
	$fig_inline_style = '';
	$fig_style_final  = '';
	$fig_style[]      = '';
	if ( $bg_hcolor != '' ) {
		$fig_style[] .= 'background:' . esc_attr( $bg_hcolor ) . '';
	}
	if ( $title_hcolor != '' ) {
		$fig_style[] .= 'color:' . esc_attr( $title_hcolor ) . '';
	}
	if ( count( $fig_style ) > 0 && ( is_array( $fig_style ) || is_object( $fig_style ) ) ) {
		foreach ( $fig_style as $attribute ) {
			if ( $attribute != '' ) {
				$fig_inline_style .= $attribute . '; ';
			}
		}
	}
	if ( $fig_inline_style != '' ) {
		$fig_style_final = 'style="' . $fig_inline_style . '"';
	}
	//=============Style Inline for title==================//
	$title_inline_style = '';
	$title_style_final  = '';
	$title_style[]      = '';
	if ( $title_color != '' ) {
		$title_style[] .= 'color:' . esc_attr( $title_color ) . '';
	}
	if ( count( $title_style ) > 0 && ( is_array( $title_style ) || is_object( $title_style ) ) ) {
		foreach ( $title_style as $attribute ) {
			if ( $attribute != '' ) {
				$title_inline_style .= $attribute . '; ';
			}
		}
	}
	if ( $title_inline_style != '' ) {
		$title_style_final = 'style="' . $title_inline_style . '"';
	}
	if ( $product_categories ) {
		woocommerce_product_loop_start();
		if ( $background_color != '' ): ?>
			<style type="text/css">
				.product-categories-shortcode.<?php echo $class; ?> li.product-category.product:before {
					background-color: <?php echo esc_attr($background_color);?>;
				}
			</style>
		<?php endif;
		foreach ( $product_categories as $category ) { ?>
			<li <?php wc_product_cat_class( '', $category ); ?>>
				<div class="prd_cat_count">
					<div class="prd_count_inner">
						<?php
						/**
						 * woocommerce_before_subcategory_title hook.
						 *
						 * @hooked woocommerce_subcategory_thumbnail - 10
						 */

						if ( $dis_img != 'no' ) {
							do_action( 'woocommerce_before_subcategory_title', $category );
						}

						?>
						<h3>
							<?php echo '<a ' . $title_style_final . ' href="' . get_term_link( $category, 'product_cat' ) . '">'; ?>
							<?php echo esc_html( $category->name ); ?><?php if ( $category->count > 0 ) {
								echo '<span class="hidden-ms hidden-md hidden-lg"> (' . esc_html( $category->count ) . ') </span>';
							}
							?>
							<?php echo '</a>'; ?>
						</h3>
						<div class="figcaption" <?php echo $fig_style_final; ?>>
							<?php if ( $category->count > 0 ) {
								echo '<p class="number_prds">' . esc_html( $category->count ) . '</p>';
							}
							?>
							<p class="name_prd"><?php echo esc_html( $category->name ) . ' ' . esc_html__( 'Products', 'efarm' ); ?></p>
							<div class="cat_link">
								<?php
								if ( $btn_text != '' ) {
									echo '<a class=" btn btn-border-white" href="' . get_term_link( $category, 'product_cat' ) . '">' . esc_html( $btn_text ) . '</a>';
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</li>
		<?php }
		woocommerce_product_loop_end();
		woocommerce_reset_loop();
	}
	?>
	<?php
	$output .= '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
	$output .= '</div>' . arrowpress_shortcode_end_block_comment( 'arrowpress_product_cate' ) . "\n";
	echo $output;
	wp_reset_postdata();
}
