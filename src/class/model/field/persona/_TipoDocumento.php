<?php

require_once("class/model/Field.php");

class _FieldPersonaTipoDocumento extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "tipo_documento";
  public $alias = "td";


  public function getEntity(){ return Entity::getInstanceRequire('persona'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('tipo_documento'); }


}
