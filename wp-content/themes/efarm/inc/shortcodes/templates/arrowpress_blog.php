<?php
$output = $number = $layout = $cat = $slug_name = $items_desktop_large = $items_desktop = $items_tablets = $items_mobile = $row_number = $el_class = '';
extract(
	shortcode_atts( array(
		'number'               => 3,
		'layout'               => 'grid_style_1',
		'layout_style'         => 'layout_style_1',
		'sticky_post'          => 'sticky_post_1',
		'filter_align'         => 'left',
		'image_type'           => 1,
		'post_display_type'    => '',
		'cat'                  => '',
		'show_filter'          => 'yes',
		'show_spacer'          => 'yes',
		'show_viewmore'        => '',
		'show_loadmore'        => '',
		'space_top_btn'        => '',
		'slug_name'            => '',
		'order'                => 'desc',
		'orderby'              => 'date',
		'items_desktop_large'  => 3,
		'items_desktop'        => 3,
		'items_tablets'        => 2,
		'items_mobile'         => 1,
		'style'                => '',
		'el_class'             => '',
		'color_default'        => '',
		'big_title_size'       => '',
		'big_title_lh'         => '',
		'big_use_theme_fonts'  => '',
		'big_google_fonts'     => '',
		'desc_size'            => '',
		'desc_lh'              => '',
		'desc_use_theme_fonts' => '',
		'desc_google_fonts'    => '',
		'desc_color'           => '',
		'info_color'           => '',
		'readmore_link'        => 'Read more',
		'viewmore_text'        => 'Go to blog',
		'viewmore_link'        => '',
		'css'                  => ''
	), $atts )
);

$layout_class = '';
if ( $layout == 'grid_style_2' ) {
	$layout_class = 'grid_style_2 blog-grid';
} elseif ( $layout == 'grid_style_3' ) {
	$layout_class = 'grid_style_3 blog-grid';
} elseif ( $layout == 'grid_style_4' ) {
	$layout_class = 'grid_style_4 blog-grid';
} elseif ( $layout == 'grid_style_5' ) {
	$layout_class = 'grid_style_5 blog-grid';
} elseif ( $layout == 'packery_style_1' ) {
	$layout_class = 'blog-entries-wrap grid-isotope blog-packery';
} else {
	$layout_class = 'blog-grid grid_style_1';
}
$layout_style_class = '';
if ( $layout_style == 'layout_style_2' ) {
	$layout_style_class = ' blog-style2';
} else {
	$layout_style_class = ' blog-style1';
}
if ( $viewmore_link != '' ) {
	$viewmore_link = $viewmore_link;
} else {
	$viewmore_link = get_post_type_archive_link( 'post' );
}
$show_spacer_class = '';
if ( $show_spacer == 'yes' ) {
	$show_spacer_class = ' show-space';
} else {
	$show_spacer_class = ' no-space';
}
$space_1 = '';
if ( $space_top_btn != '' ) {
	$space_1 .= 'style="margin-top:' . esc_attr( $space_top_btn ) . 'px"';
}
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}
$current_page = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

if ( $post_display_type == 'featured' ) {
	$args = array(
		'paged'          => $paged,
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'meta_key'       => 'special_box_check',
		'order'          => $order,
		'orderby'        => $orderby,
		'posts_per_page' => $number,
		'category_name'  => $slug_name
	);
} else if ( $post_display_type == 'most-viewed' ) {
	$args = array(
		'paged'          => $paged,
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'meta_key'       => 'post_views_count',
		'orderby'        => 'meta_value_num',
		'order'          => $order,
		'posts_per_page' => $number,
		'category_name'  => $slug_name
	);
} else {
	$args = array(
		'paged'          => $paged,
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'order'          => $order,
		'orderby'        => $orderby,
		'posts_per_page' => $number,
		'category_name'  => $slug_name
	);
}
$catArray = explode( ',', $cat );
if ( $cat ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => $catArray,
		),
	);
}
$taxonomy_names = get_object_taxonomies( 'post' );
if ( is_array( $taxonomy_names ) && count( $taxonomy_names ) > 0 && in_array( 'category', $taxonomy_names ) ) {
	if ( $cat ) {
		$terms = get_terms( 'category', array(
			'parent'     => $cat,
			'hide_empty' => true,
		) );
	} else {
		$terms = get_terms( array(
			'taxonomy'     => 'category',
			'hide_empty'   => true,
			'parent'       => 0,
			'hierarchical' => false,
		) );
	}
}
query_posts( $args );
global $wp_query;

