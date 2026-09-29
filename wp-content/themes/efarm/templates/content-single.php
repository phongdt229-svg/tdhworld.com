<?php 
    $apr_settings = apr_check_theme_options();
    if (is_category()){
        $category = get_category( get_query_var( 'cat' ) );
        $cat_id = $category->cat_ID;
        if(get_metadata('category', $cat_id, 'single_blog_layouts', true) != 'default'){
            $post_layout = get_metadata('category', $cat_id, 'single_blog_layouts', true);
        }
    }
?>
<div class="blog post-single single-1">
	<div class="blog-content">
		<div class="blog-item">
			<?php apr_get_post_media(); ?>
			<div class="blog-post-info">
				<?php if(get_the_title() != ''):?>
					<div class="blog-post-title">
						<div class="post-name">
							<h3><?php the_title(); ?> 
							</h3>                                     
						</div>					
					</div>
				<?php endif;?>
				<div class="blog-info">
					<?php if(isset($apr_settings['blog-date-format']) && !$apr_settings['blog-date-format']):?>
						<div class="info blog-date ">
							<a href="<?php the_permalink(); ?>">
								<p class="month"><?php echo get_the_time('M'); ?></p>
								<p class="date"><?php echo get_the_time('d'); ?></p>
							</a>
						</div>
					<?php else:?>
						<div class="info blog-date default-format">
							<a href="<?php the_permalink(); ?>">
								<p><?php echo get_the_date(); ?></p>
							</a>
						</div>
					<?php endif;?>
					<?php if (isset($apr_settings['post-meta2']) && in_array('author', $apr_settings['post-meta2'])) : ?>
						<?php $apr_author_id= $post->post_author;?>
						<div class="info author">
							<i class="fa fa-user" aria-hidden="true"></i>
							<span><?php echo esc_html__('By','efarm');?></span>
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author_meta( 'nickname' , $apr_author_id ); ?></a>
						</div>	
					<?php endif;?>
					<?php if (isset($apr_settings['post-meta2']) && in_array('cat', $apr_settings['post-meta2'])) : ?>					
						<div class="info info-cat">
							<?php echo get_the_term_list($post->ID,'category', '<i class="fa fa-folder-o"></i> ', ',  ' ); ?>
						</div>
					<?php endif;?>							
					<?php if (isset($apr_settings['post-meta2']) && in_array('comment', $apr_settings['post-meta2'])) : ?>							
						<div class="info info-comment"> 
							<i class="fa fa-comment-o" aria-hidden="true"></i>
							<?php comments_popup_link(esc_html__('0', 'efarm'), esc_html__('1', 'efarm'), esc_html__('%', 'efarm')); ?>
						</div>	
					<?php endif;?>
					<?php if (isset($apr_settings['post-meta2']) && in_array('like', $apr_settings['post-meta2'])) : ?>
						<div class="info info-like">
							<?php  if(function_exists('apr_getPostLikeLink')) {
							echo apr_getPostLikeLink( get_the_ID() );
							}
							?>
						</div>	
					<?php endif;?>	
					<?php if (isset($apr_settings['post-meta2']) && in_array('tag', $apr_settings['post-meta2'])) : ?>
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