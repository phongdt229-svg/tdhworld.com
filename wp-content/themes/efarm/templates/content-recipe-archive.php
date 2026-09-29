<?php 
    global $wp_query;
	$apr_settings = apr_check_theme_options();
    $apr_recipe_layout = isset($apr_settings['recipe-layout-version']) ? $apr_settings['recipe-layout-version'] :'';
    $apr_recipe_columns = isset($apr_settings['recipe-layout-columns']) ? $apr_settings['recipe-layout-columns'] :'';  
    $apr_recipe_pagination = isset($apr_settings['recipe_pagination']) ? $apr_settings['recipe_pagination'] :'';   
	$cat = $wp_query->get_queried_object();	
    if (is_tax('recipe_cat')){
        if(isset($cat->term_id)){
			$cat_id = $cat->term_id;
		}
        if(get_metadata('recipe_cat', $cat_id, 'recipe_layout', true) != 'default'){
            $apr_recipe_layout = get_metadata('recipe_cat', $cat_id, 'recipe_layout', true);    
        }
        if(get_metadata('recipe_cat', $cat_id, 'recipe_columns', true) != 'default'){
        	$apr_recipe_columns = get_metadata('recipe_cat', $cat_id, 'recipe_columns', true);  
        }      
        if(get_metadata('recipe_cat', $cat_id, 'recipe_pagination', true) != 'default'){
            $apr_recipe_pagination = get_metadata('recipe_cat', $cat_id, 'recipe_pagination', true);
        }                  
    }
    $apr_skin = get_post_meta(get_the_ID(),'skin',true);
	$apr_class = '';
	$apr_class_columns = '';
	
	if($apr_recipe_layout == 'grid'){
		$apr_class = ' recipe-grid';
	}else if($apr_recipe_layout == 'list'){
		$apr_class = ' recipe-list';
		$apr_recipe_columns = '1';
	}
	if($apr_recipe_columns == '1'){
		$apr_class_columns = 'col-md-12 col-sm-12 col-xs-12';
	}else if($apr_recipe_columns == '2'){
		$apr_class_columns = 'col-md-6 col-sm-6 col-xs-12';
	}else if($apr_recipe_columns == '4'){
		$apr_class_columns = 'col-md-3 col-sm-6 col-xs-12';
	}else{
		$apr_class_columns = 'col-md-4 col-sm-6 col-xs-12';
	}	
    $current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
?>
<div class="row recipe-entries-wrap grid-isotope <?php echo esc_attr($apr_class); ?>">
	<?php while (have_posts()) : the_post(); ?>
		<div class="item <?php echo esc_attr($apr_class_columns); ?>">
			<div class="recipe-content">
				<div class="recipe-item">	
					<?php 
    					$attachment_id = get_post_thumbnail_id();
    					$apr_recipe_list = apr_get_attachment($attachment_id, 'apr_recipe_list'); 
    				?>
    				<div class="recipe-img">	
	    				<a class="fancybox-thumb btn-fancybox" data-fancybox-group="fancybox-thumb"  href="<?php echo esc_url($apr_recipe_list['src']);?>" title="">
	                        <img width="<?php echo esc_attr($apr_recipe_list['width']) ?>" height="<?php echo esc_attr($apr_recipe_list['height']) ?>" src="<?php echo esc_url($apr_recipe_list['src']) ?>" alt="<?php echo esc_html__('recipe','efarm') ?>" />    
	                    </a>
	                </div>
					<div class="recipe-post-info">
						<?php if(get_the_title() != ''):?>
							<div class="recipe-post-title">
								<div class="recipe-name">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                     
								</div>					
							</div>
						<?php endif;?>
						<div class="recipe-info info-top">
							<?php if (isset($apr_settings['recipe-meta']) && in_array('author', $apr_settings['recipe-meta'])) : ?>
								<?php $apr_author_id= $post->post_author;?>
								<div class="info author">
									<span><?php echo esc_html__('Recipe by','efarm');?></span>
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author_meta( 'nickname' , $apr_author_id ); ?></a>
								</div>	
							<?php endif;?>
							<?php if(get_post_meta(get_the_ID(),'time',true)!=''):?>
							<div class="info time">
								<i class="fa fa-clock-o"></i>
								<?php echo get_post_meta(get_the_ID(),'time',true);?> <?php echo esc_html__('mins','efarm');?>
							</div>
							<?php endif;?>
							<?php if (isset($apr_settings['recipe-meta']) && in_array('cat', $apr_settings['recipe-meta'])) : ?>					
								<div class="info info-cat">
									<?php echo get_the_term_list($post->ID,'recipe_cat', '<i class="fa fa-folder-o"></i> ', ',  ' ); ?>
								</div>
							<?php endif;?>	
							<?php if (isset($apr_settings['recipe-meta']) && in_array('like', $apr_settings['recipe-meta'])) : ?>
								<div class="info info-like">
									<?php  if(function_exists('apr_getPostLikeLink')) {
									echo apr_getPostLikeLink( get_the_ID() );
									}
									?>
								</div>	
							<?php endif;?>							
							<?php if (isset($apr_settings['recipe-meta']) && in_array('comment', $apr_settings['recipe-meta'])) : ?>							
								<div class="info info-comment"> 
									<i class="fa fa-comment-o" aria-hidden="true"></i>
									<?php comments_popup_link(esc_html__('0', 'efarm'), esc_html__('1', 'efarm'), esc_html__('%', 'efarm')); ?>
								</div>	
							<?php endif;?>	
							<?php $percent_star = ''; ?>
							<?php $count_star = get_post_meta(get_the_ID(),'star_rating', true); 
								$percent_star = $count_star*100/5;
							?>
							<div class="info review-star">
								<?php echo apr_get_average_ratings(get_the_ID());?>
							</div>	
						</div>		
						<div class="recipe_post_desc">
							<?php 
								echo '<div class="entry-content">';
								the_content();
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'efarm' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
									'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'efarm' ) . ' </span>%',
									'separator'   => '<span class="screen-reader-text">, </span>',
								) );
								
								echo '</div>';
								?>
								<div class="read-more recipe-more">
									<a href="<?php the_permalink();?>" class="btn-recipe"><?php echo esc_html__('Read more','efarm');?> <i class="fa fa-angle-double-right"></i></a>
								</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	<?php endwhile; ?>
</div>
<?php if($apr_recipe_pagination =='3'):?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">				
			<div class="text-center">
					<?php apr_pagination(); ?>
			</div>
		</div>
	</div>
<?php elseif($apr_recipe_pagination =='2'):?>
	<?php if( get_previous_posts_link() ||  get_next_posts_link()):?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 ">
				<div class="pagination-content">			
					<ul class="paginationtype-2">
						<?php if( get_previous_posts_link()): ?>
							<li class="pagination_button_prev"><?php previous_posts_link('<span class="fa fa-angle-left"></span> Newer Post'); ?></li>
						<?php endif; ?>	
						<?php if( get_next_posts_link()): ?>
							<li class="pagination_button_next"><?php next_posts_link('Older Post <span class="fa fa-angle-right"></span>'); ?></li>
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
				<div class="load-more text-center">
					<a data-paged="<?php echo esc_attr($current_page) ?>" data-totalpage="<?php echo esc_attr($wp_query->max_num_pages) ?>" id="blog-loadmore" class="btn btn-primary"><?php echo esc_html__('Load More', 'efarm') ?> </a>
				</div>
			</div>
		</div>						
	<?php endif; ?>
<?php endif;?>

