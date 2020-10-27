<?php

require_once("class/model/Field.php");

class _FieldPersonaNumeroDocumento extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "numero_documento";
  public $alias = "nd";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
