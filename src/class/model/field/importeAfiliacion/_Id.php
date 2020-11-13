<?php

require_once("class/model/Field.php");

class _FieldImporteAfiliacionId extends Field {

  public $type = "varchar";
  public $fieldType = "pk";
  public $default = null;
  public $name = "id";
  public $alias = "id";
  public $entityName = "importe_afiliacion";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
