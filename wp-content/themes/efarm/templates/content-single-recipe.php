<?php 
    $apr_settings = apr_check_theme_options();      
?>
<div class="recipe recipe-single">
  <div class="recipe-single-content">
    <div class="recipe-item">
       <?php if(get_the_title() != ''):?>
          <div class="recipe-title">
              <h3><?php the_title(); ?> 
              </h3>         
          </div>
        <?php endif;?>
        <div class="recipe-info">
          <?php $apr_author_id= $post->post_author;?>
          <div class="info author">
            <span><?php echo esc_html__('Recipe by','efarm');?></span> 
            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author_meta( 'nickname' , $apr_author_id ); ?></a>
          </div>  
          <?php if (isset($apr_settings['recipe-meta']) && in_array('like', $apr_settings['recipe-meta'])) : ?>
            <div class="info info-like">
              <?php  if(function_exists('apr_getPostLikeLink')) {
              echo apr_getPostLikeLink( get_the_ID() );
              }
              ?>
            </div>  
          <?php endif;?>  
          <?php $count_star = get_post_meta(get_the_ID(),'star_rating', true); 
                $percent_star = $count_star*100/5;
                
              ?>
              <div class="info review-star">
                <?php echo apr_get_average_ratings(get_the_ID());?>
              </div>  
        </div>
     <?php 
        $attachment_id = get_post_thumbnail_id();
        $apr_recipe_single = apr_get_attachment($attachment_id, 'apr_recipe_single'); 
        if(!empty($apr_recipe_single['src'])):
      ?>
        <div class="recipe-img">  
          <img width="<?php echo esc_attr($apr_recipe_single['width']) ?>" height="<?php echo esc_attr($apr_recipe_single['height']) ?>" src="<?php echo esc_url($apr_recipe_single['src']) ?>" alt="<?php echo esc_html__('recipe','efarm') ?>" />    
        </div>
      <?php endif;?>
      <div class="recipe_post_desc">          
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
          <div class="recipes-details">
            <!-- Tab Nav -->
              <ul  class="nav nav-pills">
                <?php if (isset($apr_settings['recipe-tab']) && in_array('content', $apr_settings['recipe-tab'])) : ?>             
                <li class="active">
                  <a  href="#ingredient" data-toggle="tab"><i class="fa fa-spoon" aria-hidden="true"></i><?php echo esc_html__('I made it','efarm');?></a>
                </li>
                <?php endif;?>
                <?php if (isset($apr_settings['recipe-tab']) && in_array('comment', $apr_settings['recipe-tab'])) : ?>
                <li><a href="#recipe_comment" data-toggle="tab"><i class="fa fa-star-half-o" aria-hidden="true"></i><?php echo esc_html__('Rate it','efarm');?></a>
                </li>
                <?php endif;?>
                <?php if (isset($apr_settings['recipe-tab']) && in_array('share', $apr_settings['recipe-tab'])) : ?>
                <li><a href="#recipe_share" data-toggle="tab"><i class="fa fa-share-alt" aria-hidden="true"></i><?php echo esc_html__('Share','efarm');?></a>
                </li>
                <?php endif;?>
                <?php if (isset($apr_settings['recipe-tab']) && in_array('print', $apr_settings['recipe-tab'])) : ?>   
                    <?php if(isset($apr_settings['recipe_print_shortcode']) && $apr_settings['recipe_print_shortcode']!=''):?>
                        <li>
                            <?php echo do_shortcode($apr_settings['recipe_print_shortcode']);?>
                        </li>                        
                    <?php endif;?>             
                <?php endif;?>
              </ul>            
            <!-- End tab nav -->
            <!-- Tab content -->
            <div class="tab-content clearfix">
                <?php if (isset($apr_settings['recipe-tab']) && in_array('content', $apr_settings['recipe-tab'])) : ?>              
                  <div id="ingredient" class="tab-pane active recipe_ingredient_content">             
                    <div class="title-desc">    
                        <h4><?php echo esc_html__('Ingredients', 'efarm')?></h4>
                    </div>
                    <div class="recipes-content">
                        <div class="ingredients-container">
                            <ul>
                                <li class="time-recipe">
                                  <div class="icon">
                                     <i class="pe-7s-clock" aria-hidden="true"></i>
                                  </div>
                                  <?php if(get_post_meta(get_the_ID(),'time',true)!=''):?>
                                    <div class="info-recipes">
                                        <p class="name-recipes"><?php echo esc_html__('Time','efarm')?></p>
                                        <p class="time-recipes"> <?php echo sprintf(__('%s m', 'efarm'),esc_html(get_post_meta(get_the_ID(),'time', true)));?></p>
                                    </div>
                                  <?php endif;?>
                                </li>
                                <li class="servings-recipe">
                                   <div class="icon">
                                      <i class="pe-7s-graph"></i>
                                    </div>
                                    <div class="info-recipes">
                                        <?php $apr_ser_num = get_post_meta(get_the_ID(),'serving', true);?>
                                        <p class="ser-recipes">
                                        <?php echo sprintf(__('%s servings', 'efarm'),esc_html($apr_ser_num));?>
                                        </p>
                                    </div>
                                </li>
                                 <li class="cals-recipe">
                                   <div class="icon">
                                      <i class="pe-7s-graph3" aria-hidden="true"></i>
                                    </div>
                                    <div class="info-recipes">
                                        <p class="name-recipes"><?php echo esc_html__('Cals','efarm')?></p>
                                        <p class="clas-recipes"><?php echo sprintf(__('%s cals', 'efarm'),esc_html(get_post_meta(get_the_ID(),'cals', true)));?> </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                     <div class="recipes-desc">
                        <?php echo get_post_meta(get_the_ID(),'ingre', true);?>
                    </div>
      
                    <!-- Direction sections -->
                    <?php 
                      $prefix = 'arrowpress_core_';
                      $entries2 = get_post_meta( get_the_ID(), $prefix . 'direction_group', true );  
                      if(!empty($entries2)):?>
                      <div class="recipe_direction">
                        <div class="title-desc">    
                              <h4><?php echo esc_html__('Directions', 'efarm')?></h4>
                        </div>    
                         <div class="action-direction">
                             <?php if(isset($apr_settings['print_direction'])&&$apr_settings['print_direction']):?>
                                    <a class="print_direction"  href="#"><i class="fa fa-print" aria-hidden="true"></i><?php echo esc_html__('Print','efarm');?></a>
                                <?php endif;?>
                              <?php 
                                $recipe_video = get_post_meta(get_the_ID(), 'recipe_video',true);
                                if(isset($recipe_video) && $recipe_video !=''):?>
                                <a class="iframe_fancybox fancybox" data-fancybox href="<?php echo esc_url($recipe_video);?>"><i class="fa fa-video-camera" aria-hidden="true"></i><?php echo esc_html__('Watch Video','efarm');?></a>
                                <?php endif;?>
                               
                            </div>
                        <ul id="direction_list" class="direction_list">
                          <?php foreach ( (array) $entries2 as $key => $entry ) : ?>
                            <li>
                              <div class="img-recipe">
                                <?php if(isset($entry['re_image']) && $entry['re_image']!=''):?>
                                  <img src="<?php echo esc_url($entry['re_image']);?>" alt=""/>
                                <?php endif;?>
                              </div>
                              <?php if(isset($entry['re_description']) && $entry['re_description']!=''):?>
                                <div class="direction_text">
                                  <?php if(isset($entry['re_title']) && $entry['re_title']!=''):?>
                                    <h4 class="step_no">
                                      <?php echo esc_html($entry['re_title']);?>
                                    </h4>
                                  <?php endif;?>                
                                  <?php echo esc_html($entry['re_description']);?>
                                </div>
                              <?php endif;?>            
                            </li>        
                          <?php endforeach;?>
                        </ul>
                       </div>
                     <?php endif;?>                 
                  </div>
                <?php endif;?>
                <?php if (isset($apr_settings['recipe-tab']) && in_array('comment', $apr_settings['recipe-tab'])) : ?>
                    <div id="recipe_comment" class="tab-pane post-comments">
                      <?php comments_template('', true); ?>  
                    </div> 
                <?php endif;?>   
                <?php if (isset($apr_settings['recipe-tab']) && is_array($apr_settings['recipe-share']) && in_array('share', $apr_settings['recipe-tab'])) : ?>
                    <div id="recipe_share" class="tab-pane recipe_share" >
                        <div class="title-desc">    
                            <h4><?php echo esc_html__('Share', 'efarm')?></h4>
                        </div> 
                        <?php if (isset($apr_settings['recipe-share']) && in_array('facebook', $apr_settings['recipe-share'])) : ?>
                        <a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"><i class="fa fa-facebook-square"></i></a>
                        <?php endif;?>
                        <?php if (isset($apr_settings['recipe-share']) && in_array('twitter', $apr_settings['recipe-share'])) : ?>                        
                        <a href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-x-twitter"></i></a>
                        <?php endif;?>
                        <?php if (isset($apr_settings['recipe-share']) && in_array('google', $apr_settings['recipe-share'])) : ?>                        
                        <a href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>" target="_blank">
                            <i class="fa fa-google-plus"></i>
                        </a>
                        <?php endif;?>
                        <?php if (isset($apr_settings['recipe-share']) && in_array('linkin', $apr_settings['recipe-share'])) : ?>                        
                        <a href="http://www.linkedin.com/shareArticle?url=<?php echo urlencode(get_the_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <?php endif;?>
                        <?php if (isset($apr_settings['recipe-share']) && in_array('pin', $apr_settings['recipe-share'])) : ?>                        
                        <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_the_permalink()); ?>&media=<?php echo urlencode(wp_get_attachment_url( get_post_thumbnail_id() )); ?>&description=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a> 
                        <?php endif;?>               
                    </div>
                <?php endif;?>
                <?php if (isset($apr_settings['recipe-tab']) && in_array('print', $apr_settings['recipe-tab'])) : ?>        
                    <div id="recipe_print" class="tab-pane">
                      <div class="title-desc">    
                          <h4><?php echo esc_html__('Print', 'efarm')?></h4>
                      </div>                
                    </div>
                <?php endif;?>
            </div>
            <!-- End Tab content -->
          </div>
      </div>         

    </div>
  </div> 
</div>