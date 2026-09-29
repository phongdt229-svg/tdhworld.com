<?php
$output = $css = $el_class = '';
extract(
	shortcode_atts( array(
		'layout'            => 'layout1',
		'title_small'       => '',
		'title_big'         => '',
		'name_author'       => '',
		'description'       => '',
		'sign_img'          => '',
		'job_author'        => '',
		'image'             => '',
		'testimonial_align' => 'center',
		'name_color'        => '',
		'title_big_color'   => '',
		'title_small_color' => '',
		'desc_color'        => '',
		'job_color'         => '',
		'el_class'          => '',
		'css'               => '',
	), $atts )
);
$bgImage   = wp_get_attachment_url( $image );
$el_class  = arrowpress_shortcode_extract_class( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'arrowpress_testimonial', $atts );
$output    .= '<div class="testimonial-container ' . esc_html( $el_class ) . esc_html( $css_class ) . '">';
ob_start();
$wrap_class = '';
if ( $layout == 'layout2' ) {
	$wrap_class .= ' item_testimonial2 ';
} elseif ( $layout == 'layout3' ) {
	$wrap_class .= ' item_testimonial3 ';
} elseif ( $layout == 'layout4' ) {
	$wrap_class .= ' item_testimonial4 ';
} else {
	$wrap_class .= ' item_testimonial ';
}
$wrap_class .= ' text-' . $testimonial_align;
?>
	<div class="<?php echo esc_attr( $wrap_class ); ?>">
		<?php if ( $layout == 'layout1' ) : ?>
			<div class="caption_testimonial">
				<?php if ( $bgImage != '' ): ?>
					<figure>
						<img class="img-tes" src="<?php echo $bgImage; ?>" alt=""/>
					</figure>
				<?php endif; ?>
				<p class="item-desc"
					<?php if ( $desc_color != '' ): ?>
						style="color: <?php echo $desc_color; ?>"
					<?php endif; ?>
				><?php echo $description; ?></p>
				<div class="tes_info">
					<h6 class="tes_name" <?php if ( $name_color != '' ): ?>
						style="color: <?php echo $name_color; ?>"
					<?php endif; ?>
					><?php echo $name_author; ?></h6>
				</div>
			</div>
		<?php elseif ( $layout == 'layout3' ) : ?>
			<div class="caption_testimonial">
				<p class="item-desc"
					<?php if ( $desc_color != '' ): ?>
						style="color: <?php echo $desc_color; ?>"
					<?php endif; ?>
				><?php echo $description; ?>
				</p>
				<div class="tes_info">
					<?php if ( $bgImage != '' ): ?>
						<figure>
							<img class="img-tes" src="<?php echo $bgImage; ?>" alt=""/>
						</figure>
					<?php endif; ?>
					<div class="tes-author">
						<h6 class="tes_name" <?php if ( $name_color != '' ): ?>
							style="color: <?php echo $name_color; ?>"
						<?php endif; ?>
						><?php echo $name_author; ?></h6>
						<p class="job_name" <?php if ( $job_author != '' ): ?>
							style="color: <?php echo $job_color; ?>"
						<?php endif; ?>
						><?php echo $job_author; ?></p>
					</div>
				</div>
			</div>
		<?php elseif ( $layout == 'layout4' ) : ?>
			<div class="caption_testimonial">
				<?php if ( $bgImage != '' ): ?>
					<figure>
						<img class="img-tes" src="<?php echo $bgImage; ?>" alt=""/>
					</figure>
				<?php endif; ?>
				<p class="item-desc"
					<?php if ( $desc_color != '' ): ?>
						style="color: <?php echo $desc_color; ?>"
					<?php endif; ?>
				><?php echo $description; ?></p>
				<div class="tes_info">
					<h6 class="tes_name" <?php if ( $name_color != '' ): ?>
						style="color: <?php echo $name_color; ?>"
					<?php endif; ?>
					><?php echo $name_author; ?></h6>
				</div>
			</div>
		<?php else: ?>
			<div class="caption_testimonial">
				<div class="tes_title">
					<h5 class="tt-small" <?php if ( $title_small_color != '' ): ?>
						style="color: <?php echo $title_small_color; ?>"
					<?php endif; ?>
					><?php echo $title_small; ?></h5>
					<h2 class="tt-big" <?php if ( $title_big_color != '' ): ?>
						style="color: <?php echo $title_big_color; ?>"
					<?php endif; ?>
					><?php echo $title_big; ?></h2>
				</div>
				<p class="item-desc"
					<?php if ( $desc_color != '' ): ?>
						style="color: <?php echo $desc_color; ?>"
					<?php endif; ?>
				><?php echo $description; ?></p>
				<div class="tes_name">
					<h4 <?php if ( $name_color != '' ): ?>
						style="color: <?php echo $name_color; ?>"
					<?php endif; ?>
					><?php echo $name_author; ?></h4>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php
$output .= ob_get_clean();

$output .= '</div>' . arrowpress_shortcode_end_block_comment( 'arrowpress_testimonial' ) . "\n";
echo $output;


wp_reset_postdata();

