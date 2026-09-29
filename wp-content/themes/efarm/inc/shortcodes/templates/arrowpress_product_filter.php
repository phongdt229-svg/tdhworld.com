<?php
$output = $number = $first_title = $show_title = $slug_name = $load_more = $btn_text = $product_style = $last_title = $item_delay = $el_class = $exclude_cat = '';
extract(
	shortcode_atts( array(
		'colunms'             => 4,
		'category_parent'     => 0,
		'exclude_cat'         => '',
		'order'               => 'desc',
		'show_filter'         => 'yes',
		'btn_text'            => '',
		'slug_name'           => '',
		'view_more'           => 'yes',
		'product_style'       => '',
		'number'              => 8,
		'show_all'            => 'yes',
		'item_delay'          => 'yes',
		'link'                => '',
		'el_class'            => '',
		'filter_color'        => '',
		'filter_size'         => '',
		'filter_border_color' => '',
		'filter_border_style' => '',
	), $atts )
);
$href          = vc_build_link( $link );
$btn_text      = $btn_text != '' ? $btn_text : esc_html__( 'Visit store', 'arrowpress-core' );
$class_columns = '';
if ( $colunms == '1' ) {
	$class_columns = ' columns-1';
} elseif ( $colunms == '2' ) {
	$class_columns = ' columns-2';
} elseif ( $colunms == '3' ) {
	$class_columns = ' columns-3';
} else {
	$class_columns = ' columns-4';
}
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}
if ( class_exists( 'WooCommerce' ) ) {
	$meta_query = WC()->query->get_meta_query();
	$args       = array(
		'paged'               => $paged,
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		'posts_per_page'      => $number,
		'meta_query'          => $meta_query,
		'order'               => $order,
		'product_cat'         => $slug_name
	);
}
$id = '';
if ( $slug_name != '' ) {
	$idObj = get_term_by( 'slug', $slug_name, 'product_cat' );
	$id    = $idObj->term_id;
}
$dataAttr = ' data-isotope="1"';
if ( isset( $show_filter ) && $show_filter ) {
	$dataAttr .= ' data-filter="yes"';
}
if ( $category_parent || $exclude_cat || $id != '' ) {
	if ( $id != '' && ( $category_parent == '' || $category_parent == '0' ) ) {
		$catArray = explode( ',', $id );
	} else {
		$catArray = explode( ',', $category_parent );
	}
	if ( $exclude_cat != '' ) {
		$exclude_cat_a       = explode( ',', $exclude_cat );
		$args['tax_query']   = array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $catArray,
			),
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $exclude_cat_a,
				'operator' => 'NOT IN',
			),
		);
		$args['product_cat'] = $slug_name;
	} else {
		$args['tax_query']   = array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $catArray,
			),
		);
		$args['product_cat'] = $slug_name;
	}
}
if ( ( $category_parent == '' || $category_parent == '0' ) && $id != '' ) {
	$category_parent_id = $id;
} else {
	$category_parent_id = $category_parent;
}
$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, array( 'per_page' => $number ) ) );
$el_class = arrowpress_shortcode_extract_class( $el_class );
$output   = '<div class="product-filter-isotope ' . $el_class . '"';
$output   .= '>';
ob_start();
// ============Style inline for description text=============//
$filter_style         = '';
$filter_final_style   = '';
$filter_style_array[] = '';
if ( $filter_border_style != '' ) {
	$filter_style_array[] .= 'border-style:' . esc_attr( $filter_border_color ) . '';
}
if ( $filter_color != '' ) {
	$filter_style_array[] .= 'color:' . esc_attr( $filter_color ) . '';
}
if ( $filter_size != '' ) {
	$filter_style_array[] .= 'font-size:' . esc_attr( $filter_size ) . 'px';
}
if ( $filter_border_color != '' ) {
	$filter_style_array[] .= 'border-color:' . esc_attr( $filter_border_color ) . '';
}
if ( is_array( $filter_style_array ) || is_object( $filter_style_array ) ) {
	foreach ( $filter_style_array as $attribute ) {
		if ( $attribute != '' ) {
			$filter_style .= $attribute . '; ';
		}
	}
}
if ( $filter_style != '' ) {
	$filter_final_style = 'style="' . $filter_style . '"';
}

if ( $products->have_posts() ) {
	$taxonomy_names = get_object_taxonomies( 'product' );
	if ( is_array( $taxonomy_names ) && count( $taxonomy_names ) > 0 && in_array( 'product_cat', $taxonomy_names ) ) {
		if ( $exclude_cat != '' ) {
			$exclude_cat_a = explode( ',', $exclude_cat );
			$terms         = get_terms( 'product_cat', array(
				'hierarchical' => false,
				'hide_empty'   => true,
				'parent'       => $category_parent_id,
				'order'        => 'random',
				'exclude'      => $exclude_cat_a,
			) );
		} else {
			$terms = get_terms( 'product_cat', array(
				'hierarchical' => false,
				'hide_empty'   => true,
				'parent'       => $category_parent_id,
				'order'        => 'random',
			) );
		}
	}
	?>
	<?php
	$count_item      = 0.2;
	$animation_delay = '';
	if ( $item_delay ) {
		$animation_delay = ' data-sr="wait ' . $count_item . 's"';
	}
	$count_item += 0.2;
	?>
	<div class="our-products product_type_2">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<?php if ( $show_filter && is_array( $terms ) && count( $terms ) > 0 ) : ?>
					<div class="tabs-fillter">
						<ul class="nav nav-tabs btn-filter">
							<?php if ( $show_all ) : ?>
								<li><a <?php echo $filter_final_style; ?> class="button active"
																		  data-filter="*"><?php echo esc_html__( 'All', 'arrowpress-core' ); ?></a>
								</li>
							<?php endif; ?>
							<?php foreach ( $terms as $term ) : ?>
								<?php
								$apr_filter_active       = get_term_meta( $term->term_id, 'arrowpress_core_checkbox' );
								$apr_filter_active_class = '';
								if ( ! empty( $apr_filter_active ) ) {
									$apr_filter_active_class = "active_cat active";
								}
								?>
								<li><a <?php echo $filter_final_style; ?>
										class="button <?php echo esc_attr( $apr_filter_active_class ); ?>"
										data-filter=".<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				<div class="our-products-content tab-sorts woocommerce<?php echo esc_attr( $class_columns ); ?>">
					<div class="product-grid product-entries-wrap isotope">
						<?php while ( $products->have_posts() ) : $products->the_post(); ?>
							<?php wc_get_template_part( 'content', 'product' ); ?>
						<?php endwhile; ?>
					</div>
				</div>
				<?php if ( $view_more ) : ?>
					<?php if ( $href && $href['url'] != '' ): ?>
						<div class="btn-viewmore text-center">
							<a class="view_more btn btn-primary"
							   href="<?php echo esc_url( $href['url'] ); ?>"><?php echo esc_html( $btn_text ); ?></a>
						</div>
					<?php else: ?>
						<div class="btn-viewmore text-center">
							<a class="view_more btn btn-primary"
							   href="<?php echo get_post_type_archive_link( 'product' ); ?>"><?php echo esc_html( $btn_text ); ?></a>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php
} else {
	echo esc_html__( 'No product to display', 'arrowpress-core' );
}
$output .= ob_get_clean();

$output .= '</div>' . arrowpress_shortcode_end_block_comment( 'arrowpress_product_filter' ) . "\n";

echo $output;

wp_reset_postdata();
