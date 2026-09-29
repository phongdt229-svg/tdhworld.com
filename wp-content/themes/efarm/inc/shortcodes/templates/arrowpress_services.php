<?php
$output = $title = $description = $title_color = $desc_color = $link = $el_class = $layout_style = '';
extract(
	shortcode_atts( array(
		'layout_style'     => 'style_1',
		'title'            => '',
		'description'      => '',
		'number_title'     => '',
		'btn_text'         => __( 'ion-android-arrow-forward', 'arrowpress' ),
		'btn_style'        => 'btn_style_1',
		'title_color'      => '',
		'desc_color'       => '',
		'bg_color_content' => '',
		'text_align'       => '',
		'image'            => '',
		'link'             => '#',
		'el_class'         => ''
	), $atts )
);
$href     = vc_build_link( $link );
$el_class = arrowpress_shortcode_extract_class( $el_class );

$layout_class = '';
if ( $layout_style == 'style_2' ) {
	$layout_class = ' style2';
} elseif ( $layout_style == 'style_3' ) {
	$layout_class = ' style3';
} else {
	$layout_class = ' style1';
}
$bgImage   = wp_get_attachment_url( $image );
$btn_class = '';
if ( $btn_style == 'btn_style_2' ) {
	$btn_class = ' btn-primary';
} elseif ( $btn_style == 'btn_style_3' ) {
	$btn_class = ' btn-black';
} elseif ( $btn_style == 'btn_style_4' ) {
	$btn_class = ' btn-circle';
} else {
	$btn_class = ' btn-default';
}

$color_1 = '';
$color_2 = '';
$bg_1    = '';
if ( ( $title_color != '' ) || ( $desc_color != '' ) ) {
	$color_1 .= 'style="color:' . esc_attr( $title_color ) . '"';
	$color_2 .= 'style="color:' . esc_attr( $desc_color ) . '"';
}
if ( ( $bg_color_content != '' ) ) {
	$bg_1 .= 'style="background:' . esc_attr( $bg_color_content ) . '"';
}
$output = '<div class="service-content' . $el_class . $layout_class . '"';
$output .= '>';
ob_start();
?>
	<div class="service-box
		<?php if ( $text_align == 'center' ) {
		echo 'text-center';
	} ?>
		<?php if ( $text_align == 'left' ) {
		echo 'text-left';
	} ?>
		<?php if ( $text_align == 'right' ) {
		echo 'text-right';
	} ?>" <?php echo $bg_1; ?>>
		<?php if ( $href && $href['url'] != '' ): ?>
		<a href="<?php echo esc_url( $href['url'] ); ?>">
			<?php endif; ?>
			<?php if ( $image != '' ): ?>
				<div class="service-img">
					<img src="<?php echo $bgImage; ?>" alt=""/>
				</div>
			<?php endif; ?>
			<?php if ( $title != '' ): ?>
				<div class="service-title">
					<h4 <?php echo $color_1; ?>><?php echo $title; ?></h4>
				</div>
			<?php endif; ?>
			<div class="service-desc">
				<p <?php echo $color_2; ?>><?php echo $description; ?></p>
			</div>
			<?php if ( $href && $href['url'] != '' ): ?>
		</a>
	<?php endif; ?>

	</div>
<?php
$output .= ob_get_clean();
$output .= '</div>' . arrowpress_shortcode_end_block_comment( 'arrowpress_services' ) . "\n";

echo $output;


wp_reset_postdata();
