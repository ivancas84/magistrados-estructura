<?php

require_once("class/model/Field.php");

class _FieldViaticoValor extends Field {

  public $type = "decimal";
  public $fieldType = "nf";
  public $default = "0.00";
  public $name = "valor";
  public $alias = "val";
  public $entityName = "viatico";
  public $dataType = "float";  
  public $subtype = "float";  
  public $length = "12,2";  


}
