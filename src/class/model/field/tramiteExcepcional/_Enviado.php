<?php

require_once("class/model/Field.php");

class _FieldTramiteExcepcionalEnviado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = null;
  public $name = "enviado";
  public $alias = "env";
  public $entityName = "tramite_excepcional";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
