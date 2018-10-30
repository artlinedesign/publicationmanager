<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 11.10.18
 * Time: 11:43
 */

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

    if(checkBookDuplicates($title)){
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

    echo '<meta http-equiv="refresh" content="2" />';

    showAdminSuccessMessage("Book has been created.");


}

function checkBookDuplicates($title){
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


function checkAuthorDuplicates($firstname, $lastname) {
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

    if(checkAuthorDuplicates($firstname, $lastname)){
        showAdminErrorMessage('Author already exists.');
        return;
    }

    $wpdb->insert("{$wpdb->prefix}publicationmanager_authors", array(
        'title' => $title,
        'firstname' => $firstname,
        'lastname' => $lastname
    ));

    echo '<meta http-equiv="refresh" content="2" />';

    showAdminSuccessMessage("Author has been created.");


}


function checkArticleDuplicates($title){
    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->prefix}publicationmanager_articles";

    $publication = $wpdb->get_results( $sql, 'ARRAY_A' );

    foreach($publication as $p){
        if($p['name'] === $title){
            return true;
        }
    }
    return false;
}

function createArticle(){
    global $wpdb;
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $verlag = isset($_POST['verlag']) ? $_POST['verlag'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $thumbnailUrl = isset($_POST['thumbnailUrl']) ? $_POST['thumbnailUrl'] : '';
    $url = isset($_POST['url']) ? $_POST['url'] : '';


    if($title === null
        || $author === null
        || $author === null
        || $verlag === null
        || $date === null
        || $thumbnailUrl === null
        || $url === null
        || $title === ''
        || $author === ''
        || $verlag === ''
        || $date === ''
        || $thumbnailUrl === ''
        || $url === '') {
        showAdminErrorMessage( "Please fill out all fields");
        return;
    }
    if(checkArticleDuplicates($title)){
        showAdminErrorMessage( "Title already exists");
        return;
    }


    $wpdb->insert("{$wpdb->prefix}publicationmanager_articles", array(
        'title' => $title,
        'author_id' => $author,
        'verlag_id' => $verlag,
        'date' => $date,
        'thumbnail_url' => $thumbnailUrl,
        'url' => $url,
    ));

    echo '<meta http-equiv="refresh" content="2" />';

    showAdminSuccessMessage("Article has been created.");


}

function checkPublicationDuplicates($title){
    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->prefix}publicationmanager_publications";

    $publication = $wpdb->get_results( $sql, 'ARRAY_A' );

    foreach($publication as $p){
        if($p['title'] === $title){
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
    $thumbnailUrl = isset($_POST['thumbnailUrl']) ? $_POST['thumbnailUrl'] : '';
    $url = isset($_POST['url']) ? $_POST['url'] : '';

    if($title === null
        || $author === null
        || $author === null
        || $verlag === null
        || $date === null
        || $thumbnailUrl === null
        || $url === null
        || $title === ''
        || $author === ''
        || $verlag === ''
        || $date === ''
        || $thumbnailUrl === ''
        || $url === '') {
        showAdminErrorMessage( "Please fill out all fields");
        return;
    }
    if(checkPublicationDuplicates($title)){
        showAdminErrorMessage( "Title already exists");
        return;
    }


    $wpdb->insert("{$wpdb->prefix}publicationmanager_publications", array(
        'title' => $title,
        'author_id' => $author,
        'verlag_id' => $verlag,
        'date' => $date,
        'thumbnail_url' => $thumbnailUrl,
        'url' => $url,
    ));

    echo '<meta http-equiv="refresh" content="2" />';


    showAdminSuccessMessage("Publication has been created.");


}

function createVerlag() {
    global $wpdb;
    $name = isset($_POST['name']) ? $_POST['name'] : '';

    if($name === null
        || $name === '') {
        showAdminErrorMessage( "Please fill out all required (*) fields");
        return;
    }

    if(checkVerlagDuplicates($name)){
        showAdminErrorMessage('Name already exists.');
        return;
    }

    $wpdb->insert("{$wpdb->prefix}publicationmanager_verlage", array(
        'name' => $name,
    ));

    echo '<meta http-equiv="refresh" content="2" />';

    showAdminSuccessMessage("Publisher has been created.");
}

function checkVerlagDuplicates($name) {
    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->prefix}publicationmanager_verlage";

    $verlage = $wpdb->get_results( $sql, 'ARRAY_A' );

    foreach($verlage as $verlag){
        if($verlag['name'] === $name){
            return true;
        }
    }
    return false;
}

function getPublications($start = 0, $amount = 5) {
    global $wpdb;

    $sql = "SELECT {$wpdb->prefix}publicationmanager_publications.ID,{$wpdb->prefix}publicationmanager_authors.title AS author_title, {$wpdb->prefix}publicationmanager_authors.firstname, {$wpdb->prefix}publicationmanager_authors.lastname, url,thumbnail_url, date, {$wpdb->prefix}publicationmanager_publications.title, {$wpdb->prefix}publicationmanager_verlage.name AS verlag FROM {$wpdb->prefix}publicationmanager_publications LEFT JOIN {$wpdb->prefix}publicationmanager_authors ON author_id = {$wpdb->prefix}publicationmanager_authors.id LEFT JOIN {$wpdb->prefix}publicationmanager_verlage ON verlag_id = {$wpdb->prefix}publicationmanager_verlage.id LIMIT " . $start . ", ". $amount;


    $publications = $wpdb->get_results( $sql, 'ARRAY_A' );

    return $publications;

}

function getPublicationEntryAmount(){
    global $wpdb;

    $sql = "SELECT COUNT(*) AS amount FROM {$wpdb->prefix}publicationmanager_publications";


    $amount = $wpdb->get_results( $sql, 'ARRAY_A' );


    return $amount[0]['amount'];

}

function getArticles($start = 0, $amount = 5) {
    global $wpdb;

    $sql = "SELECT {$wpdb->prefix}publicationmanager_articles.ID,{$wpdb->prefix}publicationmanager_authors.title AS author_title, {$wpdb->prefix}publicationmanager_authors.firstname, {$wpdb->prefix}publicationmanager_authors.lastname, url,thumbnail_url,date, {$wpdb->prefix}publicationmanager_articles.title, {$wpdb->prefix}publicationmanager_verlage.name AS verlag FROM {$wpdb->prefix}publicationmanager_articles LEFT JOIN {$wpdb->prefix}publicationmanager_authors ON author_id = {$wpdb->prefix}publicationmanager_authors.id LEFT JOIN {$wpdb->prefix}publicationmanager_verlage ON verlag_id = {$wpdb->prefix}publicationmanager_verlage.id LIMIT " . $start . ", ". $amount;


    $publications = $wpdb->get_results( $sql, 'ARRAY_A' );

    return $publications;

}

function getArticlesEntryAmount(){
    global $wpdb;

    $sql = "SELECT COUNT(*) AS amount FROM {$wpdb->prefix}publicationmanager_articles";


    $amount = $wpdb->get_results( $sql, 'ARRAY_A' );


    return $amount[0]['amount'];

}

function getAllBooks() {
    global $wpdb;

    $sql = "SELECT {$wpdb->prefix}publicationmanager_books.ID,{$wpdb->prefix}publicationmanager_authors.title AS author_title, {$wpdb->prefix}publicationmanager_authors.firstname, {$wpdb->prefix}publicationmanager_authors.lastname, url,thumbnail_url,edition, {$wpdb->prefix}publicationmanager_books.title, {$wpdb->prefix}publicationmanager_verlage.name AS verlag FROM {$wpdb->prefix}publicationmanager_books LEFT JOIN {$wpdb->prefix}publicationmanager_authors ON author_id = {$wpdb->prefix}publicationmanager_authors.id LEFT JOIN {$wpdb->prefix}publicationmanager_verlage ON verlag_id = {$wpdb->prefix}publicationmanager_verlage.id";


    $publications = $wpdb->get_results( $sql, 'ARRAY_A' );

    return $publications;

}

?>