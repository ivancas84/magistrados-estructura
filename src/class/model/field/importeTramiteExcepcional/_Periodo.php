<?php

require_once("class/model/Field.php");

class _FieldImporteTramiteExcepcionalPeriodo extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $name = "periodo";
  public $alias = "per";
  public $entityName = "importe_tramite_excepcional";
  public $dataType = "date";  
  public $subtype = "date";  


}
