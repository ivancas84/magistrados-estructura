<?php

require_once("class/model/Field.php");

class _FieldOrganoDescripcion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "descripcion";
  public $alias = "des";
  public $entityName = "organo";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
