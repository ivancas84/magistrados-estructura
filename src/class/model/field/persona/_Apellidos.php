<?php

require_once("class/model/Field.php");

class _FieldPersonaApellidos extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "apellidos";
  public $alias = "ape";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