$items_desktop_large_no = 12 / $items_desktop_large;
$items_desktop_no       = 12 / $items_desktop;
$items_tablets_no       = 12 / $items_tablets;
$items_mobile_no        = 12 / $items_mobile;

$blog = new WP_Query( $args );
//=============Style Inline for Blog title==================//
$big_inline_style       = '';
$big_title_style_inline = '';
$big_text_font_data     = arrowpress_getFontsData( $big_google_fonts );
// Build the inline style
$big_inline_style .= arrowpress_googleFontsStyles( $big_text_font_data );

// Enqueue the right font
if ( ( isset( $big_use_theme_fonts ) || 'yes' === $big_use_theme_fonts ) ) {
	arrowpress_enqueueGoogleFonts( $big_text_font_data );
}
$big_title_style[] = '';
if ( $color_default != '' ) {
	$big_title_style[] .= 'color:' . esc_attr( $color_default ) . '';
}
if ( $big_title_size != '' ) {
	$big_title_style[] .= 'font-size:' . esc_attr( $big_title_size ) . 'px';
}
if ( $big_title_lh != '' ) {
	$big_title_style[] .= 'line-height:' . esc_attr( $big_title_lh ) . 'px';
}

if ( count( $big_title_style ) > 0 && ( is_array( $big_title_style ) || is_object( $big_title_style ) ) ) {
	foreach ( $big_title_style as $attribute ) {
		if ( $attribute != '' ) {
			$big_inline_style .= $attribute . '; ';
		}
	}
}
if ( $big_inline_style != '' ) {
	$big_title_style_inline = 'style="' . $big_inline_style . '"';
}
//=============Style Inline for Blog descrition ==================//
$desc_inline_style       = '';
$desc_title_style_inline = '';
$desc_text_font_data     = arrowpress_getFontsData( $desc_google_fonts );
// Build the inline style
$desc_inline_style .= arrowpress_googleFontsStyles( $desc_text_font_data );

// Enqueue the right font
if ( ( isset( $desc_use_theme_fonts ) || 'yes' === $desc_use_theme_fonts ) ) {
	arrowpress_enqueueGoogleFonts( $desc_text_font_data );
}
$desc_title_style[] = '';
if ( $desc_color != '' ) {
	$desc_title_style[] .= 'color:' . esc_attr( $desc_color ) . '';
}
if ( $desc_size != '' ) {
	$desc_title_style[] .= 'font-size:' . esc_attr( $desc_size ) . 'px';
}
if ( $desc_lh != '' ) {
	$desc_title_style[] .= 'line-height:' . esc_attr( $desc_lh ) . 'px';
}

