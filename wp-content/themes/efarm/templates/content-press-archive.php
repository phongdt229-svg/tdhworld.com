<?php 
    global $wp_query;
	$apr_settings = apr_check_theme_options();
    $apr_press_layout = isset($apr_settings['press-layout-version']) ? $apr_settings['press-layout-version'] :'';
    $apr_press_columns = isset($apr_settings['press-layout-columns']) ? $apr_settings['press-layout-columns'] :'';  
    $apr_press_show_all = isset($apr_settings['press_show_all']) ? $apr_settings['press_show_all'] :'';    
    $apr_press_pagination = isset($apr_settings['press_pagination']) ? $apr_settings['press_pagination'] :'';    
	$cat = $wp_query->get_queried_object();
	$taxonomy_names = get_object_taxonomies( 'press' );
	if ( is_array( $taxonomy_names ) && count( $taxonomy_names ) > 0  && in_array( 'press_cat', $taxonomy_names ) ) { 
	    $terms = get_terms( 'press_cat', array(
		    'hide_empty' => true,
		    'parent'  => 0, 
		    'hierarchical' => false, 
	        ) );
	}
    if (is_tax('press_cat')){
		if(isset($cat->term_id)){
			$cat_id = $cat->term_id;
		}
        if(get_metadata('press_cat', $cat_id, 'press_layout', true) != 'default'){
            $apr_press_layout = get_metadata('press_cat', $cat_id, 'press_layout', true);    
        }
        if(get_metadata('press_cat', $cat_id, 'press_columns', true) != 'default'){
        	$apr_press_columns = get_metadata('press_cat', $cat_id, 'press_columns', true);  
        }      
        if(get_metadata('press_cat', $cat_id, 'press_pagination', true) != 'default'){
            $apr_press_pagination = get_metadata('press_cat', $cat_id, 'press_pagination', true);
        }                  
    }
    $apr_skin = get_post_meta(get_the_ID(),'skin',true);
	$apr_class = '';
	$apr_class_columns = '';
	
	if($apr_press_layout == 'grid'){
		$apr_class = ' press-grid';
	}else{
		$apr_class = ' press-masonry';
	}
	if($apr_press_columns == '1'){
		$apr_class_columns = 'col-md-12 col-sm-12 col-xs-12';
	}else if($apr_press_columns == '2'){
		$apr_class_columns = 'col-md-6 col-sm-6 col-xs-12';
	}else if($apr_press_columns == '4'){
		$apr_class_columns = 'col-md-3 col-sm-6 col-xs-12';
	}else{
		$apr_class_columns = 'col-md-4 col-sm-6 col-xs-12';
	}	
    $current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
?>
<?php if (!is_tax('press_cat')): ?>
<div class="press_header">
	<?php if (is_array( $terms ) && count( $terms ) > 0 ) : ?>
		<div id="options" class="press_filter">
			<div id="filters" class="button-group js-radio-button-group">
				<?php if (isset($apr_settings['press_show_all']) && $apr_settings['press_show_all']): ?>
					<div class="inline-block">
						<button class="is-checked btn-filter" data-filter="*"><?php echo esc_html__('All','efarm'); ?></button>
					</div>
					<?php foreach ( $terms as $key => $term ) : ?> 
						<div class="inline-block">
							<button class="btn-filter" data-filter=".<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></button>
						</div>
					<?php endforeach;?> 
				<?php else: ?> 
					<?php foreach ( $terms as $key => $term ) : ?> 
						<?php $apr_filter_active = get_term_meta($term->term_id,'arrowpress_core_checkbox');?>
						<?php 
							$apr_filter_active_class = '';
							$apr_btn_active_class = '';
							if(!empty($apr_filter_active)){
								$apr_filter_active_class = "active_cat is-checked";
								$apr_btn_active_class = "btn-active";
							}
						?>
						<div class="inline-block <?php echo esc_attr($apr_btn_active_class);?>">
							<button class="btn-filter <?php echo esc_attr($apr_filter_active_class);?>" data-filter=".<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></button>
						</div>
					<?php endforeach;?> 
				<?php endif;?> 
			</div>
		</div> 
	<?php endif;?> 
