<?php

require_once("class/model/Field.php");

class _FieldCuotaAsociativaId extends Field {

  public $type = "varchar";
  public $fieldType = "pk";
  public $default = null;
  public $name = "id";
  public $alias = "id";
  public $entityName = "cuota_asociativa";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
