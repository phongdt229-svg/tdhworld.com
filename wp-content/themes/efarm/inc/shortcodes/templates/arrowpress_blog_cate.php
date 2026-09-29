<?php
$output = $number = $category_parent = $css = $el_class = '';
extract(
	shortcode_atts( array(
		'number'              => 8,
		'post_display_type'   => '',
		'order'               => 'desc',
		'orderby'             => 'date',
		'slides_on_desk'      => 4,
		'slides_on_tabs'      => 3,
		'slides_on_mob'       => 2,
		'slides_on_mob_small' => 1,
		'el_class'            => '',
		'css'                 => '',
	), $atts )
);

$slide_id  = 'blog_' . wp_rand();
$el_class  = arrowpress_shortcode_extract_class( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'arrowpress_blog_cate', $atts );


ob_start();
$output .= '<div class="blog-categories' . esc_attr( $el_class ) . esc_attr( $css_class ) . '">';
?>

<?php

$taxonomy = 'category';
$terms    = get_terms( $taxonomy ); // Get all terms of a taxonomy

if ( $terms && ! is_wp_error( $terms ) ) :
	?>
	<div id="<?php echo $slide_id; ?>" class="blog-category">
		<?php foreach ( $terms as $term ) { ?>
			<div class="blog-cat-content">
				<div class="cate-img">
					<img src="<?php if ( function_exists( 'bonfire_taxonomy_image_url' ) ) {
						echo bonfire_taxonomy_image_url( $term->term_id, null, false );
					} else {
						echo '<img src="/worcester/wp-content/uploads/sites/2/2016/04/placeholder-photosize.jpg" />';
					} ?>" alt=""/>
					<div class="view-cate">
						<a href="<?php echo get_term_link( $term->slug, $taxonomy ); ?>"><i class="ion-plus"></i></a>
					</div>
				</div>
				<div class="blog-cate">
					<div class="name-cate">
						<a href="<?php echo get_term_link( $term->slug, $taxonomy ); ?>"><?php echo $term->name; ?></a>
					</div>
					<div class="count-post">
						<p><?php echo esc_html( '(', 'bonfire' ); ?><?php echo $count = $term->count; ?><?php echo esc_html( 'post)', 'bonfire' ); ?></p>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
<?php endif; ?>
	<script type="text/javascript">
		jQuery(function ($) {
			$("#<?php echo esc_js( $slide_id ); ?>").slick({
				nextArrow     : '<button class="btn-prev"><i class="ion-ios-arrow-right"></i></button>',
				prevArrow     : '<button class="btn-next"><i class="ion-ios-arrow-left"></i></button>',
				slidesToShow  : <?php echo $slides_on_desk; ?>,
				slidesToScroll: 1,
				dots          : false,
				arrows        : true,
				infinite      : true,
				speed         : 300,
				responsive    : [
					{
						breakpoint: 1200,
						settings  : {
							slidesToShow: <?php echo $slides_on_tabs; ?>,
						}
					},
					{
						breakpoint: 768,
						settings  : {
							slidesToShow: <?php echo $slides_on_mob; ?>,
						}
					},
					{
						breakpoint: 481,
						settings  : {
							slidesToShow: <?php echo $slides_on_mob_small; ?>,
						}
					}
				]
			});
		});
	</script>
<?php
$output .= ob_get_clean();

$output .= '</div>' . arrowpress_shortcode_end_block_comment( 'arrowpress_blog_cate' ) . "\n";
echo $output;

wp_reset_postdata();
