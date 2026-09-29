<?php
$output = $image = $btn_text = $btn_layout = $text_align = $layout = $small_title = $big_title = $link = $el_class = $bg_content_color = $bg_hover_color = $icon_size = $title_color = $icon_color = $sm_title_color = $text_color = $overlay_bg = $color_bg = $top = $left = $en_overlay = $desc = $bottom_title_color = '';
extract(
	shortcode_atts( array(
		'layout'             => 'banner_style_1',
		'image'              => '',
		'text_align'         => 'center',
		'en_overlay'         => '',
		'small_title'        => '',
		'desc'               => '',
		'big_title'          => '',
		'title_color'        => '',
		'bottom_title_color' => '',
		'bg_overlay_color'   => '',
		'bg_hover_color'     => '',
		'sm_title_color'     => '',
		'overlay_bg'         => '',
		'bg_content_color'   => '',
		'btn_layout'         => 'btn_layout_2',
		'btn_text'           => __( 'Shop now', 'arrowpress-core' ),
		'btn_color'          => '',
		'btn_color_hover'    => '',
		'link'               => '#',
		'item_delay'         => '',
		'height_banner'      => '',
		'en_filter'          => '',
		'animation_type'     => '',
		'animation_delay'    => 500,
		'el_class'           => ''
	), $atts )
);
$href      = vc_build_link( $link );
$bgImage   = wp_get_attachment_url( $image );
$btn_class = '';
if ( $btn_layout == 'btn_layout_2' ) {
	$btn_class = ' btn-primary';
} elseif ( $btn_layout == 'btn_layout_3' ) {
	$btn_class = ' btn-black';
} elseif ( $btn_layout == 'btn_layout_4' ) {
	$btn_class = ' btn-white';
} elseif ( $btn_layout == 'btn_layout_5' ) {
	$btn_class = ' btn-noborder';
} else {
	$btn_class = ' btn-default';
}
$el_class = arrowpress_shortcode_extract_class( $el_class );
$id       = 'arp_banner-' . wp_rand();
$output   = '<div class="banner-container ' . esc_html( $el_class ) . '" id="' . esc_html( $id ) . '"';
$output   .= '>';
/**
 * Style inline
 **/
$title_style_inline = $bottom_title_style_inline = $sm_style_i = $icon_style_i = $bg_style_4 = '';
if ( $title_color != '' ) {
	$title_style_inline = 'style ="color: ' . esc_attr( $title_color ) . '"';
}
if ( $bottom_title_color != '' ) {
	$bottom_title_style_inline = 'style ="color: ' . esc_attr( $bottom_title_color ) . '"';
}
if ( $sm_title_color != '' ) {
	$sm_style_i = 'style ="color: ' . esc_attr( $sm_title_color ) . '"';
}
ob_start();

?>
<?php if ( $layout == 'banner_style_1' ): ?>
	<div id="<?php echo $id; ?>" class="banner-content banner-type1
		<?php if ( $text_align == 'center' ) {
		echo 'text-center';
	} ?>
		<?php if ( $text_align == 'left' ) {
		echo 'text-left';
	} ?>
		<?php if ( $text_align == 'right' ) {
		echo 'text-right';
	} ?>
		<?php if ( $en_overlay == 'yes' ) {
		echo 'en_overlay';
	} ?>
		<?php if ( $item_delay == 'yes' ) {
		echo 'animated show-animated';
	} ?>" data-animation-delay="<?php echo $animation_delay; ?>" data-animation="<?php echo $animation_type; ?>"
		 style="background-image: url('<?php echo $bgImage; ?>'); height:<?php echo $height_banner; ?>px;">
		<div class="banner-mid">
			<div class="banner-title">
				<a class="fancybox-thumb btn-plus" data-fancybox-group="fancybox-thumb"
				   href="<?php echo esc_url( $bgImage ); ?>" title="">
				</a>
				<?php if ( $big_title != '' ) : ?>
					<h2 <?php echo $title_style_inline; ?>><?php echo $big_title; ?></h2>
				<?php endif; ?>
				<?php if ( $small_title != '' && $layout == 'banner_style_1' ) : ?>
					<h3 <?php echo $sm_style_i; ?>><?php echo esc_html( $small_title ); ?></h3>
				<?php endif; ?>
			</div>
			<?php if ( $btn_text != '' ): ?>
				<div class="banner-btn">
					<a href="<?php echo $href['url']; ?>"
					   style="<?php if ( $btn_color != '' ): ?>color:<?php echo $btn_color; ?><?php endif; ?>"
					   class="btn<?php echo $btn_class; ?>">
						<?php echo $btn_text; ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( $bg_overlay_color != '' ): ?>
			<style type="text/css">
				#<?php echo $id; ?>.banner-type1:before {
					background-color: <?php echo esc_attr($bg_overlay_color);?>;
				}
			</style>
		<?php endif; ?>
	</div>
