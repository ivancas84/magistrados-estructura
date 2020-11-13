<?php

require_once("class/model/Field.php");

class _FieldImporteTramiteExcepcionalImporte extends Field {

  public $type = "varchar";
  public $fieldType = "_u";
  public $default = null;
  public $name = "importe";
  public $alias = "imp";
  public $entityName = "importe_tramite_excepcional";
  public $entityRefName = "importe";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
