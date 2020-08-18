<?php

require_once("class/model/Field.php");

class _FieldTipoDocumentoId extends Field {

  public $type = "varchar";
  public $fieldType = "pk";
  public $unique = true;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = true;
  public $name = "id";
  public $alias = "id";


  public function getEntity(){ return Entity::getInstanceRequire('tipo_documento'); }


}