</div>
<?php endif;?> 
<div class="row press-entries-wrap grid-isotope <?php echo esc_attr($apr_class); ?>">
	<?php while (have_posts()) : the_post(); ?>
		<?php 
			$apr_post_term_arr = get_the_terms( get_the_ID(), 'press_cat' );
			$apr_post_term_filters = '';
			$apr_post_term_names = '';

			if (is_array($apr_post_term_arr) || is_object($apr_post_term_arr)){
				foreach ( $apr_post_term_arr as $post_term ) {

					$apr_post_term_filters .= $post_term->slug . ' ';
					$apr_post_term_names .= $post_term->name . ', ';
					if($post_term->parent!=0){
						$parent_term = get_term( $post_term->parent,'press_cat' );
						$apr_post_term_filters .= $parent_term->slug . ' ';
						
					}
				}
			}

			$apr_post_term_filters = trim( $apr_post_term_filters );
			$apr_post_term_names = substr( $apr_post_term_names, 0, -2 );
			$apr_author = get_the_author_link();
		?>
		<div class="item <?php echo esc_attr($apr_class_columns); ?> <?php echo esc_attr($apr_post_term_filters);?>">
			<div class="press-content">
				<div class="press-item">	
					<?php 
						$attachment_id = get_post_thumbnail_id();
						$apr_press = apr_get_attachment($attachment_id, 'apr_press'); 
						$apr_press_full = apr_get_attachment($attachment_id, 'apr_press_2'); 
					?>
					<?php if (get_post_meta(get_the_ID(),'link_press',true) != "") : ?> 
						<div class="press-img">	
							<?php if ($apr_press_layout == 'masonry' && !empty($apr_press_full['src'])) : ?> 
								<a class="fancybox" target="_blank" href="<?php echo get_post_meta(get_the_ID(),'link_press',true);?>" title="<?php the_title(); ?>">
									<img width="<?php echo esc_attr($apr_press_full['width']) ?>" height="<?php echo esc_attr($apr_press_full['height']) ?>" src="<?php echo esc_url($apr_press_full['src']) ?>" alt="<?php echo esc_html__('Press Media','efarm') ?>" />    
									<i class="pe-7s-film"></i>
								</a>
							<?php else:?> 
								<a class="fancybox" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php if(!empty($apr_press['src'])): ?>
									<img width="<?php echo esc_attr($apr_press['width']) ?>" height="<?php echo esc_attr($apr_press['height']) ?>" src="<?php echo esc_url($apr_press['src']) ?>" alt="<?php echo esc_html__('Press Media','efarm') ?>" />    
									<?php endif;?>
									<i class="pe-7s-film"></i>
								</a>
							<?php endif;?>
							<div class="blog-info">
								<div class="info blog-date ">
									<p class="month"><a class="fancybox" target="_blank" href="<?php echo get_post_meta(get_the_ID(),'link_press',true);?>"><?php echo get_the_time('M'); ?></a></p>
									<p class="date"><a class="fancybox" target="_blank" href="<?php echo get_post_meta(get_the_ID(),'link_press',true);?>"><?php echo get_the_time('d'); ?></a></p>
								</div>
							</div>
						</div>
					<?php else:?>
						<div class="press-img">	
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php if(!empty($apr_press['src'])):?>
								<img width="<?php echo esc_attr($apr_press['width']) ?>" height="<?php echo esc_attr($apr_press['height']) ?>" src="<?php echo esc_url($apr_press['src']) ?>" alt="<?php echo esc_html__('Press Media','efarm') ?>" />    
							<?php endif;?>
							</a>
							<div class="blog-info">
								<div class="info blog-date ">
									<p class="month"><a href="<?php the_permalink(); ?>"><?php echo get_the_time('M'); ?></a></p>
									<p class="date"><a href="<?php the_permalink(); ?>"><?php echo get_the_time('d'); ?></a></p>
								</div>
							</div>
						</div>
					<?php endif;?>
					<div class="press-post-info">
						<?php if(get_the_title() != ''):?>
							<div class="press-post-title">
								<div class="press-name">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                     
								</div>					
							</div>
						<?php endif;?>
						<div class="blog-info">
							<?php if (isset($apr_settings['press-meta']) && in_array('author', $apr_settings['press-meta'])) : ?>
								<?php $apr_author_id= $post->post_author;?>
								<div class="info author">
									<i class="fa fa-user" aria-hidden="true"></i>
									<span><?php echo esc_html__('By','efarm');?></span>
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author_meta( 'nickname' , $apr_author_id ); ?></a>
								</div>	
							<?php endif;?>
							<?php if (isset($apr_settings['press-meta']) && in_array('cat', $apr_settings['press-meta'])) : ?>					
								<div class="info info-cat">
									<?php echo get_the_term_list($post->ID,'press_cat', '', ',  ' ); ?>
								</div>
							<?php endif;?>							
							<?php if (isset($apr_settings['press-meta']) && in_array('comment', $apr_settings['press-meta'])) : ?>							
								<div class="info info-comment"> 
									<i class="fa fa-comment-o" aria-hidden="true"></i>
									<?php comments_popup_link(esc_html__('0', 'efarm'), esc_html__('1', 'efarm'), esc_html__('%', 'efarm')); ?>
								</div>	
							<?php endif;?>
							<?php if (isset($apr_settings['press-meta']) && in_array('like', $apr_settings['press-meta'])) : ?>
								<div class="info info-like">
									<?php  if(function_exists('apr_getPostLikeLink')) {
									echo apr_getPostLikeLink( get_the_ID() );
									}
									?>
								</div>	
							<?php endif;?>	
							<?php if (isset($apr_settings['press-meta']) && in_array('tag', $apr_settings['press-meta'])) : ?>
								<div class="info info-tag">
									<?php echo get_the_tag_list('<i class="fa fa-tag"></i> ',', ',''); ?>
								</div>
							<?php endif;?>		
						</div>
						<div class="press_post_desc">
							<?php if (get_post_meta(get_the_ID(),'desc', true) != "") : ?>                            
								<p><?php echo get_post_meta(get_the_ID(),'desc',true);?></p>
							<?php endif; ?>
						</div>
					</div>	
				</div>
			</div>
		</div>
	<?php endwhile; ?>