<?php elseif ( $layout == 'banner_style_2' ) : ?>
	<div class="banner-content banner-type2
		<?php if ( $text_align == 'center' ) {
		echo 'text-center';
	} ?>
		<?php if ( $text_align == 'left' ) {
		echo 'text-left';
	} ?>
		<?php if ( $text_align == 'right' ) {
		echo 'text-right';
	} ?>
		<?php if ( $item_delay == 'yes' ) {
		echo 'animated show-animated';
	} ?>" data-animation-delay="<?php echo $animation_delay; ?>" data-animation="<?php echo $animation_type; ?>"
		 style="background-color: <?php echo esc_html( $bg_content_color ); ?>; <?php if ( $height_banner != '' ): ?>height:<?php echo  $height_banner;?>px; <?php endif; ?>">
		<div class="banner-mid">
			<div class="banner-title">
				<?php if ( $small_title != '' ) : ?>
					<h3 <?php echo $sm_style_i; ?>><?php echo esc_html( $small_title ); ?></h3>
				<?php endif; ?>
				<?php if ( $big_title != '' ) : ?>
					<h2 <?php echo $title_style_inline; ?>><?php echo $big_title; ?></h2>
				<?php endif; ?>
			</div>
			<div class="banner-btn">
				<a href="<?php echo $href['url']; ?>" class="btn <?php echo $btn_class; ?>"
				   style="<?php if ( $btn_color != '' ): ?>color:<?php echo $btn_color; ?><?php endif; ?>">
					<?php echo $btn_text; ?>
				</a>
			</div>
			<div class="banner-img"><img src="<?php echo $bgImage;; ?>" alt=""></div>
		</div>
	</div>
<?php elseif ( $layout == 'banner_style_3' ) : ?>
	<div id="<?php echo $id; ?>" class="banner-content banner-type3
		<?php if ( $text_align == 'center' ) {
		echo 'text-center';
	} ?>
		<?php if ( $text_align == 'left' ) {
		echo 'text-left';
	} ?>
		<?php if ( $text_align == 'right' ) {
		echo 'text-right';
	} ?>
		<?php if ( $en_overlay == 'yes' ) {
		echo 'en_overlay';
	} ?>
		<?php if ( $item_delay == 'yes' ) {
		echo 'animated show-animated';
	} ?>" data-animation-delay="<?php echo $animation_delay; ?>" data-animation="<?php echo $animation_type; ?>"
		 style="background-image: url('<?php echo $bgImage; ?>'); <?php if ( $height_banner != '' ): ?>height:<?php echo  $height_banner;?>px; <?php endif; ?>">
		<div class="banner-mid">
			<div class="banner-title">
				<?php if ( $small_title != '' ) : ?>
					<h3 <?php echo $sm_style_i; ?>><?php echo esc_html( $small_title ); ?></h3>
				<?php endif; ?>
				<?php if ( $big_title != '' ) : ?>
					<h2 <?php echo $title_style_inline; ?>><?php echo $big_title; ?></h2>
				<?php endif; ?>
			</div>
			<div class="banner-btn">
				<a href="<?php echo $href['url']; ?>" class="btn <?php echo $btn_class; ?>"
				   style="<?php if ( $btn_color != '' ): ?>color:<?php echo $btn_color; ?><?php endif; ?>">
					<?php echo $btn_text; ?>
				</a>
			</div>
		</div>
		<?php if ( $bg_overlay_color != '' ): ?>
			<style type="text/css">
				#<?php echo $id; ?>.banner-type3:before {
					background-color: <?php echo esc_attr($bg_overlay_color);?>;
				}
			</style>
		<?php endif; ?>
		<?php if ( $btn_color_hover != '' ): ?>
			<style type="text/css">
				#<?php echo $id; ?>.banner-type3:hover .banner-btn .btn {
					color: <?php echo esc_attr($btn_color_hover); ?> !important;
				}
			</style>
		<?php endif; ?>
	</div>
