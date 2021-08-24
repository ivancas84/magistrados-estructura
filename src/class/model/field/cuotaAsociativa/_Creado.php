<?php

require_once("class/model/Field.php");

class _FieldCuotaAsociativaCreado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $name = "creado";
  public $alias = "cre";
  public $entityName = "cuota_asociativa";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
