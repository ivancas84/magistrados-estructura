<?php

require_once("class/model/Field.php");

class _FieldDepartamentoJudicialCodigo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "codigo";
  public $alias = "cod";
  public $entityName = "departamento_judicial";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
