<?php

require_once("class/model/Field.php");

class _FieldAfiliacionEvaluado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = null;
  public $name = "evaluado";
  public $alias = "eva";
  public $entityName = "afiliacion";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
