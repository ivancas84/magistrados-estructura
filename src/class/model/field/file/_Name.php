<?php

require_once("class/model/Field.php");

class _FieldFileName extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "name";
  public $alias = "nam";
  public $entityName = "file";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
