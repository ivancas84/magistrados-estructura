<?php

require_once("class/model/Field.php");

class _FieldPersonaTelefonoParticular extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "telefono_particular";
  public $alias = "tp";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
