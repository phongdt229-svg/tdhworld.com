<form role="search" method="get" id="searchform" class="searchform product-search" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="search-form">
        <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php echo esc_html__("Enter the keyword...", "efarm") ?>"/>
        <button type="submit" id="searchsubmit" class="button btn-search"><i class="fa fa-search"></i></button>
		<?php 
            if (get_post_type()=='post') {
                echo  '<input type="hidden" name="post_type" value="post" />';
            } else if (get_post_type()=='gallery') {
                echo  '<input type="hidden" name="post_type" value="gallery" />';
            } else {
		        if(class_exists( 'WooCommerce' )) {
		            echo  '<input type="hidden" name="post_type" value="product" />';
		        }            	 
            } 
		?>       
    </div>
</form>