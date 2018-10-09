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

function checkDuplicates($title){
    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->prefix}publicationmanager_publications";

    $publication = $wpdb->get_results( $sql, 'ARRAY_A' );

    foreach($publication as $p){
        if($p['name'] === $title){
            return true;
        }
    }
    return false;
}

function createPublication(){
    global $wpdb;
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $verlag = isset($_POST['verlag']) ? $_POST['verlag'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $sites = isset($_POST['sites']) ? $_POST['sites'] : '';
    $thumbnailUrl = isset($_POST['thumbnailUrl']) ? $_POST['thumbnailUrl'] : '';
    $url = isset($_POST['url']) ? $_POST['url'] : '';


    if($title === null
        || $author === null
        || $author === null
        || $verlag === null
        || $date === null
        || $sites === null
        || $thumbnailUrl === null
        || $url === null
        || $title === ''
        || $author === ''
        || $verlag === ''
        || $date === ''
        || $thumbnailUrl === ''
        || $url === ''
        || $sites === '') {
        showAdminErrorMessage( "Please fill out all fields");
        return;
    }
    if(checkDuplicates($title)){
        showAdminErrorMessage( "Title already exists");
        return;
    }


    $wpdb->insert("{$wpdb->prefix}publicationmanager_publications", array(
        'title' => $title,
        'author_id' => $author,
        'verlag_id' => $verlag,
        'sites' => $sites,
        'date' => $date,
        'thumbnail_url' => $thumbnailUrl,
        'url' => $url,
    ));

}

?>
