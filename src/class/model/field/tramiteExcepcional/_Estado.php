<?php

require_once("class/model/Field.php");

class _FieldTramiteExcepcionalEstado extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "estado";
  public $alias = "est";
  public $entityName = "tramite_excepcional";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
