<?php

require_once("class/model/Field.php");

class _FieldAfiliacionEnviado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = null;
  public $name = "enviado";
  public $alias = "env";
  public $entityName = "afiliacion";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
