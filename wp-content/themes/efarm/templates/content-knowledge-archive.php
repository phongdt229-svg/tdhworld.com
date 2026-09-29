<?php 
    global $wp_query;
	$apr_settings = apr_check_theme_options();
    $apr_knowledge_layout = isset($apr_settings['knowledge-layout-version']) ? $apr_settings['knowledge-layout-version'] :'';
    $apr_knowledge_columns = isset($apr_settings['knowledge-layout-columns']) ? $apr_settings['knowledge-layout-columns'] :'';  
    $apr_knowledge_pagination = isset($apr_settings['knowledge_pagination']) ? $apr_settings['knowledge_pagination'] :'';    
	$cat = $wp_query->get_queried_object();
    if (is_tax('knowledge_cat')){
		if(isset($cat->term_id)){
			$cat_id = $cat->term_id;
		}
        if(get_metadata('knowledge_cat', $cat_id, 'knowledge_layout', true) != 'default'){
            $apr_knowledge_layout = get_metadata('knowledge_cat', $cat_id, 'knowledge_layout', true);    
        }
        if(get_metadata('knowledge_cat', $cat_id, 'knowledge_columns', true) != 'default'){
        	$apr_knowledge_columns = get_metadata('knowledge_cat', $cat_id, 'knowledge_columns', true);  
        }      
        if(get_metadata('knowledge_cat', $cat_id, 'knowledge_pagination', true) != 'default'){
            $apr_knowledge_pagination = get_metadata('knowledge_cat', $cat_id, 'knowledge_pagination', true);
        }                  
    }
    $apr_skin = get_post_meta(get_the_ID(),'skin',true);
	$apr_class = '';
	$apr_class_columns = '';
	
	if($apr_knowledge_layout == 'grid'){
		$apr_class = ' knowledge-grid';
	}else if($apr_knowledge_layout == 'list'){
		$apr_class = ' knowledge-list';
		$apr_knowledge_columns = '1';
	}
	if($apr_knowledge_columns == '1'){
		$apr_class_columns = 'col-md-12 col-sm-12 col-xs-12';
	}else if($apr_knowledge_columns == '2'){
		$apr_class_columns = 'col-md-6 col-sm-6 col-xs-12';
	}else if($apr_knowledge_columns == '4'){
		$apr_class_columns = 'col-md-3 col-sm-6 col-xs-12';
	}else{
		$apr_class_columns = 'col-md-4 col-sm-6 col-xs-12';
	}	
    $current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
