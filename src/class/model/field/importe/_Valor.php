<?php

require_once("class/model/Field.php");

class _FieldImporteValor extends Field {

  public $type = "decimal";
  public $fieldType = "nf";
  public $default = null;
  public $name = "valor";
  public $alias = "val";
  public $entityName = "importe";
  public $dataType = "float";  
  public $subtype = "float";  
  public $length = "12,2";  


}
