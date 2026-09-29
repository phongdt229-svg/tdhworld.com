<?php
$output = $first_name = $job = $image = $layout = $style = $bg_image_infostyle = $layout_style = $show_socials = $css = $link = $facebook_link = $twitter_link = $title_color = $text_color = $sm_title_color = $instagram_link = $bg_image = $dribbble_link = $print_link = $text_link = $bg_type = $bg_main_color = $el_class = $disable_info_bg = '';
extract(
	shortcode_atts( array(
		'first_name'       => '',
		'job'              => '',
		'desc'             => '',
		'image'            => '',
		'images'           => '',
		'bg_main_color'    => '',
		'bg_hover'         => '',
		'bg_type'          => '',
		'bg_image'         => '',
		'layout'           => 'layout1',
		'el_class'         => '',
		'css'              => '',
		'style'            => '',
		'link_facebook'    => '#',
		'link_twitter'     => '#',
		'link_google'      => '#',
		'link_linked'      => '#',
		'job_color'        => '',
		'name_color'       => '',
		'name_hover_color' => '',
		'icon_color'       => '',
	), $atts )
);
$layout_class  = '';
$layout_class2 = '';
if ( $layout == 'layout1' ) {
	$layout_class = ' member-type1 ';
} else if ( $layout == 'layout3' ) {
	$layout_class = ' member-type1 style-2 ';
}
if ( $layout == 'layout2' ) {
	$layout_class2 = ' member-type2 ';
}
$href                = vc_build_link( $link );
$href_face           = vc_build_link( $link_facebook );
$href_twitter        = vc_build_link( $link_twitter );
$href_google         = vc_build_link( $link_google );
$href_linked         = vc_build_link( $link_linked );
$bgImage             = wp_get_attachment_url( $image );
$href['url']         = $href['url'] != '' ? $href['url'] : '#';
$href_face['url']    = $href_face['url'] != '' ? $href_face['url'] : '';
$href_twitter['url'] = $href_twitter['url'] != '' ? $href_twitter['url'] : '';
$href_google['url']  = $href_google['url'] != '' ? $href_google['url'] : '';
$href_linked['url']  = $href_linked['url'] != '' ? $href_linked['url'] : '';
$el_class            = arrowpress_shortcode_extract_class( $el_class );
if ( $bgImage != '' ) {
	$style .= ' style="background-image: url(' . $bgImage . ')"';
};
//Option for adding background image for member info
$bg_image_info = wp_get_attachment_url( $bg_image );
if ( $bg_image_info != '' && $bg_type == 'image' ) {
	$bg_image_infostyle .= ' style="background-image: url(' . $bg_image_info . ')"';
} else if ( $bg_type == 'color' ) {
	$bg_image_infostyle .= ' style="background: ' . $bg_main_color . '"';
} else if ( $bg_type == 'none' ) {
	$bg_image_infostyle .= ' style="background-image: none"';
}

/**
 * Style inline
 **/
