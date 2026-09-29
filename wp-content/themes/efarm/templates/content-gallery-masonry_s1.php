
<?php 
    $i=0;
    $apr_gallery_layout = isset($layout)?$layout:'';
?>
<?php while (have_posts()) : the_post(); ?>
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
<?php 
    $attachment_id = get_post_thumbnail_id();
    $pakery_class ='';
    if(isset($apr_gallery_layout) && $apr_gallery_layout == 'masonry_1'){
        $index_size1 = array('2','7','13','18','24','29','35','40','46','51');
        $index_size2 = array('3','5','8','14','16','19','25','27','30','36','38','41','47','49','52');
        if(in_array($i, $index_size1)){
            $pakery_class = 'image_size1';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_type1_s1'); 
        }elseif(in_array($i, $index_size2)){
            $pakery_class = 'image_size2';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_type1_s2'); 
        }else{
            $pakery_class = 'image_size';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_type1'); 
        }    
    }
    elseif(isset($apr_gallery_layout) && $apr_gallery_layout == 'masonry_2'){
        $index_size1 = array('0','6','7','13','14','20','21','27','28','36','37','43','44','50','51');
        if(in_array($i, $index_size1)){
            $pakery_class = ' image_size1';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_type2_s1');  
        }else{
            $pakery_class = ' image_size';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_type2'); 
        }    
    }
    elseif(isset($apr_gallery_layout) && $apr_gallery_layout == 'masonry_3'){
        $index_size1 = array('3','6','11','14','19','22','27','30','35','38','43','46','51');
        $index_size2 = array('1','5','9','13','17','21','25','29','33','37','41','45','49');
        $index_size3 = array('2','4','10','12','18','20','26','28','34','36','42','44','50');
        if(in_array($i, $index_size1)){
            $pakery_class = ' image_size1';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_type3_s1');  
        }elseif(in_array($i, $index_size2)){
            $pakery_class = 'image_size2';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_type3_s2');
        }elseif(in_array($i, $index_size3)){
            $pakery_class = 'image_size3';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_type3_s3'); 
        }else{
            $pakery_class = ' image_size';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_type3'); 
        }    
    }
    elseif(isset($apr_gallery_layout) && $apr_gallery_layout == 'masonry_4'){
        $index_size1 = array('0','6','7','13','14','20','21','27','28','34','35','41','42','48','49');
        $index_size2 = array('1','5','8','12','15','19','22','26','29','33','36','40','43','47');
        if(in_array($i, $index_size1)){
            $pakery_class = ' image_size1';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_type4_s1'); 
        }elseif(in_array($i, $index_size2)){
            $pakery_class = 'image_size2';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_type4_s2'); 
        }else{
            $pakery_class = 'image_size';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_type4'); 
        }         
    }
    elseif(isset($apr_gallery_layout) && $apr_gallery_layout == 'masonry_5'){
        $index_size1 = array('2','5','9','12','16','19','23','26','30','33','37','40','44','47');
        $index_size2 = array('0','6','7','13','14','20','21','27','28','34','35','41','42','48');
        if(in_array($i, $index_size1)){
            $pakery_class = ' image_size1';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_pakery2_s1');  
        }elseif(in_array($i, $index_size2)){
            $pakery_class = ' image_size2';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_pakery2_s2');  
        }else{
            $pakery_class = ' image_size';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_pakery2'); 
        }    
    }
    else{
        $index_size1 = array('1','5','7','11','13','17','19','23','25','29','31','35','37','41','43','47','49');
        if(in_array($i, $index_size1)){
            $pakery_class = 'image_size1';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_pakery_s1'); 
       }else{
            $pakery_class = 'image_size';
            $apr_gallery_grid = apr_get_attachment($attachment_id, 'apr_gallery_pakery'); 
        }    
    }
   
?> 
<div class="item <?php echo esc_attr($apr_post_term_filters).' '.esc_attr($pakery_class);?> ">
     <div class="figcaption">
        <?php if ( has_post_thumbnail() ) : ?>
            <figure class="gallery-image">
                <div class="gallery-img">
                    <?php 
                        $apr_gallery_full = apr_get_attachment($attachment_id, 'full'); 
                    ?>
                    <img width="<?php echo esc_attr($apr_gallery_grid['width']) ?>" height="<?php echo esc_attr($apr_gallery_grid['height']) ?>" src="<?php echo esc_url($apr_gallery_grid['src']) ?>" alt="<?php echo esc_html__('gallery','efarm') ?>" />  
                </div>
            </figure>   
        <?php endif;?>  
        <div class="gallery_body">
            <a href="<?php the_permalink();?>" class="gallery_title"><h4><?php the_title();?></h4></a>
            <div class="info category">
                <?php echo get_the_term_list(get_the_ID(),'gallery_cat', '', ' ' ); ?>
            </div>   
        </div>    
    </div>  
</div>
<?php $i++;?>
<?php endwhile; ?>   