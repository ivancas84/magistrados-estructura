<?php

require_once("class/model/Field.php");

class _FieldTramiteExcepcionalDepartamentoJudicialInformado extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "departamento_judicial_informado";
  public $alias = "dji";
  public $entityName = "tramite_excepcional";
  public $entityRefName = "departamento_judicial";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
