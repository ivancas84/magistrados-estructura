<?php

require_once("class/model/Field.php");

class _FieldFileType extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "type";
  public $alias = "typ";
  public $entityName = "file";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
