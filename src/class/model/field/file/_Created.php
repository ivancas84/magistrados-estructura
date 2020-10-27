<?php

require_once("class/model/Field.php");

class _FieldFileCreated extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $name = "created";
  public $alias = "cre";
  public $entityName = "file";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
