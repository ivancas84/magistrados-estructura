<?php

require_once("class/model/Field.php");

class _FieldConfiguracionValoresNombre extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "nombre";
  public $alias = "nom";
  public $entityName = "configuracion_valores";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
