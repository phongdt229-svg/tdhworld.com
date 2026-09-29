<?php 
	get_header(); 
	$apr_settings = apr_check_theme_options(); 
	$apr_class = '';
	$apr_sidebar_left = apr_get_sidebar_left();
	$apr_sidebar_right = apr_get_sidebar_right();
	$apr_layout = apr_get_layout();	
	$apr_settings = apr_check_theme_options(); 
	if ($apr_sidebar_left && $apr_sidebar_right && is_active_sidebar($apr_sidebar_left) && is_active_sidebar($apr_sidebar_right)){
	 	$apr_class .= 'col-md-6 col-sm-12 col-xs-12 main-sidebar'; 
	}elseif($apr_sidebar_left && (!$apr_sidebar_right|| $apr_sidebar_right=="none") && is_active_sidebar($apr_sidebar_left)){
		$apr_class .= 'f-right col-lg-9 col-md-9 col-sm-12 col-xs-12 main-sidebar'; 
	}elseif((!$apr_sidebar_left || $apr_sidebar_left=="none") && $apr_sidebar_right && is_active_sidebar($apr_sidebar_right)){
		$apr_class .= 'col-lg-9 col-md-9 col-sm-12 col-xs-12 main-sidebar'; 
	}else {
		$apr_class .= 'content-primary'; 
		if($apr_layout == 'fullwidth'){
			$apr_class .= ' col-md-12';
		}
	}
