
<?php


class Formbuilder {

  static function addInput ($name=null, $type='text', $class=null, $id=null, $label=null, $value=null) {

    $input = "";
    if($label !== null){
      $input = $input . "<label for='" . $name . "'><span class='form-group-label'>" . $label ."</span>";
    }
    $input = $input . "<input type='". $type ."' name='". $name ."' value='". $value ."' class='". $class ."' id='" . $id . "'>";
    if($label !== null){
      $input = $input . "</label>";
    }
    return $input;
  }

  static function addButton ($name, $class, $id, $text) {
    $btn = "<button name='". $name ."' class='". $class ."' id='". $id ."'>" . $text . "</button>";
    return $btn;
  }

  static function addSeperator($class) {
    return "<hr class='". $class ."'>";
  }

  static function addSelect($options = [], $name, $class = null, $label = null) {
      $select = "";
      if($label !== null){
          $select = $select . "<label><span class='form-group-label'>" . $label ."</span>";;
      }
    $select = $select . "<select name='". $name ."' class='". $class ."'>";
    foreach($options as $opt){
        $value = $opt['value'];
        $text = $opt['text'];
        if($opt['selected']){
          $select = $select . "<option value='". $value ."' selected>". $text ."</option>";

        }else {
          $select = $select . "<option value='". $value ."'>". $text ."</option>";
        }
    }
    $select = $select . "</select>";
      if($label !== null){
          $select = $select . "</label>";
      }
    return $select;
  }

}
