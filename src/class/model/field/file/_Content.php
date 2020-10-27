<?php

require_once("class/model/Field.php");

class _FieldFileContent extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "content";
  public $alias = "con";
  public $entityName = "file";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
