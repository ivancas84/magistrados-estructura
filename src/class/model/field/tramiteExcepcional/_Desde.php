<?php

require_once("class/model/Field.php");

class _FieldTramiteExcepcionalDesde extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $name = "desde";
  public $alias = "des";
  public $entityName = "tramite_excepcional";
  public $dataType = "date";  
  public $subtype = "date";  


}
