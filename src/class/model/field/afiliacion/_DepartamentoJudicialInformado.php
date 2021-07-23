<?php

require_once("class/model/Field.php");

class _FieldAfiliacionDepartamentoJudicialInformado extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "departamento_judicial_informado";
  public $alias = "dji";
  public $entityName = "afiliacion";
  public $entityRefName = "departamento_judicial";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
