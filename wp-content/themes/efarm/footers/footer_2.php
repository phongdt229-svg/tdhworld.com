<?php
$apr_settings = apr_check_theme_options();
?>
<div class="footer-section">
	<div class="center_footer">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<?php 
						if(isset($apr_settings['logo_footer']['url']) && $apr_settings['logo_footer']['url']!=''){
							$logo_footer = (apr_get_meta_value('logo_footer_page') != '') ? apr_get_meta_value('logo_footer_page') : $apr_settings['logo_footer']['url'];
						}
                	?>                
                    <?php
                    if (isset($logo_footer) && $logo_footer != ''):
                        echo '<img class="" width="132"  src="' . esc_url(str_replace(array('http:', 'https:'), '', $logo_footer)) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                    endif;
                    ?>
					<?php if (isset($apr_settings['footer-info']) && $apr_settings['footer-info']) : ?>
						<div class="footer_info">
							<p><?php echo force_balance_tags(wp_kses($apr_settings['footer-info'],array('i'=>array('class' =>array()),
								'a'=>array(
									'href'=>array(), 
									'target' =>array()
									),
								'br' => array())
								)); ?></p>	
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
	<?php
		if (is_active_sidebar('footer-newsletter')) {
		?> 
		<div class="footer-newsletter">
			<div class="container">
				<div class="footer-mailchimp">
					<?php dynamic_sidebar('footer-newsletter'); ?>
				</div>
			</div>
		</div>
		<?php
		}
	?>
</div>
<div class="footer-top">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="footer-container row"> 								
					<?php

						$cols = 0;
						for ($i = 1; $i <= 4; $i++) {
							if (is_active_sidebar('footer-column-' . $i))
								$cols++;
						}
					?>
					<?php
					if ($cols) :
						$col_class = array();
						switch ($cols) {
							case 1:
								$col_class[1] = 'col-sm-12';
								break;
							case 2:
								$col_class[1] = 'col-sm-6 col-xs-6 col-md-6';
								$col_class[2] = 'col-sm-6 col-xs-6 col-md-6';
								break;
							case 3:
								$col_class[1] = 'col-xs-6 col-sm-4 col-md-4';
								$col_class[2] = 'col-xs-6 col-sm-4 col-md-4';
								$col_class[3] = 'col-xs-12 col-sm-4 col-md-4';
								break;
							case 4:
								$col_class[1] = 'col-xs-12 col-sm-6 col-md-3';
								$col_class[2] = 'col-xs-12 col-sm-6 col-md-3';
								$col_class[3] = 'col-xs-12 col-sm-6 col-md-3';
								$col_class[4] = 'col-xs-12 col-sm-6 col-md-3';
								break;
						}
					?>
					<?php endif; ?>
					<div class="footer-menu-list">
						<?php
						$cols = 1;
						for ($i = 1; $i <= 4; $i++) {
							if (is_active_sidebar('footer-column-' . $i)) {
								?>
								<div class="<?php echo esc_attr($col_class[$cols++]) ?>">
									<?php dynamic_sidebar('footer-column-' . $i); ?>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<?php if ($apr_settings['footer-copyright']) : ?>
				<div class="col-md-6 col-sm-6 col-xs-12 copy-right">
					<p><?php echo force_balance_tags(wp_kses($apr_settings['footer-copyright'],array('i'=>array('class' =>array()),
						'a'=>array(
							'href'=>array(), 
							'target' =>array()
							))
						)); ?></p>
				</div>
				<?php endif;?>
				<?php if (isset($apr_settings['show-payment']) && $apr_settings['show-payment']) : ?>
				<div class="col-md-6 col-sm-6 col-xs-12 f-float">
					<div class="payment">
						<ul>
							<?php if (!empty($apr_settings['link-visa'])): ?>
								<li><a href="<?php echo esc_url($apr_settings['link-visa']); ?>"><i class="fa fa-cc-visa"></i></a></li>
							<?php endif; ?>
							<?php if (!empty($apr_settings['link-paypal'])): ?>
								<li><a href="<?php echo esc_url($apr_settings['link-paypal']); ?>"><i class="fa fa-cc-paypal"></i></a></li>
							<?php endif; ?>
							<?php if (!empty($apr_settings['link-mastercard'])): ?>
								<li><a href="<?php echo esc_url($apr_settings['link-mastercard']); ?>"><i class="fa fa-cc-mastercard"></i></a></li>
							<?php endif; ?>
							<?php if (!empty($apr_settings['link-discover'])): ?>
								<li><a href="<?php echo esc_url($apr_settings['link-discover']); ?>"><i class="fa fa-cc-discover"></i></a></li>
							<?php endif; ?>
							<?php if (!empty($apr_settings['link-amex'])): ?>
								<li><a href="<?php echo esc_url($apr_settings['link-amex']); ?>"><i class="fa fa-cc-amex"></i></a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<?php endif;?>
			</div>
		</div>
	</div>