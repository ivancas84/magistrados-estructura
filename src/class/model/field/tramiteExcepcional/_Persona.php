<?php

require_once("class/model/Field.php");

class _FieldTramiteExcepcionalPersona extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "persona";
  public $alias = "per";
  public $entityName = "tramite_excepcional";
  public $entityRefName = "persona";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}