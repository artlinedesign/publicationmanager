<?php

function checkDuplicates($firstname, $lastname) {
    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->prefix}publicationmanager_authors";

    $authors = $wpdb->get_results( $sql, 'ARRAY_A' );

    foreach($authors as $author){
        if($author['firstname'] === $firstname && $author['lastname'] === $lastname){
            return true;
        }
    }
    return false;
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
      return;
  }

  if(checkDuplicates($firstname, $lastname)){
      showAdminErrorMessage('Author already exists.');
      return;
  }

  $wpdb->insert("{$wpdb->prefix}publicationmanager_authors", array(
      'title' => $title,
      'firstname' => $firstname,
      'lastname' => $lastname
  ));

}

?>
