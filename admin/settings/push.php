<?php


    $plugin_dir = plugin_dir_path(__FILE__) . '/templates/test.php';
    $theme_dir = get_stylesheet_directory() .  '/test.php';

    if (!copy($plugin_dir, $theme_dir)) {
        echo "failed to copy $plugin_dir to $theme_dir...\n";
    }




