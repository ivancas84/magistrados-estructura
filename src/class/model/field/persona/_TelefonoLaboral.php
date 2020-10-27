<?php

require_once("class/model/Field.php");

class _FieldPersonaTelefonoLaboral extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "telefono_laboral";
  public $alias = "tl";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
