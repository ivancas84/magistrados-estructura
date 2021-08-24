<?php

require_once("class/model/Field.php");

class _FieldCuotaAsociativaDesde extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $name = "desde";
  public $alias = "des";
  public $entityName = "cuota_asociativa";
  public $dataType = "date";  
  public $subtype = "date";  


}
