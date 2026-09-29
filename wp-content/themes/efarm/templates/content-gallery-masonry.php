
<?php 
$i = 0;
?>
<?php while (have_posts()) : the_post(); ?>
<?php
$masonry_class ='';
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
    $attachment_id = get_post_thumbnail_id();
    $index_size1 = array('0','2','5','9','11','14','18','20','23','27','29','32','36','38','41','45','47','50');
    if(in_array($i, $index_size1)){
        $pakery_class = ' image_size1';
        $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_masonrys1');  
    }else{
        $pakery_class = ' image_size';
        $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_masonry'); 
    }    
    
?>
<div class="item <?php echo esc_attr($apr_post_term_filters).' '.esc_attr($masonry_class);?>">
    <div class="figcaption">
        <?php if ( has_post_thumbnail() ) : ?>
            <figure class="gallery-image">
                <div class="gallery-img">
					<a class="fancybox-thumb btn-fancybox" data-fancybox-group="fancybox-thumb"  href="<?php echo esc_url($apr_gallery_grid['src']);?>" title="">
						<i class="fa fa-search" aria-hidden="true"></i>
						<img width="<?php echo esc_attr($apr_gallery_grid['width']) ?>" height="<?php echo esc_attr($apr_gallery_grid['height']) ?>" src="<?php echo esc_url($apr_gallery_grid['src']) ?>" alt="<?php echo esc_html__('gallery','efarm') ?>" />    
					</a>
                </div>
            </figure>   
        <?php endif;?>   
    </div>  
</div>
<?php $i++;?>
<?php endwhile; ?>