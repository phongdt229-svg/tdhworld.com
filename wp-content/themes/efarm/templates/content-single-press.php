<?php 
    $apr_settings = apr_check_theme_options();
?>
<div class="blog post-single single-1">
	<div class="blog-content">
		<div class="blog-item">
			<?php 
				$attachment_id = get_post_thumbnail_id();
				$apr_recipe_list = apr_get_attachment($attachment_id, 'apr_recipe_list'); 
			?>
			<div class="press-img">	
				<img width="<?php echo esc_attr($apr_recipe_list['width']) ?>" height="<?php echo esc_attr($apr_recipe_list['height']) ?>" src="<?php echo esc_url($apr_recipe_list['src']) ?>" alt="<?php echo esc_html__('recipe','efarm') ?>" />    
			</div>
			<div class="blog-post-info">
				<?php if(get_the_title() != ''):?>
					<div class="blog-post-title">
						<div class="post-name">
							<h3><?php the_title(); ?></h3>                                     
						</div>					
					</div>
				<?php endif;?>
				<div class="blog-info">
					<div class="info blog-date ">
						<p class="month"><?php echo get_the_time('M'); ?></p>
						<p class="date"><?php echo get_the_time('d'); ?></p>
					</div>
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
							<?php echo get_the_term_list($post->ID,'press_cat', '<i class="fa fa-folder-o"></i> ', ',  ' ); ?>
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
				<div class="blog_post_desc">					
					<?php the_content();?>
						<?php 
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'efarm' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'efarm' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) );
						?>							
				</div>
			</div>					

		</div>
	</div>
	<div class="author-box">
		<?php apr_get_share_link();?>		
		<?php apr_author_box();?>
	</div>
	<div class="post-comments">
		<?php comments_template('', true); ?>  
	</div>  
</div>