<?php get_header(); 
	$apr_settings = apr_check_theme_options(); 
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
<?php 
	$apr_class = '';
	$apr_sidebar_left = apr_get_sidebar_left();
	$apr_sidebar_right = apr_get_sidebar_right();
	$apr_layout = apr_get_layout();	
	$apr_settings = apr_check_theme_options(); 
	$apr_recipe_search= isset($apr_settings['recipe-search']) ? $apr_settings['recipe-search'] :'1';
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
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?>