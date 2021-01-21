<?php

require_once("class/model/Field.php");

class _FieldTramiteExcepcionalModificacion extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "modificacion";
  public $alias = "mob";
  public $entityName = "tramite_excepcional";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
