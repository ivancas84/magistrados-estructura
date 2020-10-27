<?php

require_once("class/model/Field.php");

class _FieldTramiteExcepcionalModificado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = null;
  public $name = "modificado";
  public $alias = "moa";
  public $entityName = "tramite_excepcional";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
