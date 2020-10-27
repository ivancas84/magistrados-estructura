<?php

require_once("class/model/Field.php");

class _FieldAfiliacionMotivo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "motivo";
  public $alias = "mot";
  public $entityName = "afiliacion";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
