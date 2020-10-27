<?php

require_once("class/model/Field.php");

class _FieldPersonaTipoDocumento extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "tipo_documento";
  public $alias = "td";
  public $entityName = "persona";
  public $entityRefName = "tipo_documento";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