</div>
<?php if($apr_press_pagination =='3'):?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">				
			<div class="text-center">
					<?php apr_pagination(); ?>
			</div>
		</div>
	</div>
<?php elseif($apr_press_pagination =='2'):?>
	<?php if( get_previous_posts_link() ||  get_next_posts_link()):?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 ">
				<div class="pagination-content">			
					<ul class="paginationtype-2">
						<?php if( get_previous_posts_link()): ?>
							<li class="pagination_button_prev"><?php previous_posts_link(esc_html__( ' Newer Posts', 'efarm' ) ); ?></li>
						<?php endif; ?>	
						<?php if( get_next_posts_link()): ?>
							<li class="pagination_button_next"><?php next_posts_link( esc_html__( 'Older Posts ', 'efarm' )); ?></li>
						<?php endif; ?>							
					</ul>
				</div>
			</div>
		</div>
	<?php endif; ?>	
<?php else:?>
	<?php if ($wp_query->max_num_pages > 1) : ?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">				
				<div class="load-more press-load text-center">
					<a data-paged="<?php echo esc_attr($current_page) ?>" data-totalpage="<?php echo esc_attr($wp_query->max_num_pages) ?>" id="press-loadmore" class="btn btn-primary"><?php echo esc_html__('Load more', 'efarm') ?> </a>
				</div>
			</div>
		</div>						
	<?php endif; ?>
<?php endif;?>

