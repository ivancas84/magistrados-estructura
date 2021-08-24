<?php

require_once("class/model/Field.php");

class _FieldViaticoOrgano extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "organo";
  public $alias = "org";
  public $entityName = "viatico";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
