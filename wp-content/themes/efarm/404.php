
<?php get_header(); ?>
<?php if(isset($apr_settings['404-overlay']) && $apr_settings['404-overlay']){
    $apr_overlay_class = 'overlay404';
}
?>
<div id="primary" class="site-content">
    <div id="content" role="main">
        <div class="page-404 text-center">
                <div class="page-404-container">
                    <div class="content-404">
                        <div class="content-desc">
                            <div class="heading404">                                         
                                    <div class="content404">
                                        <?php if(isset($apr_settings['404-title']) && $apr_settings['404-title'] !=''):?>
                                            <h1  class="title_404"><?php echo esc_html($apr_settings['404-title']);?></h1>
                                        <?php endif;?>
                                        <?php if(isset($apr_settings['404-content']) && $apr_settings['404-content'] !=''):?>
                                            <p><?php echo esc_html($apr_settings['404-content']);?></p>
                                        <?php endif;?>
                                        <p>
                                            <a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__('go back home', 'efarm');?><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                        </p>  
                                    </div>    
                                
                            </div>                      
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
