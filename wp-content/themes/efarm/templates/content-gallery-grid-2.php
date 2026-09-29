
<?php 
    $apr_post_term_arr = get_the_terms( get_the_ID(), 'gallery_cat' );
    $apr_post_term_filters = '';
    $apr_post_term_names = '';

    if (is_array($apr_post_term_arr) || is_object($apr_post_term_arr)){
        foreach ( $apr_post_term_arr as $post_term ) {

            $apr_post_term_filters .= $post_term->slug . ' ';
            $apr_post_term_names .= $post_term->name . ', ';
            if($post_term->parent!=0){
                $parent_term = get_term( $post_term->parent,'gallery_cat' );
                $apr_post_term_filters .= $parent_term->slug . ' ';
                
            }
        }
    }

    $apr_post_term_filters = trim( $apr_post_term_filters );
    $apr_post_term_names = substr( $apr_post_term_names, 0, -2 );
    $apr_author = get_the_author_link();
?>
<div class="item <?php echo esc_attr($apr_post_term_filters);?>">
    <div class="figcaption">
        <?php if ( has_post_thumbnail() ) : ?>
    		<figure class="gallery-image">
    			<div class="gallery-img">
    				<?php 
    					$attachment_id = get_post_thumbnail_id();
    					$apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_grid'); 
    				?>
    				<a href="<?php the_permalink(); ?>" title="">
                        <img width="<?php echo esc_attr($apr_gallery_grid['width']) ?>" height="<?php echo esc_attr($apr_gallery_grid['height']) ?>" src="<?php echo esc_url($apr_gallery_grid['src']) ?>" alt="<?php echo esc_html__('gallery','efarm') ?>" />    
                    </a>
    			</div>
				<div class="post-name">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>								                                     
				</div>		
    		</figure>   
			<div class="gallery_content">
				<div class="post-name">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>								                                     
				</div>		
				<div class="gallery-tag">
					<?php echo get_the_term_list(get_the_ID(),'gallery_tag', '<i class="fa fa-tags"></i>', ', ' ); ?>
				</div>
				<?php if (get_post_meta(get_the_ID(),'highlight',true) != "") : ?>  
					<?php the_excerpt(); ?>
				<?php else:?>
					<?php
					echo '<div class="entry-content">';
					the_excerpt();
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
				<?php endif; ?>
				<div class="read-more">
					<a class="btn btn-white" href="<?php the_permalink(); ?>"><?php echo esc_html__('Read More','efarm'); ?></a>								                                     
				</div>	
			</div>
        <?php endif;?>   
    </div>  
</div>