if ( count( $desc_title_style ) > 0 && ( is_array( $desc_title_style ) || is_object( $desc_title_style ) ) ) {
	foreach ( $desc_title_style as $attribute ) {
		if ( $attribute != '' ) {
			$desc_inline_style .= $attribute . '; ';
		}
	}
}
if ( $desc_inline_style != '' ) {
	$desc_title_style_inline = 'style="' . $desc_inline_style . '"';
}
// ============Style inline for blog info=============//
$info_style         = '';
$info_final_style   = '';
$info_style_array[] = '';
if ( $info_color != '' ) {
	$info_style_array[] .= 'color:' . esc_attr( $info_color ) . '';
}
if ( is_array( $info_style_array ) || is_object( $info_style_array ) ) {
	foreach ( $info_style_array as $attribute ) {
		if ( $attribute != '' ) {
			$info_style .= $attribute . '; ';
		}
	}
}
if ( $info_style != '' ) {
	$info_final_style = 'style="' . $info_style . '"';
}
if ( $blog->have_posts() ) {
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'arrowpress_blog', $atts );
	$el_class  = arrowpress_shortcode_extract_class( $el_class );
	$output    = '<div class="blog-container' . esc_html( $el_class ) . '"';
	$output    .= '>';
	ob_start();
	?>
	<?php if ( $layout == 'packery_style_1' ) : ?>
		<div
			class="blog-home <?php echo esc_html( $layout_class ); ?><?php echo esc_html( $layout_style_class ); ?> <?php echo esc_attr( $show_spacer_class ); ?>">
			<?php while ( $blog->have_posts() ) : $blog->the_post(); ?>
				<?php
				$attachment_id         = get_post_thumbnail_id();
				$apr_blog_grid         = apr_get_attachment( $attachment_id, 'apr_blog_home_2' );
				$apr_blog_grid2        = apr_get_attachment( $attachment_id, 'apr_blog_home_12' );
				$apr_post_term_arr     = get_the_terms( get_the_ID(), 'category' );
				$apr_post_term_filters = '';
				$apr_post_term_names   = '';

				if ( is_array( $apr_post_term_arr ) || is_object( $apr_post_term_arr ) ) {
					foreach ( $apr_post_term_arr as $post_term ) {

						$apr_post_term_filters .= $post_term->slug . ' ';
						$apr_post_term_names   .= $post_term->name . ', ';
						if ( $post_term->parent != 0 ) {
							$parent_term           = get_term( $post_term->parent, 'category' );
							$apr_post_term_filters .= $parent_term->slug . ' ';

						}
					}
				}

				$apr_post_term_filters = trim( $apr_post_term_filters );
				$apr_post_term_names   = substr( $apr_post_term_names, 0, - 2 );
				$apr_author            = get_the_author_link();
				?>
				<div
					class="<?php echo esc_html( $apr_post_term_filters ); ?> col-lg-<?php echo esc_html( $items_desktop_large_no ); ?> col-md-<?php echo esc_html( $items_desktop_no ) ?> col-sm-<?php echo esc_html( $items_tablets_no ) ?> col-xs-<?php echo esc_html( $items_mobile_no ) ?> grid-item blog-content">
					<div class="blog-item">
						<?php if ( has_post_thumbnail() != '' && ( get_post_format() == 'gallery' ) ): ?>
							<?php $gallery = get_post_meta( get_the_ID(), 'images_gallery', true ); ?>
							<div class="blog-gallery blog-media arrows-custom">
								<?php
								$index = 0;
								foreach ( $gallery as $key => $value ) :
									$attachment_id = wp_get_attachment_image_src( $value, 'apr_blog_home_2' );
									$alt           = get_post_meta( $value, '_wp_attachment_image_alt', true );
									echo '<div class="img-gallery">
											<div class="img">
												<img src="' . esc_url( $attachment_id[0] ) . '" alt="gallery-blog" class="gallery-img" />
											</div>
										</div>';
									$index ++;
								endforeach;
								?>
							</div>
						<?php elseif ( ( get_post_format() == 'video' ) || ( get_post_format() == 'audio' ) ): ?>
							<?php $video = get_post_meta( get_the_ID(), 'video_code', true ); ?>
							<?php if ( $video && $video != '' ): ?>
								<div class="align_left">
									<div class="blog-video blog-media <?php if ( get_post_format() == 'audio' ) {
										echo 'blog-audio';
									} ?>">
										<?php if ( get_post_format() == 'video' ) {
											echo '<div class="iframe_video_container">';
										}
										?>
										<?php if ( strpos( $video, 'iframe' ) !== false ): ?>
											<?php echo wp_kses( $video, array(
												'iframe' => array(
													'height'          => array(),
													'frameborder'     => array(),
													'style'           => array(),
													'src'             => array(),
													'allowfullscreen' => array(),
												)
											) ); ?>
										<?php else: ?>
											<iframe
												src="<?php echo esc_url( is_ssl() ? str_replace( 'http://', 'https://', $video ) : $video ); ?> "
												width="100%" <?php if ( get_post_format() == 'video' ) {
												echo 'height="400"';
											} ?>></iframe>
										<?php endif; ?>
										<?php if ( get_post_format() == 'video' ) {
											echo '</div>';
										}
										?>
									</div>
								</div>
							<?php endif; ?>
						<?php else: ?>
							<div class="blog-img blog-media">
								<?php if ( $layout_style == 'layout_style_2' ) :
									if ( ! empty( $apr_blog_grid2['src'] ) ):
										?>
										<a href="<?php the_permalink(); ?>"><img
												width="<?php echo esc_attr( $apr_blog_grid2['width'] ) ?>"
												height="<?php echo esc_attr( $apr_blog_grid2['height'] ) ?>"
												src="<?php echo esc_url( $apr_blog_grid2['src'] ) ?>"
												alt="<?php echo esc_attr( $apr_blog_grid2['alt'] ) ?>"/></a>
									<?php endif; ?>
								<?php else:
									if ( ! empty( $apr_blog_grid['src'] ) ):
										?>
										<a href="<?php the_permalink(); ?>"><img
												width="<?php echo esc_attr( $apr_blog_grid['width'] ) ?>"
												height="<?php echo esc_attr( $apr_blog_grid['height'] ) ?>"
												src="<?php echo esc_url( $apr_blog_grid['src'] ) ?>"
												alt="<?php echo esc_attr( $apr_blog_grid['alt'] ) ?>"/></a>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<div
							class="blog-post-info <?php if ( has_post_thumbnail() == '' && ( get_post_format() != 'audio' ) && ( get_post_format() != 'video' ) ) {
								echo 'no-img';
							} ?>">
							<?php if ( $layout_style == 'layout_style_2' ) : ?>
								<div class="info info-tag">
									<?php echo get_the_tag_list( '<i class="fa fa-tag"></i> ', ', ', '' ); ?>
								</div>
							<?php endif; ?>
							<?php if ( get_the_title() != '' ): ?>
								<div class="blog-post-title">
									<div class="post-name">
										<a <?php echo $big_title_style_inline; ?>
											href="<?php the_permalink(); ?>"><?php the_title(); ?>
										</a>
									</div>
								</div>
							<?php endif; ?>
							<?php if ( $layout_style == 'layout_style_1' ) : ?>
								<div class="info blog-date">
									<p class="date">
										<a <?php echo $info_final_style; ?> href="<?php the_permalink(); ?>"><i
												class="fa fa-calendar"></i> <?php echo get_the_date(); ?></a>
									</p>
								</div>
							<?php endif; ?>
							<div class="blog_post_desc" <?php echo $desc_title_style_inline; ?>>
								<?php
								if ( get_post_meta( get_the_ID(), 'highlight', true ) != "" ) : ?>
									<?php the_excerpt(); ?>
								<?php else: ?>
									<?php
									echo '<div class="entry-content">';
									the_content();
									wp_link_pages( array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'bonfire' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span>',
										'link_after'  => '</span>',
										'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'bonfire' ) . ' </span>%',
										'separator'   => '<span class="screen-reader-text">, </span>',
									) );
									echo '</div>';
									?>
								<?php endif; ?>
							</div>
							<div class="read-more">
								<a href="<?php the_permalink(); ?>"><?php echo esc_html( $readmore_link ); ?> <i
										class="lnr lnr-arrow-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	<?php else: ?>
		<div
			class="row blog-home <?php echo esc_html( $layout_class ); ?> <?php echo esc_attr( $show_spacer_class ); ?> ">
			<?php while ( $blog->have_posts() ) : $blog->the_post(); ?>
				<?php
				$apr_post_term_arr     = get_the_terms( get_the_ID(), 'category' );
				$apr_post_term_filters = '';
				$apr_post_term_names   = '';

				if ( is_array( $apr_post_term_arr ) || is_object( $apr_post_term_arr ) ) {
					foreach ( $apr_post_term_arr as $post_term ) {

						$apr_post_term_filters .= $post_term->slug . ' ';
						$apr_post_term_names   .= $post_term->name . ', ';
						if ( $post_term->parent != 0 ) {
							$parent_term           = get_term( $post_term->parent, 'category' );
							$apr_post_term_filters .= $parent_term->slug . ' ';

						}
					}
				}

				$apr_post_term_filters = trim( $apr_post_term_filters );
				$apr_post_term_names   = substr( $apr_post_term_names, 0, - 2 );
				$apr_author            = get_the_author_link();
				?>
				<div
					class="<?php echo esc_html( $apr_post_term_filters ); ?> col-lg-<?php echo esc_html( $items_desktop_large_no ); ?> col-md-<?php echo esc_html( $items_desktop_no ) ?> col-sm-<?php echo esc_html( $items_tablets_no ) ?> col-xs-<?php echo esc_html( $items_mobile_no ) ?> grid-item">
					<div class="blog-content">
						<div class="blog-item">
							<div class="blog-img blog-media">
								<?php if ( get_post_format() == 'gallery' ): ?>
									<?php $gallery = get_post_meta( get_the_ID(), 'images_gallery', true ); ?>
									<div class="blog-gallery arrows-custom">
										<?php
										$index = 0;
										foreach ( $gallery as $key => $value ) :
											$attachment_id_1  = wp_get_attachment_image_src( $value, 'apr_blog_home' );
											$attachment_id_2  = wp_get_attachment_image_src( $value, 'apr_blog_home_3' );
											$attachment_id_3  = wp_get_attachment_image_src( $value, 'apr_blog_home_2' );
											$attachment_id_5  = wp_get_attachment_image_src( $value, 'apr_blog_home_5' );
											$attachment_id_7  = wp_get_attachment_image_src( $value, 'apr_blog_home_7' );
											$attachment_id_71 = wp_get_attachment_image_src( $value, 'apr_blog_home_71' );
											$alt              = get_post_meta( $value, '_wp_attachment_image_alt', true );
											if ( $layout == 'grid_style_2' ) {
												echo '<div class="img-gallery">
														<div class="img">
															<img src="' . esc_url( $attachment_id_2[0] ) . '" alt="gallery-blog" class="gallery-img" />
														</div>
													</div>';
											} elseif ( $layout == 'grid_style_3' ) {
												echo '<div class="img-gallery">
														<div class="img">
															<img src="' . esc_url( $attachment_id_3[0] ) . '" alt="gallery-blog" class="gallery-img" />
														</div>
													</div>';
											} elseif ( $layout == 'grid_style_4' ) {
												echo '<div class="img-gallery">
														<div class="img">
															<img src="' . esc_url( $attachment_id_5[0] ) . '" alt="gallery-blog" class="gallery-img" />
														</div>
													</div>';
											} elseif ( $layout == 'grid_style_5' ) {
												if ( $items_desktop_large_no == '12' || $items_desktop_no == '12' ) {
													echo '<div class="img-gallery"> 
															<div class="img">
																<img src="' . esc_url( $attachment_id_71[0] ) . '" alt="gallery-blog" class="gallery-img" />
															</div>
														</div>';
												} else {
													echo '<div class="img-gallery">
															<div class="img">
																<img src="' . esc_url( $attachment_id_7[0] ) . '" alt="gallery-blog" class="gallery-img" />
															</div>
														</div>';
												}
											} else {
												echo '<div class="img-gallery">
														<div class="img">
															<img src="' . esc_url( $attachment_id_1[0] ) . '" alt="gallery-blog" class="gallery-img" />
														</div>
													</div>';
											}
											$index ++;
										endforeach;
										?>
									</div>
								<?php else: ?>
									<?php
									$attachment_id          = get_post_thumbnail_id();
									if ( isset( $attachment_id ) && ! empty( $attachment_id ) ) :
										$image_blog_home = apr_get_attachment( $attachment_id, 'apr_blog_home' );
										$image_blog_home_3  = apr_get_attachment( $attachment_id, 'apr_blog_home_3' );
										$image_blog_home_2  = apr_get_attachment( $attachment_id, 'apr_blog_home_2' );
										$image_blog_home_5  = apr_get_attachment( $attachment_id, 'apr_blog_home_5' );
										$image_blog_home_7  = apr_get_attachment( $attachment_id, 'apr_blog_home_7' );
										$image_blog_home_71 = apr_get_attachment( $attachment_id, 'apr_blog_home_71' );
										?>
										<?php if ( $layout == 'grid_style_2' && ! empty( $image_blog_home_3['src'] ) ): ?>
										<a href="<?php the_permalink(); ?>"><img
												width="<?php echo esc_html( $image_blog_home_3['width'] ) ?>"
												height="<?php echo esc_html( $image_blog_home_3['height'] ) ?>"
												src="<?php echo esc_url( $image_blog_home_3['src'] ) ?>"
												alt="<?php echo esc_html( $image_blog_home_3['alt'] ) ?>"/></a>
									<?php elseif ( $layout == 'grid_style_3' ): ?>
										<a href="<?php the_permalink(); ?>"><?php if ( isset( $image_blog_home_2['src'] ) ): ?>
												<img width="<?php echo esc_html( $image_blog_home_2['width'] ) ?>"
													 height="<?php echo esc_html( $image_blog_home_2['height'] ) ?>"
													 src="<?php echo esc_url( $image_blog_home_2['src'] ) ?>"
													 alt="<?php echo esc_html( $image_blog_home_2['alt'] ) ?>" /><?php endif; ?>
										</a>
									<?php elseif ( $layout == 'grid_style_4' ): ?>
										<a href="<?php the_permalink(); ?>"><img
												width="<?php echo esc_html( $image_blog_home_5['width'] ) ?>"
												height="<?php echo esc_html( $image_blog_home_5['height'] ) ?>"
												src="<?php echo esc_url( $image_blog_home_5['src'] ) ?>"
												alt="<?php echo esc_html( $image_blog_home_5['alt'] ) ?>"/></a>
									<?php elseif ( $layout == 'grid_style_5' ): ?>
										<?php if ( $items_desktop_large_no == '12' || $items_desktop_no == '12' ): ?>
											<a href="<?php the_permalink(); ?>"><img
													width="<?php echo esc_html( $image_blog_home_71['width'] ) ?>"
													height="<?php echo esc_html( $image_blog_home_71['height'] ) ?>"
													src="<?php echo esc_url( $image_blog_home_71['src'] ) ?>"
													alt="<?php echo esc_html( $image_blog_home_71['alt'] ) ?>"/></a>
										<?php else: ?>
											<a href="<?php the_permalink(); ?>"><img
													width="<?php echo esc_html( $image_blog_home_7['width'] ) ?>"
													height="<?php echo esc_html( $image_blog_home_7['height'] ) ?>"
													src="<?php echo esc_url( $image_blog_home_7['src'] ) ?>"
													alt="<?php echo esc_html( $image_blog_home_7['alt'] ) ?>"/></a>
										<?php endif; ?>
									<?php else: ?>
										<a href="<?php the_permalink(); ?>"><img
												width="<?php echo esc_html( $image_blog_home['width'] ) ?>"
												height="<?php echo esc_html( $image_blog_home['height'] ) ?>"
												src="<?php echo esc_url( $image_blog_home['src'] ) ?>"
												alt="<?php echo esc_html( $image_blog_home['alt'] ) ?>"/></a>
									<?php endif; ?>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							<div
								class="blog-post-info <?php if ( has_post_thumbnail() == '' && ( get_post_format() != 'audio' ) && ( get_post_format() != 'video' ) ) {
									echo 'no-img';
								} ?>">
								<?php if ( $layout == 'grid_style_2' || $layout == 'grid_style_3' || $layout == 'grid_style_5' ): ?>
									<div class="info blog-date">
										<p class="date">
											<a <?php echo $info_final_style; ?> href="<?php the_permalink(); ?>"><i
													class="fa fa-calendar"></i> <?php echo get_the_date(); ?></a>
										</p>
									</div>
								<?php endif; ?>
								<?php if ( get_the_title() != '' ): ?>
									<div class="blog-post-title">
										<div class="post-name">
											<a <?php echo $big_title_style_inline; ?>
												href="<?php the_permalink(); ?>"><?php the_title(); ?>
											</a>
										</div>
									</div>
								<?php endif; ?>
								<?php if ( $layout == 'grid_style_1' || $layout == 'grid_style_4' || $layout == 'grid_style_5' ): ?>
									<div class="blog_post_desc" <?php echo $desc_title_style_inline; ?>>
										<?php
										if ( get_post_meta( get_the_ID(), 'highlight', true ) != "" ) : ?>
											<?php the_excerpt(); ?>
										<?php else: ?>
											<?php
											echo '<div class="entry-content">';
											the_content();
											wp_link_pages( array(
												'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'bonfire' ) . '</span>',
												'after'       => '</div>',
												'link_before' => '<span>',
												'link_after'  => '</span>',
												'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'bonfire' ) . ' </span>%',
												'separator'   => '<span class="screen-reader-text">, </span>',
											) );
											echo '</div>';
											?>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<?php if ( $layout == 'grid_style_1' || $layout == 'grid_style_4' ): ?>
									<div class="blog-bottom">
										<div class="read-more">
											<a href="<?php the_permalink(); ?>"><?php echo esc_html( $readmore_link ); ?>
												<i class="lnr lnr-arrow-right"></i></a>
										</div>
										<div class="info blog-date">
											<p class="date">
												<a <?php echo $info_final_style; ?> href="<?php the_permalink(); ?>"><i
														class="fa fa-calendar"></i> <?php echo get_the_date(); ?></a>
											</p>
										</div>
									</div>
								<?php endif; ?>
								<?php if ( $layout == 'grid_style_2' || $layout == 'grid_style_3' || $layout == 'grid_style_5' ): ?>
									<div class="read-more">
										<a href="<?php the_permalink(); ?>"><?php echo esc_html( $readmore_link ); ?> <i
												class="lnr lnr-arrow-right"></i></a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		<?php if ( $show_viewmore ) : ?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 static">
					<div class="btn-viewmore text-center">
						<?php if ( $layout != 'masonry_style_1' ): ?>
							<a class="view_more btn btn-primary"
							   href="<?php echo esc_url( $viewmore_link ); ?>"><?php echo esc_html( $viewmore_text ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( $show_loadmore ) : ?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<?php if ( $wp_query->max_num_pages > 1 ) : ?>
						<div class="load-more text-center" <?php echo $space_1; ?>>
							<a data-paged="<?php echo esc_attr( $current_page ) ?>"
							   data-totalpage="<?php echo esc_attr( $wp_query->max_num_pages ) ?>" id="blog-loadmore"
							   class="btn btn-bg"><?php echo esc_html__( 'Load more', 'arrowpress-core' ) ?> </a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endif;
	wp_reset_postdata();
	?>
	<?php
	$output .= ob_get_clean();

	$output .= '</div>' . arrowpress_shortcode_end_block_comment( 'arrowpress_blog' ) . "\n";

	echo $output;
	wp_reset_query();
}
