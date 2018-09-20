
<?php


class Formbuilder {

  static function addInput ($name=null, $type='text', $class=null, $id=null, $label=null, $value=null) {

    $input = "";
    if($label !== null){
      $input = $input . "<label for='" . $name . "'>" . $label;
    }
    $input = $input . "<input type='". $type ."' name='". $name ."' value='". $value ."' class='". $class ."' id='" . $id . "'>";
    if($label !== null){
      $input = $input . "</label>";
    }
    return $input;
  }

  function addButton ($name, $class, $id, $text) {
    $btn = "<button name='". $name ."' class='". $class ."' id='". $id ."'>" . $text . "</button>";
    return $btn;
  }

  function addSeperator($class) {
    return "<hr class='". $class ."'>";
  }

  function addSelect($options = [], $class) {
    $select = "<select class='". $class ."'>";
    foreach($options as $opt){
      $select = $select . "<option value='". $opt ."'>";
    }
    $select = $select . "</select>";
    return $select;
  }

}
