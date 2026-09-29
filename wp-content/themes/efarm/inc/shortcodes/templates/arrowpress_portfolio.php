<?php
$output = $number = $show_filter = $item_delay = $filter_color = $el_class = '';
extract(
	shortcode_atts( array(
		'number'         => 8,
		'big_title'      => '',
		'small_title'    => '',
		'cat'            => '',
		'filter_color'   => '',
		'order'          => 'desc',
		'layout'         => 'grid',
		'layout_style'   => 'layout_style_1',
		'columns'        => 3,
		'show_viewmore'  => '',
		'loadmore_style' => 'btn-style1',
		'show_filter'    => 'yes',
		'filter_align'   => 'center',
		'show_link'      => '',
		'show_space'     => 'yes',
		'space_top_btn'  => '',
		'item_delay'     => 'yes',
		'loadmore_text'  => esc_html__( 'View more projects', 'arrowpress-core' ),
		'el_class'       => ''
	), $atts )
);

$space_class = '';
if ( $show_space == 'yes' ) {
	$space_class = '';
} else {
	$space_class = ' no-space';
}
if ( $loadmore_style == 'btn-style3' ) {
	$btn_class = ' btn-black';
} elseif ( $loadmore_style == 'btn-style2' ) {
	$btn_class = ' btn-bg';
} else {
	$btn_class = ' btn-border';
}
$space_1 = '';
if ( $space_top_btn != '' ) {
	$space_1 .= 'style="margin-top:' . esc_attr( $space_top_btn ) . 'px"';
}
$layout_style_class = '';
if ( $layout_style == 'layout_style_4' ) {
	$layout_style_class = ' gallery-style4';
} elseif ( $layout_style == 'layout_style_3' ) {
	$layout_style_class = ' gallery-style3';
} elseif ( $layout_style == 'layout_style_2' ) {
	$layout_style_class = ' gallery-style2';
} else {
	$layout_style_class = ' gallery-style1';
}
if ( $layout == 'grid' ) {
	$layout_type_class = 'gallery-grid';
} elseif ( $layout == 'slide' ) {
	$layout_type_class = 'gallery-slide';
} elseif ( $layout == 'masonry_1' || $layout == 'masonry_2' || $layout == 'masonry_5' || $layout == 'masonry_6' ) {
	$layout_type_class = 'layout_packery';
} elseif ( $layout == 'masonry_3' || $layout == 'masonry_4' ) {
	$layout_type_class = 'layout_masonry';
}
if ( $layout == 'masonry_1' ) {
	$layout_masonry_type_class = 'masonry_type_1';
} elseif ( $layout == 'masonry_2' ) {
	$layout_masonry_type_class = 'masonry_type_2';
} elseif ( $layout == 'masonry_3' ) {
	$layout_masonry_type_class = 'masonry_type_3';
} elseif ( $layout == 'masonry_4' ) {
	$layout_masonry_type_class = 'masonry_type_4';
} elseif ( $layout == 'masonry_5' ) {
	$layout_masonry_type_class = 'masonry_type_5';
} elseif ( $layout == 'masonry_6' ) {
	$layout_masonry_type_class = 'masonry_type_6';
}
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}
$current_page = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
$args         = array(
	'post_type'           => 'gallery',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => $number,
	'paged'               => $paged,
	'order'               => $order,
	'orderby'             => 'date',
);
$catArray     = explode( ',', $cat );
if ( $cat ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'gallery_cat',
			'field'    => 'term_id',
			'terms'    => $catArray,
		),
	);
}
$taxonomy_names = get_object_taxonomies( 'gallery' );
if ( is_array( $taxonomy_names ) && count( $taxonomy_names ) > 0 && in_array( 'gallery_cat', $taxonomy_names ) ) {
	if ( $cat ) {
		$terms = get_terms( 'gallery_cat', array(
			'parent'     => $cat,
			'hide_empty' => true,
		) );
	} else {
		$terms = get_terms( array(
			'taxonomy'     => 'gallery_cat',
			'hide_empty'   => true,
			'parent'       => 0,
			'hierarchical' => false,
		) );
	}
}
query_posts( $args );
global $wp_query;
$el_class = arrowpress_shortcode_extract_class( $el_class );
$id       = 'arp_gallery-' . wp_rand();
$output   = '<div class="our-gallery-sc ' . $el_class . '" id="' . esc_html( $id ) . '"';
$output   .= '>';
ob_start();
if ( isset( $columns ) ) {
	$col_class = " col-" . $columns;
}
/**
 * Style inline
 **/
