<?php

require_once("class/model/Field.php");

class _FieldCuotaAsociativaValor extends Field {

  public $type = "decimal";
  public $fieldType = "nf";
  public $default = null;
  public $name = "valor";
  public $alias = "val";
  public $entityName = "cuota_asociativa";
  public $dataType = "float";  
  public $subtype = "float";  
  public $length = "10,3";  


}
