<?php

// add_action('redux/options/apr_settings/saved', 'apr_save_theme_settings', 10, 2);
// add_action('redux/options/apr_settings/import', 'apr_save_theme_settings', 10, 2);
// add_action('redux/options/apr_settings/reset', 'apr_save_theme_settings');
// add_action('redux/options/apr_settings/section/reset', 'apr_save_theme_settings');

function apr_config_value($value) {
    return isset($value) ? $value : 0;
}

//complie scss
function apr_save_theme_settings() {
    global $apr_settings;
    update_option('apr_init_theme', '1');
    global $aprReduxSettings;

    $reduxFramework = $aprReduxSettings->ReduxFramework;
    $template_dir = get_template_directory();

    // Compile SCSS Files
    // if (!class_exists('scssc')) {
    //     require_once( APR_ADMIN . '/sassphp/scss.inc.php' );
    // } 
}
