<?php

require_once("class/model/Field.php");

class _FieldConfiguracionValoresCreado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $name = "creado";
  public $alias = "cre";
  public $entityName = "configuracion_valores";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
