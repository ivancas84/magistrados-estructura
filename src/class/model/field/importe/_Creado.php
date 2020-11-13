<?php

require_once("class/model/Field.php");

class _FieldImporteCreado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $name = "creado";
  public $alias = "cre";
  public $entityName = "importe";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
