<?php
$output = $number = $show_filter = $item_delay = $filter_color = $el_class = '';
extract(
	shortcode_atts( array(
		'number'     => 8,
		'cat'        => '',
		'order'      => 'desc',
		'layout'     => 'slide',
		'item_delay' => 'yes',
		'el_class'   => ''
	), $atts )
);
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}
$current_page = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
$args         = array(
	'post_type'           => 'recipe',
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
			'taxonomy' => 'recipe_cat',
			'field'    => 'term_id',
			'terms'    => $catArray,
		),
	);
}
$taxonomy_names = get_object_taxonomies( 'recipe' );
if ( is_array( $taxonomy_names ) && count( $taxonomy_names ) > 0 && in_array( 'recipe_cat', $taxonomy_names ) ) {
	if ( $cat ) {
		$terms = get_terms( 'recipe_cat', array(
			'parent'     => $cat,
			'hide_empty' => true,
		) );
	} else {
		$terms = get_terms( array(
			'taxonomy'     => 'recipe_cat',
			'hide_empty'   => true,
			'parent'       => 0,
			'hierarchical' => false,
		) );
	}
}
query_posts( $args );
global $wp_query;
$el_class = arrowpress_shortcode_extract_class( $el_class );
$id       = 'arp_recipe-' . wp_rand();
$output   = '<div class="our-recipe-sc ' . $el_class . '" id="' . esc_html( $id ) . '"';
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
	<?php if ( $layout == 'slide' ) : ?>
		<div class="recipe_sort">
			<div class="recipe-entries-wrap clearfix">
				<div class="recipe-gallery arrows-custom">
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="item">
							<div class="recipe-content">
								<?php if ( has_post_thumbnail() ) : ?>
									<figure class="recipe-image">
										<div class="recipe-img">
											<?php
											$attachment_id   = get_post_thumbnail_id();
											$apr_recipe_grid = apr_get_attachment( $attachment_id, 'apr_recipe_grid' );
											if ( ! empty( $apr_recipe_grid['src'] ) ):
												?>
												<img width="<?php echo esc_attr( $apr_recipe_grid['width'] ) ?>"
													 height="<?php echo esc_attr( $apr_recipe_grid['height'] ) ?>"
													 src="<?php echo esc_url( $apr_recipe_grid['src'] ) ?>"
													 alt="<?php echo esc_html__( 'recipe', 'bonfire' ) ?>"/>
											<?php endif; ?>
										</div>
									</figure>
								<?php endif; ?>
								<div class="recipe_body">
									<a href="<?php the_permalink(); ?>" class="gallery_title">
										<h2><?php the_title(); ?></h2></a>
									<div class="recipe_desc">
										<?php echo wpautop( get_the_content() ); ?>
									</div>
									<div class="read-more">
										<a href="<?php the_permalink(); ?>"
										   class="btn btn-primary"><?php echo esc_html__( 'Learn more', 'bonfire' ); ?></a>
									</div>
								</div>
								<div class="recipe_social">
									<ul>
										<li>
											<a href="<?php echo get_post_meta( get_the_ID(), 'facebook', true ); ?>"><?php echo esc_html__( 'Facebook', 'bonfire' ); ?></a>
										</li>
										<li>
											<a href="<?php echo get_post_meta( get_the_ID(), 'instagram', true ); ?>"><?php echo esc_html__( 'Instagram', 'bonfire' ); ?></a>
										</li>
										<li>
											<a href="<?php echo get_post_meta( get_the_ID(), 'twitter', true ); ?>"><?php echo esc_html__( 'Twitter', 'bonfire' ); ?></a>
										</li>
										<li>
											<a href="<?php echo get_post_meta( get_the_ID(), 'youtube', true ); ?>"><?php echo esc_html__( 'Youtube', 'bonfire' ); ?></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>
<?php
$output .= ob_get_clean();

$output .= '</div>' . arrowpress_shortcode_end_block_comment( 'arrowpress_recipe' ) . "\n";

echo $output;

wp_reset_query(); ?>
