<?php

require_once("class/model/Field.php");

class _FieldTramiteExcepcionalSucursal extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = "1";
  public $name = "sucursal";
  public $alias = "suc";
  public $entityName = "tramite_excepcional";
  public $entityRefName = "sucursal";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
