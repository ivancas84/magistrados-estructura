<?php

require_once("class/model/Field.php");

class _FieldTramiteExcepcionalMonto extends Field {

  public $type = "decimal";
  public $fieldType = "nf";
  public $default = null;
  public $name = "monto";
  public $alias = "mon";
  public $entityName = "tramite_excepcional";
  public $dataType = "float";  
  public $subtype = "float";  
  public $length = "20,2";  


}
