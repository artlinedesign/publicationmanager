<?php

function createVerlag() {
  global $wpdb;
  $name = isset($_POST['name']) ? $_POST['name'] : '';

  if($name === null
      || $name === '') {
      showAdminErrorMessage( "Please fill out all required (*) fields");
      return;
  }

  if(checkDuplicates($name)){
      showAdminErrorMessage('Name already exists.');
      return;
  }

  $wpdb->insert("{$wpdb->prefix}publicationmanager_verlage", array(
      'name' => $name,
  ));

}

function checkDuplicates($name) {
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

?>
