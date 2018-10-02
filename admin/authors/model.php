<?php

function getAllAuthors() {


  global $wpdb;
    $version = get_option( 'my_plugin_version', '1.0' );
  $charset_collate = $wpdb->get_charset_collate();
  return $wpdb->get_results("select * from wp_publicationmanager_authors");




}

function createAuthor() {
  var_dump($_POST);
  global $wpdb;
  $title = isset($_POST['title']) ? $_POST['title'] : '';
  $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
  $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';

  $wpdb->insert("{$wpdb->prefix}publicationmanager_authors", array(
      'title' => $title,
      'firstname' => $firstname,
      'lastname' => $lastname
  ));

}

?>
