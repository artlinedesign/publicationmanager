
<?php


class Formbuilder {

  static function addInput ($name=null, $type='text', $class=null, $id=null, $label=null) {

    $input = "";
    if($label !== null){
      $input = $input . "<label for='" . $name . "'>";
    }
    $input = $input . "<input type='". $type ."' name='". $name ."' value='". $value ."' class='". $class ."' id='" . $id . "'>";
    if($label !== null){
      $input = $input . "</label>";
    }

  }

  function addButton ($type, $name, $class, $id) {

  }



  function addSeperator($class) {

  }


  function addSelect($options, $class) {

  }


}