<?php elseif ( $layout == 'banner_style_4' ) : ?>
	<div id="<?php echo $id; ?>" class="banner-content banner-type4
		<?php if ( $text_align == 'center' ) {
		echo 'text-center';
	} ?>
		<?php if ( $text_align == 'left' ) {
		echo 'text-left';
	} ?>
		<?php if ( $text_align == 'right' ) {
		echo 'text-right';
	} ?>
		<?php if ( $en_overlay == 'yes' ) {
		echo 'en_overlay';
	} ?>
		<?php if ( $item_delay == 'yes' ) {
		echo 'animated show-animated';
	} ?>" data-animation-delay="<?php echo $animation_delay; ?>" data-animation="<?php echo $animation_type; ?>"
		 style="background-color: <?php echo esc_html( $bg_content_color ); ?>;">
		<div class="banner-mid">
			<div class="banner-title">
				<?php if ( $big_title != '' ) : ?>
					<h2 <?php echo $title_style_inline; ?>><?php echo $big_title; ?></h2>
				<?php endif; ?>
				<?php if ( $small_title != '' ) : ?>
					<h3 <?php echo $sm_style_i; ?>><?php echo esc_html( $small_title ); ?></h3>
				<?php endif; ?>
			</div>
		</div>
		<?php if ( $image != '' ): ?>
			<style type="text/css">
				#<?php echo $id; ?>.banner-type4:before {
					background-image: url('<?php echo esc_attr($bgImage); ?>');
				}
			</style>
			<?php if ( $bg_overlay_color != '' ): ?>
				<style type="text/css">
					#<?php echo $id; ?>.banner-type4:before {
						background-color: <?php echo esc_attr($bg_overlay_color);?>;
					}
				</style>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php elseif ( $layout == 'banner_style_5' ) : ?>
	<div id="<?php echo $id; ?>" class="banner-content banner-type3 banner-type5
		<?php if ( $text_align == 'center' ) {
		echo 'text-center';
	} ?>
		<?php if ( $text_align == 'left' ) {
		echo 'text-left';
	} ?>
		<?php if ( $text_align == 'right' ) {
		echo 'text-right';
	} ?>
		<?php if ( $en_overlay == 'yes' ) {
		echo 'en_overlay';
	} ?>
		<?php if ( $item_delay == 'yes' ) {
		echo 'animated show-animated';
	} ?>" data-animation-delay="<?php echo $animation_delay; ?>" data-animation="<?php echo $animation_type; ?>"
		 style="background-image: url('<?php echo $bgImage; ?>');">
		<div class="banner-mid">
			<div class="banner-title">
				<?php if ( $small_title != '' ) : ?>
					<h3 <?php echo $sm_style_i; ?>><?php echo esc_html( $small_title ); ?></h3>
				<?php endif; ?>
				<?php if ( $big_title != '' ) : ?>
					<h2 <?php echo $title_style_inline; ?>><?php echo $big_title; ?></h2>
				<?php endif; ?>
			</div>
			<div class="banner-btn">
				<a href="<?php echo $href['url']; ?>" class="btn <?php echo $btn_class; ?>"
				   style="<?php if ( $btn_color != '' ): ?>color:<?php echo $btn_color; ?><?php endif; ?>">
					<?php echo $btn_text; ?>
				</a>
			</div>
		</div>
		<?php if ( $bg_overlay_color != '' ): ?>
			<style type="text/css">
				#<?php echo $id; ?>.banner-type3:before {
					background-color: <?php echo esc_attr($bg_overlay_color);?>;
				}
			</style>
		<?php endif; ?>
		<?php if ( $btn_color_hover != '' ): ?>
			<style type="text/css">
				#<?php echo $id; ?>.banner-type3:hover .banner-btn .btn {
					color: <?php echo esc_attr($btn_color_hover); ?> !important;
				}
			</style>
		<?php endif; ?>
	</div>
<?php elseif ( $layout == 'banner_style_6' ) : ?>
	<div class="banner-content banner-type6
		<?php if ( $text_align == 'center' ) {
		echo 'text-center';
	} ?>
		<?php if ( $text_align == 'left' ) {
		echo 'text-left';
	} ?>
		<?php if ( $text_align == 'right' ) {
		echo 'text-right';
	} ?>
		<?php if ( $item_delay == 'yes' ) {
		echo 'animated show-animated';
	} ?>" data-animation-delay="<?php echo $animation_delay; ?>" data-animation="<?php echo $animation_type; ?>">
		<div class="banner-img"><img src="<?php echo $bgImage;; ?>" alt=""></div>
		<div class="banner-mid">
			<div class="banner-title">
				<?php if ( $small_title != '' ) : ?>
					<h3 <?php echo $sm_style_i; ?>><?php echo esc_html( $small_title ); ?></h3>
				<?php endif; ?>
				<?php if ( $big_title != '' ) : ?>
					<h2 <?php echo $title_style_inline; ?>><?php echo $big_title; ?></h2>
				<?php endif; ?>
			</div>
			<div class="banner-btn">
				<a href="<?php echo $href['url']; ?>" class="btn <?php echo $btn_class; ?>"
				   style="<?php if ( $btn_color != '' ): ?>color:<?php echo $btn_color; ?><?php endif; ?>">
					<?php echo $btn_text; ?>
				</a>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php
$output .= ob_get_clean();
$output .= '</div>' . arrowpress_shortcode_end_block_comment( 'arrowpress_banner' ) . "\n";

echo $output;


wp_reset_postdata();