?>

	<?php if(is_tax('recipe_cat')):	
		$apr_recipe_search= isset($apr_settings['recipe-search']) ? $apr_settings['recipe-search'] :'1';
		$current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
		$taxonomy_names = get_object_taxonomies( 'recipe' );
		if ( is_array( $taxonomy_names ) && count( $taxonomy_names ) > 0  && in_array( 'recipe_cat', $taxonomy_names ) ) {
		    $terms = get_terms( 'recipe_cat', array(
			    'hide_empty' => true,
			    'parent'  => 0, 
			    'hierarchical' => false, 
		        ) );
		}
	?>
		<div class="col-md-12 col-sm-12 col-xs-12">
		 <?php if (have_posts()): ?>   
			<?php if($apr_recipe_search == '1'):?>     
				<?php echo apr_get_recipe_search_ajax();?>   
			<?php endif;?>   
		  <?php endif; ?>
		</div>  
		<?php get_sidebar('left'); ?>
		<div class="<?php echo esc_attr($apr_class);?>">			
			<div id="primary" class="content-area">
	             <?php if (have_posts()): ?>   
	                 <?php get_template_part( 'templates/content', 'recipe-archive' ); ?>
	             <?php else: ?> 
	                 <?php get_template_part('content', 'none'); ?>
	             <?php endif; ?>
			</div>
		</div>
	<?php elseif(is_tax('knowledge_cat')):?>
		<div class="<?php echo esc_attr($apr_class);?>">			
			<div id="primary" class="content-area">
	             <?php if (have_posts()): ?>                        
	                 <?php get_template_part( 'templates/content', 'knowledge-archive' ); ?>
	             <?php else: ?> 
	                 <?php get_template_part('content', 'none'); ?>
	             <?php endif; ?>
			</div>
		</div>
	<?php elseif(is_tax('press_cat')):?>
		<div class="<?php echo esc_attr($apr_class);?>">			
			<div id="primary" class="content-area">
	             <?php if (have_posts()): ?>                        
	                 <?php get_template_part( 'templates/content', 'press-archive' ); ?>
	             <?php else: ?> 
	                 <?php get_template_part('content', 'none'); ?>
	             <?php endif; ?>
			</div>
		</div>
	<?php else:?>
		<?php
			$current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
			$taxonomy_names = get_object_taxonomies( 'gallery' );
			if ( is_array( $taxonomy_names ) && count( $taxonomy_names ) > 0  && in_array( 'gallery_cat', $taxonomy_names ) ) {
			    $terms = get_terms( 'gallery_cat', array(
				    'hide_empty' => true,
				    'parent'  => 0, 
				    'hierarchical' => false, 
			        ) );
			}		
			$apr_gallery_layout = isset($apr_settings['gallery-style-version']) ? $apr_settings['gallery-style-version'] :'';
			$apr_gallery_col = isset($apr_settings['gallery-cols']) ? $apr_settings['gallery-cols'] :'';
			$apr_gallery_style = isset($apr_settings['gallery-style']) ? $apr_settings['gallery-style'] :'style1'; 
			$apr_btn_style = isset($apr_settings['gallery-loadmore-style']) ? $apr_settings['gallery-loadmore-style'] :'';
			$apr_gallery_space = isset($apr_settings['gallery-space']) ? $apr_settings['gallery-space'] :'1';
			$apr_gallery_filter = isset($apr_settings['gallery_filter']) ? $apr_settings['gallery_filter'] :'';
			$apr_style_class="";
			$apr_col_class=" col-3";
			$apr_btn = "";  
			    if (is_tax('gallery_cat')){
					$cat = $wp_query->get_queried_object();
			        if(get_metadata('gallery_cat', $cat->term_id, 'gallery-style-version', true)  != 'default'){
			            $apr_gallery_layout = get_metadata('gallery_cat', $cat->term_id, 'gallery-style-version', true);    
			        }
			        if(get_metadata('gallery_cat', $cat->term_id, 'gallery-cols', true)  != 'default'){
			            $apr_gallery_col = get_metadata('gallery_cat', $cat->term_id, 'gallery-cols', true);    
					} 
					if(get_metadata('gallery_cat', $cat->term_id, 'gallery_filter', true)  != 'default'){
			            $apr_gallery_filter = get_metadata('gallery_cat', $cat->term_id, 'gallery_filter', true);    
					} 
					 if(get_metadata('gallery_cat', $cat->term_id, 'gallery-style', true)  != 'default'){
			            $apr_gallery_style = get_metadata('gallery_cat', $cat->term_id, 'gallery-style', true);    
					} 
					 if(get_metadata('gallery_cat', $cat->term_id, 'gallery-space', true)  != 'default'){
			            $apr_gallery_space = get_metadata('gallery_cat', $cat->term_id, 'gallery-space', true);    
					} 
			        if(get_metadata('gallery_cat', $cat->term_id, 'gallery-loadmore-style', true)  != 'default'){
			            $apr_btn_style = get_metadata('gallery_cat', $cat->term_id, 'gallery-loadmore-style', true);    
			        }		           
			    }
			//Gallery layout
			if($apr_gallery_layout == '2'){
				$apr_style_class = ' gallery-masonry';
			}else{
				$apr_style_class = ' gallery-grid';
			}
			//Gallery columns
			if($apr_gallery_col != ''){
			   $apr_col_class=" col-".$apr_gallery_col;
			}
			//Gallery button
			if($apr_btn_style =='2'){
				$apr_btn = ' btn-default';
			}
			?>	
			<div class="<?php echo esc_attr($apr_class);?>">
				<div id="primary" class="content-area">
		            <?php if (have_posts()): ?>   
						<div class="gallery-container">
							<?php if($apr_gallery_filter == '1') :?>
								<div class="gallery_header">
									<?php if($apr_gallery_filter == '1'):?>
										<?php if (is_array( $terms ) && count( $terms ) > 0 ) : ?>
											<div id="options" class="gallery_filter">
												<div id="filters" class="button-group js-radio-button-group">
													<div class="inline-block">
														<button class="is-checked btn-filter" data-filter="*"><?php echo esc_html__('All','efarm'); ?></button>
												  	</div>
													<?php foreach ( $terms as $key => $term ) : ?> 
														<div class="inline-block">
															<button class="btn-filter" data-filter=".<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></button>
													   	</div>
													<?php endforeach;?>  
												</div>
											</div> 
										<?php endif;?> 
									<?php endif;?>
								</div>
							<?php endif;?>
							<div class="tabs_sort gallery_sort <?php if($apr_gallery_space == '1'){echo 'no-space';}?> ">
								<div class="gallery-entries-wrap isotope clearfix <?php echo esc_attr($apr_col_class).esc_attr($apr_style_class);?>">   
									
										<?php if($apr_gallery_layout == '2'):?>
											<?php get_template_part('templates/content', 'gallery-masonry'); ?>				             			
										<?php else:?>
											<?php while (have_posts()) : the_post(); ?>
												<?php get_template_part('templates/content', 'gallery-grid'); ?>
											<?php endwhile; ?>
										<?php endif;?>
									
								</div>  
							</div> 
							<?php if ($wp_query->max_num_pages > 1) : ?>
								<div class="load-more text-center">
									<a data-paged="<?php echo esc_attr($current_page) ?>" data-totalpage="<?php echo esc_attr($wp_query->max_num_pages) ?>" id="gallery-loadmore" class="btn btn-primary btn-gallery" ><?php echo esc_html__('View more', 'efarm') ?></a>
								</div>
							<?php endif; ?>
						</div>
		            <?php else: ?> 
		                 <?php get_template_part('content', 'none'); ?>
		            <?php endif; ?>
				</div>
			</div> 				
	<?php endif;?>

<?php get_sidebar('right'); ?> 
<?php get_footer(); ?>