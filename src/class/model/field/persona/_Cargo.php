<?php

require_once("class/model/Field.php");

class _FieldPersonaCargo extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "cargo";
  public $alias = "car";
  public $entityName = "persona";
  public $entityRefName = "cargo";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
