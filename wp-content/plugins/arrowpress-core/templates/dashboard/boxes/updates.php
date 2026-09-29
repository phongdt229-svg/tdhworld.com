<?php

do_action('arrowpress_core_background_check_update_theme');

$theme_data      = Arrowpress_Theme_Manager::get_metadata();
$template        = $theme_data['template'];
$current_version = $theme_data['version'];

$update_themes = Arrowpress_Product_Registration::get_update_themes();
$themes        = $update_themes['themes'];
$last_checked  = $update_themes['last_checked'];

$data = isset($themes[$template]) ? $themes[$template] : false;

$is_active  = Arrowpress_Product_Registration::is_active();
$link_check = Arrowpress_Dashboard::get_link_main_dashboard(
	array(
		'force-check' => 1,
	)
);
$can_update = Arrowpress_Theme_Manager::can_update();

$class = $is_active ? 'active-registration' : 'inactive-registration';
// $personal_token = get_option( 'arrowpress_personal_token' );
$personal_token = Arrowpress_Product_Registration::get_data_theme_register('personal_token');

?>
<div class="tc-box-body">
	<div class="td-box-welcome-admin">
		<div class="box-left">
			<p>
				<?php printf(
					__(
						'Thanks for installing the %1$s theme. If this is the first time you work with %1$s, please read and follow
			the instructions carefully. This is the getting started section of %1$s Theme Dashboard.',
						'arrowpress-core'
					),
					esc_attr($data['name'])
				); ?>
			</p>
			<a href="<?php echo admin_url('admin.php?page=arrowpress-getting-started'); ?>" class="tc-button-box tc-button-black"><?php esc_html_e('Let\'s get started', 'arrowpress-core'); ?></a>
		</div>
		<div class="box-right">
			<?php
			if (!$data) {
				$data_info = array(
					'title'      => __('Something went wrong!', 'arrowpress-core'),
					'desc'       => __('Please try again later.', 'arrowpress-core'),
					'class'      => 'no-info-theme',
					'btn-update' => '',
				);
			} else {
				if ($can_update) {
					$data_info = array(
						'title' => sprintf(__('<span style="color: red">Version %1$s</span> available.', 'arrowpress-core'), $data['version']),
						'class' => 'has-update',
						'desc'  => __('Your Version is', 'arrowpress-core') . ' ' . $current_version
					);
					if ($is_active) {
						if (empty($personal_token)) {
							$data_info['btn-update'] = '<div class="update-notice"><a href="' . esc_url(admin_url('/admin.php?page=arrowpress-license')) . '" >' . esc_html__('Add personal token', 'arrowpress-core') . '</a></div>';
						} else {
							$data_info['btn-update'] = '<div class="update-message"><button class="button-link tc-update-now" type="button">' . esc_html__('Update now', 'arrowpress-core') . '</button></div>';
						}
					} else {
						$data_info['btn-update'] = '<div class="update-notice"><a href="' . esc_url(admin_url('/admin.php?page=arrowpress-license')) . '" class="active-theme-now">' . esc_html__('Active Theme Now', 'arrowpress-core') . '</a></div>';
					}
				} else {
					$data_info = array(
						'title'      => __('Theme is up to date', 'arrowpress-core'),
						'class'      => 'no-update',
						'desc'       => __('Your Version is', 'arrowpress-core') . ' ' . $current_version,
						'btn-update' => '',
					);
				}
			}

			$requirements_notification = apply_filters('arrowpress_core_number_requirements_notification', 0);
			if ($requirements_notification > 0) {
				$requiremen_info = array(
					'title' => __('Something wrong', 'arrowpress-core'),
					'desc'  => __('We detected ' . $requirements_notification . ' issues', 'arrowpress-core'),
					'link'  => admin_url('admin.php?page=arrowpress-system-status'),
					'icon'  => '',
				);
			} else {
				$requiremen_info = array(
					'title' => __('All is Good', 'arrowpress-core'),
					'desc'  => __('Nothing wrong found', 'arrowpress-core'),
					'icon'  => ' reqirements-success',
				);
			}
			?>
			<div class="box box-info-update <?php echo esc_attr($data_info['class']); ?>">
				<span class="icon"></span>
				<h5><?php echo $data_info['title']; ?></h5>
				<p><?php echo $data_info['desc']; ?></p>
				<?php echo $data_info['btn-update']; ?>
			</div>
			<div class="box box-info-reqirements<?php echo $requiremen_info['icon']; ?>">
				<span class="icon"></span>
				<h5><?php echo $requiremen_info['title']; ?></h5>
				<p><?php echo $requiremen_info['desc']; ?></p>
				<?php
				if (isset($requiremen_info['link'])) {
					echo '<div class="update-notice"><a href="' . $requiremen_info['link'] . '">Resolve now</a></div>';
				}
				?>
			</div>
		</div>
	</div>
</div>