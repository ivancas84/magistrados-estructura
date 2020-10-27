<?php

require_once("class/model/Field.php");

class _FieldTramiteExcepcionalMotivo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "motivo";
  public $alias = "mot";
  public $entityName = "tramite_excepcional";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
