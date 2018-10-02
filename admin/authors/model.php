<?php

function getAllAuthors() {


  global $wpdb;
    $version = get_option( 'my_plugin_version', '1.0' );
  $charset_collate = $wpdb->get_charset_collate();
  return $wpdb->get_results("select * from wp_publicationmanager_authors");




}

function createAuthor() {
  global $wpdb;
  $title = isset($_POST['title']) ? $_POST['title'] : '';
  $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
  $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;

  if($firstname === null
      || $lastname === null
      || $firstname === ''
      || $lastname === '') {
      showAdminErrorMessage( "Please fill out all required (*) fields");
  }

  $wpdb->insert("{$wpdb->prefix}publicationmanager_authors", array(
      'title' => $title,
      'firstname' => $firstname,
      'lastname' => $lastname
  ));

}

?>
