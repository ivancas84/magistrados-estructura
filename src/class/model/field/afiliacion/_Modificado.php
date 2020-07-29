<?php

require_once("class/model/Field.php");

class _FieldAfiliacionModificado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = false;
  public $main = false;
  public $name = "modificado";
  public $alias = "moa";


  public function getEntity(){ return Entity::getInstanceRequire('afiliacion'); }


}
