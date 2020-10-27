<?php

require_once("class/model/Field.php");

class _FieldPersonaNombres extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "nombres";
  public $alias = "nom";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