?>
<div class="row knowledge-entries-wrap grid-isotope <?php echo esc_attr($apr_class); ?>">
	<?php 
		$i= 1;
		$pakery_class ='';
	?>
	<?php while (have_posts()) : the_post(); ?>
		<div class="item <?php echo esc_attr($apr_class_columns); ?>">
			<div class="knowledge-content">
				<div class="knowledge-item">	 
					<?php 
    					$attachment_id = get_post_thumbnail_id();
    					$apr_knowledge = apr_get_attachment($attachment_id, 'apr_knowledge'); 
    					$apr_knowledge_full = apr_get_attachment($attachment_id, 'full'); 
    				?>
    				<div class="knowledge-img">	
						<?php if(!empty($apr_knowledge['src'])): ?>
	    				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	                        <img width="<?php echo esc_attr($apr_knowledge['width']) ?>" height="<?php echo esc_attr($apr_knowledge['height']) ?>" src="<?php echo esc_url($apr_knowledge['src']) ?>" alt="<?php echo esc_html__('knowledge','efarm') ?>" />    
	                    </a>
						<?php endif;?>
						<div class="blog-info">
							<div class="info blog-date ">
								<p class="month"><a href="<?php the_permalink(); ?>"><?php echo get_the_time('M'); ?></a></p>
								<p class="date"><a href="<?php the_permalink(); ?>"><?php echo get_the_time('d'); ?></a></p>
							</div>
						</div>
	                </div>
					<div class="knowledge-post-info">
						<?php if(get_the_title() != ''):?>
							<div class="knowledge-post-title">
								<div class="knowledge-name">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                     
								</div>					
							</div>
						<?php endif;?>
						<div class="knowledge_post_desc">
							<?php if (get_post_meta(get_the_ID(),'desc', true) != "") : ?>                            
								<p><?php echo get_post_meta(get_the_ID(),'desc',true);?></p>
							<?php endif; ?>
						</div>
						<?php if($apr_knowledge_layout == 'list'): ?>
							<div class="blog-info">
								<?php if (isset($apr_settings['knowledge-meta']) && in_array('author', $apr_settings['knowledge-meta'])) : ?>
									<?php $apr_author_id= $post->post_author;?>
									<div class="info author">
										<i class="fa fa-user" aria-hidden="true"></i>
										<span><?php echo esc_html__('By','efarm');?></span>
										<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author_meta( 'nickname' , $apr_author_id ); ?></a>
									</div>	
								<?php endif;?>
								<?php if (isset($apr_settings['knowledge-meta']) && in_array('cat', $apr_settings['knowledge-meta'])) : ?>					
									<div class="info info-cat">
										<?php echo get_the_term_list($post->ID,'knowledge_cat', '<i class="fa fa-folder-o"></i> ', ',  ' ); ?>
									</div>
								<?php endif;?>							
								<?php if (isset($apr_settings['knowledge-meta']) && in_array('comment', $apr_settings['knowledge-meta'])) : ?>							
									<div class="info info-comment"> 
										<i class="fa fa-comment-o" aria-hidden="true"></i>
										<?php comments_popup_link(esc_html__('0', 'efarm'), esc_html__('1', 'efarm'), esc_html__('%', 'efarm')); ?>
									</div>	
								<?php endif;?>
								<?php if (isset($apr_settings['knowledge-meta']) && in_array('like', $apr_settings['knowledge-meta'])) : ?>
									<div class="info info-like">
										<?php  if(function_exists('apr_getPostLikeLink')) {
										echo apr_getPostLikeLink( get_the_ID() );
										}
										?>
									</div>	
								<?php endif;?>	
								<?php if (isset($apr_settings['knowledge-meta']) && in_array('tag', $apr_settings['knowledge-meta'])) : ?>
									<div class="info info-tag">
										<?php echo get_the_tag_list('<i class="fa fa-tag"></i> ',', ',''); ?>
									</div>
								<?php endif;?>		
							</div>
						<?php endif;?>		
					</div>	
				</div>
			</div>
		</div>
		<?php $i++;?>
	<?php endwhile; ?>
</div>
<?php if($apr_knowledge_pagination =='3'):?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">				
			<div class="text-center">
					<?php apr_pagination(); ?>
			</div>
		</div>
	</div>
<?php elseif($apr_knowledge_pagination =='2'):?>
	<?php if( get_previous_posts_link() ||  get_next_posts_link()):?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 ">
				<div class="pagination-content">			
					<ul class="paginationtype-2">
						<?php if( get_previous_posts_link()): ?>
							<li class="pagination_button_prev"><?php previous_posts_link( '<span class="fa fa-angle-left"></span>'.esc_html__( ' Newer Posts', 'efarm' ) ); ?></li>
						<?php endif; ?>	
						<?php if( get_next_posts_link()): ?>
							<li class="pagination_button_next"><?php next_posts_link( esc_html__( 'Older Posts ', 'efarm' ).'<span class="fa fa-angle-right"></span>'); ?></li>
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
				<div class="load-more knowledge-load text-center">
					<a data-paged="<?php echo esc_attr($current_page) ?>" data-totalpage="<?php echo esc_attr($wp_query->max_num_pages) ?>" id="knowledge-loadmore" class="btn btn-primary"><?php echo esc_html__('Load more', 'efarm') ?> </a>
				</div>
			</div>
		</div>						
	<?php endif; ?>
<?php endif;?>

