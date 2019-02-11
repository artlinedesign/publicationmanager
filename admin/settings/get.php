<?php





$theme_dir = '../../../../themes/avada-child-theme/';


$files = scandir($theme_dir);
foreach ($files as $file) {
    echo nl2br("\r\n$file", false);}