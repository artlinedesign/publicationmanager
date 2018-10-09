<?php

function getAuthorsList(){
    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->prefix}publicationmanager_authors";

    $authors = $wpdb->get_results( $sql, 'ARRAY_A' );

    return $authors;
}

function getVerlageList(){
    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->prefix}publicationmanager_verlage";

    $verlage = $wpdb->get_results( $sql, 'ARRAY_A' );

    return $verlage;
}

function createBook() {
  global $wpdb;

  $edition = isset($_POST['edition']) ? $_POST['edition'] : '';
  $verlag = isset($_POST['verlag']) ? $_POST['verlag'] : '';
  $author = isset($_POST['author']) ? $_POST['author'] : '';
  $thumbnailUrl = isset($_POST['thumbnailUrl']) ? $_POST['thumbnailUrl'] : '';
  $url = isset($_POST['url']) ? $_POST['url'] : '';
  $title = isset($_POST['title']) ? $_POST['title'] : '';


    if($title === null
        || $author === null
        || $edition === null
        || $verlag === null
        || $thumbnailUrl === null
        || $url === null
        || $title === ''
        || $author === ''
        || $verlag === ''
        || $edition === ''
        || $thumbnailUrl === ''
        || $url === ''){
        showAdminErrorMessage( "Please fill out all fields");
        return;
    }

  if(checkDuplicates($title)){
      showAdminErrorMessage('Title already exists.');
      return;
  }

    $wpdb->insert("{$wpdb->prefix}publicationmanager_books", array(
        'title' => $title,
        'edition' => $edition,
      'verlag_id' => $verlag,
      'author_id' => $author,
      'thumbnail_url' => $thumbnailUrl,
      'url' => $url,
  ));

}

function checkDuplicates($title){
    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->prefix}publicationmanager_books";

    $books = $wpdb->get_results( $sql, 'ARRAY_A' );

    foreach($books as $b){
        if($b['title'] === $title){
            return true;
        }
    }
    return false;
}
?>
