<?php

function getAllAuthors() {


  global $wpdb;
    $version = get_option( 'my_plugin_version', '1.0' );
  $charset_collate = $wpdb->get_charset_collate();
  return $wpdb->get_results("select * from wp_publicationmanager_authors");




}

function createAthor() {
  
}

?>
