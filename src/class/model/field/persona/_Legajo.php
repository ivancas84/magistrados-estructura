<?php

require_once("class/model/Field.php");

class _FieldPersonaLegajo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "legajo";
  public $alias = "leg";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
