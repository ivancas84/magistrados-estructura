<?php

require_once("class/model/Field.php");

class _FieldImporteAfiliacionAfiliacion extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "afiliacion";
  public $alias = "afi";
  public $entityName = "importe_afiliacion";
  public $entityRefName = "afiliacion";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
