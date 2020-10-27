<?php

require_once("class/model/Field.php");

class _FieldFileSize extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $default = null;
  public $name = "size";
  public $alias = "siz";
  public $entityName = "file";
  public $dataType = "integer";  
  public $subtype = "integer";  
  public $length = "10";  


}
