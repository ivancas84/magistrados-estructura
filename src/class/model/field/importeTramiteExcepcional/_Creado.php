<?php

require_once("class/model/Field.php");

class _FieldImporteTramiteExcepcionalCreado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $name = "creado";
  public $alias = "cre";
  public $entityName = "importe_tramite_excepcional";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
