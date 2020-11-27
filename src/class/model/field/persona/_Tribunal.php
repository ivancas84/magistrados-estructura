<?php

require_once("class/model/Field.php");

class _FieldPersonaTribunal extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "tribunal";
  public $alias = "tri";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
