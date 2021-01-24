<?php

require_once("class/model/Field.php");

class _FieldViaticoPeriodo extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $name = "periodo";
  public $alias = "per";
  public $entityName = "viatico";
  public $dataType = "date";  
  public $subtype = "date";  


}
