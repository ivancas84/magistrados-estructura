<?php

require_once("class/model/Field.php");

class _FieldPersonaEmail extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "email";
  public $alias = "ema";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