$filter_style_inline = '';
if ( $filter_color != '' ) {
	$filter_style_inline = 'style ="color: ' . esc_attr( $filter_color ) . '"';
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
<?php if ( have_posts() ) : ?>
	<?php if ( $show_filter ) : ?>
		<div class="gallery_header">
			<?php if ( $show_filter ): ?>
				<?php if ( is_array( $terms ) && count( $terms ) > 0 ) : ?>
					<div id="options" class="gallery_filter <?php if ( $filter_align == 'center' ) {
						echo 'text-center';
					} ?>
						<?php if ( $filter_align == 'left' ) {
						echo 'text-left';
					} ?>
						<?php if ( $filter_align == 'right' ) {
						echo 'text-right';
					} ?>">
						<div id="filters"
							 class="button-group js-radio-button-group" <?php echo $filter_style_inline; ?>>
							<?php if ( $filter_color != '' ): ?>
								<style type="text/css">
									#<?php echo $id;?> .button-group .inline-block:before {
										background: <?php echo esc_attr($filter_color);?>;
									}
								</style>
							<?php endif; ?>
							<div class="inline-block">
								<button class="is-checked btn-filter"
										data-filter="*"><?php echo esc_html__( 'All', 'apr' ); ?></button>
							</div>
							<?php foreach ( $terms as $key => $term ) : ?>
								<div class="inline-block">
									<button class="btn-filter"
											data-filter=".<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></button>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="tabs_sort <?php if ( $layout != 'slide' ) {
		echo 'gallery_sort';
	} ?> <?php echo esc_attr( $space_class ); ?> ">
		<div class="<?php if ( $layout != 'slide' ) {
			echo 'gallery-entries-wrap isotope';
		} ?> clearfix <?php echo esc_attr( $layout_style_class ) . ' ' . esc_attr( $layout_type_class ); ?>
			<?php if ( $layout == 'masonry_3' || $layout == 'masonry_4' || $layout == 'grid' ) {
			echo esc_attr( $col_class );
		} ?>
			<?php if ( $layout == 'masonry_1' || $layout == 'masonry_2' || $layout == 'masonry_3' || $layout == 'masonry_4' || $layout == 'masonry_5' || $layout == 'masonry_6' ) {
			echo esc_attr( $layout_masonry_type_class );
		} ?>">
			<?php if ( $layout == 'masonry_1' || $layout == 'masonry_2' || $layout == 'masonry_3' || $layout == 'masonry_4' || $layout == 'masonry_5' || $layout == 'masonry_6' ) : ?>
				<?php include( locate_template( 'templates/content-gallery-masonry_s1.php' ) ); ?>
			<?php elseif ( $layout == 'slide' ) : ?>
				<?php include( locate_template( 'templates/content-gallery-slide.php' ) ); ?>
			<?php else: ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if ( $layout_style == 'layout_style_3' || $layout == 'grid_2' ): ?>
						<?php get_template_part( 'templates/content', 'gallery-grid-2' ); ?>
					<?php else: ?>
						<?php get_template_part( 'templates/content', 'gallery-grid' ); ?>
					<?php endif; ?>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
	<?php if ( $show_viewmore ) : ?>
		<div <?php echo $animation_delay; ?> >
			<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<div class="load-more text-center" <?php echo $space_1; ?>>
					<a data-paged="<?php echo esc_attr( $current_page ) ?>"
					   data-totalpage="<?php echo esc_attr( $wp_query->max_num_pages ) ?>" id="gallery-loadmore"
					   class="btn btn-primary <?php echo esc_attr( $btn_class ); ?> "><?php echo esc_html( $loadmore_text ) ?> </a>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
<?php endif; ?>
<?php
$output .= ob_get_clean();

$output .= '</div>' . arrowpress_shortcode_end_block_comment( 'arrowpress_portfolio' ) . "\n";

echo $output;

wp_reset_query(); ?>
