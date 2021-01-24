<?php

require_once("class/model/Field.php");

class _FieldViaticoOrgano extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "organo";
  public $alias = "org";
  public $entityName = "viatico";
  public $entityRefName = "organo";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
