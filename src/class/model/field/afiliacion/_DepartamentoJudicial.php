<?php

require_once("class/model/Field.php");

class _FieldAfiliacionDepartamentoJudicial extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "departamento_judicial";
  public $alias = "dj";
  public $entityName = "afiliacion";
  public $entityRefName = "departamento_judicial";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
