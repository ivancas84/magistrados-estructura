<?php

require_once("class/model/Field.php");

class _FieldTramiteExcepcionalHasta extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $name = "hasta";
  public $alias = "has";
  public $entityName = "tramite_excepcional";
  public $dataType = "date";  
  public $subtype = "date";  


}
