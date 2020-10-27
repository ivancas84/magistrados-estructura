<?php

require_once("class/model/Field.php");

class _FieldAfiliacionCreado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $name = "creado";
  public $alias = "cre";
  public $entityName = "afiliacion";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