$bg_main_color_style = $name_style_inline = $sm_style_i = $style_first_name_color = $icon_color_i = $bg_hover_style = $name_style_hover = '';
if ( $bg_hover != '' ) {
	$bg_hover_style = 'style ="color: ' . esc_attr( $bg_hover ) . '"';
}
if ( $name_color != '' ) {
	$name_style_inline = 'style ="color: ' . esc_attr( $name_color ) . '"';
}
if ( $name_hover_color != '' ) {
	$name_style_hover = 'style ="color: ' . esc_attr( $name_hover_color ) . '"';
}
if ( $job_color != '' ) {
	$sm_style_i = 'style ="color: ' . esc_attr( $job_color ) . '"';
}
if ( $icon_color != '' ) {
	$icon_color_i = 'style ="color: ' . esc_attr( $icon_color ) . '; border-color: ' . esc_attr( $icon_color ) . '"';
}
$id = 'arp_member-' . wp_rand();
ob_start();
?>
<?php
$output = '<div  class="' . esc_attr( $el_class ) . esc_attr( $layout_class ) . esc_attr( $layout_class2 ) . '" id="' . esc_html( $id ) . '"';
$output .= '>';
?>
<?php if ( $layout == 'layout2' ) : ?>
	<div class="item-member-content">
		<div class="member-img">
			<img src="<?php echo esc_url( $bgImage ); ?>" alt="img-member"/>
		</div>
		<div id="<?php echo $id; ?>" class="member-info text-center" <?php echo $bg_image_infostyle; ?>>
			<div class="member-name">
				<h4 <?php echo $name_style_inline; ?>><?php echo esc_html( $first_name ); ?></h4>
			</div>
			<div class="member-job" <?php echo $sm_style_i; ?>>
				<p><?php echo esc_html( $job ); ?></p>
			</div>
			<div class="member_social">
				<ul>
					<?php if ( $href_face['url'] != '' ): ?>
						<li><a <?php echo $icon_color_i; ?> href="<?php echo $href_face['url']; ?>"><i
									class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if ( $href_twitter['url'] != '' ): ?>
						<li><a <?php echo $icon_color_i; ?> href="<?php echo $href_twitter['url']; ?>"><i
									class="fa fa-x-twitter" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if ( $href_google['url'] != '' ): ?>
						<li><a <?php echo $icon_color_i; ?> href="<?php echo $href_google['url']; ?>"><i
									class="fa fa-google-plus" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if ( $href_linked['url'] != '' ): ?>
						<li><a <?php echo $icon_color_i; ?> href="<?php echo $href_linked['url']; ?>"><i
									class="fa fa-linkedin" aria-hidden="true"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
			<div class="member-desc" <?php echo $sm_style_i; ?>>
				<p><?php echo esc_html( $desc ); ?></p>
			</div>
		</div>

		<?php if ( $bg_hover != '' || $name_hover_color != '' ): ?>
			<style type="text/css">
				.item-member-content:hover #<?php echo $id; ?>.member-info {
					background: <?php echo esc_attr($bg_hover);?> !important;
				}

				.item-member-content:hover #<?php echo $id; ?> .member-name h4,
				.item-member-content:hover #<?php echo $id; ?>.member-info .member-job {
					color: <?php echo esc_attr($name_hover_color);?> !important;
				}
			</style>
		<?php endif; ?>
	</div>
<?php else: ?>
	<div class="item-member-content">
		<div class="member-img">
			<img src="<?php echo esc_url( $bgImage ); ?>" alt="img-member"/>
		</div>
		<div id="<?php echo $id; ?>" class="member-info text-center" <?php echo $bg_image_infostyle; ?>>
			<div class="member-name">
				<h4 <?php echo $name_style_inline; ?>><?php echo esc_html( $first_name ); ?></h4>
			</div>
			<div class="member-job" <?php echo $sm_style_i; ?>>
				<p><?php echo esc_html( $job ); ?></p>
			</div>
			<div class="member_social">
				<ul>
					<?php if ( $href_face['url'] != '' ): ?>
						<li><a <?php echo $icon_color_i; ?> href="<?php echo $href_face['url']; ?>"><i
									class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if ( $href_twitter['url'] != '' ): ?>
						<li><a <?php echo $icon_color_i; ?> href="<?php echo $href_twitter['url']; ?>"><i
									class="fa fa-x-twitter" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if ( $href_google['url'] != '' ): ?>
						<li><a <?php echo $icon_color_i; ?> href="<?php echo $href_google['url']; ?>"><i
									class="fa fa-google-plus" aria-hidden="true"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>

		<?php if ( $bg_hover != '' || $name_hover_color != '' ): ?>
			<style type="text/css">
				.item-member-content:hover #<?php echo $id; ?>.member-info {
					background: <?php echo esc_attr($bg_hover);?> !important;
				}

				.item-member-content:hover #<?php echo $id; ?> .member-name h4,
				 .item-member-content:hover #<?php echo $id; ?>.member-info .member-job {
					color: <?php echo esc_attr($name_hover_color);?> !important;
				}
			</style>
		<?php endif; ?>
	</div>
<?php endif; ?>
<?php
$output .= ob_get_clean();
$output .= '</div>' . arrowpress_shortcode_end_block_comment( 'arrowpress_member' ) . "\n";

echo $output;


wp_reset_postdata();
