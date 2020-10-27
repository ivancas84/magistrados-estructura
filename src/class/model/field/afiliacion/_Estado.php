<?php

require_once("class/model/Field.php");

class _FieldAfiliacionEstado extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "estado";
  public $alias = "est";
  public $entityName = "afiliacion";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
