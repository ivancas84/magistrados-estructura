<?php

require_once("class/model/Field.php");

class _FieldImporteAfiliacionImporte extends Field {

  public $type = "varchar";
  public $fieldType = "_u";
  public $default = null;
  public $name = "importe";
  public $alias = "imp";
  public $entityName = "importe_afiliacion";
  public $entityRefName = "importe";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
