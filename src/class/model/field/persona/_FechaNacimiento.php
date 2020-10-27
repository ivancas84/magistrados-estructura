<?php

require_once("class/model/Field.php");

class _FieldPersonaFechaNacimiento extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $name = "fecha_nacimiento";
  public $alias = "fn";
  public $entityName = "persona";
  public $dataType = "date";  
  public $subtype = "date";  


}
