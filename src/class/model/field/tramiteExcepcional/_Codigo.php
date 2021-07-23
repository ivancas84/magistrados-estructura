<?php

require_once("class/model/Field.php");

class _FieldTramiteExcepcionalCodigo extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $default = null;
  public $name = "codigo";
  public $alias = "cod";
  public $entityName = "tramite_excepcional";
  public $dataType = "integer";  
  public $subtype = "integer";  
  public $length = "10";  


}
